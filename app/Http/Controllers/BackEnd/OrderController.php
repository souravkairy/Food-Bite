<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function GetOrderData()
    {
        $success = DB::table('order')->get();
        return $success;
    }
    public function placedorder(request $request)
    {

        $data['user_id'] = $request->user_id;
        $data['total_price'] = $request->total_price;
        $data['status'] = 1;

        // return $data;
        $order_id=DB::table('order')->insertGetId($data);
        DB::table('shipping')->insert(['order_id'=>$order_id ,'shipping_address'=>$request->shipping_address]);

        $data = array();
        foreach($request->orders as $order)
        {
            $data['product_id'] = $order['product_id'];
            $data['price'] = $order['price'];
            $data['quantity'] = $order['quantity'];
            $data['order_id']=$order_id;
            DB::table('order_details')->insert($data);


        }
        if ($order_id) {
            return[
                "status" =>"success",
                "msg" =>"Order Placed",
            ];
        }
        else{
            return[
                "status" =>"error",
                "msg" =>"Something is wrong",
            ];
        }

    }
    public function vieworder($user_id)
    {

        $order_id = DB::table('order')->where('user_id',$user_id)->get()->pluck('id');
        $data = DB::table('order_details')->whereIn('order_id', $order_id)->get();
        if ($data) {
            return[
                "status" =>"success",
                "msg" =>"Data retrived Sccessfully",
                "data" => $data,
            ];
        }
        else{
            return[
                "status" =>"error",
                "msg" =>"Something is wrong",
            ];
        }
    }
}
