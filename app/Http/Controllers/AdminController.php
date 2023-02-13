<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Carbon\Carbon;
use Ramsey\Uuid\Type\Time;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminController extends ResponseController
{
    
   // constructor
    public function __construct()
    {
      $this->middleware('AdminAuth:admin')->except('login','createAdmin');
    //  $this->middleware('BossAdmin:admin')->except('login','logout');
    }


 //////// create Admin
    
   public function createAdmin(Request $request){
    //  $d=date_parse("2022-07-05T13:00:18.000000Z");
    // //  return $d['year']+1;
    // return anArray($d);
       $validate=Validator::make($request->all(),
        [
           'name'=>'required',
           'email'=>'required|unique:admins|string|email|max:255',
           'password'=>'required|min:8|'
        ]);
    
       if($validate->fails()){
       return $this->responseError($validate->errors());
       }

        Admin::create(['name'=>$request->get('name'),
       'email'=>$request->get('email'),
       'password'=>Hash::make($request->get('password')),
            ] );

        $user=Admin::where('email',$request->email)->first();
        $token = JWTAuth::fromUser($user);
        return $this->responseData($token,'Registeration sccessful');
      }

  //////////// delet admin
    
    public function deletAdmin(Request $request){

      $validate=Validator::make($request->all(),
       [
          'email'=>'required|exists:admins|string|email|max:255',
       ]);
   
       if($validate->fails()){
       return $this->responseError($validate->errors());
       }
     
       $boss=Admin::where('id','=','1')->first();
    
       $admin= Admin::where('email','=',$request->email)->first();

       if(! $admin)
       {
        return $this->responseData([],'not found');
       }

       if($admin==$boss){
       return $this->responseData([],'cant delet this accoutn');
       }

       $admin->delete();
       return $this->responseData([],'deleted successfully');
     
   }
  //update admin
  public function updateAdmin(Request $request)
  {
      $validate=Validator::make($request->all(),
      [
      'email'=>'required|string|exists:admins,email|max:255',
      'oldpassword'=>'required|min:8|',
      'newpassword'=>'required|min:8|'
      ]);
      if($validate->fails()){
        return $this->responseError($validate->errors());
        }
      $admin=Admin::where('email',$request->email)->first();
     
      if(Hash::check($request->oldpassword,$admin->password))
      {

      $newpassword=Hash::make($request->get('newpassword'));
      $admin->password=$newpassword;
      Admin::where('email',$request->email)->first()->update(['password'=>$newpassword]);
      return $this->responseData($admin,'updated successfully');
      }
      return $this->responseData([],'invalid oldPassword');
  }
///////// Login
    
   public function login (Request $request)
   {
   
    $validate=Validator::make($request->all(),
    [
    'email'=>'required|string|email|max:255',
    'password'=>'required|min:8|'
    ]);

    if($validate->fails()){
                return $this->responseError($validate->errors());
    }
                   
    $credate=$request->only('email','password');

    if (!auth()->guard('admin')->validate($credate) )
    {
      return $this->responseError('email or password invalid');
    }

    $user =Admin::where('email',$request->email)->first();
    $token = JWTAuth::fromUser($user);
    return $this->responseData($token,'login sccessful');
}


//////// Logout

public function logout()
{
  $logout=auth()->guard('admin')->logout();
  return $this->responseData(null,'logout sccessful');
}

 }