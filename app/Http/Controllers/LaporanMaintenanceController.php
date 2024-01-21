<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanMaintenance;
use App\Models\City;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\ExcelExportM;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Carbon\Carbon;


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


        $account = Auth::guard('account')->user();
        return view('maintenance.laporan_maintenance', [
            "title" => "Laporan Maintenance",
            "laporanMaintenances" => LaporanMaintenance::all()->where("kota_id", "=", $account->id_nama_kota),
            "roles" => $roles,
            "citys" => $citys,
            
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
        ]);
    }
    
    public function storeLaporanMaintenance(Request $request)
    {
        $account = Auth::guard('account')->user();
        $messages = [
            'required' => 'Field wajib diisi',
            'unique' => 'Nilai sudah ada',
        ];
        $this->validate($request, [
            "ID_SAP_maintenance" => 'required|unique:laporan_maintenance',
            "PID_maintenance" => 'required',
            'NO_PR_maintenance' => 'required',
            'tanggal_PR' => 'required',
        ], $messages);
        
        // LOKASI (Mengambil nilai dari form)


        LaporanMaintenance::insert([
            "ID_SAP_maintenance" => $request->ID_SAP_maintenance,
            "PID_maintenance" => $request->PID_maintenance,
            'NO_PR_maintenance' => $request->NO_PR_maintenance,
            'tanggal_PR' => $request->tanggal_PR,
            'keterangan' => $request->keterangan,
            'kota_id' => $account->id_nama_kota,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'slugm' => preg_replace('/[^A-Za-z0-9]+/', '-', preg_replace('/[^A-Za-z0-9\/-]+/', '', $request->ID_SAP_maintenance)),
        ]);
        return redirect()->intended(route('maintenance.laporanMaintenance.index'))->with("success", "Laporan Berhasil Dibuat");

        
    }

    public function deleteLaporanMaintenance($id)
    {
        try {
            $account = Auth::guard('account')->user();
            DB::beginTransaction();

            $laporan_maintenance = LaporanMaintenance::where("slugm", "=", $id);

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
                return redirect()->intended(route('maintenance.laporanMaintenance.index'))->with("error", "Terjadi Error karena ID SAP ini sedang digunakan");
            } else if ($account->role == "Admin") {
                return redirect()->intended(route('admin.laporan_maintenance'))->with("error", "Terjadi Error karena ID SAP ini sedang digunakan");
            }
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            if ($account->role == "Maintenance") {
                return redirect()->intended(route('maintenance.laporanMaintenance.index'))->with("error", $e->getMessage());
            } else if ($account->role == "Admin") {
                return redirect()->intended(route('admin.laporan_maintenance'))->with("error", "Terjadi Error karena ID SAP ini sedang digunakan");
            }
        }
    }
    public function editLaporanMaintenance($id)
    {
        return view('maintenance.laporan_maintenance_edit', [
            "title" => "Edit Laporan Maintenance",
            "maintenance" => LaporanMaintenance::all()->where("slugm", "=", $id),
            "addcity" => City::all(),
            "id" => $id,
        ]);
    }

    public function updateLaporanMaintenance(Request $request, $id)
    {
        $account = Auth::guard('account')->user();
        $messages = [
            'required' => ':Field wajib diisi',
            'unique' => ':attribute sudah ada',
        ];

        $this->validate($request, [
            'ID_SAP_maintenance' => 'required',
            "PID_maintenance" => 'required',
            'NO_PR_maintenance' => 'required',
            'tanggal_PR' => 'required',
            
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
        LaporanMaintenance::where('slugm', '=', $id)->update([
            'PID_maintenance' => $request->PID_maintenance,
            'NO_PR_maintenance' => $request->NO_PR_maintenance,
            'tanggal_PR' => $request->tanggal_PR,
            'keterangan' => $request->keterangan,
            'kota_id' => $account->id_nama_kota,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->intended(route('maintenance.laporanMaintenance.index'))->with("success", "Berhasil mengubah Laporan Maintenance");
    }

    public function Editable($id)
    {
        LaporanMaintenance::where('slugm', '=', $id)->update([
            "editable" => 1
        ]);

        return redirect()->intended(route('admin.laporan_maintenance'))->with("success", "Berhasil memberi akses edit pada Laporan Maintenance");
    }

    public function Uneditable($id)
    {
        LaporanMaintenance::where('slugm', $id)->update([
            "editable" => 0
        ]);

        return redirect()->intended(route('admin.laporan_maintenance'))->with("success", "Berhasil mengubah akses edit pada Laporan Maintenance");
    }
}

