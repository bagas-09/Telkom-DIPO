<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanTiket;
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
use App\Exports\ExcelExportT;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Carbon\Carbon;


class LaporanTiketController extends Controller
{
    //
    public function index()
    {
        $laporanTikets = array();
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

        $account = Auth::guard('account')->user();
        if ($account->role == "Maintenance") {
        return view('maintenance.laporan_tiket', [
            "title" => "Laporan Tiket",
            "laporanTikets" => LaporanTiket::all()->where("kota_id", "=", $account->id_nama_kota)->where("draft", "=", 0),
            "laporan_tiket_commerce"=> LaporanTiket::all()->where("commerce", "!=", 1)->where("draft", "=", 0)->where("kota_id", "=", $account->id_nama_kota),
            "laporan_tiket_procurement"=> LaporanTiket::all()->where("procurement", "!=", 1)->where("draft", "=", 0)->where("kota_id", "=", $account->id_nama_kota),
            "roles" => $roles,
            "citys" => $citys,
            "status_pekerjaan_id" => $status_pekerjaan_id,
            "mitra_id" => $mitra_id,
            "tipe_kemitraan_id" => $tipe_kemitraan_id,
            "jenis_program_id" => $jenis_program_id,
            "tipe_provisioning_id" => $tipe_provisioning_id,
        ]);
        } elseif ($account->role == "GM"){
            return view('gm.laporan_tiket', [
                "title" => "Laporan Tiket",
                "laporanTikets" => LaporanTiket::all()->where("commerce", "=", 0)->where("draft", "=", 0),
                "laporan_tiket_commerce"=> LaporanTiket::all()->where("commerce", "=", 0)->where("draft", "=", 0),
                "laporan_tiket_procurement"=> LaporanTiket::all()->where("procurement", "=", 0)->where("draft", "=", 0),
                "roles" => $roles,
                "citys" => $citys,
                "status_pekerjaan_id" => $status_pekerjaan_id,
                "mitra_id" => $mitra_id,
                "tipe_kemitraan_id" => $tipe_kemitraan_id,
                "jenis_program_id" => $jenis_program_id,
                "tipe_provisioning_id" => $tipe_provisioning_id,
                
            ]);
        } else {
            return view('maintenance.laporan_tiket', [
                "title" => "Laporan Tiket",
                "laporanTikets" => LaporanTiket::all()->where("commerce", "=", 0)->where("draft", "=", 0),
                "laporan_tiket_commerce"=> LaporanTiket::all()->where("commerce", "=", 0)->where("draft", "=", 0),
                "laporan_tiket_procurement"=> LaporanTiket::all()->where("procurement", "=", 0)->where("draft", "=", 0),
                "roles" => $roles,
                "citys" => $citys,
                "status_pekerjaan_id" => $status_pekerjaan_id,
                "mitra_id" => $mitra_id,
                "tipe_kemitraan_id" => $tipe_kemitraan_id,
                "jenis_program_id" => $jenis_program_id,
                "tipe_provisioning_id" => $tipe_provisioning_id,
                
            ]);
        }
    }

    public function export(){
        return Excel::download(new ExcelExportT, 'expor_tiket.xlsx', ExcelExcel::XLSX);
    }

    public function draft(){
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

        $program_id = array();
        foreach (JenisProgram::all() as $program) {
            $program_id[$program->id] = $program->nama_program;
        }

        $tipe_provisioning_id = array();
        foreach (TipeProvisioning::all() as $tipeP) {
            $tipe_provisioning_id[$tipeP->id] = $tipeP->nama_tipe_provisioning;
        }
        
        $account = Auth::guard('account')->user();
        return view('maintenance.draft', [
            "title" => "OGPm",
            "tiket" => LaporanTiket::all()->where('draft', '=', 1)->where("kota_id", "=", $account->id_nama_kota),
            "roles" => $roles,
            "citys" => $citys,
            "status_pekerjaan_id" => $status_pekerjaan_id,
            "mitra_id" => $mitra_id,
            "tipe_kemitraan_id" => $tipe_kemitraan_id,
            "program_id" => $program_id,
            "tipe_provisioning_id" => $tipe_provisioning_id,
        ]);
    }
    
    public function addLaporanTiket(Request $request)
    {
        return view('maintenance.laporan_tiket_add',[
            // dd(JenisProgram::all()),
            "title" => "Buat Laporan Tiket",
            "addcity" => City::all(),
            "addMaintenance" => LaporanMaintenance::all(),
            "addsp" => StatusPekerjaan::all()->where("role", "=", "Maintenance"),
            "mitrass" => Mitra::all()->where("role", "=", "Maintenance"),
            "tipek" => TipeKemitraan::all()->where("role", "=", "Maintenance"),
            "jenisP" => JenisProgram::all(),
            "tipeprov" => TipeProvisioning::all()->where("role", "=", "Maintenance"),
        ]);
    }
    
    public function storeLaporanTiket(Request $request)
    {
        // dd(str_replace('.', '', $request->material_DRM));
        $account = Auth::guard('account')->user();
        if ($_POST['submit'] == 'draft') {
        $messages = [
            'required' => 'Field wajib diisi',
            'unique' => 'Nilai sudah ada',
        ];

        $this->validate($request, [
            'ID_tiket' => 'required|unique:laporan_tiket',
            'ID_SAP_maintenance' => 'required',
            'slugt' => 'unique:laporan_tiket'
        ], $messages);

        // Mengambil nilai dari form

            LaporanTiket::insert([
                'ID_tiket' => $request->ID_tiket,
                "ID_SAP_maintenance" => $request->ID_SAP_maintenance,
                'datek' => $request->datek,
                'status_pekerjaan_id' => $request->status_pekerjaan_id,
                'mitra_id' => $request->mitra_id,
                'tipe_kemitraan_id' => $request->tipe_kemitraan_id,
                'jenis_program_id' => $request->jenis_program_id,
                'tipe_provisioning_id' => $request->tipe_provisioning_id,
                'periode_pekerjaan' => $request->periode_pekerjaan,
                'lokasi' => $request->lokasi,
                'material_DRM' => str_replace('.', '', $request->material_DRM),
                'jasa_DRM' => str_replace('.', '', $request->jasa_DRM),
                'total_DRM' => str_replace('.', '', $request->total_DRM),
                'material_aktual' => str_replace('.', '', $request->material_aktual),
                'jasa_aktual' => str_replace('.', '', $request->jasa_aktual),
                'total_aktual' => str_replace('.', '', $request->total_aktual),
                'keterangan' => $request->keterangan,
                'kota_id' => $account->id_nama_kota,
                'draft' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'slugt' => preg_replace('/[^A-Za-z0-9]+/', '-', preg_replace('/[^A-Za-z0-9\/-]+/', '', $request->ID_tiket)),
            ]);
            return redirect()->intended(route('maintenance.tiket.draft'))->with("success", "Laporan Berhasil Dibuat");
        } else if ($_POST['submit'] == 'save') {
        $messages = [
            'required' => 'Field wajib diisi',
            'unique' => 'Nilai sudah ada',
        ];
        $this->validate($request, [
            "ID_tiket" => 'required|unique:laporan_tiket',
            "ID_SAP_maintenance" => 'required',
            "datek" => 'required',
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
            
        ], $messages);
        
        // // LOKASI (Mengambil nilai dari form)
        // $jenisProgram = $request->jenis_program_id;
        // $tipeProvisioning = $request->tipe_provisioning_id;
        // $lokasi = $request->lokasi;

        // $program = JenisProgram::where("id", "=", $jenisProgram)
        //     ->get(["nama_jenis_program"]);
        // $programObject = json_decode($program[0]);
        // $programValue = $programObject->nama_jenis_program;

        // $tipeProv = TipeProvisioning::where("id", "=", $tipeProvisioning)
        //     ->get(["nama_tipe_provisioning"]);
        // $tipeProvObject = json_decode($tipeProv[0]);
        // $tipeProvValue = $tipeProvObject->nama_tipe_provisioning;

        // if ($programValue == "QE RECOVERY-DISTRIBUSI" || $programValue == "QE RECOVERY-FEEDER" || $programValue == "QE RECOVERY-ODC" || $programValue == "QE RECOVERY-ODP" || $programValue == "QE RELOKASI UTILITAS" || $programValue == "QE HEM" || $programValue == "QE ACCESS") {
        //     // Menggabungkan nilai autoGenerated dan inputLokasi
        //     $nilaiDitambahkan = $programValue . " - " . $tipeProvValue . " - " . $lokasi;
        // } else {
        //     $nilaiDitambahkan = $lokasi;
        // }


        LaporanTiket::insert([
            'ID_tiket' => $request->ID_tiket,
            "ID_SAP_maintenance" => $request->ID_SAP_maintenance,
            "datek" => $request->datek,
            'status_pekerjaan_id' => $request->status_pekerjaan_id,
            'mitra_id' => $request->mitra_id,
            'tipe_kemitraan_id' => $request->tipe_kemitraan_id,
            'jenis_program_id' => $request->jenis_program_id,
            'tipe_provisioning_id' => $request->tipe_provisioning_id,
            'periode_pekerjaan' => $request->periode_pekerjaan . '-01',
            'lokasi' => $request->lokasi,
            'material_DRM' => str_replace('.', '', $request->material_DRM),
            'jasa_DRM' => str_replace('.', '', $request->jasa_DRM),
            'total_DRM' => str_replace('.', '', $request->total_DRM),
            'material_aktual' => str_replace('.', '', $request->material_aktual),
            'jasa_aktual' => str_replace('.', '', $request->jasa_aktual),
            'total_aktual' => str_replace('.', '', $request->total_aktual),
            'keterangan' => $request->keterangan,
            'kota_id' => $account->id_nama_kota,
            'draft' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'slugt' => preg_replace('/[^A-Za-z0-9]+/', '-', preg_replace('/[^A-Za-z0-9\/-]+/', '', $request->ID_tiket))
        ]);
        return redirect()->intended(route('maintenance.tiket.index'))->with("success", "Laporan Berhasil Dibuat");
    }
        
    }

    public function deleteLaporanTiket($id)
    {
        try {
            $account = Auth::guard('account')->user();
            DB::beginTransaction();

            $laporan_tiket = LaporanTiket::where("slugt", "=", $id);

            // Pengecekan di setiap tabel terkait
            // if ($status->laporanCommerce()->count() > 0) {
            //     throw new \Exception("Kota ini sedang digunakan di Tabel Account dan tidak dapat dihapus.");
            // }

            // Jika tidak ada pengecualian, hapus 
            $laporan_tiket->delete();

            DB::commit();

            return redirect()->intended(route('maintenance.tiket.index'))->with("success", "Berhasil menghapus Laporan Tiket");
            
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('maintenance.tiket.index'))->with("error", "Terjadi Error karena ID Tiket ini sedang digunakan");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('maintenance.tiket.index'))->with("error", "Terjadi Error karena ID Tiket ini sedang digunakan");
        }
        
    }
    public function editLaporanTiket($id)
    {
        return view('maintenance.laporan_tiket_edit', [
            "title" => "Edit Laporan Tiket",
            "tiket" => LaporanTiket::all()->where("slugt", "=", $id),
            "addcity" => City::all(),
            "addMaintenance" => LaporanMaintenance::all(),
            "addsp" => StatusPekerjaan::all()->where("role", "=", "Maintenance"),
            "mitrass" => Mitra::all()->where("role", "=", "Maintenance"),
            "tipek" => TipeKemitraan::all()->where("role", "=", "Maintenance"),
            "jenisP" => JenisProgram::all(),
            "tipeprov" => TipeProvisioning::all(),
            "id" => $id,
        ]);
    }

    public function updateLaporanTiket(Request $request, $id)
    {
        $account = Auth::guard('account')->user();
        if ($_POST['submit'] == 'draft') {   
            $messages = [
                'required' => ':Field wajib diisi',
                'unique' => 'Nilai sudah ada',
            ];
    
            $this->validate($request, [
                // 'ID_tiket' => 'required',
                // 'ID_SAP_maintenance' => 'required',
                // 'datek' => 'required',
                // 'status_pekerjaan_id' => 'required',
                // 'mitra_id' => 'required',
                // 'tipe_kemitraan_id' => 'required',
                // 'jenis_program_id' => 'required',
                // 'tipe_provisioning_id' => 'required',
                // 'periode_pekerjaan' => 'required',
                // 'lokasi' => 'required',
                // 'material_DRM' => 'required',
                // 'jasa_DRM' => 'required',
                // 'total_DRM' => 'required',
                // 'material_aktual' => 'required',
                // 'jasa_aktual' => 'required',
                // 'total_aktual' => 'required',
               
            ], $messages);
        $messages = [
            'required' => ':Field wajib diisi',
            'unique' => 'Nilai sudah ada',
        ];
        LaporanTiket::where('slugt', '=', $id)->update([
            'ID_tiket' => $request->ID_tiket,
            'ID_SAP_maintenance' => $request->ID_SAP_maintenance,
            'datek' => $request->datek,
            'status_pekerjaan_id' => $request->status_pekerjaan_id,
            'mitra_id' => $request->mitra_id,
            'tipe_kemitraan_id' => $request->tipe_kemitraan_id,
            'jenis_program_id' => $request->jenis_program_id,
            'tipe_provisioning_id' => $request->tipe_provisioning_id,
            'periode_pekerjaan' => $request->periode_pekerjaan . '-01',
            'lokasi' => $request->lokasi,
            'material_DRM' => str_replace('.', '', $request->material_DRM),
            'jasa_DRM' => str_replace('.', '', $request->jasa_DRM),
            'total_DRM' => str_replace('.', '', $request->total_DRM),
            'material_aktual' => str_replace('.', '', $request->material_aktual),
            'jasa_aktual' => str_replace('.', '', $request->jasa_aktual),
            'total_aktual' => str_replace('.', '', $request->total_aktual),
            'keterangan' => $request->keterangan,
            'kota_id' => $account->id_nama_kota,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'draft' => 0,
        ]);
        return redirect()->intended(route('maintenance.tiket.draft'))->with("success", "Berhasil mengubah Laporan Tiket");
    } else if ($_POST['submit'] == 'save') {
        $messages = [
            'required' => ':Field wajib diisi',
            'unique' => ':attribute sudah ada',
        ];
        $this->validate($request, [
            'ID_tiket' => 'required',
            'ID_SAP_maintenance' => 'required',
            'datek' => 'required',
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
        $account = Auth::guard('account')->user();
        LaporanTiket::where('slugt', '=', $id)->update([
            'ID_tiket' => $request->ID_tiket,
            'ID_SAP_maintenance' => $request->ID_SAP_maintenance,
            'datek' => $request->datek,
            'status_pekerjaan_id' => $request->status_pekerjaan_id,
            'mitra_id' => $request->mitra_id,
            'tipe_kemitraan_id' => $request->tipe_kemitraan_id,
            'jenis_program_id' => $request->jenis_program_id,
            'tipe_provisioning_id' => $request->tipe_provisioning_id,
            'periode_pekerjaan' => $request->periode_pekerjaan . '-01',
            'lokasi' => $request->lokasi,
            'material_DRM' => str_replace('.', '', $request->material_DRM),
            'jasa_DRM' => str_replace('.', '', $request->jasa_DRM),
            'total_DRM' => str_replace('.', '', $request->total_DRM),
            'material_aktual' => str_replace('.', '', $request->material_aktual),
            'jasa_aktual' => str_replace('.', '', $request->jasa_aktual),
            'total_aktual' => str_replace('.', '', $request->total_aktual),
            'keterangan' => $request->keterangan,
            'kota_id' => $account->id_nama_kota,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'draft' => 0,
        ]);
        return redirect()->intended(route('maintenance.tiket.index'))->with("success", "Berhasil mengubah Laporan Tiket");
    }
}

public function drafted($id)
{
    LaporanTiket::where('slugt', '=', $id)->update([
        'draft' => 1
    ]);
    return redirect()->intended(route('admin.laporanTiket.draft'))->with("success", "Laporan Berhasil Menjadi OGP");
}


    public function Editable($id)
    {
        $account = Auth::guard('account')->user();
        LaporanTiket::where('slugt', '=', $id)->update([
            "editable" => 1
        ]);

        if ($account->role == "Maintenance") {
            return redirect()->intended(route('maintenance.tiket.index'))->with("success", "Berhasil memberi akses edit pada Laporan Tiket");
        } else if ($account->role == "Admin") {
            return redirect()->intended(route('admin.laporanTiket.index'))->with("success", "Berhasil memberi akses edit pada Laporan Tiket");
        }
    }

    public function Uneditable($id)
    {
        $account = Auth::guard('account')->user();
        LaporanTiket::where('slugt', $id)->update([
            "editable" => 0
        ]);

        if ($account->role == "Maintenance") {
            return redirect()->intended(route('maintenance.tiket.index'))->with("success", "Berhasil menghapus akses edit pada Laporan Tiket");
        } else if ($account->role == "Admin") {
            return redirect()->intended(route('admin.laporanTiket.index'))->with("success", "Berhasil menghapus akses edit pada Laporan Tiket");
        }
    }
}

