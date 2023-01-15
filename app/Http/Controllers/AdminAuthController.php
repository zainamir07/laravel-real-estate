<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Listing;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Models\User;
class AdminAuthController extends Controller
{
    public function index(){
        $users = User::count();
        $listing = Listing::count();
        $categories = Category::count();
        $data = compact('users', 'listing', 'categories');
        return view('admin.dashboard')->with($data);
    }
}
