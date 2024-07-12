<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Review;
use App\Models\Slide;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $title = "DASHBOARD";
        $articles = Article::count();
        $products = Product::count();
        $slides = Slide::count();
        $galleries = Gallery::count();
        $teams = Team::count();
        $reviews = Review::count();
        $messages = Contact::count();
        $users = User::count();

        return view("pages.admin.index", compact(
            "title",
            "articles",
            "products",
            "slides",
            "galleries",
            "teams",
            "reviews",
            "messages",
            "users"
        ));
    }
}
