<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $title = "Produk";
        return view("pages.admin.product", compact("title"));
    }

    // HANDLER API
    public function dataTable(Request $request)
    {
        $query = Product::query();

        if ($request->query("search")) {
            $searchValue = $request->query("search")['value'];
            $query->where(function ($query) use ($searchValue) {
                $query->where('title', 'like', '%' . $searchValue . '%');
            });
        }

        $recordsFiltered = $query->count();
        $data = $query->orderBy('created_at', 'desc')
            ->skip($request->query('start'))
            ->limit($request->query('length'))
            ->get();

        $output = $data->map(function ($item) {
            $action = " <div class='dropdown-primary dropdown open'>
                            <button class='btn btn-sm btn-primary dropdown-toggle waves-effect waves-light' id='dropdown-{$item->id}' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
                                Aksi
                            </button>
                            <div class='dropdown-menu' aria-labelledby='dropdown-{$item->id}' data-dropdown-out='fadeOut'>
                                <a class='dropdown-item' onclick='return getData(\"{$item->id}\");' href='javascript:void(0);' title='Edit'>Edit</a>
                                <a class='dropdown-item' onclick='return removeData(\"{$item->id}\");' href='javascript:void(0)' title='Hapus'>Hapus</a>
                            </div>
                        </div>";

            $is_publish = $item->is_publish == 'Y' ? '
                <div class="text-center">
                    <span class="label-switch">Publish</span>
                </div>
                <div class="input-row">
                    <div class="toggle_status on">
                        <input type="checkbox" onclick="return updateStatus(\'' . $item->id . '\', \'Draft\');" />
                        <span class="slider"></span>
                    </div>
                </div>' :
                '<div class="text-center">
                    <span class="label-switch">Draft</span>
                </div>
                <div class="input-row">
                    <div class="toggle_status off">
                        <input type="checkbox" onclick="return updateStatus(\'' . $item->id . '\', \'Publish\');" />
                        <span class="slider"></span>
                    </div>
                </div>';

            $image = '<div class="thumbnail">
                        <div class="thumb">
                            <img src="' . Storage::url($item->image) . '" alt="" width="300px" height="300px" 
                            class="img-fluid img-thumbnail" alt="' . $item->title . '">
                        </div>
                    </div>';
            $title = "<p>" . Str::limit(strip_tags($item->title), 100) . "</p>";
            $item['action'] = $action;
            $item['is_publish'] = $is_publish;
            $item['image'] = $image;
            $item['title'] = $title;
            return $item;
        });

        $total = Product::count();
        return response()->json([
            'draw' => $request->query('draw'),
            'recordsFiltered' => $recordsFiltered,
            'recordsTotal' => $total,
            'data' => $output,
        ]);
    }

    public function getDetail($id)
    {
        try {
            $article = Product::find($id);

            if (!$article) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan",
                ], 404);
            }

            return response()->json([
                "status" => "success",
                "data" => $article
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage()
            ], 500);
        }
    }

    public function create(Request $request)
    {
        try {
            $data = $request->all();
            $rules = [
                "title" => "required|string",
                "excerpt" => "required|string|max:250",
                "description" => "required|string",
                "is_publish" => "required|string|in:Y,N",
                "image" => "required|image|max:1024|mimes:giv,svg,jpeg,png,jpg"
            ];

            $messages = [
                "title.required" => "Judul harus diisi",
                "excerpt.required" => "Kutipan harus diisi",
                "excerpt.max" => "Kutipan harus kurang dari 250 karakter",
                "description.required" => "Deskripsi harus diisi",
                "is_publish.required" => "Status harus diisi",
                "is_publish.in" => "Status tidak sesuai",
                "image.required" => "Gambar harus di isi",
                "image.image" => "Gambar yang di upload tidak valid",
                "image.max" => "Ukuran gambar maximal 1MB",
                "image.mimes" => "Format gambar harus giv/svg/jpeg/png/jpg"
            ];

            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first(),
                ], 400);
            }

            if ($request->file('image')) {
                $data['image'] = $request->file('image')->store('assets/product', 'public');
            }
            $data["slug"] = Str::slug($data["title"]);

            Product::create($data);
            return response()->json([
                "status" => "success",
                "message" => "Data berhasil dibuat"
            ]);
        } catch (\Exception $err) {
            if ($request->file("image")) {
                unlink(public_path("storage/assets/product/" . $request->image->hashName()));
            }
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $data = $request->all();
            $rules = [
                "id" => "required|integer",
                "title" => "required|string",
                "excerpt" => "required|string|max:250",
                "description" => "required|string",
                "is_publish" => "required|string|in:Y,N",
                "image" => "nullable"
            ];

            if ($request->file('image')) {
                $rules['image'] .= '|image|max:1024|mimes:giv,svg,jpeg,png,jpg';
            }

            $messages = [
                "id.required" => "Data ID harus diisi",
                "id.integer" => "Type ID tidak sesuai",
                "title.required" => "Judul harus diisi",
                "excerpt.required" => "Kutipan harus diisi",
                "excerpt.max" => "Kutipan harus kurang dari 250 karakter",
                "description.required" => "Deskripsi harus diisi",
                "is_publish.required" => "Status harus diisi",
                "is_publish.in" => "Status tidak sesuai",
                "image.image" => "Gambar yang di upload tidak valid",
                "image.max" => "Ukuran gambar maximal 1MB",
                "image.mimes" => "Format gambar harus giv/svg/jpeg/png/jpg"
            ];

            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first(),
                ], 400);
            }

            $product = Product::find($data['id']);
            if (!$product) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan"
                ], 404);
            }

            // delete undefined data image
            unset($data["image"]);
            if ($request->file("image")) {
                $oldImagePath = "public/" . $product->image;
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
                $data["image"] = $request->file("image")->store("assets/product", "public");
            }

            if ($data["title"]) {
                $data["slug"] = Str::slug($data["title"]);
            }

            $product->update($data);
            return response()->json([
                "status" => "success",
                "message" => "Data berhasil diperbarui"
            ]);
        } catch (\Exception $err) {
            if ($request->file("image")) {
                unlink(public_path("storage/assets/product/" . $request->image->hashName()));
            }
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage(),
            ], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $data = $request->all();
            $rules = [
                "id" => "required|integer",
                "is_publish" => "required|string|in:Y,N",
            ];

            $messages = [
                "id.required" => "Data ID harus diisi",
                "id.integer" => "Type ID tidak sesuai",
                "is_publish.required" => "Status harus diisi",
                "is_publish.in" => "Status tidak sesuai",
            ];

            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first(),
                ], 400);
            }

            $product = Product::find($data['id']);
            if (!$product) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan"
                ], 404);
            }
            $product->update($data);
            return response()->json([
                "status" => "success",
                "message" => "Status berhasil diperbarui"
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage(),
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), ["id" => "required|integer"], [
                "id.required" => "Data ID harus diisi",
                "id.integer" => "Type ID tidak valid"
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first()
                ], 400);
            }

            $id = $request->id;
            $product = Product::find($id);
            if (!$product) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan"
                ], 404);
            }
            $oldImagePath = "public/" . $product->image;
            if (Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }

            $product->delete();
            return response()->json([
                "status" => "success",
                "message" => "Data berhasil dihapus"
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage()
            ], 500);
        }
    }
}
