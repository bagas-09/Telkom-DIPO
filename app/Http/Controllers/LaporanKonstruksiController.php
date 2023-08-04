<?php

namespace App\Http\Controllers;

use App\Models\JenisOrder;
use App\Models\LaporanKonstruksi;
use App\Models\Mitra;
use App\Models\StatusPekerjaan;
use App\Models\TipeKemitraan;
use App\Models\TipeProvisioning;
use App\Models\City;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class LaporanKonstruksiController extends Controller
{
    //
    public function index()
    {
        $laporanKonstruksis = array();
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

        $jenis_order_id = array();
        foreach (JenisOrder::all() as $jenisO) {
            $jenis_order_id[$jenisO->id] = $jenisO->nama_jenis_order;
        }

        $tipe_provisioning_id = array();
        foreach (TipeProvisioning::all() as $tipeP) {
            $tipe_provisioning_id[$tipeP->id] = $tipeP->nama_tipe_provisioning;
        }

        $account = Auth::guard('account')->user();
        return view('konstruksi.laporan_konstruksi', [
            "title" => "Laporan Konstruksi",
            "laporanKonstruksis" => LaporanKonstruksi::all()->where("kota_id", "=", $account->id_nama_kota),
            "laporan_konstruksi_commerce" => LaporanKonstruksi::all()->where("commerce", "!=", 1)->where("kota_id", "=", $account->id_nama_kota),
            "laporan_konstruksi_procurement" => LaporanKonstruksi::all()->where("procurement", "!=", 1)->where("kota_id", "=", $account->id_nama_kota),
            "roles" => $roles,
            "citys" => $citys,
            "status_pekerjaan_id" => $status_pekerjaan_id,
            "mitra_id" => $mitra_id,
            "tipe_kemitraan_id" => $tipe_kemitraan_id,
            "jenis_order_id" => $jenis_order_id,
            "tipe_provisioning_id" => $tipe_provisioning_id,
            // "editable" => LaporanKonstruksi::select("editable"),
        ]);
    }


    public function addLaporanKonstruksi(Request $request)
    {
        return view('konstruksi.laporan_konstruksi_add', [
            "title" => "Buat Laporan Konstruksi",
            "addcity" => City::all(),
            "addsp" => StatusPekerjaan::all()->where("role", "=", "Konstruksi"),
            "mitrass" => Mitra::all()->where("role", "=", "Konstruksi"),
            "tipek" => TipeKemitraan::all()->where("role", "=", "Konstruksi"),
            "jeniso" => JenisOrder::all(),
            "tipeprov" => TipeProvisioning::all(),
        ]);
    }

    // private function generateNilaiDitambahkan($jenisOrder, $tipeProvisioning, $lokasi)
    // {
    //     // Buat logika untuk menggabungkan nilai sesuai kebutuhan Anda
    //     $nilaiDitambahkan = $jenisOrder . " - " . $tipeProvisioning . " - " . $lokasi;

    //     return $nilaiDitambahkan;
    // }

    public function storeLaporanKonstruksi(Request $request)
    {
        $messages = [
            'required' => ':Field wajib diisi',
            'unique' => ':Nilai sudah ada',
        ];

        $this->validate($request, [
            'PID_konstruksi' => 'required|unique:laporan_konstruksi',
            'ID_SAP_konstruksi' => 'required',
            'NO_PR_konstruksi' => 'required',
            'tanggal_PR' => 'required',
            'status_pekerjaan_id' => 'required',
            'mitra_id' => 'required',
            'tipe_kemitraan_id' => 'required',
            'jenis_order_id' => 'required',
            'tipe_provisioning_id' => 'required',
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
        $jenisOrder = $request->jenis_order_id;
        $tipeProvisioning = $request->tipe_provisioning_id;
        $lokasi = $request->lokasi;

        $order = JenisOrder::where("id", "=", $jenisOrder)
            ->get(["nama_jenis_order"]);
        $orderObject = json_decode($order[0]);
        $orderValue = $orderObject->nama_jenis_order;

        $tipeProv = TipeProvisioning::where("id", "=", $tipeProvisioning)
            ->get(["nama_tipe_provisioning"]);
        $tipeProvObject = json_decode($tipeProv[0]);
        $tipeProvValue = $tipeProvObject->nama_tipe_provisioning;

        if ($orderValue == "Konsumer (Cons)" || $orderValue == "HEM" || $orderValue == "Node B" || $orderValue == "Node B OLO (MTEL)") {
            // Menggabungkan nilai autoGenerated dan inputLokasi
            $nilaiDitambahkan = $orderValue . " - " . $tipeProvValue . " - " . $lokasi;
        } else {
            $nilaiDitambahkan = $lokasi;
        }

        $account = Auth::guard('account')->user();
        LaporanKonstruksi::insert([
            // "id" => 2,
            // "nama_tipe_kemitraan" => $request->nama_tipe_kemitraan,
            // "role" => $request->role,
            'PID_konstruksi' => $request->PID_konstruksi,
            'ID_SAP_konstruksi' => $request->ID_SAP_konstruksi,
            'NO_PR_konstruksi' => $request->NO_PR_konstruksi,
            'tanggal_PR' => $request->tanggal_PR,
            'status_pekerjaan_id' => $request->status_pekerjaan_id,
            'mitra_id' => $request->mitra_id,
            'tipe_kemitraan_id' => $request->tipe_kemitraan_id,
            'jenis_order_id' => $request->jenis_order_id,
            'tipe_provisioning_id' => $request->tipe_provisioning_id,
            'lokasi' => $nilaiDitambahkan,
            'material_DRM' => $request->material_DRM,
            'jasa_DRM' => $request->jasa_DRM,
            'total_DRM' => $request->total_DRM,
            'material_aktual' => $request->material_aktual,
            'jasa_aktual' => $request->jasa_aktual,
            'total_aktual' => $request->total_aktual,
            'keterangan' => $request->keterangan,
            'kota_id' => $account->id_nama_kota
        ]);
        return redirect()->intended(route('konstruksi.laporanKonstruksi.index'))->with("success", "Berhasil menambahkan Laporan Konstruksi");
    }

    public function deleteLaporanKonstruksi($id)
    {
        try {
            $account = Auth::guard('account')->user();
            DB::beginTransaction();

            $tipe_kemitraan = LaporanKonstruksi::find($id);

            // Pengecekan di setiap tabel terkait
            // if ($status->laporanCommerce()->count() > 0) {
            //     throw new \Exception("Kota ini sedang digunakan di Tabel Account dan tidak dapat dihapus.");
            // }

            // Jika tidak ada pengecualian, hapus kota
            $tipe_kemitraan->delete();

            DB::commit();

            if ($account->role == "Konstruksi") {
                return redirect()->intended(route('konstruksi.laporanKonstruksi.index'))->with("success", "Berhasil menghapus Laporan Konstruksi");
            } else if ($account->role == "Admin") {
                return redirect()->intended(route('admin.laporan_konstruksi'))->with("success", "Berhasil menghapus Laporan Konstruksi");
            }
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            if ($account->role == "Konstruksi") {
                return redirect()->intended(route('konstruksi.laporanKonstruksi.index'))->with("error", $e->getMessage());
            } else if ($account->role == "Admin") {
                return redirect()->intended(route('admin.laporan_konstruksi'))->with("error", $e->getMessage());
            }
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            if ($account->role == "Konstruksi") {
                return redirect()->intended(route('konstruksi.laporanKonstruksi.index'))->with("error", $e->getMessage());
            } else if ($account->role == "Admin") {
                return redirect()->intended(route('admin.laporan_konstruksi'))->with("error", $e->getMessage());
            }
        }
    }

    public function editLaporanKonstruksi($id)
    {
        return view('konstruksi.laporan_konstruksi_edit', [
            "title" => "Edit Laporan Konstruksi",
            "konstruksi" => LaporanKonstruksi::where("PID_konstruksi", "=", $id)->get(),
            "addcity" => City::all(),
            "addsp" => StatusPekerjaan::all()->where("role", "=", "Konstruksi"),
            "mitrass" => Mitra::all()->where("role", "=", "Konstruksi"),
            "tipek" => TipeKemitraan::all()->where("role", "=", "Konstruksi"),
            "jeniso" => JenisOrder::all(),
            "tipeprov" => TipeProvisioning::all(),
            "id" => $id,
        ]);
    }

    public function updateLaporanKonstruksi(Request $request, $id)
    {
        $messages = [
            'required' => ':Field wajib diisi',
        ];

        $this->validate($request, [
            'ID_SAP_konstruksi' => 'required',
            'NO_PR_konstruksi' => 'required',
            'tanggal_PR' => 'required',
            'status_pekerjaan_id' => 'required',
            'mitra_id' => 'required',
            'tipe_kemitraan_id' => 'required',
            'jenis_order_id' => 'required',
            'tipe_provisioning_id' => 'required',
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
        $account = Auth::guard('account')->user();
        LaporanKonstruksi::where('PID_konstruksi', $id)->update([
            'ID_SAP_konstruksi' => $request->ID_SAP_konstruksi,
            'NO_PR_konstruksi' => $request->NO_PR_konstruksi,
            'tanggal_PR' => $request->tanggal_PR,
            'status_pekerjaan_id' => $request->status_pekerjaan_id,
            'mitra_id' => $request->mitra_id,
            'tipe_kemitraan_id' => $request->tipe_kemitraan_id,
            'jenis_order_id' => $request->jenis_order_id,
            'tipe_provisioning_id' => $request->tipe_provisioning_id,
            'lokasi' => $request->lokasi,
            'material_DRM' => $request->material_DRM,
            'jasa_DRM' => $request->jasa_DRM,
            'total_DRM' => $request->total_DRM,
            'material_aktual' => $request->material_aktual,
            'jasa_aktual' => $request->jasa_aktual,
            'total_aktual' => $request->total_aktual,
            'keterangan' => $request->keterangan,
            'kota_id' => $account->id_nama_kota
        ]);
        return redirect()->intended(route('konstruksi.laporanKonstruksi.index'))->with("success", "Berhasil mengubah Laporan Konstruksi");
    }

    public function Editable($id)
    {
        LaporanKonstruksi::where('PID_konstruksi', $id)->update([
            "editable" => 1
        ]);

        return redirect()->intended(route('admin.laporan_konstruksi'))->with("success", "Berhasil memberi akses edit pada Laporan Konstruksi");
    }

    public function Uneditable($id)
    {
        LaporanKonstruksi::where('PID_konstruksi', $id)->update([
            "editable" => 0
        ]);

        return redirect()->intended(route('admin.laporan_konstruksi'))->with("success", "Berhasil mengubah akses edit pada Laporan Konstruksi");
    }
}
