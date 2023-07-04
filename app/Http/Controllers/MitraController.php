<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

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
            return redirect()->intended(route('admin.dashboard.mitra'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.mitra'))->with("error", $e->getMessage());
        }
    }

    public function updateMitra(Request $request, $id)
    {
        Mitra::where('id', $id)->update([
            "nama_mitra" => $request->nama_mitra,
            "role" => $request->role,
        ]);

        return redirect()->intended(route('admin.dashboard.mitra'))->with("success", "Berhasil mengubah Mitra");
    }
}
