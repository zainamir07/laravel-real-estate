<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Custom;

class ListingController extends Controller
{
    // function index(){
    //     $listing = Listing::all(); 
    //     $categories = Category::all();
    //     $data = compact('listing', 'categories');
    //     return view('admin.listing')->with($data);
    // }
    public function index(Request $request){
      $search = $request['search'] ?? "";
      if($search != ""){
        $listing = Listing::orderBy('list_id', 'desc')->where("title", "LIKE", "%$search%")->orWhere("price", "LIKE", "%$search%")->paginate(5);
      }else{
        $listing = Listing::orderBy('list_id', 'desc')->paginate(5);
      }
    //    return view('user');
      $categories = Category::orderBy('category_id', 'desc')->get();
      $data = compact('listing', 'search', 'categories');
      return view('admin.listing')->with($data);
    }

    public function FrontPageListing($purpose = "", $category_id = "", Request $request){
      // echo $category_id;
      // echo $purpose;
      // die;
      $search = $request['search'] ?? "";
      if($search != ""){
        $listing = Listing::orderBy('list_id', 'desc')->where("title", "LIKE", "%$search%")->orwhere("price", "LIKE", "%$search%")->orwhere("address", "LIKE", "%$search%")->orwhere("city", "LIKE", "%$search%")->get();

      }else if($purpose != ""){
        $listing = Listing::orderBy('list_id', 'desc')->where('purpose', '=', $purpose)->get();
        // echo '<pre>';
        // print_r($listing);
        // die;

      }else if($category_id != ""){
        $listing = Listing::orderBy('list_id', 'desc')->where('category_id', '=', $category_id)->get();
        echo '<pre>';
        print_r($listing);
        die;

      }else{
        $listing = Listing::orderBy('list_id', 'desc')->get();
        // echo '<pre>';
        // print_r($listing);
        // die;
      }
      $data = compact('listing', 'search', 'purpose', 'category_id');
      return view('properties')->with($data);
    }


    function store(Request $request){
       $request->validate([
         'title' => 'required',
         'purpose' => 'required',
         'category' => 'required',
         'city' => 'required',
         'address' => 'required',
         'contact' => 'required',
         'price' => 'required',
         'image' => 'required',
         'description' => 'required',
       ]);
       
       $imageName = time().".".$request->image->extension();
       $request->image->move(public_path('Backend/listing_images'), $imageName);

       $listing = new Listing;
       $listing->title = $request['title'];
       $listing->purpose = $request['purpose'];
       $listing->category_id = $request['category'];
       $listing->city = $request['city'];
       $listing->address = $request['address'];
       $listing->Contact = $request['contact'];
       $listing->price = $request['price'];
       $listing->status = "A";
       $listing->image = $imageName;
       $listing->description = $request['description'];
       $listing->author_id = session()->get('user_id');
       $listing->save();

       if($listing){
        return redirect('admin/listing')->with('success', 'Listed Successfully');
       }else{
        return redirect('admin/listing')->with('error', 'Something Went Wrong');
       }

    }

    public function delete($id){
      $list = Listing::find($id);
      $list->delete();
      if($list){
        return redirect('admin/listing')->with('success', 'Recorded has been Deleted');
      }else{
        return redirect('admin/listing')->with('error', 'Something Went Wrong');
      }
    }

    public function edit($id){
      $list = Listing::find($id);
      return response()->json([
        'list_id' => $list,
    ]);
    }
    
    function update(Request $request){
      $request->validate([
        'edittitle' => 'required',
        'editpurpose' => 'required',
        'editcategory' => 'required',
        'editcity' => 'required',
        'editaddress' => 'required',
        'editContact' => 'required',
        'editprice' => 'required',
        'editdescription' => 'required',
      ],
    
    // [
    //    'edittitle.required' => 'This is a custom title field', 
    // ]
  );
      
      $listing = new Listing;
      $listing->title = $request['edittitle'];
      $listing->purpose = $request['editpurpose'];
      $listing->category_id = $request['editcategory'];
      $listing->city = $request['editcity'];
      $listing->address = $request['editaddress'];
      $listing->Contact = $request['editContact'];
      $listing->price = $request['editprice'];
      $listing->status = "A";
      if($request['image'] != ""){
        $imageName = time().".".$request->image->extension();
        $request->image->move(public_path('Backend/listing_images'), $imageName);
        $listing->image = $imageName;
      }else{
        $listing->image = $request['oldImage'];
      }
      $listing->description = $request['editdescription'];
      $listing->author_id = session()->get('user_id');
      $listing->save();
      // echo "<pre>";
      // print_r($listing->toArray());
      // die;
      if($listing){
       return redirect('admin/listing')->with('success', 'Record Updated Successfully');
      }else{
       return redirect('admin/listing')->with('error', 'Something Went Wrong');
      }

   }
  
//    public function editValidate(Request $request){
//     {
//       $validator = Validator::make($request->all(), [
//           'title' => 'required',
//           'purpose' => 'required|email',
//           'category' => 'required',
//           'city' => 'required',
//           'address' => 'required',
//           'contact' => 'required',
//           'price' => 'required',
//           'description' => 'required',
//       ]);

//       if ($validator->passes()) {

//           return response()->json(['success'=>'Added new records.']);
          
//       }

//       return response()->json(['error'=>$validator->errors()]);
//   }

// }

    public function myListing(){
      $userID = session()->get('user_id');
      $listing = Listing::orderBy('list_id', 'desc')->where('author_id', '=', $userID)->get();
      $categories = Category::all();
      // $listing = Listing::with('user_id')->all();
      // echo '<pre>';
      // print_r($listing->toArray());
      // die;
      $data = compact('listing', 'categories');
      return view('mylisting')->with($data);
    }

    public function AddMyListing(Request $request){
      $request->validate([
        'title' => 'required',
        'purpose' => 'required',
        'category' => 'required',
        'city' => 'required',
        'address' => 'required',
        'contact' => 'required',
        'price' => 'required',
        'image' => 'required',
        'description' => 'required',
      ]);
      
      $imageName = time().".".$request->image->extension();
      $request->image->move(public_path('Backend/listing_images'), $imageName);

      $listing = new Listing;
      $listing->title = $request['title'];
      $listing->purpose = $request['purpose'];
      $listing->category_id = $request['category'];
      $listing->city = $request['city'];
      $listing->address = $request['address'];
      $listing->Contact = $request['contact'];
      $listing->price = $request['price'];
      $listing->status = "A";
      $listing->image = $imageName;
      $listing->description = $request['description'];
      $listing->author_id = session()->get('user_id');
      $listing->save();

      if($listing){
       return redirect('mylisting')->with('success', 'Listed Successfully');
      }else{
       return redirect('mylisting')->with('error', 'Something Went Wrong');
      }
      
    }

    public function DeleteMyListing($id){
      $listing = Listing::find($id);
      $listing->delete();
      if($listing){
        return redirect('mylisting')->with('success', 'Record has beed Deleted');
       }else{
        return redirect('mylisting')->with('error', 'Something Went Wrong');
       }
    }

    public function EditMyListing($id){
       $list = Listing::find($id);
       $categories = Category::all();
       $data = compact('list', 'categories');
       return view('editListing')->with($data);
    }
    
    public function UpdateMyListing($id, Request $request){
      $request->validate([
        'title' => 'required',
        'purpose' => 'required',
        'category' => 'required',
        'city' => 'required',
        'address' => 'required',
        'contact' => 'required',
        'price' => 'required',
        'description' => 'required',
      ]);
      
      
      $listing = Listing::find($id);
      $listing->title = $request['title'];
      $listing->purpose = $request['purpose'];
      $listing->category_id = $request['category'];
      $listing->city = $request['city'];
      $listing->address = $request['address'];
      $listing->Contact = $request['contact'];
      $listing->price = $request['price'];
      $listing->status = "A";
      if($request['image'] != ""){
        $imageName = time().".".$request->image->extension();
        $request->image->move(public_path('Backend/listing_images'), $imageName);
        $listing->image = $imageName;
      }else{
        $listing->image = $request['oldImage'];
      }
      $listing->description = $request['description'];
      $listing->author_id = session()->get('user_id');
      $listing->update();

      if($listing){
       return redirect('mylisting')->with('success', 'Updated Successfully');
      }else{
       return redirect('mylisting')->with('error', 'Something Went Wrong');
      }
    }
  
    public function displayProperty($id){
      $listing = Listing::find($id);
      $data = compact('listing');
      return view('displayProperty')->with($data);
    }
}
