<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use App\Employees;
class Employee extends Controller
{
    public function employee_registration(){
        return view('emp_registration');
      }

      public function postRegistrationEmp(Request $request)
      {  
          request()->validate([
          'name' => 'required',
          'email' => 'required|email|unique:emp',
          'password' => 'required|min:5',   
          ]);
           
          //$data = $request->all();
          $emp = Employees::create(request(['name', 'email', 'password']));
         // $check = $this->create($data);
         
          return Redirect::to("login")->withSuccess('Great! You have Successfully loggedin');
      }
      protected function create(array $data)
      {
          return Employees::create([
              'name' => $data['name'],
              'email' => $data['email'],
              'password' => bcrypt($data['password']),
              
          ]);
      }
}
