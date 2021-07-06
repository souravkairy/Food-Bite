<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function GetUserData(request $request)
    {

        $phone = $request->phone;
        $password = $request->password;

        $match = DB::table('tbl_user')->where('Phone',$phone)->where('password',md5($password))->first();

        if ($match) {
            return[
                "status" =>"success",
                "msg" =>"user logged in successfully",
                "data"=>
                        [
                            "id" => $match->id,
                            "name" => $match->name,
                            "phone" => $match->phone,
                            "profileimage" => $match->profileimage,
                            "email" => $match->email,
                            "is_active" => $match->is_active,
                            "address" => $match->address,
                            "type" => $match->type,
                        ]
            ];
        }
        else{
            return[
                "status" =>"failed",
                "msg" =>"Authentication failed",
            ];
        }
    }

    public function insertuserdata(request $request)
    {
        if ($request->file('profileimage')) {
            $data['name'] = $request->name;
            $data['phone'] = $request->phone;
            $data['password'] = md5($request->password);
            $data['email'] = $request->email;
            $data['is_active'] = 1;
            $data['is_Verifide'] = 0;
            $data['address'] = $request->address;
            $data['type'] = $request->type;

            $picName = $request->file('profileimage')->getClientOriginalName();
            $picName = uniqid() . '_' . $picName;
            $path = 'userImages' . "/" ;
            $destinationPath = $path; // upload path
            $request->file('profileimage')->move($destinationPath, $picName);


            $data['profileimage'] = 'userImages/' . $picName;

            $match = DB::table('tbl_user')->insert($data);
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
        else{
            $data['name'] = $request->name;
            $data['phone'] = $request->phone;
            $data['password'] = md5($request->password);
            $data['email'] = $request->email;
            $data['is_active'] = 1;
            $data['is_Verifide'] = 0;
            $data['address'] = $request->address;
            $data['type'] = $request->type;

            $match = DB::table('tbl_user')->insert($data);
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
    public function updateuserdata(request $request)
    {
        $id = $request->id;
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['password'] = md5($request->password);
        $data['email'] = $request->email;
        $data['is_active'] = $request->is_active;
        $data['is_Verifide'] = $request->is_Verifide;
        $data['address'] = $request->address;
        $data['type'] = $request->type;

        $picName = $request->file('profileimage')->getClientOriginalName();
        $picName = uniqid() . '_' . $picName;
        $path = 'userImages' . "/" ;
        $destinationPath = $path; // upload path
        $request->file('profileimage')->move($destinationPath, $picName);
        $data['profileimage'] = 'userImages/' . $fileName;

        $match = DB::table('tbl_user')->where('id',$id)->update($data);
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
    public function deleteuserdata(request $request)
    {
        $id = $request->id;
        $success = DB::table('tbl_user')->where('id',$id)->delete();
        if ($success) {
            return[
                "status" =>"success",
                "msg" =>"Data Deleted Sccessfully",
            ];
        }
        else{
            return[
                "status" =>"failed",
                "msg" =>"Something is worng",
            ];
        }
    }
    public function allUserList()
    {
        $success = DB::table('tbl_user')->get();
        if ($success) {
            return[
                "status" =>"success",
                "msg" =>"Data fetched Sccessfully",
                "data" =>$success,
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
