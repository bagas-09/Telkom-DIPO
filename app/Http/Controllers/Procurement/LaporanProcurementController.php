<?php

namespace App\Http\Controllers\Procurement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanProcurement;
use App\Models\LaporanKonstruksi;
use App\Models\LaporanMaintenance;
use App\Models\StatusTagihan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class LaporanProcurementController extends Controller
{
    public function index()
    {
        $status_tagihan_id = array();
        foreach (StatusTagihan::all() as $statusT) {
            $status_tagihan_id[$statusT->id] = $statusT->nama_status_tagihan;
        }
        $procurement = DB::table('laporan_procurement')
            ->join('status_tagihan', 'laporan_procurement.status_tagihan_id', '=', 'status_tagihan.id')
            ->select('*')
            ->where([
            [
                'laporan_procurement.draft', '=', 0
            ],
            [
                'status_tagihan.nama_status_tagihan', '=', 'CASH & BANK'
            ]
            ])->get();
            
        return view('procurement.dashboard.index', [
            "title" => "Laporan Procurement",
            // "procurement" => LaporanProcurement::all()->where('draft', '=', 0),
            "procurement" => $procurement,
            "status_tagihan"=> $status_tagihan_id
        ]);
    }


    public function draft()
    {
        $status_tagihan_id = array();
        foreach (StatusTagihan::all() as $statusT) {
            $status_tagihan_id[$statusT->id] = $statusT->nama_status_tagihan;
        }
        return view('procurement.dashboard.draft', [
            "title" => "OGP",
            "procurement" => LaporanProcurement::all()->where('draft', '=', 1),
            "status_tagihan"=> $status_tagihan_id
        ]);
    }

    public function add_maintenance($id)
    {

        $lokasi = LaporanMaintenance::where("PID_maintenance", "=", $id)
            ->get(["lokasi"]);
        $lokasiObject = json_decode($lokasi[0]);
        $lokasiValue = $lokasiObject->lokasi;
        return view('procurement.dashboard.add_maintenance', [
            "title" => "Tambah Laporan Procurement",
            "procurement" => LaporanProcurement::all(),
            "statustagihanmany" => StatusTagihan::all(),
            "id" => $id,
            "lokasi" => $lokasiValue
        ]);
    }

    public function add_konstruksi($id)
    {
        $lokasi = LaporanKonstruksi::where("PID_konstruksi", "=", $id)
            ->get(["lokasi"]);
        $lokasiObject = json_decode($lokasi[0]);
        $lokasiValue = $lokasiObject->lokasi;
        return view('procurement.dashboard.add_konstruksi', [
            "title" => "Tambah Laporan Procurement",
            "procurement" => LaporanProcurement::all(),
            "statustagihanmany" => StatusTagihan::all(),
            "id" => $id,
            "lokasi" => $lokasiValue
        ]);
    }

    public function store_konstruksi(Request $request, $id)
    {
        $lokasi = LaporanKonstruksi::where("PID_konstruksi", "=", $id)
            ->get(["lokasi"]);
        $lokasiObject = json_decode($lokasi[0]);
        $lokasiValue = $lokasiObject->lokasi;
        if ($_POST['submit'] == 'draft') {
            $messages = [
                'required' => ':attribute wajib diisi',
                'unique' => ':attribute sudah ada',
                'PR_SAP.required' => 'Nomor PR wajib diisi',
                'PR_SAP.unique' => 'Nomor PR sudah ada',
                'PID_konstruksi_id.unique' => 'Laporan sudah ada, silahkan periksa laporan procurement',
            ];
            $this->validate($request, [
                "PR_SAP" => 'required|unique:laporan_procurement',
                "PID_konstruksi_id" => 'required|unique:laporan_procurement'
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
                'PID_konstruksi_id'  => $id,
                'lokasi' => $lokasiValue,
                'draft' => 1
            ]);
            LaporanKonstruksi::where('PID_konstruksi', $id)->update([
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
                'PID_konstruksi_id.unique' => 'Laporan sudah ada, silahkan periksa laporan procurement',
            ];

            $this->validate($request, [
                "PR_SAP" => 'required|unique:laporan_procurement',
                "PID_konstruksi_id" => 'unique:laporan_procurement',
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
                'PID_konstruksi_id'  => $id,
                'lokasi' => $lokasiValue,
                'draft' => 0
            ]);
            LaporanKonstruksi::where('PID_konstruksi', $id)->update([
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
        $lokasi = LaporanMaintenance::where("PID_maintenance", "=", $id)
            ->get(["lokasi"]);
        $lokasiObject = json_decode($lokasi[0]);
        $lokasiValue = $lokasiObject->lokasi;
        if ($_POST['submit'] == 'draft') {
            $messages = [
                'required' => ':attribute wajib diisi',
                'unique' => ':attribute sudah ada',
                'PR_SAP.required' => 'Nomor PR wajib diisi',
                'PR_SAP.unique' => 'Nomor PR sudah ada', 
                'PID_maintenance_id.unique' => 'Laporan sudah ada, silahkan periksa laporan procurement',
            ];
            $this->validate($request, [
                "PR_SAP" => 'required|unique:laporan_procurement',
                "PID_maintenance_id" => 'required|unique:laporan_procurement'
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
                'PID_maintenance_id'  => $id,
                'lokasi' => $lokasiValue,
                'draft' => 1
            ]);
            LaporanMaintenance::where('PID_maintenance', $id)->update([
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
                'PID_maintenance_id.unique' => 'Laporan sudah ada, silahkan periksa laporan procurement',
            ];

            $this->validate($request, [
                "PR_SAP" => 'required|unique:laporan_procurement',
                "PID_maintenance_id" => 'unique:laporan_procurement',
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
                'PID_maintenance_id'  => $id,
                'lokasi' => $lokasiValue,
                'draft' => 0
            ]);
            LaporanMaintenance::where('PID_maintenance', $id)->update([
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

            $procurement = LaporanProcurement::find($id);
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
                return redirect()->intended(route('procurement.dashboard.index'))->with("error", $e->getMessage());
            }else if ($account->role == 'Admin') {
                return redirect()->intended(route('admin.laporan_procurement.index'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
            }        }
    }
    public function edit($id){
        return view('procurement.dashboard.edit', [
            "title" => "Edit Laporan Procurement",
            "procurement" => LaporanProcurement::where("PR_SAP", "=", $id)->get(),
            "statustagihanmany" => StatusTagihan::all(),
            "id" => $id,
        ]);
    }
    public function update(Request $request, $id){
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
            LaporanProcurement::where("PR_SAP", '=', $id)->update([
                // "PR_SAP" => $request->PR_SAP,
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
                'PID_konstruksi_id'  => $request->PID_konstruksi_id,
                'PID_maintenance_id'  => $request->PID_maintenance_id,
                'keterangan' => $request->keterangan,
                'lokasi' => $request->lokasi,
                'draft' => 1
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
                'No_SAP' => 'required',
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

            LaporanProcurement::where("PR_SAP", '=', $id)->update([
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
                'PID_konstruksi_id'  => $request->PID_konstruksi_id,
                'PID_maintenance_id'  => $request->PID_maintenance_id,
                'keterangan' => $request->keterangan,
                'lokasi' => $request->lokasi,
                'draft' => 0
            ]);
            return redirect()->intended(route('procurement.dashboard.index'))->with("success", "Laporan Berhasil Dibuat");
        } else {
            //invalid action!
        }
    }

    public function drafted($id){
        LaporanProcurement::where("PR_SAP", '=', $id)->update([
            'draft' => 1
        ]);
        return redirect()->intended(route('admin.laporan_procurement.draft'))->with("success", "Laporan Berhasil Menjadi Draft");
    }
}
