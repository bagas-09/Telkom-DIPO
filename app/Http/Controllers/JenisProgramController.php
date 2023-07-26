<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\JenisProgram;

class JenisProgramController extends Controller
{
    public function index()
    {
        $role = array();
        return view('admin.dashboard.jenis_program', [
            "title" => "Jenis Program",
            "type" => JenisProgram::all(),
            // dd(["type" => JenisProgram::all()]),
        ]);
    }

    public function storeJenis(Request $request)
    {
        JenisProgram::insert([
            "nama_jenis_program" => $request->nama_jenis_program,
        ]);
        return redirect()->intended(route('admin.dashboard.jenisprogram'))->with("success", "Berhasil menambahkan Jenis Program");
    }

    public function updateJenis(Request $request, $id)
    {
        JenisProgram::where('id', $id)->update([
            "nama_jenis_program" => $request->nama_jenis_program,
        ]);

        return redirect()->intended(route('admin.dashboard.jenisprogram'))->with("success", "Berhasil mengubah Jenis Program");
    }

    public function deleteJenis($id)
    {
        try {
            DB::beginTransaction();

            $type = JenisProgram::find($id);

            // Pengecekan di setiap tabel terkait
            // if ($type->accounts()->count() > 0) {
            //     throw new \Exception("Jenis ini sedang digunakan di Tabel Account dan tidak dapat dihapus.");
            // }

            // if ($role->laporans()->count() > 0) {
            //     throw new \Exception("Kota ini sedang digunakan di Tabel Laporan dan tidak dapat dihapus.");
            // }

            // Jika tidak ada pengecualian, hapus kota
            $type->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.jenisprogram'))->with("success", "Berhasil menghapus Jenis Program");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.jenisprogram'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.jenisprogram'))->with("error", $e->getMessage());
        }
    }
}
