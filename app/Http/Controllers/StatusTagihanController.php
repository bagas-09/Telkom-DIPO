<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\statustagihan;

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
        statustagihan::insert([
            "nama_status_tagihan" => $request->nama_status_tagihan,
        ]);
        return redirect()->intended(route('admin.dashboard.statustagihan'))->with("success", "Berhasil menambahkan Statuss Program");
    }

    public function updateStatus(Request $request, $id)
    {
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
            return redirect()->intended(route('admin.dashboard.statustagihan'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.statustagihan'))->with("error", $e->getMessage());
        }
    }
}
