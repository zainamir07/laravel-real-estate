<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::orderBy('category_id', 'desc')->get();
        $data = compact('category');
        return view('admin.category')->with($data);
    }

    public function store(Request $request){
       $request->validate([
          'category_name' => 'required',
       ]);
      $category = new Category;
      $category->category_name = $request['category_name'];
      $category->category_status = 'A';
      $category->save();
      if($category){
          return redirect('admin/category')->with('success', 'Category Added Successfully'); 
      }else{
        return redirect('admin/category')->with('error', 'Something Went wrong'); 
      }
    }

    public function delete($id){
      $user = Category::find($id);
      $user->delete();
      if($user){
        return redirect('admin/category')->with('success', 'Recorded has been Deleted');
      }else{
        return redirect('admin/category')->with('error', 'Something Went Wrong');
      }
      // echo '<pre>';
      // print_r($user->toArray());
    }

    public function edit($id){
      $category = Category::find($id);
      return response()->json([
          'cate_id' => $category,
      ]);
  }
 
  public function update(Request $request){
    $request->validate([
      'cate_name' => 'required',
   ]);
   $cate_id = $request['cate_id'];
  $category = Category::find($cate_id);
  $category->category_name = $request['cate_name'];
  $category->category_status = 'A';
  $category->save();
  if($category){
      return redirect('admin/category')->with('success', 'Category Updated Successfully'); 
  }else{
    return redirect('admin/category')->with('error', 'Something Went wrong'); 
  }
  }
}
