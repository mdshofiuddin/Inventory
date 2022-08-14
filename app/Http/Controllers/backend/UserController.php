<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    //
    public function view(){

        $data['allData']   =    User::all();
//        $alldata    =   User::all();
//        dd($alldata->toArray());
        return view('backend.user.user-view',$data);
    }
    public function add(){
       return view('backend.user.user-add');
    }
    public function store(Request $request){
        $this->validate($request,[
           'name'   =>  'required',
            'email' =>  'required|unique:users,email'
        ]);

        $data           = new User();
        $data->usertype = $request->usertype;
        $data->name     = $request->name;
        $data->email    = $request->email;
        // $data->password = $request->password;
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect()->route('user-view')->with('success','Data Inserted Successfully');
    }

    public function edit($id){
        $editData = User::find($id);
        return view('backend.user.user-edit',compact('editData'));
    }
    public function update(Request $request, $id){
        $data           = User::find($id);
        $data->usertype = $request->usertype;
        $data->name     = $request->name;
        $data->email    = $request->email;
        $data->save();
        return redirect()->route('user-view')->with('success','Data Updated Successfully');
        //'success' found master file from session in notify js cdn

    }

    public function delete($id){
        $user = User::find($id);
//        $user->delete();
        if (file_exists('/public/upload/user_images/'.$user->image) AND ! empty($user->image)){
            unlink('/public/upload/user_images/'.$user->image);
        }
        $user->delete();
        return redirect()->route('user-view')->with('success','Data Deleted Successfully');
    }


}
