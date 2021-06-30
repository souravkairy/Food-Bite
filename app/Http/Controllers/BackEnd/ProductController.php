<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function GetProductData()
    {
        $success = DB::table('products')->get();
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


    public function insertproductdata(request $request)
    {

        $data['category_id'] = $request->category_id;
        $data['name'] = $request->name;
        $data['price'] = $request->price;
        $data['selling_price'] = $request->selling_price;
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

            $data['img1'] = '/public/productImages/' . $fileName1;
            $data['img2'] = '/public/productImages/' . $fileName2;
            $data['img3'] = '/public/productImages/' . $fileName3;
            $data['img4'] = '/public/productImages/' . $fileName4;
            $data['img5'] = '/public/productImages/' . $fileName5;

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


            $data['img1'] = '/public/productImages/' . $fileName1;
            $data['img2'] = '/public/productImages/' . $fileName2;
            $data['img3'] = '/public/productImages/' . $fileName3;
            $data['img4'] = '/public/productImages/' . $fileName4;


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
            $data['img1'] = '/public/productImages/' . $fileName1;
            $data['img2'] = '/public/productImages/' . $fileName2;
            $data['img3'] = '/public/productImages/' . $fileName3;
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


            $data['img1'] = '/public/productImages/' . $fileName1;
            $data['img2'] = '/public/productImages/' . $fileName2;

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

            $data['img1'] = '/public/productImages/' . $fileName1;


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
        $data['selling_price'] = $request->selling_price;
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

            $data['img1'] = '/public/productImages/' . $fileName1;
            $data['img2'] = '/public/productImages/' . $fileName2;
            $data['img3'] = '/public/productImages/' . $fileName3;
            $data['img4'] = '/public/productImages/' . $fileName4;
            $data['img5'] = '/public/productImages/' . $fileName5;

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


            $data['img1'] = '/public/productImages/' . $fileName1;
            $data['img2'] = '/public/productImages/' . $fileName2;
            $data['img3'] = '/public/productImages/' . $fileName3;
            $data['img4'] = '/public/productImages/' . $fileName4;


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
            $data['img1'] = '/public/productImages/' . $fileName1;
            $data['img2'] = '/public/productImages/' . $fileName2;
            $data['img3'] = '/public/productImages/' . $fileName3;
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


            $data['img1'] = '/public/productImages/' . $fileName1;
            $data['img2'] = '/public/productImages/' . $fileName2;

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
            $data['img1'] = '/public/productImages/' . $fileName1;


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
        $success = DB::table('products')->where('ID',$id)->delete();
        if ($success) {
            return[
                "status" =>"success",
                "msg" =>"Data Deleted Sccessfully",
            ];
        }
    }
}
