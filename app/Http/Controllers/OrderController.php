<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Storage, Validator, Log, DB};
use App\Models\{Order, Status, Product, Role, Transaction, User, Payment};
use Carbon\Carbon;

class OrderController extends Controller
{
    // 🧾 Hiển thị form đặt hàng
    public function makeOrderGet($productId)
    {
        $product = Product::findOrFail($productId);
        $payments = Payment::all(); // ✅ Lấy danh sách phương thức thanh toán

        return view('order.make_order', [
            'title' => 'Make Order',
            'product' => $product,
            'payments' => $payments // ✅ Truyền sang view
        ]);
    }

    // 🧩 Tạo đơn hàng mới
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $validatedData = $request->validate([
    'product_id' => 'required|exists:products,id',
    'quantity' => 'required|integer|min:1',
    'address' => 'required|string|max:255',
    'total_price' => 'required|numeric|min:0',
    'payment_id' => 'required|exists:payments,id',
    'bank_id' => 'required_if:payment_id,1|nullable|exists:banks,id', // ✅ Thêm dòng này
    'note_id' => 'nullable|exists:notes,id',
    'shipping_address' => 'nullable|string|max:255',
], [
    // ✅ Thông báo lỗi dễ hiểu hơn
    'payment_id.required' => 'Vui lòng chọn phương thức thanh toán.',
    'bank_id.required_if' => 'Vui lòng chọn ngân hàng khi thanh toán chuyển khoản.',
    'quantity.min' => 'Số lượng phải lớn hơn 0.',
]);


        $data = [
            'product_id' => $validatedData['product_id'],
            'user_id' => $user->id,
            'quantity' => $validatedData['quantity'],
            'address' => $validatedData['address'],
            'shipping_address' => $request->input('shipping_address') ?: null,
            'total_price' => $validatedData['total_price'],
            'payment_id' => $validatedData['payment_id'] ?? null,
            'bank_id' => $validatedData['bank_id'] ?? null,
            'note_id' => $validatedData['note_id'] ?? null,
            'status_id' => 1, // Mặc định: Chờ duyệt
            'transaction_doc' => null,
            'is_done' => 0,
        ];

        try {
            DB::beginTransaction();
            Order::create($data);
            DB::commit();

            return redirect()->back()->with('success', 'Đơn hàng đã được tạo thành công, vui lòng chờ duyệt!');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Order store failed: '.$e->getMessage(), ['trace'=>$e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Có lỗi khi tạo đơn: '.$e->getMessage());
        }
    }

    // 🗂️ Dữ liệu đơn hàng đang xử lý
    public function orderData()
    {
        $title = "Dữ Liệu Đơn Hàng";
        $currentUser = Auth::user();

        if (!$currentUser) {
            return redirect()->route('login');
        }

        $orders = Order::with(['bank', 'note', 'payment', 'user', 'status', 'product'])
            ->where('is_done', 0)
            ->when($currentUser->role_id != 1, function($query) use ($currentUser) {
                return $query->where('user_id', $currentUser->id);
            })
            ->orderBy('id', 'ASC')
            ->get();

        $status = Status::all();
        return view('order.order_data', compact('title', 'orders', 'status'));
    }

    // 🔍 Lọc đơn hàng theo trạng thái
    public function orderDataFilter(Request $request, $status_id)
    {
        $title = "Dữ Liệu Đơn Hàng";
        $orders = Order::with(['bank', 'note', 'payment', 'user', 'status', 'product'])
            ->where('status_id', $status_id)
            ->orderBy('id', 'ASC')
            ->get();
        $status = Status::all();

        return view('order.order_data', compact('title', 'orders', 'status'));
    }

    // 📄 Lấy chi tiết đơn hàng
    public function getOrderData(Order $order)
    {
        $order->load(['product', 'user', 'note', 'status', 'bank', 'payment']);
        return $order;
    }

    // 🕒 Lịch sử đơn hàng
    public function orderHistory()
    {
        $title = "Lịch Sử Đơn Hàng";
        $currentUser = Auth::user();

        if (!$currentUser) {
            return redirect()->route('login');
        }

        $orders = Order::with(['bank', 'note', 'payment', 'user', 'status', 'product', 'approver'])
            ->where('is_done', 1)
            ->when($currentUser->role_id != 1, function($query) use ($currentUser) {
                return $query->where('user_id', $currentUser->id);
            })
            ->orderBy('id', 'DESC')
            ->get();

        $status = Status::all();
        return view('order.order_data', compact('title', 'orders', 'status'));
    }

    // ✅ Duyệt đơn hàng
    public function approveOrder(Order $order)
    {
        try {
            $currentUser = Auth::user();
            if (!$currentUser || $currentUser->role_id != 1) {
                throw new \Exception('Unauthorized action');
            }

            $targetStatusId = 2; // "Đã duyệt"
            if (!\App\Models\Status::find($targetStatusId)) {
                throw new \Exception("Status id={$targetStatusId} không tồn tại");
            }

            DB::beginTransaction();
            $order->update([
                'is_done' => 1,
                'note_id' => 2,               
                'status_id' => $targetStatusId,
                'approved_by' => $currentUser->id,
                'approved_at' => now()
            ]);
            DB::commit();

            myFlasherBuilder(message: "Đơn hàng đã được duyệt thành công!", success: true);
            return redirect()->back();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Approve order failed: '.$e->getMessage(), ['order_id'=>$order->id ?? null, 'trace'=>$e->getTraceAsString()]);
            myFlasherBuilder(message: "Có lỗi xảy ra khi duyệt đơn hàng: ".$e->getMessage(), failed: true);
            return redirect()->back();
        }
    }
  public function cancel($id)
{
    $order = Order::findOrFail($id);

    if(auth()->user()->role_id == 1) {
        return redirect()->back()->with('error', 'Admin không thể huỷ đơn.');
    }

    if($order->is_done) {
        return redirect()->back()->with('error', 'Không thể huỷ đơn đã duyệt.');
    }

    $order->update([
        'status_id' => 5,              // Huỷ
        'is_done' => 1, 
        'note_id' => 2,                
        'approved_by' => auth()->id(), 
        'approved_at' => now()         
    ]);
    $orders = Order::where('is_done', 0)
               ->where('status_id', '!=', 5) // loại bỏ đơn huỷ
               ->get();
    $total = Order::where('status_id', '!=', 5)->sum('total_price'); // bỏ đơn huỷ
    return redirect()->back()->with('success', 'Đơn hàng đã được huỷ.');
}
}
