<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Carbon\Carbon;
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
use App\Exports\ExcelExportK;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;


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

        $program_id = array();
        foreach (Program::all() as $program) {
            $program_id[$program->id] = $program->nama_program;
        }

        $tipe_provisioning_id = array();
        foreach (TipeProvisioning::all() as $tipeP) {
            $tipe_provisioning_id[$tipeP->id] = $tipeP->nama_tipe_provisioning;
        }

        $account = Auth::guard('account')->user();
        return view('konstruksi.laporan_konstruksi', [
            "title" => "Laporan Konstruksi",
            "laporanKonstruksis" => LaporanKonstruksi::all()->where("kota_id", "=", $account->id_nama_kota)->where("draft", "=", 0),
            "laporan_konstruksi_commerce" => LaporanKonstruksi::all()->where("commerce", "!=", 1)->where("draft", "=", 0)->where("kota_id", "=", $account->id_nama_kota),
            "laporan_konstruksi_procurement" => LaporanKonstruksi::all()->where("procurement", "!=", 1)->where("draft", "=", 0)->where("kota_id", "=", $account->id_nama_kota),
            "roles" => $roles,
            "citys" => $citys,
            "status_pekerjaan_id" => $status_pekerjaan_id,
            "mitra_id" => $mitra_id,
            "tipe_kemitraan_id" => $tipe_kemitraan_id,
            "program_id" => $program_id,
            "tipe_provisioning_id" => $tipe_provisioning_id,
            // "editable" => LaporanKonstruksi::select("editable"),
        ]);
    }

    public function export(){
        return Excel::download(new ExcelExportK, 'expor_konstruksi.xlsx', ExcelExcel::XLSX);
    }

    public function draft()
    {
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
        foreach (Program::all() as $program) {
            $program_id[$program->id] = $program->nama_program;
        }

        $tipe_provisioning_id = array();
        foreach (TipeProvisioning::all() as $tipeP) {
            $tipe_provisioning_id[$tipeP->id] = $tipeP->nama_tipe_provisioning;
        }
        
        $account = Auth::guard('account')->user();
        return view('konstruksi.draft', [
            "title" => "OGPk",
            "konstruksi" => LaporanKonstruksi::all()->where('draft', '=', 1)->where("kota_id", "=", $account->id_nama_kota),
            "roles" => $roles,
            "citys" => $citys,
            "status_pekerjaan_id" => $status_pekerjaan_id,
            "mitra_id" => $mitra_id,
            "tipe_kemitraan_id" => $tipe_kemitraan_id,
            "program_id" => $program_id,
            "tipe_provisioning_id" => $tipe_provisioning_id,
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
            "program" => Program::all(),
            "tipeprov" => TipeProvisioning::all(),
        ]);
    }

    // private function generateNilaiDitambahkan($Program, $tipeProvisioning, $lokasi)
    // {
    //     // Buat logika untuk menggabungkan nilai sesuai kebutuhan Anda
    //     $nilaiDitambahkan = $Program . " - " . $tipeProvisioning . " - " . $lokasi;

    //     return $nilaiDitambahkan;
    // }

    public function storeLaporanKonstruksi(Request $request)
    {
        $account = Auth::guard('account')->user();
        if ($_POST['submit'] == 'draft') {
        $messages = [
            'required' => 'Field wajib diisi',
            'unique' => 'Nilai sudah ada',
        ];

        $this->validate($request, [
            'ID_SAP_konstruksi' => 'required|unique:laporan_konstruksi',
            'PID_konstruksi' => 'required',
        ], $messages);

        // Mengambil nilai dari form
        

        LaporanKonstruksi::insert([
            // "id" => 2,
            // "nama_tipe_kemitraan" => $request->nama_tipe_kemitraan,
            // "role" => $request->role,
            'ID_SAP_konstruksi' => $request->ID_SAP_konstruksi,
            'PID_konstruksi' => $request->PID_konstruksi,
            'NO_PR_konstruksi' => $request->NO_PR_konstruksi,
            'tanggal_PR' => $request->tanggal_PR,
            'status_pekerjaan_id' => $request->status_pekerjaan_id,
            'mitra_id' => $request->mitra_id,
            'tipe_kemitraan_id' => $request->tipe_kemitraan_id,
            'program_id' => $request->program_id,
            'tipe_provisioning_id' => $request->tipe_provisioning_id,
            'lokasi' => $request->lokasi,
            'material_DRM' => str_replace('.', '', $request->material_DRM),
            'jasa_DRM' => str_replace('.', '', $request->jasa_DRM),
            'total_DRM' => str_replace('.', '', $request->total_DRM),
            'material_aktual' => str_replace('.', '', $request->material_aktual),
            'jasa_aktual' => str_replace('.', '', $request->jasa_aktual),
            'total_aktual' => str_replace('.', '', $request->total_aktual),
            'keterangan' => $request->keterangan,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'kota_id' => $account->id_nama_kota,
            'draft' => 1,
            'slugk' => preg_replace('/[^A-Za-z0-9]+/', '-', preg_replace('/[^A-Za-z0-9\/-]+/', '', $request->ID_SAP_konstruksi)),
        ]);
        return redirect()->intended(route('konstruksi.laporanKonstruksi.draft'))->with("success", "Berhasil menambahkan Laporan Konstruksi");
    } else if ($_POST['submit'] == 'save') {
        $messages = [
            'required' => 'Field wajib diisi',
            'unique' => 'Nilai sudah ada',
        ];

        $this->validate($request, [
            'ID_SAP_konstruksi' => 'required|unique:laporan_konstruksi',
            'PID_konstruksi' => 'required',
            'NO_PR_konstruksi' => 'required',
            'tanggal_PR' => 'required',
            'status_pekerjaan_id' => 'required',
            'mitra_id' => 'required',
            'tipe_kemitraan_id' => 'required',
            'program_id' => 'required',
            'tipe_provisioning_id' => 'required',
            'lokasi' => 'required',
            'material_DRM' => 'required',
            'jasa_DRM' => 'required',
            'total_DRM' => 'required',
            'material_aktual' => 'required',
            'jasa_aktual' => 'required',
            'total_aktual' => 'required',
            
            
        ], $messages);

        // Mengambil nilai dari form
        // $Program = $request->program_id;
        // $tipeProvisioning = $request->tipe_provisioning_id;
        // $lokasi = $request->lokasi;

        // $program = Program::where("id", "=", $Program)
        //     ->get(["nama_program"]);
        // $programObject = json_decode($program[0]);
        // $programValue = $programObject->nama_program;

        // $tipeProv = TipeProvisioning::where("id", "=", $tipeProvisioning)
        //     ->get(["nama_tipe_provisioning"]);
        // $tipeProvObject = json_decode($tipeProv[0]);
        // $tipeProvValue = $tipeProvObject->nama_tipe_provisioning;

        // if ($programValue == "Konsumer (Cons)" || $programValue == "HEM" || $programValue == "Node B" || $programValue == "Node B OLO (MTEL)") {
        //     // Menggabungkan nilai autoGenerated dan inputLokasi
        //     $nilaiDitambahkan = $programValue . " - " . $tipeProvValue . " - " . $lokasi;
        // } else {
        //     $nilaiDitambahkan = $lokasi;
        // }

        $account = Auth::guard('account')->user();
        LaporanKonstruksi::insert([
            // "id" => 2,
            // "nama_tipe_kemitraan" => $request->nama_tipe_kemitraan,
            // "role" => $request->role,
            'ID_SAP_konstruksi' => $request->ID_SAP_konstruksi,
            'PID_konstruksi' => $request->PID_konstruksi,
            'NO_PR_konstruksi' => $request->NO_PR_konstruksi,
            'tanggal_PR' => $request->tanggal_PR,
            'status_pekerjaan_id' => $request->status_pekerjaan_id,
            'mitra_id' => $request->mitra_id,
            'tipe_kemitraan_id' => $request->tipe_kemitraan_id,
            'program_id' => $request->program_id,
            'tipe_provisioning_id' => $request->tipe_provisioning_id,
            'lokasi' => $request->lokasi,
            'material_DRM' => str_replace('.', '', $request->material_DRM),
            'jasa_DRM' => str_replace('.', '', $request->jasa_DRM),
            'total_DRM' => str_replace('.', '', $request->total_DRM),
            'material_aktual' => str_replace('.', '', $request->material_aktual),
            'jasa_aktual' => str_replace('.', '', $request->jasa_aktual),
            'total_aktual' => str_replace('.', '', $request->total_aktual),
            'keterangan' => $request->keterangan,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'kota_id' => $account->id_nama_kota,
            'draft' => 0,
            'slugk' => preg_replace('/[^A-Za-z0-9]+/', '-', preg_replace('/[^A-Za-z0-9\/-]+/', '', $request->ID_SAP_konstruksi)),
        ]);
        return redirect()->intended(route('konstruksi.laporanKonstruksi.index'))->with("success", "Berhasil menambahkan Laporan Konstruksi");
    } 
}

    public function deleteLaporanKonstruksi($id)
    {
        try {
            $account = Auth::guard('account')->user();
            DB::beginTransaction();

            $laporan_kontruksi = LaporanKonstruksi::where("slugk", "=", $id);

            // Pengecekan di setiap tabel terkait
            // if ($status->laporanCommerce()->count() > 0) {
            //     throw new \Exception("Kota ini sedang digunakan di Tabel Account dan tidak dapat dihapus.");
            // }

            // Jika tidak ada pengecualian, hapus kota
            $laporan_kontruksi->delete();

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
                return redirect()->intended(route('admin.laporan_konstruksi'))->with("error", "Terjadi Error karena ID SAP ini sedang digunakan");
            }
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            if ($account->role == "Konstruksi") {
                return redirect()->intended(route('konstruksi.laporanKonstruksi.index'))->with("error", $e->getMessage());
            } else if ($account->role == "Admin") {
                return redirect()->intended(route('admin.laporan_konstruksi'))->with("error", "Terjadi Error karena ID SAP ini sedang digunakan");
            }
        }
    }
    
    public function editLaporanKonstruksi($id)
    {
        return view('konstruksi.laporan_konstruksi_edit', [
            "title" => "Edit Laporan Konstruksi",
            "konstruksi" => LaporanKonstruksi::where("slugk", "=", $id)->get(),
            "addcity" => City::all(),
            "addsp" => StatusPekerjaan::all()->where("role", "=", "Konstruksi"),
            "mitrass" => Mitra::all()->where("role", "=", "Konstruksi"),
            "tipek" => TipeKemitraan::all()->where("role", "=", "Konstruksi"),
            "program" => Program::all(),
            "tipeprov" => TipeProvisioning::all(),
            "id" => $id,
        ]);
    }

    public function updateLaporanKonstruksi(Request $request, $id)
    {
        $account = Auth::guard('account')->user();
        if ($_POST['submit'] == 'draft') {   
        $messages = [
            'required' => ':Field wajib diisi',
            'unique' => ':attribute sudah ada',
        ];

        $this->validate($request, [
            // 'ID_SAP_konstruksi' => 'required',
            // 'NO_PR_konstruksi' => 'required',
            // 'tanggal_PR' => 'required',
            // 'status_pekerjaan_id' => 'required',
            // 'mitra_id' => 'required',
            // 'tipe_kemitraan_id' => 'required',
            // 'program_id' => 'required',
            // 'tipe_provisioning_id' => 'required',
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

        LaporanKonstruksi::where('slugk', '=', $id)->update([
            'PID_konstruksi' => $request->PID_konstruksi,
            'NO_PR_konstruksi' => $request->NO_PR_konstruksi,
            'tanggal_PR' => $request->tanggal_PR,
            'status_pekerjaan_id' => $request->status_pekerjaan_id,
            'mitra_id' => $request->mitra_id,
            'tipe_kemitraan_id' => $request->tipe_kemitraan_id,
            'program_id' => $request->program_id,
            'tipe_provisioning_id' => $request->tipe_provisioning_id,
            'lokasi' => $request->lokasi,
            'material_DRM' => str_replace('.', '', $request->material_DRM),
            'jasa_DRM' => str_replace('.', '', $request->jasa_DRM),
            'total_DRM' => str_replace('.', '', $request->total_DRM),
            'material_aktual' => str_replace('.', '', $request->material_aktual),
            'jasa_aktual' => str_replace('.', '', $request->jasa_aktual),
            'total_aktual' => str_replace('.', '', $request->total_aktual),
            'keterangan' => $request->keterangan,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'kota_id' => $account->id_nama_kota,
            'draft' => 0,
        ]);
        return redirect()->intended(route('konstruksi.laporanKonstruksi.draft'))->with("success", "Berhasil mengubah Laporan Konstruksi");
    } else if ($_POST['submit'] == 'save') {
        $messages = [
            'required' => ':Field wajib diisi',
            'unique' => ':attribute sudah ada',
        ];

        $this->validate($request, [
            'PID_konstruksi' => 'required',
            'NO_PR_konstruksi' => 'required',
            'tanggal_PR' => 'required',
            'status_pekerjaan_id' => 'required',
            'mitra_id' => 'required',
            'tipe_kemitraan_id' => 'required',
            'program_id' => 'required',
            'tipe_provisioning_id' => 'required',
            'lokasi' => 'required',
            'material_DRM' => 'required',
            'jasa_DRM' => 'required',
            'total_DRM' => 'required',
            'material_aktual' => 'required',
            'jasa_aktual' => 'required',
            'total_aktual' => 'required',
            
        ], $messages);

        LaporanKonstruksi::where('slugk', '=', $id)->update([
            'PID_konstruksi' => $request->PID_konstruksi,
            'NO_PR_konstruksi' => $request->NO_PR_konstruksi,
            'tanggal_PR' => $request->tanggal_PR,
            'status_pekerjaan_id' => $request->status_pekerjaan_id,
            'mitra_id' => $request->mitra_id,
            'tipe_kemitraan_id' => $request->tipe_kemitraan_id,
            'program_id' => $request->program_id,
            'tipe_provisioning_id' => $request->tipe_provisioning_id,
            'lokasi' => $request->lokasi,
            'material_DRM' => str_replace('.', '', $request->material_DRM),
            'jasa_DRM' => str_replace('.', '', $request->jasa_DRM),
            'total_DRM' => str_replace('.', '', $request->total_DRM),
            'material_aktual' => str_replace('.', '', $request->material_aktual),
            'jasa_aktual' => str_replace('.', '', $request->jasa_aktual),
            'total_aktual' => str_replace('.', '', $request->total_aktual),
            'keterangan' => $request->keterangan,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'kota_id' => $account->id_nama_kota,
            'draft' => 0,
        ]);
        return redirect()->intended(route('konstruksi.laporanKonstruksi.index'))->with("success", "Berhasil mengubah Laporan Konstruksi");
    } else {
    }
    }
    public function drafted($id)
    {
        LaporanKonstruksi::where('slugk', '=', $id)->update([
            'draft' => 1
        ]);
        return redirect()->intended(route('admin.laporan_konstruksi.draft'))->with("success", "Laporan Berhasil Menjadi OGP");
    }

    public function Editable($id)
    {
        LaporanKonstruksi::where('slugk', '=', $id)->update([
            "editable" => 1
        ]);

        return redirect()->intended(route('admin.laporan_konstruksi'))->with("success", "Berhasil memberi akses edit pada Laporan Konstruksi");
    }

    public function Uneditable($id)
    {
        LaporanKonstruksi::where('slugk', $id)->update([
            "editable" => 0
        ]);

        return redirect()->intended(route('admin.laporan_konstruksi'))->with("success", "Berhasil mengubah akses edit pada Laporan Konstruksi");
    }
}
