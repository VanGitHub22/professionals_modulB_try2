<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Course;
use App\Models\Token;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function makeOrder(Request $request, $id){
        $token = $request->bearerToken();
        $user = Token::where("token", $token)->first();

        Order::create([
            "user_id" => $user->user_id,
            "course_id" => $id,
            "date" => date("Y-m-d"),
            "status" => "новое",
        ]);
        
        return response()->json([
            "pay_url" => "http://link.ru"
        ], 200);
    }

    public function webhook(Request $request){
        $order_id = $request->input("order_id");
        $status = $request->input("status");

        return response()->json([], 204);
    }

    public function apiOrders(Request $request){
        $token = $request->bearerToken();

        $user = Token::where("token", $token)->first()->user->id;

        $orders = Order::where("user_id", $user)->latest()->get();
        $courses = Course::all();

        return response()->json([
            "data" => [
                "orders" => $orders,
                "courses" => $courses,
            ]
        ], 200);
    }

    public function deleteOrder(Request $request, $id){
        $token = $request->bearerToken();

        Order::where("id", $id)->delete();

        return response()->json([
            "status" => "success",
        ], 200);
    } 
}
