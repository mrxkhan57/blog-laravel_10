<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserController extends Controller
{
    public function user(){

        $data['active_class'] = 'user';
        $data['getRecord'] = User::getRecordUser();
        return view('backend.user.list', $data);
    }

    public function add_user(Request $request){
        $data['active_class'] = 'user';
        return view('backend.user.add', $data);
    }

    public function edit_user($id){

        $data['active_class'] = 'user';
        $data['getRecord'] = User::getSingle($id);
        return view('backend.user.edit', $data);

    }

    public function update_user($id, Request $request){

        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $save = User::getSingle($id);
        $save->name = trim($request->name);
        $save->email = trim($request->email);
        if (!empty($request->password)){
            $save->password = Hash::make($request->password);
        }

        $save->status = trim($request->status);

        $save->save();

        //session()->flash('success', 'Successfully updated');
        //return redirect('panel/user/list')->back();
        //$save->status = trim($request->status);

        //$save->status = trim($request->status) == '1' ? 1 : 0;
        //$save->save();

        return redirect('panel/user/list')->with('success', 'Successfully updated');

    }

    public function delete_user($id){
        $save = User::getSingle($id);
        //$save->is_delete = 1;
        $save->delete();
        //$save->save();

        return redirect()->back()->with('success', 'Successfully deleted');
    }

    public function insert_user(Request $request){

        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $save = new User;
        $save->name = trim($request->name);
        $save->email = trim($request->email);
        $save->password = Hash::make($request->password);
        $save->status = trim($request->status);
        $save->save();

        return redirect('panel/user/list')->with('success', 'Successfully added new user');
    }

    public function changepassword()
    {
        return view('backend.user.change_password');
    }

    public function updatepassword(Request $request){
        $user = User::getSingle(Auth::user()->id);
        if(Hash::check($request->old_password, $user->password)){
            if($request->new_password == $request->confirm_password){
                $user->password = Hash::make($request->new_password);
                $user->save();
                return redirect()->back()->with('success', 'Successfully updated password!');
            }
            else{
                return redirect()->back()->with('error', 'Confirm password does not match');
            }
        }
        else {
            return redirect()->back()->with('error', 'Old password is incorrect!');
        }
    }

    public function accountsetting(){
        $data['getUser'] = User::getSingle(Auth::user()->id);
        return view('backend.profile.account_setting', $data);
    }

    public function updateaccountsetting(Request $request){
        $getUser = User::getSingle(Auth::user()->id);
        $getUser->name = $request->name;
        $getUser->email = $request->email;

        if(!empty($request->file('profile_pic'))){

            if(!empty($getUser->profile_pic) && file_exists('upload/profile/'.$getUser->profile_pic)){
                unlink('upload/profile/'.$getUser->profile_pic);
            }
            if(!empty($request->file('profile_pic'))){
                $ext =$request->file('profile_pic')->getClientOriginalExtension();
                $file = $request->file('profile_pic');
                $filename = Str::random(20).'.'.$ext;
                $file -> move('upload/profile/', $filename);
                $getUser->profile_pic = $filename;
            }
        }

        $getUser->save();

        return redirect()->back()->with('success', 'Successfully updated account!');

    }
}
