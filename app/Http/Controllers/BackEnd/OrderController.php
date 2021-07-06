<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\OrdersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function GetOrderData()
    {
        $order = DB::table('order')
            ->join('shipping', 'order.id', 'shipping.order_id')
        // ->select('order.*','shipping.shipping_address')
            ->get();

        $shipping_info = DB::table('order')
            ->join('shipping', 'order.id', 'shipping.order_id')
            ->join('tbl_user', 'order.user_id', 'tbl_user.id')
            ->join('order_details', 'order.id', 'order_details.order_id')
            ->select('shipping.shipping_address', 'tbl_user.name', 'order_details.*')
        // ->orderBy('order.id', 'desc')
            ->get();
        $user = DB::table('order')
            ->join('tbl_user', 'order.user_id', 'tbl_user.id')
            ->select('tbl_user.*')
            ->orderBy('order.id', 'desc')
            ->get();
        $shoppingDetails = DB::table('order')
            ->join('order_details', 'order.id', 'order_details.order_id')
            ->select('order_details.*')
            ->get();

        return $order;

    }
    public function placedorder(request $request)
    {

        $data['user_id'] = $request->user_id;
        $data['total_price'] = $request->total_price;
        $data['status'] = 1;

        // return $data;
        $order_id = DB::table('order')->insertGetId($data);
        DB::table('shipping')->insert(['order_id' => $order_id, 'shipping_address' => $request->shipping_address]);

        $data = array();
        foreach ($request->orders as $order) {
            $data['product_id'] = $order['product_id'];
            $data['product_name'] = $order['product_name'];
            $data['price'] = $order['price'];
            $data['quantity'] = $order['quantity'];
            $data['order_id'] = $order_id;
            DB::table('order_details')->insert($data);
        }
        if ($order_id) {
            return [
                "status" => "success",
                "msg" => "Order Placed",
            ];
        } else {
            return [
                "status" => "error",
                "msg" => "Something is wrong",
            ];
        }

    }
    public function processingorder(request $request)
    {
        $order_id = $request->id;
        $data = DB::table('order')->where('id', $order_id)->update(['status' => 2]);
        if ($data) {
            return [
                "id" => $order_id,
                "status" => "success",
                "msg" => "Order is processing Now",

            ];
        } else {
            return [
                "status" => "error",
                "msg" => "Something is wrong",
            ];
        }
    }
    public function deliverorder(request $request)
    {
        $order_id = $request->id;
        $data = DB::table('order')->where('id', $order_id)->update(['status' => 3]);
        if ($data) {
            return [
                "id" => $order_id,
                "status" => "success",
                "msg" => "Delivery is processing",

            ];
        } else {
            return [
                "status" => "error",
                "msg" => "Something is wrong",
            ];
        }
    }
    public function completeorder(request $request)
    {
        $order_id = $request->id;
        $data = DB::table('order')->where('id', $order_id)->update(['status' => 4]);
        if ($data) {
            return [
                "id" => $order_id,
                "status" => "success",
                "msg" => "Delivery Done",

            ];
        } else {
            return [
                "status" => "error",
                "msg" => "Something is wrong",
            ];
        }
    }

    public function getplacedorder()
    {

        $data = DB::table('order')->where('status', 'placed')->get();
        if ($data) {
            return [

                "status" => "Success",
                "msg" => "All Placed Order",
                "data" => $data,

            ];
        } else {
            return [
                "status" => "error",
                "msg" => "Something is wrong",
            ];
        }
    }
    public function getprocessingorder()
    {

        $data = DB::table('order')->where('status', 'processing')->get();
        if ($data) {
            return [

                "status" => "Success",
                "msg" => "All Processing Order",
                "data" => $data,

            ];
        } else {
            return [
                "status" => "error",
                "msg" => "Something is wrong",
            ];
        }
    }
    public function getdeliverorder()
    {

        $data = DB::table('order')->where('status', 'deliver')->get();
        if ($data) {
            return [
                "status" => "Success",
                "msg" => "All Delivery processing Order",
                "data" => $data,

            ];
        } else {
            return [
                "status" => "error",
                "msg" => "Something is wrong",
            ];
        }
    }
    public function getcompleteorder(request $request)
    {

        $data = DB::table('order')->where('status', 'complete')->get();
        if ($data) {
            return [
                "status" => "Success",
                "msg" => "Delivery Done",
                "data" => $data,

            ];
        } else {
            return [
                "status" => "error",
                "msg" => "Something is wrong",
            ];
        }
    }

    //this method for single order
    public function orders()
    {
        $data = OrdersModel::with(['details', 'user', 'shipping'])->get();
        return response()->json($data);
    }
    public function vieworder($user_id)
    {
        $data = OrdersModel::with(['user', 'details', 'shipping'])->where('user_id', $user_id)->get();
        return response()->json($data);

        // $order_id = DB::table('order')->where('user_id', $user_id)->get()->pluck('id');
        // $data = DB::table('order_details')->whereIn('order_id', $order_id)->get();
        // if ($data) {
        //     return [
        //         "status" => "success",
        //         "msg" => "Data retrived Sccessfully",
        //         "data" => $data,
        //     ];
        // } else {
        //     return [
        //         "status" => "error",
        //         "msg" => "Something is wrong",
        //     ];
        // }
    }
}
