<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\statustagihan;
use Illuminate\Support\Facades\Validator;

class StatusTagihanController extends Controller
{
    public function index()
    {
        $role = array();
        return view('admin.dashboard.status_tagihan', [
            "title" => "Status Tagihan",
            "type" => statustagihan::all(),
        ]);
    }

    public function storeStatus(Request $request)
    {
        $validator = Validator::make($request->all(), statustagihan::$rules, statustagihan::$messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        statustagihan::insert([
            "nama_status_tagihan" => $request->nama_status_tagihan,
        ]);
        return redirect()->intended(route('admin.dashboard.statustagihan'))->with("success", "Berhasil menambahkan Statuss Program");
    }

    public function updateStatus(Request $request, $id)
    {
         // Ambil aturan validasi dari model
         $rules = statustagihan::$rules;
         $messages = statustagihan::$messages;
 
         // Modifikasi aturan validasi untuk keperluan update
         $rules['nama_status_tagihan'] = 'unique:status_tagihan,nama_status_tagihan,'.$id.',id';
 
         // Buat validator dengan aturan validasi yang telah dimodifikasi
         $validator = Validator::make($request->all(), $rules, $messages);
 
         // Lakukan validasi
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
        statustagihan::where('id', $id)->update([
            "nama_status_tagihan" => $request->nama_status_tagihan,
        ]);

        return redirect()->intended(route('admin.dashboard.statustagihan'))->with("success", "Berhasil mengubah Statuss Program");
    }

    public function deleteStatus($id)
    {
        try {
            DB::beginTransaction();
            $type = statustagihan::find($id);
            $type->delete();
            DB::commit();

            return redirect()->intended(route('admin.dashboard.statustagihan'))->with("success", "Berhasil menghapus Statuss Program");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.statustagihan'))->with("error", "Terjadi Error karena data ini sedang digunakan");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.statustagihan'))->with("error", "Terjadi Error karena data ini sedang digunakan");
        }
    }
}
