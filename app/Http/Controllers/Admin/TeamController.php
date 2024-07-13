<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    public function index()
    {
        $title = "Team";
        return view("pages.admin.team", compact("title"));
    }

    // FRONT PAGE
    public function homeTeam(Request $request)
    {
        $title = 'Teams - PT. SAMUDERA RIZKI SEJAHTERA';
        $teams = Team::where(function ($query) use ($request) {
            if (($s = $request->s)) {
                $query->orWhere('name', 'LIKE', '%' . $s . '%')
                    ->orWhere('position', 'LIKE', '%' . $s . '%')
                    ->get();
            }
        })
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $reviews = Review::inRandomOrder()->limit(4)->get();
        return view('pages.front.team', compact('title', 'teams', 'reviews'));
    }

    // HANDLER API
    public function create(Request $request)
    {
        try {
            $data = $request->all();
            $rules = [
                "name" => "required|string",
                "position" => "required|string",
                "image" => "required|image|max:1024|mimes:giv,svg,jpeg,png,jpg"
            ];

            $messages = [
                "name.required" => "Nama harus diisi",
                "position.required" => "Posisi harus diisi",
                "image.required" => "Gambar harus diisi",
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
            $data['image'] = $request->file('image')->store('assets/team', 'public');
            Team::create($data);

            return response()->json([
                "status" => "success",
                "message" => "Data slide berhasil disimpan"
            ]);
        } catch (\Exception $err) {
            if ($request->file('image')) {
                unlink(public_path('storage/assets/team/' . $request->image->hashName()));
            }
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage()
            ], 500);
        }
    }

    public function getDetail($id)
    {
        try {
            $team = Team::find($id);

            if (!$team) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data tidak ditemukan",
                ], 404);
            }

            return response()->json([
                "status" => "success",
                "data" => $team
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage()
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
                "position" => "required|string",
                "image" => "nullable",
            ];

            if ($request->file('image')) {
                $rules['image'] .= '|image|max:1024|mimes:giv,svg,jpeg,png,jpg';
            }

            $messages = [
                "id.required" => "Data ID harus diisi",
                "id.integer" => "Type ID tidak sesuai",
                "name.required" => "Nama harus diisi",
                "position.required" => "Posisi harus diisi",
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
            $team = Team::find($data['id']);

            if (!$team) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data team tidak ditemukan"
                ], 404);
            }

            // delete undefined data image
            unset($data["image"]);
            if ($request->file('image')) {
                $oldImagePath = "public/" . $team->image;
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
                $data['image'] = $request->file('image')->store('assets/team', 'public');
            }

            $team->update($data);
            return response()->json([
                "status" => "success",
                "message" => "Data team berhasil diperbarui"
            ]);
        } catch (\Exception $err) {
            if ($request->file('image')) {
                unlink(public_path('storage/assets/team/' . $request->image->hashName()));
            }
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage()
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
            $team = Team::find($id);
            if (!$team) {
                return response()->json([
                    "status" => "error",
                    "message" => "Data team tidak ditemukan"
                ], 404);
            }

            $oldImagePath = "public/" . $team->image;
            if (Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }

            $team->delete();
            return response()->json([
                "status" => "success",
                "message" => "Data team berhasil dihapus"
            ]);
        } catch (\Exception $err) {
            return response()->json([
                "status" => "error",
                "message" => $err->getMessage()
            ], 500);
        }
    }

    public function dataTable(Request $request)
    {
        $query = Team::query();

        if ($request->query("search")) {
            $searchValue = $request->query("search")['value'];
            $query->where(function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('position', 'like', '%' . $searchValue . '%');
            });
        }

        $recordsFiltered = $query->count();

        $data = $query->orderBy('created_at', 'desc')
            ->skip($request->query('start'))
            ->limit($request->query('length'))
            ->get();

        $output = $data->map(function ($item) {
            $action = "<div class='dropdown-primary dropdown open'>
                            <button class='btn btn-sm btn-primary dropdown-toggle waves-effect waves-light' id='dropdown-{$item->id}' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
                                Aksi
                            </button>
                            <div class='dropdown-menu' aria-labelledby='dropdown-{$item->id}' data-dropdown-out='fadeOut'>
                                <a class='dropdown-item' onclick='return getData(\"{$item->id}\");' href='javascript:void(0);' title='Edit'>Edit</a>
                                <a class='dropdown-item' onclick='return removeData(\"{$item->id}\");' href='javascript:void(0)' title='Hapus'>Hapus</a>
                            </div>
                        </div>";

            $image = '<div class="thumbnail">
                        <div class="thumb">
                            <img src="' . Storage::url($item->image) . '" alt="" width="300px" height="300px" 
                            class="img-fluid img-thumbnail" alt="' . $item->title . '">
                        </div>
                    </div>';
            $item['action'] = $action;
            $item['image'] = $image;
            return $item;
        });

        $total = Team::count();
        return response()->json([
            'draw' => $request->query('draw'),
            'recordsFiltered' => $recordsFiltered,
            'recordsTotal' => $total,
            'data' => $output,
        ]);
    }
}
