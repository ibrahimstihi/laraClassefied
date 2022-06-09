<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\Category;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function new_ads(){
        $ads = Advertisement::paginate(8);
        return view('admin.new_ads', ['ads' => $ads, 'categories' => Category::all()]);    
    }
    public function old_ads(){
        $ads = Advertisement::paginate(8);
        return view('admin.old_ads', ['ads' => $ads, 'categories' => Category::all()]);    
    }
    
}
