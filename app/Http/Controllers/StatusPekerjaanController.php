<?php

namespace App\Http\Controllers;

use App\Models\StatusPekerjaan;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

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
            return redirect()->intended(route('admin.dashboard.status_pekerjaan'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.status_pekerjaan'))->with("error", $e->getMessage());
        }
    }

    public function updateStatusPekerjaan(Request $request, $id)
    {
        StatusPekerjaan::where('id', $id)->update([
            "nama_status_pekerjaan" => $request->nama_status_pekerjaan,
            "role" => $request->role,
        ]);

        return redirect()->intended(route('admin.dashboard.status_pekerjaan'))->with("success", "Berhasil mengubah Status Pekerjaan");
    }
}
