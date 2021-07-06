<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function GetCategoryData()
    {
        $success = DB::table('category')->get();
        if ($success) {
            return[
                "status" =>"success",
                "msg" =>"Category retrived Sccessfully",
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
    public function savecategory(request $request)
    {
        $data['name'] = $request->name;

        $picName = $request->file('category_image')->getClientOriginalName();
        $picName = uniqid() . '_' . $picName;
        $path = 'category_image' . "/" ;
        $destinationPath = $path; // upload path
        $request->file('category_image')->move($destinationPath, $picName);
        $data['category_image'] = '/category_image/' . $picName;
        $save = DB::table('category')->insert($data);

        if ($save) {
            return[
                "status" =>"success",
                "msg" =>"Category Inserted Sccessfully",
            ];
        }
        else{
            return[
                "status" =>"failed",
                "msg" =>"Something is worng",
            ];
        }
    }
    public function update_category(request $request)
    {
              $id = $request->id;
        $data['name'] = $request->name;

        $picName = $request->file('category_image')->getClientOriginalName();
        $picName = uniqid() . '_' . $picName;
        $path = 'category_image' . "/" ;
        $destinationPath = $path; // upload path
        $request->file('category_image')->move($destinationPath, $picName);
        $data['category_image'] = '/category_image/' . $picName;
        $save = DB::table('category')->where('id',$id)->update($data);
        if ($save) {
            return[
                "status" =>"success",
                "msg" =>"Category Updated Sccessfully",
            ];
        }
        else{
            return[
                "status" =>"failed",
                "msg" =>"Something is worng",
            ];
        }
    }
    public function deletecategory(request $request)
    {
        $id = $request->id;
        $save = DB::table('category')->where('id',$id)->delete();
        if ($save) {
            return[
                "status" =>"success",
                "msg" =>"Category Deleted Sccessfully",
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
