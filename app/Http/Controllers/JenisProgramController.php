<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\JenisProgram;
use Illuminate\Support\Facades\Validator;

class JenisProgramController extends Controller
{
    public function index()
    {
        $jenisprogram = array();
        return view('admin.dashboard.jenis_program', [
            "title" => "Jenis Program",
            "type" => JenisProgram::all(),
            // dd(["type" => JenisProgram::all()]),
        ]);
    }

    public function storeJenis(Request $request)
    {
        $validator = Validator::make($request->all(), JenisProgram::$rules, JenisProgram::$messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        JenisProgram::insert([
            "nama_jenis_program" => $request->nama_jenis_program,
        ]);
        return redirect()->intended(route('admin.dashboard.jenisprogram'))->with("success", "Berhasil menambahkan Jenis Program");
    }

    public function updateJenis(Request $request, $id)
    {
        // Ambil aturan validasi dari model
        $rules = JenisProgram::$rules;
        $messages = JenisProgram::$messages;

        // Modifikasi aturan validasi untuk keperluan update
        $rules['nama_jenis_program'] = 'unique:jenis_program,nama_jenis_program,'.$id.',id';

        // Buat validator dengan aturan validasi yang telah dimodifikasi
        $validator = Validator::make($request->all(), $rules, $messages);

        // Lakukan validasi
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        JenisProgram::where('id', $id)->update([
            "nama_jenis_program" => $request->nama_jenis_program,
        ]);

        return redirect()->intended(route('admin.dashboard.jenisprogram'))->with("success", "Berhasil mengubah Jenis Program");
    }

    public function deleteJenis($id)
    {
        try {
            DB::beginTransaction();

            $jenisprogram = JenisProgram::find($id);

            // Pengecekan di setiap tabel terkait
            // if ($type->accounts()->count() > 0) {
            //     throw new \Exception("Jenis ini sedang digunakan di Tabel Account dan tidak dapat dihapus.");
            // }

            // if ($role->laporans()->count() > 0) {
            //     throw new \Exception("Kota ini sedang digunakan di Tabel Laporan dan tidak dapat dihapus.");
            // }

            // Jika tidak ada pengecualian, hapus kota
            $jenisprogram->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.jenisprogram'))->with("success", "Berhasil menghapus Jenis Program");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.jenisprogram'))->with("error", "Terjadi Error karena data ini sedang digunakan");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.jenisprogram'))->with("error", "Terjadi Error karena data ini sedang digunakan");
        }
    }
}
