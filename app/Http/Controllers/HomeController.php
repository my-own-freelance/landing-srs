<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Product;
use App\Models\PublicInformation;
use App\Models\Review;
use App\Models\Slide;
use App\Models\Team;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'PT. SAMUDERA RIZKI SEJAHTERA';
        $sliders = Slide::where('is_publish', 'Y')->get();
        $about = About::first();
        $information = PublicInformation::first();
        $products = Product::where('is_publish', 'Y')->orderBy('created_at', 'desc')->limit(6)->get();
        $teams = Team::orderBy('created_at', 'desc')->limit(4)->get();
        $reviews = Review::orderBy('created_at', 'desc')->limit(4)->get();

        return view("pages.front.index", compact(
            'title',
            'sliders',
            'about',
            'information',
            'products',
            'teams',
            'reviews'
        ));
    }
}
