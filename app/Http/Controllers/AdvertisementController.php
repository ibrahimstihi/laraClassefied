<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\Category;

class AdvertisementController extends Controller
{
    const FORM_VALIDATION_RULES = [
        'description' => 'required|min:10|max:1000',
        'price' => 'required|numeric|between:0,99999.99',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'category_id' => 'required|exists:categories,id',
    ];

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'adsByCategory']]);
    }

    public function index()
    {
        $ads = Advertisement::paginate(8);

        return view('advertisement.index', ['ads' => $ads, 'categories' => Category::all()]);
    }
    
    public function adsByCategory($id)
    {
        $category = Category::find($id);

        if (!$category) {
            abort(404);
        }

        $ads = Advertisement::where('category_id', $category->id)->paginate(8);

        return view('advertisement.index', ['ads' => $ads, 'categories' => Category::all(), 'category' => $category]);
    }

    public function create()
    {
        return view('advertisement.create', ['categories' => Category::all()]);
    }

    public function store(Request $request)
    {
        $request->validate(self::FORM_VALIDATION_RULES);

        $ad = Advertisement::create($request->all());
        $ad->updateImage($request->image);
        //start
        $ad->updateImage1($request->image1);
        $ad->updateImage2($request->image2);
        $ad->updateImage3($request->image3);
        //end

        return redirect(route('advertisement.show', [$ad->id]))
            ->with('message_type', 'success')
            ->with('message', 'You have successfully posted advertisement.');
    }

    public function show($id)
    {
        $ad = Advertisement::find($id);

        if (!$ad) {
            abort(404);
        }
        return view('advertisement.show', ['ad' => $ad]);
    }

    public function edit($id)
    {
        $ad = Advertisement::find($id);

        if (!$ad) {
            abort(404);
        }

        if (Auth::id() !== $ad->user_id) {
            abort(403);
        }

        return view('advertisement.edit', ['ad' => $ad, 'categories' => Category::all()]);
    }

    public function update(Request $request, $id)
    {
        $ad = Advertisement::find($id);

        if (Auth::id() !== $ad->user_id) {
            abort(403);
        }

        $request->validate(self::FORM_VALIDATION_RULES);

        $ad->update($request->all());
        $ad->updateImage($request->image);
        //start
        $ad->updateImage1($request->image1);
        $ad->updateImage2($request->image2);
        $ad->updateImage3($request->image3);
        //end
        return redirect(route('advertisement.show', [$ad->id]))
            ->with('message_type', 'success')
            ->with('message', 'You have successfully updated advertisement.');
    }
    public function ads_valide(Advertisement $ad)
    {
        $ad->is_valide = 1;
        return $ad->price;
    }

    public function destroy($id)
    {
        $ad = Advertisement::find($id);

        if (!$ad) {
            return redirect(route('advertisement.admin'));
        }

        
        if(Auth::id() !== $ad->user_id || Auth::user()->is_admin==1){
            $ad->delete();
        }else{
            abort(403);
        }
        if(Auth::user()->is_admin==1){
            return back()
            ->with('message_type', 'success')
            ->with('message', 'You have successfully deleted advertisement.');
        }
        return redirect(route('advertisement.admin'))
            ->with('message_type', 'success')
            ->with('message', 'You have successfully deleted advertisement.');
    }

    public function admin()
    {
        $ads = Advertisement::where('user_id', Auth::id())->get();

        return view('advertisement.admin', ['ads' => $ads]);
    }
    public function valide($id)
    {
        $ad = Advertisement::find($id);
        $ad->is_valide = 1;
        $ad->save();

        return back();
    }
    public function masque($id)
    {
        $ad = Advertisement::find($id);
        $ad->is_valide = 0;
        $ad->save();

        return back();
    }
    // public function ads_valide(Advertisement $ad)
    // {
    //     $ad->is_valide = 1;
    //     $ad->price =1000;
    //     $ad->description = $ad->description;
    //     $ad->image_url = $ad->image_url;
    //     $ad->titre= $ad->titre;
    //     $ad->ville = $ad->ville;
    //     $ad->category_id=$ad->category_id;
    //     $ad->save();      
    //     return back();
    // }
}
