<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;
use App\Helpers\Custom;
class AuthController extends Controller
{
   public function login(){
      return view('auth.login');
   }
   public function register(){
    return view('auth.register');
 }
 public function login_validate(Request $request){
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
       ]);

       $user = User::where('email', '=', $request->email)->first();
       $password = md5($request->password);
      
       if($user){
        if($user->password == $password){
         session()->put('user_id', $user->id);
            session()->put('user_name', $user->name);
            session()->put('user_email', $user->email);
         if($user->id == 1){
               return redirect('admin')->with('success', 'Admin. You have been Logedin');   
         }else{
               return redirect('dashboard')->with('success', 'You have been Logedin');
         }
        }else{
        return redirect('login')->with('error', 'Something Went Wrong');
        }
       }

 }
 public function register_validate(Request $request){
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed',
        'password_confirmation' => 'required',
       ]);
       $user = new User;
       $user->name = $request['name'];
       $user->email = $request['email'];
       $user->status = "A";
       $user->password = md5($request['password']);
       $user->save();

       if($user){
        return redirect('login')->with('success', 'You have been Registered');
       }else{
        return redirect('register')->with('error', 'Something Went Wrong');
       }

 }
 
    public function dashboard(){
        $user_id = session()->get('user_id');
         $listing = Listing::where('author_id', '=', $user_id)->count();
         $status = User::find($user_id);
         $userStatus = $status->status;
         $showListing = Listing::where('author_id', '=', $user_id)->orderBy('list_id', 'desc')->take(3)->get();
         $data = compact('listing', 'userStatus', 'showListing');
         return view('dashboard')->with($data);
     }
    
    public function logout(){
      session()->forget('user_id');
         session()->forget('user_name');
         session()->forget('user_email');
         return redirect('login')->with('success', 'You have been Logged Out');
    }

    public function profile(){
      $user_id = session()->get('user_id');
      $user = User::find($user_id);
      $data = compact('user');
      return view('profile')->with($data);
    }

    public function updateProfile(Request $request){
       $user_id = session()->get('user_id');
       $request->validate([
         'name' => 'required',
         'email' => 'required|email',
       ]);

       if($request['oldPassword'] != ""){
         $request->validate([
           'password' => 'required',
         ]);
         $password = $request['password'];
         $oldPassword = Custom::oldPassword($request['password']);
       }else{
         $user_password = User::find($user_id);
         $password = $user_password->password;
         $oldPassword = "";
       }

      
       if($oldPassword == 1){
         $user = User::find($user_id);
         $user->name = $request['name'];
         $user->email = $request['email'];
         $user->password = md5($password);
         $user->save();
         return redirect('logout')->with('success', 'Password has been updated');
       }else{
         return redirect('profile')->with('error', 'Old Password Not Matched');
       }

    }


      //Find all Users data
    // public function testApi($id = null){
    //    if($id != ""){
    //      return User::find($id);
    //    }else{
    //     return User::all();
    //    }
    // }
    //Find email that matches the given data
  //   public function testApi($key = null){
  //     if($key != ""){
  //       return User::where('email', '=', $key)->get();
  //     }else{
  //      return User::all();
  //     }
  //  }

  //Find specific column
  public function testApi(Request $request){
     $user = new User;
     $user->name = $request->name;
     $user->email = $request->email;
     $user->status = $request->status;
     $user->password = $request->password;
     $result = $user->save();
     if($result){
      return ['Done Data Saved'];
     }else{
      return ['Operation Failed'];
     }
    // return User::select($coloum)->get();
 }
}
