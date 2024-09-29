<?php

namespace App\Http\Controllers;

use App\Models\StatusPekerjaan;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StatusPekerjaanController extends Controller
{
    //
    //
    public function index()
    {
        // $status_pekerjaan = array();
        $status_pekerjaan = StatusPekerjaan::all();
        $roless = DB::table('role')
            ->select('*')
            ->where('nama_role', '!=', 'GM')
            ->where('nama_role', '!=', 'Admin')
            ->get();

        return view('admin.dashboard.status_pekerjaan', [
            "title" => "Status Pekerjaan",
            "status_pekerjaan" => $status_pekerjaan,
            "roless" => $roless,
        ]);
    }

    public function storeStatusPekerjaan(Request $request)
    {
        // Lakukan validasi menggunakan Validator di dalam kontroller
        $validator = Validator::make($request->all(), [
            'nama_status_pekerjaan' => [
                Rule::unique('status_pekerjaan')->where(function ($query) use ($request) {
                    return $query->where('nama_status_pekerjaan', $request->nama_status_pekerjaan)
                                ->where('role', $request->role);
                }),
            ],
        ], [
            'nama_status_pekerjaan.unique' => 'Kombinasi Nama Status Pekerjaan dan Role sudah ada dalam database.',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } 
        // $request->validate([
        //     'nama_city' => 'required'
        // ]);

        StatusPekerjaan::insert([
            // "id" => 2,
            "nama_status_pekerjaan" => $request->nama_status_pekerjaan,
            "role" => $request->role,
        ]);
        return redirect()->intended(route('admin.dashboard.status_pekerjaan'))->with("success", "Berhasil menambahkan Status Pekerjaan");
    }

    public function deleteStatusPekerjaan($id)
    {
        try {
            DB::beginTransaction();

            $status_pekerjaan = StatusPekerjaan::find($id);

            // Pengecekan di setiap tabel terkait
            // if ($status->laporanCommerce()->count() > 0) {
            //     throw new \Exception("Kota ini sedang digunakan di Tabel Account dan tidak dapat dihapus.");
            // }

            // Jika tidak ada pengecualian, hapus kota
            $status_pekerjaan->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.status_pekerjaan'))->with("success", "Berhasil menghapus Status Pekerjaan");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.status_pekerjaan'))->with("error", "Terjadi Error karena data ini sedang digunakan");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.status_pekerjaan'))->with("error", "Terjadi Error karena data ini sedang digunakan");
        }
    }

    public function updateStatusPekerjaan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_status_pekerjaan' => [
                Rule::unique('status_pekerjaan')->where(function ($query) use ($request, $id) {
                    return $query->where('nama_status_pekerjaan', $request->nama_status_pekerjaan)
                        ->where('role', $request->role)
                        ->where('id', '!=', $id); // Tambahkan kondisi untuk memeriksa id
                }),
            ],
            // ... definisi validasi untuk field lainnya
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $status_pekerjaan = StatusPekerjaan::find($id);
        $status_pekerjaan->nama_status_pekerjaan = $request->nama_status_pekerjaan;
        $status_pekerjaan->role = $request->role;
        $status_pekerjaan->save();
        StatusPekerjaan::where('id', $id)->update([
            "nama_status_pekerjaan" => $request->nama_status_pekerjaan,
            "role" => $request->role,
        ]);

        return redirect()->intended(route('admin.dashboard.status_pekerjaan'))->with("success", "Berhasil mengubah Status Pekerjaan");
    }
}
