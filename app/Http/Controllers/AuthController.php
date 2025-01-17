<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $title = "Kelola Akses";
        return view("pages.auth.index", compact("title"));
    }

    public function account()
    {
        $title = "Kelola Akun";
        return view("pages.admin.account", compact("title"));
    }

    public function validateLogin(Request $request)
    {
        try {
            $rules = [
                "username" => "required|string",
                "password" => "required|string",
            ];

            $messages = [
                "username.required" => "Username harus diisi",
                "password.required" => "Password harus diisi"
            ];

            $validate = Validator::make($request->all(), $rules, $messages);
            if ($validate->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validate->errors()->first(),
                ], 400);
            }

            $user = User::where('username', $request->username)->first();

            if ($user && $user->is_active != "Y") {
                return response()->json([
                    "status" => "error",
                    "message" => "Akun tidak aktif"
                ], 400);
            }

            if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                $data = User::where('username', $request->username)
                    ->select('name', 'username', 'role', 'is_active')
                    ->first();

                // $request->session()->put('user', $data);
                Cookie::queue("user", $data);
                return response()->json([
                    "status" => "success",
                    "message" => "Login Sukses",
                ]);
            }

            return response()->json([
                "status" => "error",
                "message" => "Username / Password salah"
            ], 400);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage()
            ], 500);
        }
    }
    public function logout(Request $request)
    {
        // $request->session()->forget('user');
        Auth::logout();
        Cookie::queue(Cookie::forget("user"));

        return redirect()->route('home');
    }

    public function detail()
    {
        try {
            $user = json_decode(Cookie::get("user"));
            $data = User::where("username", $user->username)->first();
            if (!$user) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data user tidak ditemukan"
                ], 404);
            }

            return response()->json([
                "status" => "success",
                "data" => $data
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage(),
                "user" => $user
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $data = $request->all();
            $rules = [
                "id" => "required|integer",
                "name" => "required|string",
                "password" => "nullable",
            ];

            if ($data["password"]) {
                $rules["password"] .= "|string|min:5";
            }
            $messages = [
                "id.required" => "Data ID harus diisi",
                "id.integer" => "Type ID tidak sesuai",
                "name.required" => "Nama harus diisi",
                "password.min" => "Password minimal 5 karakter",
            ];

            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first(),
                ], 400);
            }

            $user = User::find($data["id"]);
            if (!$user) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data user tidak ditemukan"
                ], 404);
            }

            if ($data["password"]) {
                $data["password"] = Hash::make($data["password"]);
            } else {
                unset($data["password"]);
            }

            $user->update($data);

            return response()->json([
                "status" => "success",
                "message" => "Update berhasil"
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage()
            ], 500);
        }
    }
}
