<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipeProvisioning;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class TipeProvisioningController extends Controller
{
    //
    public function index()
    {
        $tipe_provisioning = array();
        return view('admin.dashboard.tipe_provisioning', [
            "title" => "Tipe Provisioning",
            "tipe_provisioning" => TipeProvisioning::all(),
        ]);
    }

    public function storeTipeProvisioning(Request $request)
    {
        TipeProvisioning::insert([
            // "id" => 2,
            "nama_tipe_provisioning" => $request->nama_tipe_provisioning,
        ]);
        return redirect()->intended(route('admin.dashboard.tipe_provisioning'))->with("success", "Berhasil menambahkan Tipe Provisioning");
    }

    public function deleteTipeProvisioning($id)
    {
        try {
            DB::beginTransaction();

            $tipe_provisioning = TipeProvisioning::find($id);

            // Pengecekan di setiap tabel terkait
            // if ($tipe_provisioning->laporanCommerce()->count() > 0) {
            //     throw new \Exception("Kota ini sedang digunakan di Tabel Account dan tidak dapat dihapus.");
            // }

            // Jika tidak ada pengecualian, hapus kota
            $tipe_provisioning->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.tipe_provisioning'))->with("success", "Berhasil menghapus Tipe Provisioning");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.tipe_provisioning'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.tipe_provisioning'))->with("error", $e->getMessage());
        }
    }

    public function updateTipeProvisioning(Request $request, $id)
    {
        TipeProvisioning::where('id', $id)->update([
            "nama_tipe_provisioning" => $request->nama_tipe_provisioning,
        ]);

        return redirect()->intended(route('admin.dashboard.tipe_provisioning'))->with("success", "Berhasil mengubah Tipe Provisioning");
    }
}