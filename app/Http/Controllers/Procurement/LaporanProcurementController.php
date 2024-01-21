<?php

namespace App\Http\Controllers\Procurement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\LaporanProcurement;
use App\Models\LaporanKonstruksi;
use App\Models\LaporanTiket;
use App\Models\StatusTagihan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Exports\ExcelExportP;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;
use App\Models\JenisProgram;
use App\Models\Program;
use App\Models\Mitra;
use App\Models\StatusPekerjaan;
use App\Models\TipeKemitraan;
use App\Models\TipeProvisioning;

class LaporanProcurementController extends Controller
{
    public function index()
    {
        $status_tagihan_id = array();
        foreach (StatusTagihan::all() as $statusT) {
            $status_tagihan_id[$statusT->id] = $statusT->nama_status_tagihan;
        }
        $account = Auth::guard('account')->user();
        $procurement = DB::table('laporan_procurement')
            ->join('status_tagihan', 'laporan_procurement.status_tagihan_id', '=', 'status_tagihan.id')
            ->select('*')
            ->where([
            [
                'laporan_procurement.draft', '=', 0
            ],
            [
                'status_tagihan.nama_status_tagihan', '=', 'CASH & BANK'
            ],
            [
                "kota_id", "=", $account->id_nama_kota
            ]
            ])->get();
            
        return view('procurement.dashboard.index', [
            "title" => "Laporan Procurement",
            // "procurement" => LaporanProcurement::all()->where('draft', '=', 0),
            "procurement" => $procurement,
            "status_tagihan"=> $status_tagihan_id
        ]);

    }
    public function export(){
        return Excel::download(new ExcelExportP, 'expor_procurement.xlsx', ExcelExcel::XLSX);
    }

    public function draft()
    {
        $account = Auth::guard('account')->user();
        $status_tagihan_id = array();
        foreach (StatusTagihan::all() as $statusT) {
            $status_tagihan_id[$statusT->id] = $statusT->nama_status_tagihan;
        }
        return view('procurement.dashboard.draft', [
            "title" => "OGPp",
            "procurement" => LaporanProcurement::all()->where('draft', '=', 1)->where("kota_id", "=", $account->id_nama_kota),
            "status_tagihan"=> $status_tagihan_id
        ]);
    }

    public function add_maintenance($id)
    {
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

        $lokasi = LaporanTiket::where("slugt", "=", $id)
            ->get(["lokasi"]);
        $lokasiObject = json_decode($lokasi[0]);
        $lokasiValue = $lokasiObject->lokasi;
        return view('procurement.dashboard.add_maintenance', [
            "title" => "Tambah Laporan Procurement",
            "procurement" => LaporanProcurement::all(),
            "statustagihanmany" => StatusTagihan::all(),
            "id" => $id,
            "lokasi" => $lokasiValue,
            "toket" => LaporanTiket::where("slugt", "=", $id)->get(),
            "status_pekerjaan_id" => $status_pekerjaan_id,
            "mitra_id" => $mitra_id,
            "tipe_kemitraan_id" => $tipe_kemitraan_id,
            "jenis_program_id" => $jenis_program_id,
            "tipe_provisioning_id" => $tipe_provisioning_id,
        ]);
    }

    public function add_konstruksi($id)
    {
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
        foreach (Program::all() as $program) {
            $program_id[$program->id] = $program->nama_program;
        }

        $tipe_provisioning_id = array();
        foreach (TipeProvisioning::all() as $tipeP) {
            $tipe_provisioning_id[$tipeP->id] = $tipeP->nama_tipe_provisioning;
        }
        $lokasi = LaporanKonstruksi::where("slugk", "=", $id)
            ->get(["lokasi"]);
        $lokasiObject = json_decode($lokasi[0]);
        $lokasiValue = $lokasiObject->lokasi;
        return view('procurement.dashboard.add_konstruksi', [
            "title" => "Tambah Laporan Procurement",
            "procurement" => LaporanProcurement::all(),
            "statustagihanmany" => StatusTagihan::all(),
            "id" => $id,
            "lokasi" => $lokasiValue,
            "tuket" => LaporanKonstruksi::where("slugk", "=", $id)->get(),
            "status_pekerjaan_id" => $status_pekerjaan_id,
            "mitra_id" => $mitra_id,
            "tipe_kemitraan_id" => $tipe_kemitraan_id,
            "program_id" => $program_id,
            "tipe_provisioning_id" => $tipe_provisioning_id,
        ]);
    }

    public function store_konstruksi(Request $request, $id)
    {
        $lokasi = LaporanKonstruksi::where("slugk", "=", $id)
            ->get(["lokasi"]);
        $id_SAP_KONS = LaporanKonstruksi::where('slugk', $id)->pluck('ID_SAP_konstruksi')->first();
        $lokasiObject = json_decode($lokasi[0]);
        $lokasiValue = $lokasiObject->lokasi;
        $account = Auth::guard('account')->user();
        if ($_POST['submit'] == 'draft') {
            $messages = [
                'required' => ':attribute wajib diisi',
                'unique' => ':attribute sudah ada',
                'PR_SAP.required' => 'Nomor PR wajib diisi',
                'PR_SAP.unique' => 'Nomor PR sudah ada',
                'ID_SAP_konstruksi_id.unique' => 'Laporan sudah ada, silahkan periksa laporan procurement',
            ];
            $this->validate($request, [
                "PR_SAP" => 'required|unique:laporan_procurement',
                "ID_SAP_konstruksi_id" => 'required|unique:laporan_procurement'
            ], $messages);
            LaporanProcurement::insert([
                "PR_SAP" => $request->PR_SAP,
                'PO_SAP' => $request->PO_SAP,
                'tanggal_PO_SAP' => $request->tanggal_PO_SAP,
                'material_DRM' => $request->material_DRM,
                'jasa_DRM' => $request->jasa_DRM,
                'total_DRM' => $request->total_DRM,
                'material_aktual' => $request->material_aktual,
                'jasa_aktual'  => $request->jasa_aktual,
                'total_aktual'  => $request->total_aktual,
                'status_tagihan_id' => $request->status_tagihan_id,
                'keterangan' => $request->keterangan,
                'ID_SAP_konstruksi_id'  => $id_SAP_KONS,
                'lokasi' => $lokasiValue,
                'draft' => 1,
                'kota_id' => $account->id_nama_kota,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'slugp' => preg_replace('/[^A-Za-z0-9]+/', '-', preg_replace('/[^A-Za-z0-9\/-]+/', '', $request->PR_SAP))
            ]);
            LaporanKonstruksi::where('slugk', $id)->update([
                "procurement" => 1
            ]);
            return redirect()->intended(route('procurement.dashboard.draft'))->with("success", "Laporan Berhasil Dibuat");
        } else if ($_POST['submit'] == 'save') {
            DB::beginTransaction();
            $messages = [
                'required' => ':attribute wajib diisi',
                'unique' => ':attribute sudah ada',
                'PR_SAP.required' => 'Nomor PR wajib diisi',
                'PR_SAP.unique' => 'Nomor PR sudah ada',
                'ID_SAP_konstruksi_id.unique' => 'Laporan sudah ada, silahkan periksa laporan procurement',
            ];

            $this->validate($request, [
                "PR_SAP" => 'required|unique:laporan_procurement',
                "ID_SAP_konstruksi_id" => 'unique:laporan_procurement',
                'PO_SAP' => 'required',
                'tanggal_PO_SAP' => 'required',
                'material_DRM' => 'required',
                'jasa_DRM' => 'required',
                'total_DRM' => 'required',
                'material_aktual' => 'required',
                'jasa_aktual'  => 'required',
                'total_aktual'  => 'required',
                'status_tagihan_id' => 'required',
                'keterangan' => 'required',
            ], $messages);

            LaporanProcurement::insert([
                "PR_SAP" => $request->PR_SAP,
                'PO_SAP' => $request->PO_SAP,
                'tanggal_PO_SAP' => $request->tanggal_PO_SAP,
                'material_DRM' => $request->material_DRM,
                'jasa_DRM' => $request->jasa_DRM,
                'total_DRM' => $request->total_DRM,
                'material_aktual' => $request->material_aktual,
                'jasa_aktual'  => $request->jasa_aktual,
                'total_aktual'  => $request->total_aktual,
                'status_tagihan_id' => $request->status_tagihan_id,
                'keterangan' => $request->keterangan,
                'ID_SAP_konstruksi_id'  => $id_SAP_KONS,
                'lokasi' => $lokasiValue,
                'draft' => 0,
                'kota_id' => $account->id_nama_kota,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'slugp' => preg_replace('/[^A-Za-z0-9]+/', '-', preg_replace('/[^A-Za-z0-9\/-]+/', '', $request->PR_SAP))
            ]);
            LaporanKonstruksi::where('slugk', $id)->update([
                "procurement" => 1
            ]);
            DB::commit();
            return redirect()->intended(route('procurement.dashboard.index'))->with("success", "Laporan Berhasil Dibuat");
        } else {
            //invalid action!
        }
        
    }


    public function store_maintenance(Request $request, $id)
    {
        $lokasi = LaporanTiket::where("slugt", "=", $id)
            ->get(["lokasi"]);
        $id_SAP_MAIN = LaporanTiket::where('slugt', $id)->pluck('ID_tiket')->first();
        $lokasiObject = json_decode($lokasi[0]);
        $lokasiValue = $lokasiObject->lokasi;
        $account = Auth::guard('account')->user();
        if ($_POST['submit'] == 'draft') {
            $messages = [
                'required' => ':attribute wajib diisi',
                'unique' => ':attribute sudah ada',
                'PR_SAP.required' => 'Nomor PR wajib diisi',
                'PR_SAP.unique' => 'Nomor PR sudah ada', 
                'ID_tiket_id.unique' => 'Laporan sudah ada, silahkan periksa laporan procurement',
            ];
            $this->validate($request, [
                "PR_SAP" => 'required|unique:laporan_procurement',
                "ID_tiket_id" => 'required|unique:laporan_procurement'
            ], $messages);
            LaporanProcurement::insert([
                "PR_SAP" => $request->PR_SAP,
                'PO_SAP' => $request->PO_SAP,
                'tanggal_PO_SAP' => $request->tanggal_PO_SAP,
                'material_DRM' => $request->material_DRM,
                'jasa_DRM' => $request->jasa_DRM,
                'total_DRM' => $request->total_DRM,
                'material_aktual' => $request->material_aktual,
                'jasa_aktual'  => $request->jasa_aktual,
                'total_aktual'  => $request->total_aktual,
                'status_tagihan_id' => $request->status_tagihan_id,
                'keterangan' => $request->keterangan,
                'ID_tiket_id' => $id_SAP_MAIN,
                'lokasi' => $lokasiValue,
                'draft' => 1,
                'kota_id' => $account->id_nama_kota,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'slugp' => preg_replace('/[^A-Za-z0-9]+/', '-', preg_replace('/[^A-Za-z0-9\/-]+/', '', $request->PR_SAP))
            ]);
            LaporanTiket::where('slugt', $id)->update([
                "procurement" => 1
            ]);
            return redirect()->intended(route('procurement.dashboard.draft'))->with("success", "Laporan Berhasil Dibuat");
        } else if ($_POST['submit'] == 'save') {
            DB::beginTransaction();
            $messages = [
                'required' => ':attribute wajib diisi',
                'unique' => ':attribute sudah ada',
                'PR_SAP.required' => 'Nomor PR wajib diisi',
                'PR_SAP.unique' => 'Nomor PR sudah ada', 
                'ID_tiket_id.unique' => 'Laporan sudah ada, silahkan periksa laporan procurement',
            ];

            $this->validate($request, [
                "PR_SAP" => 'required|unique:laporan_procurement',
                "ID_tiket_id" => 'unique:laporan_procurement',
                'PO_SAP' => 'required',
                'tanggal_PO_SAP' => 'required',
                'material_DRM' => 'required',
                'jasa_DRM' => 'required',
                'total_DRM' => 'required',
                'material_aktual' => 'required',
                'jasa_aktual'  => 'required',
                'total_aktual'  => 'required',
                'status_tagihan_id' => 'required',
            ], $messages);

            LaporanProcurement::insert([
                "PR_SAP" => $request->PR_SAP,
                'PO_SAP' => $request->PO_SAP,
                'tanggal_PO_SAP' => $request->tanggal_PO_SAP,
                'material_DRM' => $request->material_DRM,
                'jasa_DRM' => $request->jasa_DRM,
                'total_DRM' => $request->total_DRM,
                'material_aktual' => $request->material_aktual,
                'jasa_aktual'  => $request->jasa_aktual,
                'total_aktual'  => $request->total_aktual,
                'status_tagihan_id' => $request->status_tagihan_id,
                'keterangan' => $request->keterangan,
                'ID_tiket_id' => $id_SAP_MAIN,
                'lokasi' => $lokasiValue,
                'draft' => 0,
                'kota_id' => $account->id_nama_kota,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'slugp' => preg_replace('/[^A-Za-z0-9]+/', '-', preg_replace('/[^A-Za-z0-9\/-]+/', '', $request->PR_SAP))
            ]);
            LaporanTiket::where('slugt', $id)->update([
                "procurement" => 1
            ]);
            DB::commit();
            return redirect()->intended(route('procurement.dashboard.index'))->with("success", "Laporan Berhasil Dibuat");
        } else {
            //invalid action!
        }
    }

    public function deleteLaporanProcurement($id)
    {
        try {
            DB::beginTransaction();

            $procurement = LaporanProcurement::where("slugp", "=", $id);
            $procurement->delete();

            DB::commit();
            $account = Auth::guard('account')->user();
            if ($account->role == "Procurement") {
                return redirect()->intended(route('procurement.dashboard.index'))->with("success", "Berhasil menghapus Laporan Procurement");
            } else if ($account->role == 'Admin') {
                return redirect()->intended(route('admin.laporan_procurement.index'))->with("success", "Berhasil menghapus Laporan Procurement");

            }
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            if ($account->role == "Procurement") {
                return redirect()->intended(route('procurement.dashboard.index'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
            }else if ($account->role == 'Admin') {
                return redirect()->intended(route('admin.laporan_procurement.index'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
            }

        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            if ($account->role == "Procurement") {
                return redirect()->intended(route('procurement.dashboard.index'))->with("error", "Terjadi Error karena data ini sedang digunakan");
            }else if ($account->role == 'Admin') {
                return redirect()->intended(route('admin.laporan_procurement.index'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
            }        }
    }
    public function edit($id){
        return view('procurement.dashboard.edit', [
            "title" => "Edit Laporan Procurement",
            "procurement" => LaporanProcurement::where("slugp", "=", $id)->get(),
            "statustagihanmany" => StatusTagihan::all(),
            "id" => $id,
        ]);
    }
    public function update(Request $request, $id){
        $id_SAP_KONS = LaporanKonstruksi::where('slugk', $id)->pluck('ID_SAP_konstruksi')->first();
        $account = Auth::guard('account')->user();
        if ($_POST['submit'] == 'draft') {
            $messages = [
                'required' => ':attribute wajib diisi',
                'unique' => ':attribute sudah ada',
                'PR_SAP.required' => 'Nomor PR wajib diisi',
                'PR_SAP.unique' => 'Nomor PR sudah ada', 
            ];
            $this->validate($request, [
                // "PR_SAP" => 'required',
            ], $messages);
            LaporanProcurement::where("slugp", '=', $id)->update([
                // "PR_SAP" => $request->PR_SAP,
                'PO_SAP' => $request->PO_SAP,
                'tanggal_PO_SAP' => $request->tanggal_PO_SAP,
                'material_DRM' => $request->material_DRM,
                'jasa_DRM' => $request->jasa_DRM,
                'total_DRM' => $request->total_DRM,
                'material_aktual' => $request->material_aktual,
                'jasa_aktual'  => $request->jasa_aktual,
                'total_aktual'  => $request->total_aktual,
                'status_tagihan_id' => $request->status_tagihan_id,
                // 'ID_SAP_konstruksi_id'  => $id_SAP_KONS,
                // 'ID_tiket_id'  => $request->ID_tiket_id,
                'keterangan' => $request->keterangan,
                'lokasi' => $request->lokasi,
                'draft' => 1,
                'kota_id' => $account->id_nama_kota
                
            ]);
            return redirect()->intended(route('procurement.dashboard.draft'))->with("success", "Laporan Berhasil Dibuat");
        } else if ($_POST['submit'] == 'save') {
            $messages = [
                'required' => ':attribute wajib diisi',
                'unique' => ':attribute sudah ada',
                'PR_SAP.required' => 'Nomor PR wajib diisi',
                'PR_SAP.unique' => 'Nomor PR sudah ada', 
            ];

            $this->validate($request, [
                // "PR_SAP" => 'required|unique:laporan_procurement',
                // "PID_maintenance_id" => 'unique:laporan_procurement',
                'PO_SAP' => 'required',
                'tanggal_PO_SAP' => 'required',
                'material_DRM' => 'required',
                'jasa_DRM' => 'required',
                'total_DRM' => 'required',
                'material_aktual' => 'required',
                'jasa_aktual'  => 'required',
                'total_aktual'  => 'required',
                'status_tagihan_id' => 'required',
            ], $messages);

            LaporanProcurement::where("slugp", '=', $id)->update([
                // "PR_SAP" => $request->PR_SAP,
                'PO_SAP' => $request->PO_SAP,
                'tanggal_PO_SAP' => $request->tanggal_PO_SAP,
                'material_DRM' => $request->material_DRM,
                'jasa_DRM' => $request->jasa_DRM,
                'total_DRM' => $request->total_DRM,
                'material_aktual' => $request->material_aktual,
                'jasa_aktual'  => $request->jasa_aktual,
                'total_aktual'  => $request->total_aktual,
                'status_tagihan_id' => $request->status_tagihan_id,
// 'ID_SAP_konstruksi_id'  => $id_SAP_KONS,
                // 'ID_tiket_id'  => $request->ID_tiket_id,
                'keterangan' => $request->keterangan,
                'lokasi' => $request->lokasi,
                'draft' => 0,
                'kota_id' => $account->id_nama_kota
            ]);
            return redirect()->intended(route('procurement.dashboard.index'))->with("success", "Laporan Berhasil Dibuat");
        } else {
            //invalid action!
        }
    }

    public function drafted($id){
        LaporanProcurement::where("slugp", '=', $id)->update([
            'draft' => 1
        ]);
        return redirect()->intended(route('admin.laporan_procurement.draft'))->with("success", "Laporan Berhasil Menjadi OGP");
    }
}
