<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use App\User;
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
       
      //$data = $request->all();
      $user = User::create(request(['name', 'email', 'password']));
     // $check = $this->create($data);
     
      return Redirect::to("dashboard")->withSuccess('Great! You have Successfully loggedin');
  }
   
  protected function create(array $data)
  {
      return User::create([
          'name' => $data['name'],
          'email' => $data['email'],
          'password' => bcrypt($data['password']),
          
      ]);
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

      public function image()
      {
          return view('imageform');
      }

      public function storeImage(Request $request)
      {
          $request->validate([
              'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
          ]);
  
          $imageName = time().'.'.$request->image->extension();
  
          // Public Folder
          $request->image->move(public_path('images'), $imageName);
  
          // //Store in Storage Folder
          // $request->image->storeAs('images', $imageName);
  
          // // Store in S3
          // $request->image->storeAs('images', $imageName, 's3');
  
          //Store IMage in DB 
  
  
          return back()->with('success', 'Image uploaded Successfully!')
          ->with('image', $imageName);
      }
}
