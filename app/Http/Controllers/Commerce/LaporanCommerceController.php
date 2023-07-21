<?php

namespace App\Http\Controllers\Commerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanCommerce;
use App\Models\LaporanKonstruksi;
use App\Models\LaporanMaintenance;
use App\Models\Status;
use Illuminate\Support\Facades\DB;

class LaporanCommerceController extends Controller
{
    public function index()
    {
        $status_id = array();
        foreach (Status::all() as $statusP) {
            $status_id[$statusP->id] = $statusP->nama_status;
        }
        return view('commerce.laporan.index', [
            "title" => "Laporan Commerce",
            "commerce" => LaporanCommerce::all()->where('draft', '=', 0),
            "status"=> $status_id
        ]);
    }


    public function draft()
    {
        $status_id = array();
        foreach (Status::all() as $statusP) {
            $status_id[$statusP->id] = $statusP->nama_status;
        }
        return view('commerce.laporan.draft', [
            "title" => "Draft",
            "commerce" => LaporanCommerce::all()->where('draft', '=', 1),
            "status"=> $status_id
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
                'draft' => 1
            ]);
            LaporanKonstruksi::where('PID_konstruksi', $id)->update([
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
                'draft' => 0
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
                'draft' => 1
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
                'draft' => 0
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

            // Pengecekan di setiap tabel terkait
            // if ($status->laporanCommerce()->count() > 0) {
            //     throw new \Exception("Kota ini sedang digunakan di Tabel Account dan tidak dapat dihapus.");
            // }

            // Jika tidak ada pengecualian, hapus kota
            $commerce->delete();

            DB::commit();

            return redirect()->intended(route('commerce.laporan.index'))->with("success", "Berhasil menghapus Laporan Commerce");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('commerce.laporan.index'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('commerce.laporan.index'))->with("error", $e->getMessage());
        }
    }

    public function edit($id){
        return view('commerce.laporan.edit', [
            "title" => "Edit Laporan Commerce",
            "commerce" => LaporanCommerce::where("no_PO", "=", $id)->get(),
            "statusmany" => Status::all(),
            "id" => $id,
        ]);
    }

    public function update(Request $request, $id){
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
                'draft' => 1
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
                'draft' => 0
            ]);
            return redirect()->intended(route('commerce.laporan.index'))->with("success", "Laporan Berhasil Dibuat");
        } else {
            //invalid action!
        }
    }
}
