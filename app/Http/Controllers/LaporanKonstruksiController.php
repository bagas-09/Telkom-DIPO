<?php

namespace App\Http\Controllers;

use App\Models\JenisOrder;
use App\Models\LaporanKonstruksi;
use App\Models\Mitra;
use App\Models\StatusPekerjaan;
use App\Models\TipeKemitraan;
use App\Models\TipeProvisioning;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LaporanKonstruksiController extends Controller
{
    //
    public function index()
    {
        $laporanKonstruksis = array();
        $roles = DB::table('role')
            ->select('*')
            ->get();

        $citys = array();
        foreach (City::all() as $item) {
            $citys[$item->id] = $item->nama_city;
        }

        $status_pekerjaan_id = array();
        foreach (StatusPekerjaan::all() as $statusP) {
            $status_pekerjaan_id[$statusP->id] = $statusP->nama_status_pekerjaan;
        }

        $mitra_id = array();
        foreach (Mitra::all() as $mitra) {
            $mitra_id[$mitra->id] = $mitra->nama_mitra;
        }

        $tipe_kemitraan_id = array();
        foreach (TipeKemitraan::all() as $tipeK) {
            $tipe_kemitraan_id[$tipeK->id] = $tipeK->nama_tipe_kemitraan;
        }

        $jenis_order_id = array();
        foreach (JenisOrder::all() as $jenisO) {
            $jenis_order_id[$jenisO->id] = $jenisO->nama_jenis_order;
        }

        $tipe_provisioning_id = array();
        foreach (TipeProvisioning::all() as $tipeP) {
            $tipe_provisioning_id[$tipeP->id] = $tipeP->nama_tipe_provisioning;
        }


        return view('konstruksi.laporan_konstruksi', [
            "title" => "Laporan Konstruksi",
            "laporanKonstruksis" => LaporanKonstruksi::all(),
            "roles" => $roles,
            "citys" => $citys,
            "status_pekerjaan_id" => $status_pekerjaan_id,
            "mitra_id" => $mitra_id,
            "tipe_kemitraan_id" => $tipe_kemitraan_id,
            "jenis_order_id" => $jenis_order_id,
            "tipe_provisioning_id" => $tipe_provisioning_id,
        ]);
    }


    public function addLaporanKonstruksi(Request $request)
    {
        return view('konstruksi.laporan_konstruksi_add', [
            "title" => "Buat Laporan Konstruksi",
            "addcity" => City::all(),
            "addsp" => StatusPekerjaan::all(),
            "mitrass" => Mitra::all(),
            "tipek" => TipeKemitraan::all(),
            "jeniso" => JenisOrder::all(),
            "tipeprov" => TipeProvisioning::all(),
        ]);
    }

    public function storeLaporanKonstruksi(Request $request)
    {
        // $request->validate([
        //     'nama_city' => 'required'
        // ]);

        LaporanKonstruksi::insert([
            // "id" => 2,
            // "nama_tipe_kemitraan" => $request->nama_tipe_kemitraan,
            // "role" => $request->role,
            'PID_konstruksi' => $request->PID_konstruksi,
            'ID_SAP_konstruksi' => $request->ID_SAP_konstruksi,
            'NO_PR_konstruksi' => $request->NO_PR_konstruksi,
            'tanggal_PR' => $request->tanggal_PR,
            'status_pekerjaan_id' => $request->status_pekerjaan_id,
            'mitra_id' => $request->mitra_id,
            'tipe_kemitraan_id' => $request->tipe_kemitraan_id,
            'jenis_order_id' => $request->jenis_order_id,
            'tipe_provisioning_id' => $request->tipe_provisioning_id,
            'lokasi' => $request->lokasi,
            'material_DRM' => $request->material_DRM,
            'jasa_DRM' => $request->jasa_DRM,
            'total_DRM' => $request->total_DRM,
            'material_aktual' => $request->material_aktual,
            'jasa_aktual' => $request->jasa_aktual,
            'total_aktual' => $request->total_aktual,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->intended(route('konstruksi.laporan_konstruksi'))->with("success", "Berhasil menambahkan Laporan Konstruksi");
    }

    public function deleteLaporanKonstruksi($id)
    {
        try {
            DB::beginTransaction();

            $tipe_kemitraan = LaporanKonstruksi::find($id);

            // Pengecekan di setiap tabel terkait
            // if ($status->laporanCommerce()->count() > 0) {
            //     throw new \Exception("Kota ini sedang digunakan di Tabel Account dan tidak dapat dihapus.");
            // }

            // Jika tidak ada pengecualian, hapus kota
            $tipe_kemitraan->delete();

            DB::commit();

            return redirect()->intended(route('konstruksi.laporan_konstruksi'))->with("success", "Berhasil menghapus Laporan Konstruksi");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.tipe_kemitraan'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.tipe_kemitraan'))->with("error", $e->getMessage());
        }
    }

    public function updateLaporanKonstruksi(Request $request, $id)
    {
        LaporanKonstruksi::where('id', $id)->update([
            "nama_tipe_kemitraan" => $request->nama_tipe_kemitraan,
            "role" => $request->role,
        ]);

        return redirect()->intended(route('admin.dashboard.tipe_kemitraan'))->with("success", "Berhasil mengubah Tipe Kemitraan");
    }
}