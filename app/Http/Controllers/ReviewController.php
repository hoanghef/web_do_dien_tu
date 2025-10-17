<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\{User, Product, Review};

class ReviewController extends Controller
{
    public function productReview(User $user, Product $product)
    {
        $title = "Đánh giá sản phẩm";
        $reviews = $product->review;
        $user = auth()->user();
        if (count($reviews) == 0) {
            $rate = 0;
        } else {
            $rate = $reviews->sum("rating") / count($reviews);
        }
        $isPurchased = $this->isPurchased($user, $product);
        $isReviewed = $this->isReviewed($user, $product);
        $starCounter = [];
        $sum = 0;
        for ($i = 1; $i <= 5; $i++) {
            $total = count(Review::where(["rating" => $i, "product_id" => $product->id])->get());
            array_push($starCounter,  $total);
            $sum += $total;
        }
        return view("/review/product_review", compact("title", "reviews", "product", "rate", "isPurchased", "isReviewed", "starCounter", "sum"));
    }


    public function addReview(Request $request)
    {
        $validatedData = $request->validate([
            "rating" => "required",
            "review" => "required"
        ]);
        $validatedData["user_id"] = auth()->user()->id;
        $validatedData["product_id"] = $request->product_id;
        $validatedData["is_edit"] = 0;
        Review::create($validatedData);
        $message = "Đánh giá của bạn đã được tạo!";
        myFlasherBuilder(message: $message, success: true);
        return back();
    }


    public function getDataReview(Review $review)
    {
        return $review;
    }

    public function get($id)
{
    try {
        $review = Review::findOrFail($id);
        return response()->json($review);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


    public function update(Request $request)
{
    try {
        $review = Review::findOrFail($request->id);
        $review->rating = $request->input('rating');
        $review->review = $request->input('review');
        $review->is_edit = 1;
        $review->save();

        myFlasherBuilder(message: "Cập nhật đánh giá thành công!", success: true);
        return back();
    } catch (\Exception $e) {
        myFlasherBuilder(message: "Lỗi khi cập nhật đánh giá: " . $e->getMessage(), failed: true);
        return back();
    }
}


    public function deleteReview(Review $review)
    {
        $review->delete();
        $message = "Đánh giá của bạn đã được xóa!";
        myFlasherBuilder(message: $message, success: true);
        return back();
    }

    private function isPurchased($user, $product)
    {
        $orders = Order::where(["user_id" => $user->id, "product_id" => $product->id, "is_done" => 1])->get();
        if (count($orders) > 0) {
            return 1;
        }
        return 0;
    }
    

    private function isReviewed($user, $product)
    {
        $review = Review::where(["user_id" => $user->id, "product_id" => $product->id])->get();
        if (count($review) > 0) {
            return 1;
        }
        return 0;
    }
    
}
