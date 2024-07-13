<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\PublicInformation;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    public function index()
    {
        $title = "Tentang Kami";
        return view("pages.admin.about", compact("title"));
    }

    public function webinfo()
    {
        return view("pages.admin.abouts.webinfo");
    }

    public function profile()
    {
        return view("pages.admin.abouts.profile");
    }

    public function sosmed()
    {
        return view("pages.admin.abouts.sosmed");
    }

    public function maps()
    {
        return view("pages.admin.abouts.maps");
    }

    // FRONT PAGE
    public function homeAbout()
    {
        $title = 'About - PT. SAMUDERA RIZKI SEJAHTERA';
        $about = About::first();
        $information = PublicInformation::first();
        $teams = Team::inRandomOrder()->limit(4)->get();

        return view('pages.front.about', compact('title', 'about', 'information', 'teams'));
    }

    // HANDLER API
    public function getDetail()
    {
        try {
            $data = About::first();

            if (!$data) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data masih kosong"
                ], 404);
            }

            if ($data['location'] && $data['location'] != "") {
                $data['maps_preview'] = "<iframe src='" . $data["location"] . "' allowfullscreen class='w-100' height='500'></iframe>";
            }
            return response()->json([
                "status" => "success",
                "data" => $data
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage()
            ], 500);
        }
    }

    public function createAndUpdate(Request $request)
    {
        try {
            $data = $request->all();
            $rules = [
                "id" => "nullable",
                "address" => "required|string",
                "description" => "required|string",
                "location" => "required|string",
                "whatsapp" => "required|string",
                "telegram" => "required|string",
                "email" => "required|string",
                "twitter" => "required|string",
                "youtube" => "required|string",
                "linkedin" => "required|string",
            ];

            $messages = [
                "address.required" => "Nama Website harus diisi",
                "description.required" => "Deskripsi harus diisi",
                "location.required" => "Embed Google Maps harus diisi",
                "whatsapp.required" => "WhastApp harus diisi",
                "telegram.required" => "Telegram harus diisi",
                "email.required" => "Email harus diisi",
                "twitter.required" => "Twitter harus diisi",
                "youtube.required" => "Youtube harus diisi",
                "linkedin.required" => "LinkedIn harus diisi",
            ];

            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first()
                ], 400);
            }

            $about = About::first();

            if ($about) {
                // update
                $about->update($data);
                return response()->json([
                    "status" => "success",
                    "message" => "Data berhasil diperbarui"
                ]);
            }

            // ceate
            About::create($data);

            return response()->json([
                "status" => "success",
                "message" => "Data berhasil disimpan"
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage()
            ], 500);
        }
    }
}
