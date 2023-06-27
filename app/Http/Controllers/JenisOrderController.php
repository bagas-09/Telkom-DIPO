<?php

namespace App\Http\Controllers;

use App\Models\JenisOrder;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class JenisOrderController extends Controller
{
    //
    public function index()
    {
        $jenisOrder = array();
        return view('admin.dashboard.jenisOrder', [
            "title" => "Jenis Order",
            "jenisOrder" => JenisOrder::all(),
        ]);
    }

    public function storeJenisOrder(Request $request)
    {
        JenisOrder::insert([
            "nama_jenis_order" => $request->nama_jenis_order,
        ]);
        return redirect()->intended(route('admin.dashboard.jenisOrder'))->with("success", "Berhasil menambahkan Jenis Order");
    }

    public function deleteJenisOrder($id)
    {
        try {
            DB::beginTransaction();

            $jenisOrder = JenisOrder::find($id);

            // Pengecekan di setiap tabel terkait
            // if ($status->laporanCommerce()->count() > 0) {
            //     throw new \Exception("Kota ini sedang digunakan di Tabel Account dan tidak dapat dihapus.");
            // }

            // Jika tidak ada pengecualian, hapus kota
            $jenisOrder->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.jenisOrder'))->with("success", "Berhasil menghapus Jenis Order");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.jenisOrder'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.jenisOrder'))->with("error", $e->getMessage());
        }
    }

    public function updateJenisOrder(Request $request, $id)
    {
        JenisOrder::where('id', $id)->update([
            "nama_jenis_order" => $request->nama_jenis_order,
        ]);

        return redirect()->intended(route('admin.dashboard.jenisOrder'))->with("success", "Berhasil mengubah Jenis Order");
    }
}
