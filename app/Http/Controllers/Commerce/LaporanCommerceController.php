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

        return view('commerce.laporan.index', [
            "title" => "Laporan Commerce",
            "commerce" => LaporanCommerce::all(),
        ]);
    }

    public function index_maintenance()
    {

        $status = array();
        foreach (Status::all() as $item) {
            $status[$item->id] = $item->nama_status;
        }
        return view('commerce.maintenance.index', [
            "title" => "Laporan Maintenance",
            "laporan_maintenance" => LaporanMaintenance::all(),
            "statusmany" => $status
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

        DB::beginTransaction();
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
            'NO-BAST' => $request->NO_BAST,
            'tanggal_BAST' => $request->tanggal_BAST,
            'material_aktual' => $request->material_aktual,
            'jasa_aktual'  => $request->jasa_aktual,
            'total_aktual'  => $request->total_aktual,
            'status_id' => $request->status_id,
            'PID_konstruksi_id'  => $id,
            'lokasi' => $lokasiValue
        ]);
        LaporanKonstruksi::insert([
            "commerce" => 1
        ]);
        DB::commit();
        return redirect()->intended(route('commerce.laporan.index'))->with("success", "Laporan Berhasil Dibuat");
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
}
