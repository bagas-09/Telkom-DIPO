<?php

namespace App\Http\Controllers\Commerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanCommerce;
use App\Models\LaporanKonstruksi;
use App\Models\LaporanMaintenance;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Exports\ExcelExportC;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;

class LaporanCommerceController extends Controller
{
    public function index()
    {
        $status_id = array();
        foreach (Status::all() as $statusP) {
            $status_id[$statusP->id] = $statusP->nama_status;
        }
        $account = Auth::guard('account')->user();
        $commerce = DB::table('laporan_commerce')
            ->join('status', 'laporan_commerce.status_id', '=', 'status.id')
            ->select('*')
            ->where([
                [
                    'laporan_commerce.draft', '=', 0
                ],
                [
                    'status.nama_status', '=', 'CASH IN'
                ],
                [
                    "kota_id", "=", $account->id_nama_kota
                ]

            ])
            ->get();
        return view('commerce.laporan.index', [
            "title" => "Laporan Commerce",
            // "commerce" => LaporanCommerce::all()->where('draft', '=', 0),
            "commerce" => $commerce,
            "status" => $status_id
        ]);
    }

    public function export(){
        return Excel::download(new ExcelExportC, 'expor_commerce.xlsx', ExcelExcel::XLSX);
    }

    public function draft()
    {
        $account = Auth::guard('account')->user();
        $status_id = array();
        foreach (Status::all() as $statusP) {
            $status_id[$statusP->id] = $statusP->nama_status;
        }
        return view('commerce.laporan.draft', [
            "title" => "OGP",
            "commerce" => LaporanCommerce::all()->where('draft', '=', 1)->where("kota_id", "=", $account->id_nama_kota),
            "status" => $status_id
        ]);
    }

    public function add_maintenance($id)
    {

        $lokasi = LaporanMaintenance::where("PID_maintenance", "=", $id)
            ->get(["lokasi"]);
        $lokasiObject = json_decode($lokasi[0]);
        $lokasiValue = $lokasiObject->lokasi;
        return view('commerce.laporan.add_maintenance', [
            "title" => "Tambah Laporan Commerce",
            "commerce" => LaporanCommerce::all(),
            "statusmany" => Status::all(),
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
        return view('commerce.laporan.add_konstruksi', [
            "title" => "Tambah Laporan Commerce",
            "commerce" => LaporanCommerce::all(),
            "statusmany" => Status::all(),
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
        $account = Auth::guard('account')->user();
        if ($_POST['submit'] == 'draft') {
            $messages = [
                'required' => ':attribute wajib diisi',
                'unique' => ':attribute sudah ada',
                'no_PO.required' => 'Nomor PO wajib diisi',
                'no_PO.unique' => 'Nomor PO sudah ada',
                'PID_konstruksi_id.unique' => 'Laporan sudah ada, silahkan periksa laporan commerce',
            ];
            $this->validate($request, [
                "no_PO" => 'required|unique:laporan_commerce',
                "PID_konstruksi_id" => 'required|unique:laporan_commerce'
            ], $messages);
            LaporanCommerce::insert([
                "no_PO" => $request->no_PO,
                'tanggal_PO' => $request->tanggal_PO,
                'No_SP' => $request->No_SP,
                'tanggal_SP' => $request->tanggal_SP,
                'TOC' => $request->TOC,
                'No_BAUT' => $request->No_BAUT,
                'tanggal_BAUT' => $request->tanggal_BAUT,
                'NO_BAR' => $request->NO_BAR,
                'tanggal_BAR' => $request->tanggal_BAR,
                'NO_BAST' => $request->NO_BAST,
                'tanggal_BAST' => $request->tanggal_BAST,
                'material_aktual' => $request->material_aktual,
                'jasa_aktual'  => $request->jasa_aktual,
                'total_aktual'  => $request->total_aktual,
                'status_id' => $request->status_id,
                'PID_konstruksi_id'  => $id,
                'lokasi' => $lokasiValue,
                'draft' => 1,
                'kota_id' => $account->id_nama_kota

            ]);
            LaporanKonstruksi::where('PID_konstruksi', $id)->update([
                "commerce" => 1
            ]);
            return redirect()->intended(route('commerce.laporan.draft'))->with("success", "Laporan Berhasil Dibuat");
        } else if ($_POST['submit'] == 'save') {
            $messages = [
                'required' => ':attribute wajib diisi',
                'unique' => ':attribute sudah ada',
                'no_PO.required' => 'Nomor Po wajib diisi',
                'no_PO.unique' => 'Nomor Po sudah ada',
                'PID_konstruksi_id.unique' => 'Laporan sudah ada, silahkan periksa laporan commerce',
            ];

            $this->validate($request, [
                "no_PO" => 'required|unique:laporan_commerce',
                "PID_konstruksi_id" => 'unique:laporan_commerce',
                'tanggal_PO' => 'required',
                'No_SP' => 'required',
                'tanggal_SP' => 'required',
                'TOC' => 'required',
                'No_BAUT' => 'required',
                'tanggal_BAUT' => 'required',
                'NO_BAR' => 'required',
                'tanggal_BAR' => 'required',
                'NO_BAST' => 'required',
                'tanggal_BAST' => 'required',
                'material_aktual' => 'required',
                'jasa_aktual'  => 'required',
                'total_aktual'  => 'required',
                'status_id' => 'required',
            ], $messages);

            LaporanCommerce::insert([
                "no_PO" => $request->no_PO,
                'tanggal_PO' => $request->tanggal_PO,
                'No_SP' => $request->No_SP,
                'tanggal_SP' => $request->tanggal_SP,
                'TOC' => $request->TOC,
                'No_BAUT' => $request->No_BAUT,
                'tanggal_BAUT' => $request->tanggal_BAUT,
                'NO_BAR' => $request->NO_BAR,
                'tanggal_BAR' => $request->tanggal_BAR,
                'NO_BAST' => $request->NO_BAST,
                'tanggal_BAST' => $request->tanggal_BAST,
                'material_aktual' => $request->material_aktual,
                'jasa_aktual'  => $request->jasa_aktual,
                'total_aktual'  => $request->total_aktual,
                'status_id' => $request->status_id,
                'PID_konstruksi_id'  => $id,
                'lokasi' => $lokasiValue,
                'draft' => 0,
                'kota_id' => $account->id_nama_kota

            ]);
            LaporanKonstruksi::where('PID_konstruksi', $id)->update([
                "commerce" => 1
            ]);
            DB::commit();
            return redirect()->intended(route('commerce.laporan.index'))->with("success", "Laporan Berhasil Dibuat");
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
        $account = Auth::guard('account')->user();
        if ($_POST['submit'] == 'draft') {
            $messages = [
                'required' => ':attribute wajib diisi',
                'unique' => ':attribute sudah ada',
                'no_PO.required' => 'Nomor PO wajib diisi',
                'no_PO.unique' => 'Nomor PO sudah ada',
                'PID_maintenance_id.unique' => 'Laporan sudah ada, silahkan periksa laporan commerce',
            ];
            $this->validate($request, [
                "no_PO" => 'required|unique:laporan_commerce',
                "PID_maintenance_id" => 'required|unique:laporan_commerce'
            ], $messages);
            LaporanCommerce::insert([
                "no_PO" => $request->no_PO,
                'tanggal_PO' => $request->tanggal_PO,
                'No_SP' => $request->No_SP,
                'tanggal_SP' => $request->tanggal_SP,
                'TOC' => $request->TOC,
                'No_BAUT' => $request->No_BAUT,
                'tanggal_BAUT' => $request->tanggal_BAUT,
                'NO_BAR' => $request->NO_BAR,
                'tanggal_BAR' => $request->tanggal_BAR,
                'NO_BAST' => $request->NO_BAST,
                'tanggal_BAST' => $request->tanggal_BAST,
                'material_aktual' => $request->material_aktual,
                'jasa_aktual'  => $request->jasa_aktual,
                'total_aktual'  => $request->total_aktual,
                'status_id' => $request->status_id,
                'PID_maintenance_id'  => $id,
                'lokasi' => $lokasiValue,
                'draft' => 1,
                'kota_id' => $account->id_nama_kota
            ]);
            LaporanMaintenance::where('PID_maintenance', $id)->update([
                "commerce" => 1
            ]);
            return redirect()->intended(route('commerce.laporan.draft'))->with("success", "Laporan Berhasil Dibuat");
        } else if ($_POST['submit'] == 'save') {
            DB::beginTransaction();
            $messages = [
                'required' => ':attribute wajib diisi',
                'unique' => ':attribute sudah ada',
                'no_PO.required' => 'Nomor Po wajib diisi',
                'no_PO.unique' => 'Nomor Po sudah ada',
                'PID_maintenance_id.unique' => 'Laporan sudah ada, silahkan periksa laporan commerce',
            ];

            $this->validate($request, [
                "no_PO" => 'required|unique:laporan_commerce',
                "PID_konstruksi_id" => 'unique:laporan_commerce',
                'tanggal_PO' => 'required',
                'No_SP' => 'required',
                'tanggal_SP' => 'required',
                'TOC' => 'required',
                'No_BAUT' => 'required',
                'tanggal_BAUT' => 'required',
                'NO_BAR' => 'required',
                'tanggal_BAR' => 'required',
                'NO_BAST' => 'required',
                'tanggal_BAST' => 'required',
                'material_aktual' => 'required',
                'jasa_aktual'  => 'required',
                'total_aktual'  => 'required',
                'status_id' => 'required',
            ], $messages);

            LaporanCommerce::insert([
                "no_PO" => $request->no_PO,
                'tanggal_PO' => $request->tanggal_PO,
                'No_SP' => $request->No_SP,
                'tanggal_SP' => $request->tanggal_SP,
                'TOC' => $request->TOC,
                'No_BAUT' => $request->No_BAUT,
                'tanggal_BAUT' => $request->tanggal_BAUT,
                'NO_BAR' => $request->NO_BAR,
                'tanggal_BAR' => $request->tanggal_BAR,
                'NO_BAST' => $request->NO_BAST,
                'tanggal_BAST' => $request->tanggal_BAST,
                'material_aktual' => $request->material_aktual,
                'jasa_aktual'  => $request->jasa_aktual,
                'total_aktual'  => $request->total_aktual,
                'status_id' => $request->status_id,
                'PID_maintenance_id'  => $id,
                'lokasi' => $lokasiValue,
                'draft' => 0,
                'kota_id' => $account->id_nama_kota
            ]);
            LaporanMaintenance::where('PID_maintenance', $id)->update([
                "commerce" => 1
            ]);
            DB::commit();
            return redirect()->intended(route('commerce.laporan.index'))->with("success", "Laporan Berhasil Dibuat");
        } else {
            //invalid action!
        }
    }

    public function deleteLaporanCommerce($id)
    {
        try {
            DB::beginTransaction();

            $commerce = LaporanCommerce::find($id);
            $commerce->delete();

            DB::commit();
            $account = Auth::guard('account')->user();
            if ($account->role == "Commerce") {
                return redirect()->intended(route('commerce.laporan.index'))->with("success", "Berhasil menghapus Laporan Commerce");
            } else if ($account->role == 'Admin') {
                return redirect()->intended(route('admin.laporan_commerce.index'))->with("success", "Berhasil menghapus Laporan Commerce");
            }
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            if ($account->role == "Commerce") {
                return redirect()->intended(route('commerce.laporan.index'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
            } else if ($account->role == 'Admin') {
                return redirect()->intended(route('admin.laporan_commerce.index'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
            }
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            if ($account->role == "Commerce") {
                return redirect()->intended(route('commerce.laporan.index'))->with("error", $e->getMessage());
            } else if ($account->role == 'Admin') {
                return redirect()->intended(route('admin.laporan_commerce.index'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
            }
        }
    }

    public function edit($id)
    {
        return view('commerce.laporan.edit', [
            "title" => "Edit Laporan Commerce",
            "commerce" => LaporanCommerce::where("no_PO", "=", $id)->get(),
            "statusmany" => Status::all(),
            "id" => $id,
        ]);
    }

    public function update(Request $request, $id)
    {
        $account = Auth::guard('account')->user();
        if ($_POST['submit'] == 'draft') {
            $messages = [
                'required' => ':attribute wajib diisi',
                'unique' => ':attribute sudah ada',
                'no_PO.required' => 'Nomor PO wajib diisi',
                'no_PO.unique' => 'Nomor PO sudah ada',
            ];
            $this->validate($request, [
                // "no_PO" => 'required',
            ], $messages);
            LaporanCommerce::where("no_PO", '=', $id)->update([
                // "no_PO" => $request->no_PO,
                'tanggal_PO' => $request->tanggal_PO,
                'No_SP' => $request->No_SP,
                'tanggal_SP' => $request->tanggal_SP,
                'TOC' => $request->TOC,
                'No_BAUT' => $request->No_BAUT,
                'tanggal_BAUT' => $request->tanggal_BAUT,
                'NO_BAR' => $request->NO_BAR,
                'tanggal_BAR' => $request->tanggal_BAR,
                'NO_BAST' => $request->NO_BAST,
                'tanggal_BAST' => $request->tanggal_BAST,
                'material_aktual' => $request->material_aktual,
                'jasa_aktual'  => $request->jasa_aktual,
                'total_aktual'  => $request->total_aktual,
                'status_id' => $request->status_id,
                'PID_konstruksi_id'  => $request->PID_konstruksi_id,
                'PID_maintenance_id'  => $request->PID_maintenance_id,
                'lokasi' => $request->lokasi,
                'draft' => 1,
                'kota_id' => $account->id_nama_kota
            ]);
            return redirect()->intended(route('commerce.laporan.draft'))->with("success", "Laporan Berhasil Dibuat");
        } else if ($_POST['submit'] == 'save') {
            $messages = [
                'required' => ':attribute wajib diisi',
                'unique' => ':attribute sudah ada',
                'no_PO.required' => 'Nomor Po wajib diisi',
                'no_PO.unique' => 'Nomor Po sudah ada',
            ];

            $this->validate($request, [
                // "no_PO" => 'required',
                'tanggal_PO' => 'required',
                'No_SP' => 'required',
                'tanggal_SP' => 'required',
                'TOC' => 'required',
                'No_BAUT' => 'required',
                'tanggal_BAUT' => 'required',
                'NO_BAR' => 'required',
                'tanggal_BAR' => 'required',
                'NO_BAST' => 'required',
                'tanggal_BAST' => 'required',
                'material_aktual' => 'required',
                'jasa_aktual'  => 'required',
                'total_aktual'  => 'required',
                'status_id' => 'required',
            ], $messages);

            LaporanCommerce::where("no_PO", '=', $id)->update([
                // "no_PO" => $request->no_PO,
                'tanggal_PO' => $request->tanggal_PO,
                'No_SP' => $request->No_SP,
                'tanggal_SP' => $request->tanggal_SP,
                'TOC' => $request->TOC,
                'No_BAUT' => $request->No_BAUT,
                'tanggal_BAUT' => $request->tanggal_BAUT,
                'NO_BAR' => $request->NO_BAR,
                'tanggal_BAR' => $request->tanggal_BAR,
                'NO_BAST' => $request->NO_BAST,
                'tanggal_BAST' => $request->tanggal_BAST,
                'material_aktual' => $request->material_aktual,
                'jasa_aktual'  => $request->jasa_aktual,
                'total_aktual'  => $request->total_aktual,
                'status_id' => $request->status_id,
                'PID_konstruksi_id'  => $request->PID_konstruksi_id,
                'PID_maintenance_id'  => $request->PID_maintenance_id,
                'lokasi' => $request->lokasi,
                'draft' => 0,
                'kota_id' => $account->id_nama_kota
            ]);
            return redirect()->intended(route('commerce.laporan.index'))->with("success", "Laporan Berhasil Dibuat");
        } else {
            //invalid action!
        }
    }

    public function drafted($id)
    {
        LaporanCommerce::where("no_PO", '=', $id)->update([
            'draft' => 1
        ]);
        return redirect()->intended(route('admin.laporan_commerce.draft'))->with("success", "Laporan Berhasil Menjadi OGP");
    }
}
