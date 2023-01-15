<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    // public function index(){
    //     $users = User::all();
    //     $data = compact('users');
    //     return view('admin.users')->with($data);
    // }
    public function index(Request $request){
        $user_id = session()->get('user_id');
        $search = $request['search'] ?? "";
        if($search != ""){
          $users = User::where('id', '!=', $user_id)->orderBy('id', 'desc')->where("name", "LIKE", "%$search%")->orWhere("email", "LIKE", "%$search%")->paginate(5);
        }else{
          $users = User::where('id', '!=', $user_id)->orderBy('id', 'desc')->paginate(5);
        }
      //    return view('user');
        $data = compact('users', 'search');
        return view('admin/users')->with($data);
      }


    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        $user = new User;
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = md5($request['password']);
        $user->save();
        if($user){
            return redirect('admin/users')->with('success', 'User Has Been Added');   
        }else{
            return redirect('admin/users')->with('error', 'Something Went Wrong');
        }
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        if($user){
            return redirect('admin/users')->with('success', 'User Has Been Delete');   
        }else{
            return redirect('admin/users')->with('error', 'Something Went Wrong');
        }
    }

    public function edit($id){
        $user = User::find($id);
        return response()->json([
            'user_id' => $user,
        ]);
    }
    
    public function update(Request $request){
        $request->validate([
            'editname' => 'required',
            'editemail' => 'required|email',
            'editpassword' => 'required',
            'editstatus' => 'required',
        ]);
        $user_id = $request['user_id'];
        $user = User::find($user_id);
        $user->name = $request['editname'];
        $user->email = $request['editemail'];
        $user->status = $request['editstatus'];
        $user->password = md5($request['editpassword']);
        $user->save();
        if($user){
            return redirect('admin/users')->with('success', 'User Has Been Updated');   
        }else{
            return redirect('admin/users')->with('error', 'Something Went Wrong');
        }
    }

}
