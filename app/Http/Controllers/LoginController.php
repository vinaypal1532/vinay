<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
//Use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;


class LoginController extends Controller
{
  public function login(){
    return view('login');
  }
  public function loginuserdata(Request $request){
   
    request()->validate([
        'email' => 'required',
        'password' => 'required',
        ]);
 
        $credentials = $request->only('email', 'password');
       // print_r($credentials);die;
        if (Auth::attempt($credentials)) {
             session(['name' => $credentials['email']]);
            return redirect()->intended('dashboard');
        }
        return Redirect::to("login")->withSuccess('Oppes! You have entered invalid credentials');
  }

  public function registration()
  {
      return view('registration');
  }
   
  public function postRegistration(Request $request)
  {  
      request()->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:6',
      ]);
       
      $data = $request->all();
print_r( $data); die;
      $check = $this->create($data);
     
      return Redirect::to("dashboard")->withSuccess('Great! You have Successfully loggedin');
  }
   

  public function dashboard()
    {
 
      if(Auth::check()){
        return view('dashboard');
       
      }
       return Redirect::to("login")->withSuccess('Opps! You do not have access');
    }


    public function logout(Request $request ) {
      $request->session()->flush();
      Auth::logout();
      return Redirect('login');
      }
}
