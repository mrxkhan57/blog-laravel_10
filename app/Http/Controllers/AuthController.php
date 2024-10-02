<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use function Laravel\Prompts\text;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function forgot(){
        return view('auth.forgot');
    }

    public function reset($token){

        $user = User::where('remember_token', '=', $token)->first();
        if (!empty($user)) {

            $data['user']=$user;
            return view('auth.reset');
        }
        else {
            abort(404);
        }
    }

    public function post_reset($token, Request $request){
        $user = User::where('remember_token', '=', $token)->first();
        if (!empty($user)) {

            if ($request->password == $request->cpassword) {

                if (empty($user->email_verified_at)){
                    $user->email_verified_at = date('Y-m-d H:i:s');
                }
                $user->password = Hash::make($request->password);
                $user->remember_token = Str::random(40);
                $user->save();

                return redirect('login')->with('success', 'Password successfully reset!');

            }
            else {
                return redirect()->back()->with('error', 'Your Password and Confirm password does not match!');
            }

        }
        else {
            abort(404);
        }
    }

    public function forgot_password(Request $request){
        $user = User::where('email', '=', $request->email)->first();
        if (!empty($user)) {
            $user->remember_token = Str::random(40);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success', 'Please check your email and reset your password!');
        }
        else {
            return redirect()->back()->with('error', 'Email not found!');
        }
    }

    public function auth_login(Request $request){
        $remember = !empty($request) ? true:false;

        if(Auth::attempt(
['email' => $request->email,
              'password' => $request->password,], $remember)){
                if (!empty(Auth::user()->email_verified_at)){

                    return redirect('panel/dashboard');

                }
                else {
                    $user_id = Auth::user()->id;
                    Auth::logout();

                    $save = User::getSingle($user_id);
                    $save->remember_token = Str::random(40);
                    $save->save();

                    Mail::to($save->email)->send(new RegisterMail($save));

                    return redirect()->back()->with('success', "Please first verify your email account!");
                }
        }
        else {
            return redirect()->back()->with('error', 'Please enter correct email or password');
        }
    }

    public function create_user(Request $request){

        request()->validate([

            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required"

        ]);

        $save = new User;
        $save->name = trim($request->name);
        $save->email = trim($request->email);
        $save->password = Hash::make($request->password);
        $save->remember_token = Str::random(40);
        $save->save();

        Mail::to($save->email)->send(new RegisterMail($save));

        return redirect('login')->with('success', "Register successfully and verify your account!");
    }

    public function verify($token){
        $user = User::where('remember_token','=',$token)->first();
        if(!empty($user)){
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->remember_token = Str::random(40);
            $user->save();

            return redirect('login')->with('success', "Your account successfully verified!");
        }
        else {
            abort(404);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }

}
