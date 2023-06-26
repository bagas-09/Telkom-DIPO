<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class StatusController extends Controller
{
    //
    public function index()
    {
        $status = array();
        return view('admin.dashboard.status', [
            "title" => "Status",
            "status" => Status::all(),
        ]);
    }

    public function storeStatus(Request $request)
    {
        // $request->validate([
        //     'nama_city' => 'required'
        // ]);

        Status::insert([
            // "id" => 2,
            "nama_status" => $request->nama_status,
        ]);
        return redirect()->intended(route('admin.dashboard.status'))->with("success", "Berhasil menambahkan Status");
    }

    public function deleteStatus($id)
    {
        try {
            DB::beginTransaction();

            $status = Status::find($id);

            // Pengecekan di setiap tabel terkait
            // if ($status->laporanCommerce()->count() > 0) {
            //     throw new \Exception("Kota ini sedang digunakan di Tabel Account dan tidak dapat dihapus.");
            // }

            // Jika tidak ada pengecualian, hapus kota
            $status->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.status'))->with("success", "Berhasil menghapus Status");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.status'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.status'))->with("error", $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        Status::where('id', $id)->update([
            "nama_status" => $request->nama_status,
        ]);

        return redirect()->intended(route('admin.dashboard.status'))->with("success", "Berhasil mengubah Status");
    }
}
