<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    public function GetSliderData()
    {
        $success = DB::table('dashboard_slider')->get();
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
    public function SaveSliderData(request $request)
    {
        $data['status'] = 1;

        $picName = $request->file('slider_image')->getClientOriginalName();
        $picName = uniqid() . '_' . $picName;
        $path = 'slider_image' . "/" ;
        $destinationPath = $path; // upload path
        $request->file('slider_image')->move($destinationPath, $picName);
        $data['slider_image'] = '/public/slider_image/' . $picName;
        $save = DB::table('dashboard_slider')->insert($data);

        if ($save) {
            return[
                "status" =>"success",
                "msg" =>"Slider Inserted Sccessfully",
            ];
        }
        else{
            return[
                "status" =>"failed",
                "msg" =>"Something is worng",
            ];
        }
    }
    public function UpdateSliderData(request $request)
    {
        $id = $request->id;
        $data['status'] = 1;

        $image = $request->file('slider_image');
        $fileName = $image->getClientOriginalName();
        $destinationPath = base_path() . '/public/slider_image/' . $fileName;
        $image->move($destinationPath, $fileName);
        $data['slider_image'] = '/public/slider_image/' . $fileName;
        $save = DB::table('dashboard_slider')->where('id',$id)->update($data);
        if ($save) {
            return[
                "status" =>"success",
                "msg" =>"Slider Updated Sccessfully",
            ];
        }
        else{
            return[
                "status" =>"failed",
                "msg" =>"Something is worng",
            ];
        }
    }
    public function DeleteSliderData(request $request)
    {
        $id = $request->id;
        $save = DB::table('dashboard_slider')->where('id',$id)->delete();
        if ($save) {
            return[
                "status" =>"success",
                "msg" =>"Slider Deleted Sccessfully",
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
