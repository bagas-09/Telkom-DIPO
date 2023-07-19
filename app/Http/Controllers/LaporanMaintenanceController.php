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
        $laporanMaintenances = array();
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


        return view('maintenance.laporan_maintenance', [
            "title" => "Laporan Maintenance",
            "laporanMaintenances" => LaporanMaintenance::all(),
            "roles" => $roles,
            "citys" => $citys,
            "status_pekerjaan_id" => $status_pekerjaan_id,
            "mitra_id" => $mitra_id,
            "tipe_kemitraan_id" => $tipe_kemitraan_id,
            "jenis_program_id" => $jenis_program_id,
            "tipe_provisioning_id" => $tipe_provisioning_id,
        ]);
    }

    public function addLaporanMaintenance(Request $request)
    {
        return view('maintenance.laporan_maintenance_add',[
            "title" => "Buat Laporan Maintenance",
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
        LaporanMaintenance::insert([
            "PID_maintenance" => $request->PID_maintenance,
            "ID_SAP_maintenance" => $request->ID_SAP_maintenance,
            'NO_PR_maintenance' => $request->NO_PR_maintenance,
            'tanggal_PR' => $request->tanggal_PR,
            'status_pekerjaan_id' => $request->status_pekerjaan_id,
            'mitra_id' => $request->mitra_id,
            'tipe_kemitraan_id' => $request->tipe_kemitraan_id,
            'jenis_program_id' => $request->jenis_program_id,
            'tipe_provisioning_id' => $request->tipe_provisioning_id,
            'periode_pekerjaan' => $request->periode_pekerjaan,
            'lokasi' => $request->lokasi,
            'material_DRM' => $request->material_DRM,
            'jasa_DRM' => $request->jasa_DRM,
            'total_DRM' => $request->total_DRM,
            'material_aktual' => $request->material_aktual,
            'jasa_aktual' => $request->jasa_aktual,
            'total_aktual' => $request->total_aktual,
            'keterangan' => $request->keterangan

        ]);
        return redirect()->intended(route('maintenance.laporan_maintenance'))->with("success", "Laporan Berhasil Dibuat");

        $validatedData = $request->validate([
            "PID_maintenance" => '$request',
            "ID_SAP_maintenance" => '$request',
            'NO_PR_maintenance' => '$request',
            'tanggal_PR' => '$request',
            'status_pekerjaan_id' => '$request',
            'mitra_id' => '$request',
            'tipe_kemitraan_id' => '$request',
            'jenis_program_id' => '$request',
            'tipe_provisioning_id' => '$request',
            'periode_pekerjaan' => '$request',
            'lokasi' => '$request',
            'material_DRM' => '$request',
            'jasa_DRM' => '$request',
            'total_DRM' => '$request',
            'material_aktual' => '$request',
            'jasa_aktual' => '$request',
            'total_aktual' => '$request',
            'keterangan' => '$request',
        ], [
            'PID_maintenance.required' => 'PID_maintenance field is required.',
            'ID_SAP_maintenance.required' => 'ID_SAP field is required.',
            'NO_PR_maintenance.required' => 'No_PR field is required.',
        
        ]);
        $laporanMaintenance = LaporanMaintenance::create($validatedData);
            
    }

    public function deleteLaporanMaintenance($id)
    {
        try {
            DB::beginTransaction();

            $laporanMaintenance = LaporanMaintenance::find($id);

            // Pengecekan di setiap tabel terkait
            // if ($status->laporanCommerce()->count() > 0) {
            //     throw new \Exception("Kota ini sedang digunakan di Tabel Account dan tidak dapat dihapus.");
            // }

            // Jika tidak ada pengecualian, hapus kota
            $laporanMaintenance->delete();

            DB::commit();

            return redirect()->intended(route('maintenance.laporan_maintenance'))->with("success", "Berhasil menghapus Laporan Maintenance");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('maintenance.laporan_maintenance'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('maintenance.laporan_maintenance'))->with("error", $e->getMessage());
        }
    }

}

