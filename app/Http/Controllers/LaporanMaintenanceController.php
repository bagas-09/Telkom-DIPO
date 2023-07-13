<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanMaintenance;
use App\Models\City;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\JenisProgram;
use App\Models\Mitra;
use App\Models\StatusPekerjaan;
use App\Models\TipeKemitraan;
use App\Models\TipeProvisioning;

class LaporanMaintenanceController extends Controller
{
    //
    public function index()
    {
        $laporanMaintenance = array();
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

        $jenis_program_id = array();
        foreach (JenisProgram::all() as $jenisP) {
            $jenis_program_id[$jenisP->id] = $jenisP->nama_jenis_program;
        }

        $tipe_provisioning_id = array();
        foreach (TipeProvisioning::all() as $tipeP) {
            $tipe_provisioning_id[$tipeP->id] = $tipeP->nama_tipe_provisioning;
        }


        return view('Maintenance.laporan_maintenance', [
            "title" => "Laporan Maintenance",
            "laporan_maintenance" => LaporanMaintenance::all(),
            "roles" => $roles,
            "citys" => $citys,
            "status_pekerjaan_id" => $status_pekerjaan_id,
            "mitra_id" => $mitra_id,
            "tipe_kemitraan_id" => $tipe_kemitraan_id,
            "jenis_program_id" => $jenis_program_id,
            "tipe_provisioning_id" => $tipe_provisioning_id,
            "addcity" => City::all(),
            "addsp" => StatusPekerjaan::all(),
            "mitrass" => Mitra::all(),
            "tipek" => TipeKemitraan::all(),
            "jenisp" => JenisProgram::all(),
            "tipeprov" => TipeProvisioning::all(),
        ]);
    }
    public function storeLaporanMaintenance(Request $request)
    {
        // $request->validate([
        //     'nama_city' => 'required'
        // ]);

        LaporanMaintenance::insert([
            // "id" => 2,
            "nama_laporanmaintenance" => $request->nama_laporanmaintenance,
        ]);
        return redirect()->intended(route('admin.dashboard.laporan_maintenance'))->with("success", "Berhasil menambahkan Laporan");
    }
}
