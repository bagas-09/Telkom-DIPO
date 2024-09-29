<?php

namespace App\Http\Controllers\Commerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\LaporanCommerce;
use App\Models\LaporanKonstruksi;
use App\Models\LaporanTiket;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Exports\ExcelExportC;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;
use App\Models\JenisProgram;
use App\Models\Program;
use App\Models\Mitra;
use App\Models\StatusPekerjaan;
use App\Models\TipeKemitraan;
use App\Models\TipeProvisioning;

class LaporanCommerceController extends Controller
{
    public function index()
    {
        $status_id = array();
        foreach (Status::all() as $status) {
            $status_id[$status->id] = $status->nama_status;
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
        foreach (Status::all() as $status) {
            $status_id[$status->id] = $status->nama_status;
        }
        return view('commerce.laporan.draft', [
            "title" => "OGPc",
            "commerce" => LaporanCommerce::all()->where('draft', '=', 1)->where("kota_id", "=", $account->id_nama_kota),
            "status" => $status_id
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
        return view('commerce.laporan.add_maintenance', [
            "title" => "Tambah Laporan Commerce",
            "commerce" => LaporanCommerce::all(),
            "statusmany" => Status::all(),
            "id" => $id,
            "lokasi" => $lokasiValue,
            "tlket" => LaporanTiket::where("slugt", "=", $id)->get(),
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
        $lokasi = LaporanKonstruksi::where("slugk", "=", $id)->get(["lokasi"]);
        // dd($lokasi);
        $lokasiObject = json_decode($lokasi[0]);
        $lokasiValue = $lokasiObject->lokasi;
        return view('commerce.laporan.add_konstruksi', [
            "title" => "Tambah Laporan Commerce",
            "commerce" => LaporanCommerce::all(),
            "statusmany" => Status::all(),
            "id" => $id,
            "lokasi" => $lokasiValue,
            "tpket" => LaporanKonstruksi::where("slugk", "=", $id)->get(),
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
                'no_PO.required' => 'Nomor PO wajib diisi',
                'no_PO.unique' => 'Nomor PO sudah ada',
                'ID_SAP_konstruksi_id.unique' => 'Laporan sudah ada, silahkan periksa laporan commerce',
            ];
            $this->validate($request, [
                "no_PO" => 'required|unique:laporan_commerce',
                "ID_SAP_konstruksi_id" => 'required|unique:laporan_commerce'
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
                'material_aktual' => str_replace('.', '', $request->material_aktual),
            'jasa_aktual' => str_replace('.', '', $request->jasa_aktual),
            'total_aktual' => str_replace('.', '', $request->total_aktual),
                'status_id' => $request->status_id,
                // 'slugK'  => $id,
                'ID_SAP_konstruksi_id'  => $id_SAP_KONS,
                'lokasi' => $lokasiValue,
                'draft' => 1,
                'kota_id' => $account->id_nama_kota,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'slugc' => preg_replace('/[^A-Za-z0-9]+/', '-', preg_replace('/[^A-Za-z0-9\/-]+/', '', $request->no_PO))

            ]);
            LaporanKonstruksi::where('slugk', $id)->update([
                "commerce" => 1
            ]);
            return redirect()->intended(route('commerce.laporan.draft'))->with("success", "Laporan Berhasil Dibuat");
        } else if ($_POST['submit'] == 'save') {
            $messages = [
                'required' => ':attribute wajib diisi',
                'unique' => ':attribute sudah ada',
                'no_PO.required' => 'Nomor Po wajib diisi',
                'no_PO.unique' => 'Nomor Po sudah ada',
                'ID_SAP_konstruksi_id.unique' => 'Laporan sudah ada, silahkan periksa laporan commerce',
            ];

            $this->validate($request, [
                "no_PO" => 'required|unique:laporan_commerce',
                "ID_SAP_konstruksi_id" => 'unique:laporan_commerce',
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
                'material_aktual' => str_replace('.', '', $request->material_aktual),
            'jasa_aktual' => str_replace('.', '', $request->jasa_aktual),
            'total_aktual' => str_replace('.', '', $request->total_aktual),
                'status_id' => $request->status_id,
                'ID_SAP_konstruksi_id'  => $id_SAP_KONS,
                'lokasi' => $lokasiValue,
                'draft' => 0,
                'kota_id' => $account->id_nama_kota,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'slugc' => preg_replace('/[^A-Za-z0-9]+/', '-', preg_replace('/[^A-Za-z0-9\/-]+/', '', $request->no_PO))

            ]);
            LaporanKonstruksi::where('slugk', $id)->update([
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
                'no_PO.required' => 'Nomor PO wajib diisi',
                'no_PO.unique' => 'Nomor PO sudah ada',
                'ID_tiket_id.unique' => 'Laporan sudah ada, silahkan periksa laporan commerce',
            ];
            $this->validate($request, [
                "no_PO" => 'required|unique:laporan_commerce',
                "ID_tiket_id" => 'required|unique:laporan_commerce'
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
                'material_aktual' => str_replace('.', '', $request->material_aktual),
            'jasa_aktual' => str_replace('.', '', $request->jasa_aktual),
            'total_aktual' => str_replace('.', '', $request->total_aktual),
                'status_id' => $request->status_id,
                'ID_tiket_id' => $id_SAP_MAIN,
                // 'slugt'  => $id,
                'lokasi' => $lokasiValue,
                'draft' => 1,
                'kota_id' => $account->id_nama_kota,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'slugc' => preg_replace('/[^A-Za-z0-9]+/', '-', preg_replace('/[^A-Za-z0-9\/-]+/', '', $request->no_PO))
            ]);
            LaporanTiket::where('slugt', $id)->update([
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
                'ID_tiket_id.unique' => 'Laporan sudah ada, silahkan periksa laporan commerce',
            ];

            $this->validate($request, [
                "no_PO" => 'required|unique:laporan_commerce',
                "ID_tiket_id" => 'unique:laporan_commerce',
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
                'material_aktual' => str_replace('.', '', $request->material_aktual),
            'jasa_aktual' => str_replace('.', '', $request->jasa_aktual),
            'total_aktual' => str_replace('.', '', $request->total_aktual),
                'status_id' => $request->status_id,
                // 'ID_SAP_maintenance_id'  => $id,
                'ID_tiket_id' => $id_SAP_MAIN,
                'lokasi' => $lokasiValue,
                'draft' => 0,
                'kota_id' => $account->id_nama_kota,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'slugc' => preg_replace('/[^A-Za-z0-9]+/', '-', preg_replace('/[^A-Za-z0-9\/-]+/', '', $request->no_PO))
            ]);
            LaporanTiket::where('slugt', $id)->update([
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

            $commerce = LaporanCommerce::where("slugc", "=", $id);
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
            "commerce" => LaporanCommerce::all()->where("slugc", "=", $id),
            "statusmany" => Status::all(),
            "id" => $id,
        ]);
    }

    public function update(Request $request, $id)
    {
        $id_SAP_KONS = LaporanKonstruksi::where('slugk', $id)->pluck('ID_SAP_konstruksi')->first();
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
            LaporanCommerce::where("slugc", '=', $id)->update([
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
                'material_aktual' => str_replace('.', '', $request->material_aktual),
            'jasa_aktual' => str_replace('.', '', $request->jasa_aktual),
            'total_aktual' => str_replace('.', '', $request->total_aktual),
                'status_id' => $request->status_id,
                // 'ID_SAP_konstruksi_id'  => $id_SAP_KONS,
                // 'ID_tiket_id'  => $request->ID_tiket_id,
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

            LaporanCommerce::where("slugc", '=', $id)->update([
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
                'material_aktual' => str_replace('.', '', $request->material_aktual),
                'jasa_aktual' => str_replace('.', '', $request->jasa_aktual),
                'total_aktual' => str_replace('.', '', $request->total_aktual),
                'status_id' => $request->status_id,
                // 'ID_SAP_konstruksi_id'  => $id_SAP_KONS,
                // 'ID_SAP_maintenance_id'  => $request->ID_SAP_maintenance_id,
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
        LaporanCommerce::where("slugc", '=', $id)->update([
            'draft' => 1
        ]);
        return redirect()->intended(route('admin.laporan_commerce.draft'))->with("success", "Laporan Berhasil Menjadi OGP");
    }
}
