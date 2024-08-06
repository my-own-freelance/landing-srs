<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PublicInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicInformationController extends Controller
{
    public function index()
    {
        $title = "Informasi Publik";
        return view('pages.admin.public-information', compact("title"));
    }

    // HANDLER API
    public function getDetail()
    {
        try {
            $data = PublicInformation::first();
            if (!$data) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data informasi publik masih kosong"
                ], 404);
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
                "title" => "required|string",
                "description" => "required|string",
                "happy_client" => "required|integer",
                "complete_shipment" => "required|integer",
                "customer_review" => "required|integer",
                "contact_us" => "required|string",
            ];

            $messages = [
                "title.required" => "Judul harus diisi",
                "description.required" => "Deskripsi harus diisi",
                "happy_client.required" => "Jumlah pelanggan senang harus diisi",
                "complete_shipment.required" => "Jumlah pengiriman sukses harus diisi",
                "customer_review.required" => "Jumalh review pelanggan harus diisi",
                "contact_us.required" => "Kontak Kami harus diisi",
            ];

            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first(),
                ], 400);
            }

            $publicInformation = PublicInformation::first();

            if ($publicInformation) {
                $publicInformation->update($data);
                return response()->json([
                    "status" => "success",
                    "message" => "Data berhasil diperbarui"
                ]);
            }

            // ceate
            PublicInformation::create($data);

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
