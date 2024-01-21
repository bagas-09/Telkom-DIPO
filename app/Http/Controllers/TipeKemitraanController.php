<?php

namespace App\Http\Controllers;

use App\Models\TipeKemitraan;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TipeKemitraanController extends Controller
{
    //
    public function index()
    {
        // $status_pekerjaan = array();
        $tipe_kemitraan = TipeKemitraan::all();
        $roless = DB::table('role')
            ->select('*')
            ->where('nama_role', '!=', 'GM')
            ->where('nama_role', '!=', 'Admin')
            ->get();

        return view('admin.dashboard.tipe_kemitraan', [
            "title" => "Tipe Kemitraan",
            "tipe_kemitraan" => $tipe_kemitraan,
            "roless" => $roless,
        ]);
    }

    public function storeTipeKemitraan(Request $request)
    {
        // Lakukan validasi menggunakan Validator di dalam kontroller
        $validator = Validator::make($request->all(), [
            'nama_tipe_kemitraan' => [
                Rule::unique('tipe_kemitraan')->where(function ($query) use ($request) {
                    return $query->where('nama_tipe_kemitraan', $request->nama_tipe_kemitraan)
                                ->where('role', $request->role);
                }),
            ],
        ], [
            'nama_tipe_kemitraan.unique' => 'Kombinasi Nama Tipe Kemitraaan dan Role sudah ada dalam database.',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } 
        // $request->validate([
        //     'nama_city' => 'required'
        // ]);

        TipeKemitraan::insert([
            // "id" => 2,
            "nama_tipe_kemitraan" => $request->nama_tipe_kemitraan,
            "role" => $request->role,
        ]);
        return redirect()->intended(route('admin.dashboard.tipe_kemitraan'))->with("success", "Berhasil menambahkan Tipe Kemitraan");
    }

    public function deleteTipeKemitraan($id)
    {
        try {
            DB::beginTransaction();

            $tipe_kemitraan = TipeKemitraan::find($id);

            // Pengecekan di setiap tabel terkait
            // if ($status->laporanCommerce()->count() > 0) {
            //     throw new \Exception("Kota ini sedang digunakan di Tabel Account dan tidak dapat dihapus.");
            // }

            // Jika tidak ada pengecualian, hapus kota
            $tipe_kemitraan->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.tipe_kemitraan'))->with("success", "Berhasil menghapus Tipe Kemitraan");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.tipe_kemitraan'))->with("error", "Terjadi Error karena data ini sedang digunakan");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.tipe_kemitraan'))->with("error", "Terjadi Error karena data ini sedang digunakan");
        }
    }

    public function updateTipeKemitraan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_tipe_kemitraan' => [
                Rule::unique('tipe_kemitraan')->where(function ($query) use ($request, $id) {
                    return $query->where('nama_tipe_kemitraan', $request->nama_tipe_kemitraan)
                        ->where('role', $request->role)
                        ->where('id', '!=', $id); // Tambahkan kondisi untuk memeriksa id
                }),
            ],
            // ... definisi validasi untuk field lainnya
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tipe_kemitraan = TipeKemitraan::find($id);
        $tipe_kemitraan->nama_tipe_kemitraan = $request->nama_tipe_kemitraan;
        $tipe_kemitraan->role = $request->role;
        $tipe_kemitraan->save();
        TipeKemitraan::where('id', $id)->update([
            "nama_tipe_kemitraan" => $request->nama_tipe_kemitraan,
            "role" => $request->role,
        ]);

        return redirect()->intended(route('admin.dashboard.tipe_kemitraan'))->with("success", "Berhasil mengubah Tipe Kemitraan");
    }
}