<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $table = 'emp';
   // protected $fillable = ['first_name', 'last_name', 'email'];
   protected $fillable = [
    'name', 'email', 'password',
];
   public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
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
