<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function GetallProductData()
    {
        $success = DB::table('products')->get();
        if ($success) {
            return[
                "status" =>"success",
                "msg" =>"Data retrived Sccessfully",
                "data" => $success ,
            ];
        }
        else{
            return[
                "status" =>"error",
                "msg" =>"Something is wrong",
            ];
        }

    }
    public function catproductdata(request $request)
    {
        $cat_id = $request->category_id;
        $success = DB::table('products')->where('category_id',$cat_id)->get();
        if ($success) {
            return[
                "status" =>"success",
                "msg" =>"Data retrived Sccessfully",
                "data" => $success,
            ];
        }
        else{
            return[
                "status" =>"error",
                "msg" =>"Something is wrong",
            ];
        }
    }
    public function getproductdata(request $request)
    {
        $id = $request->id;
        $success = DB::table('products')->where('id',$id)->first();
        if ($success) {
            return[
                "status" =>"success",
                "msg" =>"Data retrived Sccessfully",
                "data" => [
                    "id" => $success->id,
                    "category_id" => $success->category_id,
                    "name" => $success->name,
                    "price" => $success->price,
                    "selling_price" => $success->selling_price,
                    "description" => $success->description,
                ],
                "images"=>  [
                    "img1" => $success->img1,
                    "img2" => $success->img1,
                    "img3" => $success->img1,
                    "img4" => $success->img1,
                    "img5" => $success->img1,
                ],
            ];
        }
        else{
            return[
                "status" =>"error",
                "msg" =>"Something is wrong",
            ];
        }
    }


    public function insertproductdata(request $request)
    {

        $data['category_id'] = $request->category_id;
        $data['name'] = $request->name;
        $data['price'] = $request->price;
        $data['description'] = $request->description;
        $data['selling_price'] = $request->selling_price;

        if ($request->img1 && $request->img2 && $request->img3 && $request->img4 &&$request->img5) {

            $fileNameone = $request->file('img1')->getClientOriginalName();
            $fileNametwo = $request->file('img2')->getClientOriginalName();
            $fileNamethree = $request->file('img3')->getClientOriginalName();
            $fileNamefour = $request->file('img4')->getClientOriginalName();
            $fileNamefive = $request->file('img5')->getClientOriginalName();
            $fileName1 =  $fileNameone;
            $fileName2 =  $fileNametwo;
            $fileName3 =  $fileNamethree;
            $fileName4 =  $fileNamefour;
            $fileName5 =  $fileNamefive;
            $path = 'productImages' . "/" ;
            $destinationPath = $path; // upload path

            $request->file('img1')->move($destinationPath, $fileName1);
            $request->file('img2')->move($destinationPath, $fileName2);
            $request->file('img3')->move($destinationPath, $fileName3);
            $request->file('img4')->move($destinationPath, $fileName4);
            $request->file('img5')->move($destinationPath, $fileName5);

            $data['img1'] = '/productImages/' . $fileName1;
            $data['img2'] = '/productImages/' . $fileName2;
            $data['img3'] = '/productImages/' . $fileName3;
            $data['img4'] = '/productImages/' . $fileName4;
            $data['img5'] = '/productImages/' . $fileName5;

            $match = DB::table('products')->insert($data);
            if ($match) {
                return[
                    "status" =>"success",
                    "msg" =>"Data Inserted Sccessfully",
                ];
            }
            else{
                return[
                    "status" =>"failed",
                    "msg" =>"Something is worng",
                ];
            }
        }
        elseif($request->img1 && $request->img2 && $request->img3 && $request->img4) {
            $fileNameone = $request->file('img1')->getClientOriginalName();
            $fileNametwo = $request->file('img2')->getClientOriginalName();
            $fileNamethree = $request->file('img3')->getClientOriginalName();
            $fileNamefour = $request->file('img4')->getClientOriginalName();

            $fileName1 =  $fileNameone;
            $fileName2 =  $fileNametwo;
            $fileName3 =  $fileNamethree;
            $fileName4 =  $fileNamefour;

            $path = 'productImages' . "/" ;
            $destinationPath = $path; // upload path

            $request->file('img1')->move($destinationPath, $fileName1);
            $request->file('img2')->move($destinationPath, $fileName2);
            $request->file('img3')->move($destinationPath, $fileName3);
            $request->file('img4')->move($destinationPath, $fileName4);


            $data['img1'] = '/productImages/' . $fileName1;
            $data['img2'] = '/productImages/' . $fileName2;
            $data['img3'] = '/productImages/' . $fileName3;
            $data['img4'] = '/productImages/' . $fileName4;


            $match = DB::table('products')->insert($data);
            if ($match) {
                return[
                    "status" =>"success",
                    "msg" =>"Data Inserted Sccessfully",
                ];
            }
            else{
                return[
                    "status" =>"failed",
                    "msg" =>"Something is worng",
                ];
            }
        }
        elseif($request->img1 && $request->img2 && $request->img3) {
            $fileNameone = $request->file('img1')->getClientOriginalName();
            $fileNametwo = $request->file('img2')->getClientOriginalName();
            $fileNamethree = $request->file('img3')->getClientOriginalName();
            $fileName1 =  $fileNameone;
            $fileName2 =  $fileNametwo;
            $fileName3 =  $fileNamethree;
            $path = 'productImages' . "/" ;
            $destinationPath = $path; // upload path
            $request->file('img1')->move($destinationPath, $fileName1);
            $request->file('img2')->move($destinationPath, $fileName2);
            $request->file('img3')->move($destinationPath, $fileName3);
            $data['img1'] = '/productImages/' . $fileName1;
            $data['img2'] = '/productImages/' . $fileName2;
            $data['img3'] = '/productImages/' . $fileName3;
            $match = DB::table('products')->insert($data);
            if ($match) {
                return[
                    "status" =>"success",
                    "msg" =>"Data Inserted Sccessfully",
                ];
            }
            else{
                return[
                    "status" =>"failed",
                    "msg" =>"Something is worng",
                ];
            }
        }
        elseif($request->img1 && $request->img2) {
            $fileNameone = $request->file('img1')->getClientOriginalName();
            $fileNametwo = $request->file('img2')->getClientOriginalName();
            $fileName1 =  $fileNameone;
            $fileName2 =  $fileNametwo;

            $path = 'productImages' . "/" ;
            $destinationPath = $path; // upload path

            $request->file('img1')->move($destinationPath, $fileName1);
            $request->file('img2')->move($destinationPath, $fileName2);


            $data['img1'] = '/productImages/' . $fileName1;
            $data['img2'] = '/productImages/' . $fileName2;

            $match = DB::table('products')->insert($data);
            if ($match) {
                return[
                    "status" =>"success",
                    "msg" =>"Data Inserted Sccessfully",
                ];
            }
            else{
                return[
                    "status" =>"failed",
                    "msg" =>"Something is worng",
                ];
            }
        }
        elseif($request->img1) {
            $fileNameone = $request->file('img1')->getClientOriginalName();
            $fileName1 =  $fileNameone;
            $path = 'productImages' . "/" ;
            $destinationPath = $path; // upload path

            $request->file('img1')->move($destinationPath, $fileName1);

            $data['img1'] = '/productImages/' . $fileName1;


            $match = DB::table('products')->insert($data);
            if ($match) {
                return[
                    "status" =>"success",
                    "msg" =>"Data Inserted Sccessfully",
                ];
            }
            else{
                return[
                    "status" =>"failed",
                    "msg" =>"Something is worng",
                ];
            }
        }
        else
        {
            $match = DB::table('products')->insert($data);
            if ($match) {
                return[
                    "status" =>"success",
                    "msg" =>"Data Inserted Sccessfully",
                ];
            }
            else{
                return[
                    "status" =>"failed",
                    "msg" =>"Something is worng",
                ];
            }
        }
    }

    public function updateproductdata(request $request)
    {
        $id = $request->id;
        $data['category_id'] = $request->category_id;
        $data['name'] = $request->name;
        $data['price'] = $request->price;
        $data['description'] = $request->description;

        if ($request->img1 && $request->img2 && $request->img3 && $request->img4 &&$request->img5) {

            $fileNameone = $request->file('img1')->getClientOriginalName();
            $fileNametwo = $request->file('img2')->getClientOriginalName();
            $fileNamethree = $request->file('img3')->getClientOriginalName();
            $fileNamefour = $request->file('img4')->getClientOriginalName();
            $fileNamefive = $request->file('img5')->getClientOriginalName();
            $fileName1 =  $fileNameone;
            $fileName2 =  $fileNametwo;
            $fileName3 =  $fileNamethree;
            $fileName4 =  $fileNamefour;
            $fileName5 =  $fileNamefive;
            $path = 'productImages' . "/" ;
            $destinationPath = $path; // upload path

            $request->file('img1')->move($destinationPath, $fileName1);
            $request->file('img2')->move($destinationPath, $fileName2);
            $request->file('img3')->move($destinationPath, $fileName3);
            $request->file('img4')->move($destinationPath, $fileName4);
            $request->file('img5')->move($destinationPath, $fileName5);

            $data['img1'] = '/productImages/' . $fileName1;
            $data['img2'] = '/productImages/' . $fileName2;
            $data['img3'] = '/productImages/' . $fileName3;
            $data['img4'] = '/productImages/' . $fileName4;
            $data['img5'] = '/productImages/' . $fileName5;

            $match = DB::table('products')->insert($data);
            if ($match) {
                return[
                    "status" =>"success",
                    "msg" =>"Data Updated Sccessfully",
                ];
            }
            else{
                return[
                    "status" =>"failed",
                    "msg" =>"Something is worng",
                ];
            }
        }
        elseif($request->img1 && $request->img2 && $request->img3 && $request->img4) {
            $fileNameone = $request->file('img1')->getClientOriginalName();
            $fileNametwo = $request->file('img2')->getClientOriginalName();
            $fileNamethree = $request->file('img3')->getClientOriginalName();
            $fileNamefour = $request->file('img4')->getClientOriginalName();

            $fileName1 =  $fileNameone;
            $fileName2 =  $fileNametwo;
            $fileName3 =  $fileNamethree;
            $fileName4 =  $fileNamefour;

            $path = 'productImages' . "/" ;
            $destinationPath = $path; // upload path

            $request->file('img1')->move($destinationPath, $fileName1);
            $request->file('img2')->move($destinationPath, $fileName2);
            $request->file('img3')->move($destinationPath, $fileName3);
            $request->file('img4')->move($destinationPath, $fileName4);


            $data['img1'] = '/productImages/' . $fileName1;
            $data['img2'] = '/productImages/' . $fileName2;
            $data['img3'] = '/productImages/' . $fileName3;
            $data['img4'] = '/productImages/' . $fileName4;


            $match = DB::table('products')->insert($data);
            if ($match) {
                return[
                    "status" =>"success",
                    "msg" =>"Data Updated Sccessfully",
                ];
            }
            else{
                return[
                    "status" =>"failed",
                    "msg" =>"Something is worng",
                ];
            }
        }
        elseif($request->img1 && $request->img2 && $request->img3) {
            $fileNameone = $request->file('img1')->getClientOriginalName();
            $fileNametwo = $request->file('img2')->getClientOriginalName();
            $fileNamethree = $request->file('img3')->getClientOriginalName();
            $fileName1 =  $fileNameone;
            $fileName2 =  $fileNametwo;
            $fileName3 =  $fileNamethree;
            $path = 'productImages' . "/" ;
            $destinationPath = $path; // upload path
            $request->file('img1')->move($destinationPath, $fileName1);
            $request->file('img2')->move($destinationPath, $fileName2);
            $request->file('img3')->move($destinationPath, $fileName3);
            $data['img1'] = '/productImages/' . $fileName1;
            $data['img2'] = '/productImages/' . $fileName2;
            $data['img3'] = '/productImages/' . $fileName3;
            $match = DB::table('products')->insert($data);
            if ($match) {
                return[
                    "status" =>"success",
                    "msg" =>"Data Updated Sccessfully",
                ];
            }
            else{
                return[
                    "status" =>"failed",
                    "msg" =>"Something is worng",
                ];
            }
        }
        elseif($request->img1 && $request->img2) {
            $fileNameone = $request->file('img1')->getClientOriginalName();
            $fileNametwo = $request->file('img2')->getClientOriginalName();
            $fileName1 =  $fileNameone;
            $fileName2 =  $fileNametwo;

            $path = 'productImages' . "/" ;
            $destinationPath = $path; // upload path

            $request->file('img1')->move($destinationPath, $fileName1);
            $request->file('img2')->move($destinationPath, $fileName2);


            $data['img1'] = '/productImages/' . $fileName1;
            $data['img2'] = '/productImages/' . $fileName2;

            $match = DB::table('products')->insert($data);
            if ($match) {
                return[
                    "status" =>"success",
                    "msg" =>"Data Updated Sccessfully",
                ];
            }
            else{
                return[
                    "status" =>"failed",
                    "msg" =>"Something is worng",
                ];
            }
        }
        elseif($request->img1) {
            $fileNameone = $request->file('img1')->getClientOriginalName();
            $fileName1 =  $fileNameone;
            $path = 'productImages' . "/" ;
            $destinationPath = $path; // upload path
            $request->file('img1')->move($destinationPath, $fileName1);
            $data['img1'] = '/productImages/' . $fileName1;


            $match = DB::table('products')->insert($data);
            if ($match) {
                return[
                    "status" =>"success",
                    "msg" =>"Data Updated Sccessfully",
                ];
            }
            else{
                return[
                    "status" =>"failed",
                    "msg" =>"Something is worng",
                ];
            }
        }
        else
        {
            $match = DB::table('products')->where('id',$id)->update($data);
            if ($match) {
                return[
                    "status" =>"success",
                    "msg" =>"Data Updated Sccessfully",
                ];
            }
            else{
                return[
                    "status" =>"failed",
                    "msg" =>"Something is worng",
                ];
            }
        }
    }
    public function deleteproductdata(request $request)
    {

        $id = $request->id;
        $success = DB::table('products')->where('id',$id)->delete();
        if ($success) {
            return[
                "status" =>"success",
                "msg" =>"Data Deleted Sccessfully",
            ];
        }
    }
    public function deleteproduct(request $request)
    {
        $id = $request->id;
        $success = DB::table('products')->where('id',$id)->delete();
        if ($success) {
            return[
                "status" =>"success",
                "msg" =>"Data Deleted Sccessfully",
            ];
        }
    }
    public function summary()
    {
        $placed_order = DB::table('order')->where('status', 'placed')->count();
        $processing_order = DB::table('order')->where('status', 'processing')->count();
        $delivered = DB::table('order')->where('status', 'deliver')->count();
        $all_product = DB::table('products')->count();
        $category = DB::table('category')->count();
        $all_user = DB::table('tbl_user')->count();
        if ($placed_order) {
            return[
                "status" =>"success",
                "msg" =>"Data retrived Sccessfully",
                "data" => [
                    "placed_order" => $placed_order,
                    "processing_order" => $processing_order,
                    "delivered" => $delivered,
                    "all_product" => $all_product,
                    "category" => $category,
                    "all_user" => $all_user,

                ],

            ];
        }
        else{
            return[
                "status" =>"failed",
                "msg" =>"Something is worng",
            ];
        }
    }
}
