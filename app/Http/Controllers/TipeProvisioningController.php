<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipeProvisioning;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TipeProvisioningController extends Controller
{
    //
    public function index()
    {
        $tipe_provisioning = array();
        return view('admin.dashboard.tipe_provisioning', [
            "title" => "Tipe Provisioning",
            "tipe_provisioning" => TipeProvisioning::all(),
        ]);
    }

    public function storeTipeProvisioning(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_tipe_provisioning' => [
                Rule::unique('tipe_provisioning')->where(function ($query) use ($request) {
                    return $query->where('nama_tipe_provisioning', $request->nama_tipe_provisioning)
                                ->where('role', $request->role);
                }),
            ],
        ], [
            'nama_tipe_provisioning.unique' => 'Kombinasi Nama Tipe Provisioning dan Role sudah ada dalam database.',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } 
        // $request->validate([
        //     'nama_city' => 'required'
        // ]);

        TipeProvisioning::insert([
            // "id" => 2,
            "nama_tipe_provisioning" => $request->nama_tipe_provisioning,
            "role" => $request->role,
        ]);
        return redirect()->intended(route('admin.dashboard.tipe_provisioning'))->with("success", "Berhasil menambahkan Tipe Provisioning");
    }

    public function deleteTipeProvisioning($id)
    {
        try {
            DB::beginTransaction();

            $tipe_provisioning = TipeProvisioning::find($id);

            // Pengecekan di setiap tabel terkait
            // if ($tipe_provisioning->laporanCommerce()->count() > 0) {
            //     throw new \Exception("Kota ini sedang digunakan di Tabel Account dan tidak dapat dihapus.");
            // }

            // Jika tidak ada pengecualian, hapus kota
            $tipe_provisioning->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.tipe_provisioning'))->with("success", "Berhasil menghapus Tipe Provisioning");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.tipe_provisioning'))->with("error", "Terjadi Error karena data ini sedang digunakan");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.tipe_provisioning'))->with("error", "Terjadi Error karena data ini sedang digunakan");
        }
    }

    public function updateTipeProvisioning(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_tipe_provisioning' => [
                Rule::unique('tipe_provisioning')->where(function ($query) use ($request, $id) {
                    return $query->where('nama_tipe_provisioning', $request->nama_tipe_provisioning)
                        ->where('role', $request->role)
                        ->where('id', '!=', $id); // Tambahkan kondisi untuk memeriksa id
                }),
            ],
            // ... definisi validasi untuk field lainnya
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tipe_provisioning = TipeProvisioning::find($id);
        $tipe_provisioning->nama_tipe_provisioning = $request->nama_tipe_provisioning;
        $tipe_provisioning->role = $request->role;
        $tipe_provisioning->save();
        TipeProvisioning::where('id', $id)->update([
            "nama_tipe_provisioning" => $request->nama_tipe_provisioning,
            "role" => $request->role,
        ]);

        return redirect()->intended(route('admin.dashboard.tipe_provisioning'))->with("success", "Berhasil mengubah Tipe Provisioning");
    }
}