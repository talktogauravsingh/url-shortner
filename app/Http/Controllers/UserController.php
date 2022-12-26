<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //

    public function index(){

    }

    public function dashboard(){
        if(Auth::check()){
            return view('dashboard');
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function login(Request $request){
        $request->validate([
            'user_email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('user_email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function signup(Request $request){
        try {
            $request->validate([
                'user_name' => 'required',
                'user_email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);

            $user = new User();
            $user->user_name = $request->user_name;
            $user->user_email = $request->user_email;
            $user->password = Hash::make($request->password);

            if ($user->save()) {
                return view('dashboard')->with('status', 'true')->with('message', 'Welcome to the URL Shortner!');
            }else{
                return view('signup')->with('status', 'false')->with('message', 'Something Went wrong!');
            }

        } catch (\Exception $e) {

            /*

            1] visit on below file path :

            /home/gauravs/Desktop/GauravSingh/url-shortner/vendor/laravel/framework/src/Illuminate/Validation/Validator.php

            2] Change protected to public property :

                public $failedRules = [];

            */

            /* $failedFieldName = [];

            foreach ($e->validator->failedRules as $key => $value) {
                if($key == 'user_name'){
                    array_push($failedFieldName, 'user_name');
                }
                if($key == 'user_email'){
                    array_push($failedFieldName, 'user_email');
                }
                if($key == 'password'){
                    array_push($failedFieldName, 'password');
                }
            } */

            // dd($e->validator->failedRules);

            return view('signup')->with('status', 'false')->with('message', $e->getMessage());
        }

    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

}
