<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = json_decode(Cookie::get("user"));
        $title = "DASHBOARD";

        return view("pages.admin.index", compact(
            "title",
        ));
    }
}
