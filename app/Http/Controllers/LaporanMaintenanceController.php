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
use Illuminate\Support\Facades\Auth;
use App\Exports\ExcelExportM;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;

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
            "laporan_maintenance_commerce"=> LaporanMaintenance::all()->where("commerce", "!=", 1),
            "laporan_maintenance_procurement"=> LaporanMaintenance::all()->where("procurement", "!=", 1),
            "roles" => $roles,
            "citys" => $citys,
            "status_pekerjaan_id" => $status_pekerjaan_id,
            "mitra_id" => $mitra_id,
            "tipe_kemitraan_id" => $tipe_kemitraan_id,
            "jenis_program_id" => $jenis_program_id,
            "tipe_provisioning_id" => $tipe_provisioning_id,
            
        ]);
    }

    public function export(){
        return Excel::download(new ExcelExportM, 'expor_maintenance.xlsx', ExcelExcel::XLSX);
    }

    public function addLaporanMaintenance(Request $request)
    {
        return view('maintenance.laporan_maintenance_add',[
            "title" => "Buat Laporan Maintenance",
            "addcity" => City::all(),
            "addsp" => StatusPekerjaan::all()->where("role", "=", "Maintenance"),
            "mitrass" => Mitra::all()->where("role", "=", "Maintenance"),
            "tipek" => TipeKemitraan::all()->where("role", "=", "Maintenance"),
            "jenisp" => JenisProgram::all(),
            "tipeprov" => TipeProvisioning::all()->where("role", "=", "Maintenance"),
        ]);
    }
    
    public function storeLaporanMaintenance(Request $request)
    {
        $messages = [
            'required' => 'Field wajib diisi',
            'unique' => 'Nilai sudah ada',
        ];
        $this->validate($request, [
            "PID_maintenance" => 'required|unique:laporan_maintenance',
            "ID_SAP_maintenance" => 'required',
            'NO_PR_maintenance' => 'required',
            'tanggal_PR' => 'required',
            'status_pekerjaan_id' => 'required',
            'mitra_id' => 'required',
            'tipe_kemitraan_id' => 'required',
            'jenis_program_id' => 'required',
            'tipe_provisioning_id' => 'required',
            'periode_pekerjaan' => 'required',
            'lokasi' => 'required',
            'material_DRM' => 'required',
            'jasa_DRM' => 'required',
            'total_DRM' => 'required',
            'material_aktual' => 'required',
            'jasa_aktual' => 'required',
            'total_aktual' => 'required',
            'keterangan' => 'required',
        ], $messages);
        
        // LOKASI (Mengambil nilai dari form)
        $jenisProgram = $request->jenis_program_id;
        $tipeProvisioning = $request->tipe_provisioning_id;
        $lokasi = $request->lokasi;

        $program = JenisProgram::where("id", "=", $jenisProgram)
            ->get(["nama_jenis_program"]);
        $programObject = json_decode($program[0]);
        $programValue = $programObject->nama_jenis_program;

        $tipeProv = TipeProvisioning::where("id", "=", $tipeProvisioning)
            ->get(["nama_tipe_provisioning"]);
        $tipeProvObject = json_decode($tipeProv[0]);
        $tipeProvValue = $tipeProvObject->nama_tipe_provisioning;

        if ($programValue == "QE RECOVERY-DISTRIBUSI" || $programValue == "QE RECOVERY-FEEDER" || $programValue == "QE RECOVERY-ODC" || $programValue == "QE RECOVERY-ODP" || $programValue == "QE RELOKASI UTILITAS" || $programValue == "QE HEM" || $programValue == "QE ACCESS") {
            // Menggabungkan nilai autoGenerated dan inputLokasi
            $nilaiDitambahkan = $programValue . " - " . $tipeProvValue . " - " . $lokasi;
        } else {
            $nilaiDitambahkan = $lokasi;
        }


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
            'lokasi' => $nilaiDitambahkan,
            'material_DRM' => $request->material_DRM,
            'jasa_DRM' => $request->jasa_DRM,
            'total_DRM' => $request->total_DRM,
            'material_aktual' => $request->material_aktual,
            'jasa_aktual' => $request->jasa_aktual,
            'total_aktual' => $request->total_aktual,
            'keterangan' => $request->keterangan

        ]);
        return redirect()->intended(route('maintenance.laporanMaintenance.index'))->with("success", "Laporan Berhasil Dibuat");

        
    }

    public function deleteLaporanMaintenance($id)
    {
        try {
            $account = Auth::guard('account')->user();
            DB::beginTransaction();

            $laporan_maintenance = LaporanMaintenance::find($id);

            // Pengecekan di setiap tabel terkait
            // if ($status->laporanCommerce()->count() > 0) {
            //     throw new \Exception("Kota ini sedang digunakan di Tabel Account dan tidak dapat dihapus.");
            // }

            // Jika tidak ada pengecualian, hapus 
            $laporan_maintenance->delete();

            DB::commit();

            if ($account->role == "Maintenance") {
                return redirect()->intended(route('maintenance.laporanMaintenance.index'))->with("success", "Berhasil menghapus Laporan Maintenance");
            } else if ($account->role == "Admin") {
                return redirect()->intended(route('admin.laporan_maintenance'))->with("success", "Berhasil menghapus Laporan Maintenance");
            }
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            if ($account->role == "Maintenance") {
                return redirect()->intended(route('maintenance.laporanMaintenance.index'))->with("error", $e->getMessage());
            } else if ($account->role == "Admin") {
                return redirect()->intended(route('admin.laporan_maintenance'))->with("error", $e->getMessage());
            }
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            if ($account->role == "Maintenance") {
                return redirect()->intended(route('maintenance.laporanMaintenance.index'))->with("error", $e->getMessage());
            } else if ($account->role == "Admin") {
                return redirect()->intended(route('admin.laporan_maintenance'))->with("error", $e->getMessage());
            }
        }
    }
    public function editLaporanMaintenance($id)
    {
        return view('maintenance.laporan_maintenance_edit', [
            "title" => "Edit Laporan Maintenance",
            "maintenance" => LaporanMaintenance::where("PID_maintenance", "=", $id)->get(),
            "addcity" => City::all(),
            "addsp" => StatusPekerjaan::all()->where("role", "=", "Maintenance"),
            "mitrass" => Mitra::all()->where("role", "=", "Maintenance"),
            "tipek" => TipeKemitraan::all()->where("role", "=", "Maintenance"),
            "jenisp" => JenisProgram::all(),
            "tipeprov" => TipeProvisioning::all(),
            "id" => $id,
        ]);
    }

    public function updateLaporanMaintenance(Request $request, $id)
    {
        $messages = [
            'required' => ':Field wajib diisi',
        ];

        $this->validate($request, [
            'ID_SAP_maintenance' => 'required',
            'NO_PR_maintenance' => 'required',
            'tanggal_PR' => 'required',
            'status_pekerjaan_id' => 'required',
            'mitra_id' => 'required',
            'tipe_kemitraan_id' => 'required',
            'jenis_program_id' => 'required',
            'tipe_provisioning_id' => 'required',
            'periode_pekerjaan' => 'required',
            'lokasi' => 'required',
            'material_DRM' => 'required',
            'jasa_DRM' => 'required',
            'total_DRM' => 'required',
            'material_aktual' => 'required',
            'jasa_aktual' => 'required',
            'total_aktual' => 'required',
            'keterangan' => 'required',
        ], $messages);

        // Mengambil nilai dari form
        // $jenisOrder = $request->jenis_order_id;
        // $tipeProvisioning = $request->tipe_provisioning_id;
        // $lokasi = $request->lokasi;

        // $order = JenisOrder::where("id", "=", $jenisOrder)
        //     ->get(["nama_jenis_order"]);
        // $orderObject = json_decode($order[0]);
        // $orderValue = $orderObject->nama_jenis_order;

        // $tipeProv = TipeProvisioning::where("id", "=", $tipeProvisioning)
        //     ->get(["nama_tipe_provisioning"]);
        // $tipeProvObject = json_decode($tipeProv[0]);
        // $tipeProvValue = $tipeProvObject->nama_tipe_provisioning;

        // if ($orderValue == "Konsumer" || $orderValue == "HEM" || $orderValue == "Node B" || $orderValue == "Node B OLO") {
        //     // Menggabungkan nilai autoGenerated dan inputLokasi
        //     $nilaiDitambahkan = $orderValue . " - " . $tipeProvValue . " - " . $lokasi;
        // } else {
        //     $nilaiDitambahkan = $lokasi;
        // }

        LaporanMaintenance::where('PID_maintenance', $id)->update([
            'ID_SAP_maintenance' => $request->ID_SAP_maintenance,
            'NO_PR_maintenance' => $request->NO_PR_maintenance,
            'tanggal_PR' => $request->tanggal_PR,
            'status_pekerjaan_id' => $request->status_pekerjaan_id,
            'mitra_id' => $request->mitra_id,
            'tipe_kemitraan_id' => $request->tipe_kemitraan_id,
            'jenis_order_id' => $request->jenis_order_id,
            'tipe_provisioning_id' => $request->tipe_provisioning_id,
            'periode_pekerjaan' => $request->periode_pekerjaan,
            'lokasi' => $request->lokasi,
            'material_DRM' => $request->material_DRM,
            'jasa_DRM' => $request->jasa_DRM,
            'total_DRM' => $request->total_DRM,
            'material_aktual' => $request->material_aktual,
            'jasa_aktual' => $request->jasa_aktual,
            'total_aktual' => $request->total_aktual,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->intended(route('maintenance.laporanMaintenance.index'))->with("success", "Berhasil mengubah Laporan Maintenance");
    }

    public function Editable($id)
    {
        LaporanMaintenance::where('PID_maintenance', $id)->update([
            "editable" => 1
        ]);

        return redirect()->intended(route('admin.laporan_maintenance'))->with("success", "Berhasil memberi akses edit pada Laporan Maintenance");
    }

    public function Uneditable($id)
    {
        LaporanMaintenance::where('PID_maintenance', $id)->update([
            "editable" => 0
        ]);

        return redirect()->intended(route('admin.laporan_maintenance'))->with("success", "Berhasil mengubah akses edit pada Laporan Maintenance");
    }
}

