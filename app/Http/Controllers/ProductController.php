<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $title = "Sản phẩm";
        $query = Product::query();

        if ($request->filled('search')) {
            $keyword = $request->input('search');
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        }

        $product = $query->get();
        return view('product.index', compact("title", "product"));
    }

    // ✅ Sửa chuẩn hàm lấy dữ liệu chi tiết
    public function getProductData($id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['error' => 'Không tìm thấy sản phẩm'], 404);
            }

            // Đảm bảo đường dẫn ảnh đúng
            $imageUrl = $product->image
                ? asset('storage/' . $product->image)
                : asset('images/default_product.jpg');

            return response()->json([
                'id' => $product->id,
                'product_name' => $product->product_name,
                'price' => $product->price,
                'discount' => $product->discount,
                'stock' => $product->stock,
                'description' => $product->description,
                'orientation' => $product->orientation,
                'image' => $imageUrl,
            ]);
        } catch (\Throwable $e) {
            \Log::error('Lỗi khi tải chi tiết sản phẩm: ' . $e->getMessage());
            return response()->json(['error' => 'Không thể tải chi tiết sản phẩm'], 500);
        }
    }

    public function addProductGet()
    {
        $title = "Thêm sản phẩm";
        $categories = Category::all();
        return view('product.add_product', compact("title", "categories"));
    }

    public function addProductPost(Request $request)
    {
        $validatedData = $request->validate([
            "product_name" => "required|max:255",
            "stock" => "required|numeric|gt:0",
            "price" => "required|numeric|gt:0",
            "discount" => "required|numeric|gte:0|lt:100",
            "orientation" => "required",
            "description" => "required",
            "image" => "image|max:2048",
            "category_id" => "required|exists:categories,id"
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $filePath = 'product/' . $fileName;
            $file->storeAs('public/product', $fileName); // ✅ lưu đúng vào storage/public
            $validatedData["image"] = 'product/' . $fileName;
        } else {
            $validatedData["image"] = env("IMAGE_PRODUCT");
        }

        Product::create($validatedData);
        myFlasherBuilder(message: "Sản phẩm đã được thêm thành công!", success: true);
        return redirect('/product');
    }

    public function editProductGet(Product $product)
    {
        $data["title"] = "Chỉnh sửa sản phẩm";
        $data["product"] = $product;
        $data["categories"] = Category::all();
        return view("product.edit_product", $data);
    }

    public function editProductPost(Request $request, Product $product)
    {
        $rules = [
            'orientation' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|gt:0',
            'stock' => 'required|numeric|gt:0',
            'discount' => 'required|numeric|gte:0|lt:100',
            'category_id' => 'required|exists:categories,id',
            'image' => 'image|file|max:2048'
        ];

        if ($product->product_name != $request->product_name) {
            $rules['product_name'] = 'required|max:255|unique:products,product_name';
        } else {
            $rules['product_name'] = 'required|max:255';
        }

        $validatedData = $request->validate($rules);

        if ($request->hasFile("image")) {
            if ($product->image && $product->image != env("IMAGE_PRODUCT")) {
                Storage::delete('public/' . $product->image);
            }

            $file = $request->file("image");
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/product', $fileName);
            $validatedData["image"] = 'product/' . $fileName;
        }

        $product->update($validatedData);
        myFlasherBuilder(message: "Sản phẩm đã được cập nhật thành công!", success: true);
        return redirect("/product");
    }

    public function deleteProduct(Product $product)
    {
        if ($product->image && $product->image != env("IMAGE_PRODUCT")) {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();
        myFlasherBuilder(message: "Sản phẩm đã được xóa thành công!", success: true);
        return redirect('/product');
    }

    public function showByCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if (!$category) {
            return redirect('/product')->with('message', '<div class="alert alert-danger">Không tìm thấy loại sản phẩm</div>');
        }

        $product = Product::where('category_id', $category->id)->get();
        return view('product.index', compact('product'));
    }
    public function detail($id)
{
    try {
        $product = Product::findOrFail($id);
        $title = "Chi tiết sản phẩm - " . $product->product_name;
        return view('product.detail', compact('title', 'product'));
    } catch (\Exception $e) {
        return redirect('/product')->with('error', 'Không thể tải chi tiết sản phẩm!');
    }
}
}
