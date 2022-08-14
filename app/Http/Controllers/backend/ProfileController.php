<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function view(){
        $id     = Auth::user()->id;
        $user   = User::find($id);
        return view('backend.user.profile-view',compact('user'));
    }

    public function edit(){
        $id         = Auth::user()->id;
        $editData   = User::find($id);
        return view('backend.user.profile-edit',compact('editData'));
    }

    public function update(Request $request){
        $data               = User::find(Auth::user()->id);
        $data->name         = $request->name;
        $data->email        = $request->email;
        $data->moblie       = $request->moblie;
        $data->address      = $request->address;
        $data->gender       = $request->gender;
        if ($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('/upload/user-images/'.$data->image));
            $fileName = date('YmdHi').$file->getClientOriginalName();
//            $extension = $file->extension();
//            $file->move(public_path('/upload/user-images'), $fileName.".".$extension);
            $file->move(public_path('/upload/user-images'), $fileName);
            $data['image'] = $fileName;
        }
        $data->save();
        return redirect()->route('profile-view')->with('success','Profile Updated Successfully');
    }
    public function passwordView(){
       return view('backend.user.password-edit');
    }
    public function passwordUpdate(Request $request){
        if (Auth::attempt(['id'=>Auth::user()->id, 'password'=>$request->old_password])){
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->new_password);
            $user->save();
            return redirect()->route('profile-view')->with('success','Successfully password changed');
        }
        else{
           return redirect()->back()->with('error','Current password does not match');
        }
    }
}
