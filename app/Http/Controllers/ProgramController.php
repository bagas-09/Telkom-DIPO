<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    //
    public function index()
    {
        $program = array();
        return view('admin.dashboard.program', [
            "title" => "Program",
            "program" => Program::all(),
        ]);
    }

    public function storeProgram(Request $request)
    {
        $validator = Validator::make($request->all(), Program::$rules, Program::$messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Program::insert([
            "nama_program" => $request->nama_program,
        ]);
        return redirect()->intended(route('admin.dashboard.program'))->with("success", "Berhasil menambahkan Program");
    }

    public function deleteProgram($id)
    {
        try {
            DB::beginTransaction();

            $program = Program::find($id);

            // Pengecekan di setiap tabel terkait
            // if ($status->laporanCommerce()->count() > 0) {
            //     throw new \Exception("Kota ini sedang digunakan di Tabel Account dan tidak dapat dihapus.");
            // }

            // Jika tidak ada pengecualian, hapus kota
            $program->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.program'))->with("success", "Berhasil menghapus Program");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.program'))->with("error", "Terjadi Error karena data ini sedang digunakan");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.program'))->with("error", "Terjadi Error karena data ini sedang digunakan");
        }
    }

    public function updateProgram(Request $request, $id)
    {
         // Ambil aturan validasi dari model
         $rules = Program::$rules;
         $messages = Program::$messages;
 
         // Modifikasi aturan validasi untuk keperluan update
         $rules['nama_program'] = 'unique:program,nama_program,'.$id.',id';
 
         // Buat validator dengan aturan validasi yang telah dimodifikasi
         $validator = Validator::make($request->all(), $rules, $messages);
 
         // Lakukan validasi
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
        Program::where('id', $id)->update([
            "nama_program" => $request->nama_program,
        ]);

        return redirect()->intended(route('admin.dashboard.program'))->with("success", "Berhasil mengubah Program");
    }
}
