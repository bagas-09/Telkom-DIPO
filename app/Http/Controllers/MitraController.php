<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MitraController extends Controller
{
    //
    public function index()
    {
        
        // $status_pekerjaan = array();
        $mitra = Mitra::all();
        $roless = DB::table('role')
            ->select('*')
            ->where('nama_role', '!=', 'GM')
            ->where('nama_role', '!=', 'Admin')
            ->get();

        return view('admin.dashboard.mitra', [
            "title" => "Mitra",
            "mitra" => $mitra,
            "roless" => $roless,
        ]);
    }

    public function storeMitra(Request $request)
    {
         // Lakukan validasi menggunakan Validator di dalam kontroller
         $validator = Validator::make($request->all(), [
            'nama_mitra' => [
                Rule::unique('mitra')->where(function ($query) use ($request) {
                    return $query->where('nama_mitra', $request->nama_mitra)
                                ->where('role', $request->role);
                }),
            ],
        ], [
            'nama_mitra.unique' => 'Kombinasi Nama Mitra dan Role sudah ada dalam database.',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } 
        // $request->validate([
        //     'nama_city' => 'required'
        // ]);

        Mitra::insert([
            // "id" => 2,
            "nama_mitra" => $request->nama_mitra,
            "role" => $request->role,
        ]);
        return redirect()->intended(route('admin.dashboard.mitra'))->with("success", "Berhasil menambahkan Mitra");
    }

    public function deleteMitra($id)
    {
        try {
            DB::beginTransaction();

            $mitra = Mitra::find($id);

            // Pengecekan di setiap tabel terkait
            // if ($status->laporanCommerce()->count() > 0) {
            //     throw new \Exception("Kota ini sedang digunakan di Tabel Account dan tidak dapat dihapus.");
            // }

            // Jika tidak ada pengecualian, hapus kota
            $mitra->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.mitra'))->with("success", "Berhasil menghapus Mitra");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.mitra'))->with("error", "Terjadi Error karena data ini sedang digunakan");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.mitra'))->with("error", "Terjadi Error karena data ini sedang digunakan");
        }
    }

    public function updateMitra(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_mitra' => [
                Rule::unique('mitra')->where(function ($query) use ($request, $id) {
                    return $query->where('nama_mitra', $request->nama_mitra)
                        ->where('role', $request->role)
                        ->where('id', '!=', $id); // Tambahkan kondisi untuk memeriksa id
                }),
            ],
            // ... definisi validasi untuk field lainnya
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $mitra = Mitra::find($id);
        $mitra->nama_mitra = $request->nama_mitra;
        $mitra->role = $request->role;
        $mitra->save();
        Mitra::where('id', $id)->update([
            "nama_mitra" => $request->nama_mitra,
            "role" => $request->role,
        ]);

        return redirect()->intended(route('admin.dashboard.mitra'))->with("success", "Berhasil mengubah Mitra");
    }
}
