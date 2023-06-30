<?php

namespace App\Http\Controllers;

use App\Models\TipeKemitraan;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

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
            return redirect()->intended(route('admin.dashboard.tipe_kemitraan'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.tipe_kemitraan'))->with("error", $e->getMessage());
        }
    }

    public function updateTipeKemitraan(Request $request, $id)
    {
        TipeKemitraan::where('id', $id)->update([
            "nama_tipe_kemitraan" => $request->nama_tipe_kemitraan,
            "role" => $request->role,
        ]);

        return redirect()->intended(route('admin.dashboard.tipe_kemitraan'))->with("success", "Berhasil mengubah Tipe Kemitraan");
    }
}