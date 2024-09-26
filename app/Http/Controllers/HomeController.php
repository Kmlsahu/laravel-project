<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where("status", 1)->get();
        return view('web.home', compact('sliders'));
    }

    public function contact()
    {
        return view('web.contact');
    }

    public function page(String $urlkey)
    {
        $pages = Page::where('url_key', $urlkey)->where('status', 1)->first();
        return view('web.page', compact('pages'));
    }

    public function category(String $urlkey)
    {
        $category = Category::where('url_key', $urlkey)->where('status', 1)->first();

        // $products = Product::orderBy('id', 'DESC')->get();
        return view('web.category', compact('category'));
    }

    public function product(String $urlkey)
    {
        $products = Product::where('url_key', $urlkey)->where('status', 1)->with('attributes.attributeValue')->first();
        return view('web.product', compact('products'));
    }
}
