<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //
    public function index()
    {
        $account = array();
        $roles = DB::table('role')
            ->select('*')
            ->get();

        $citys = array();
        foreach (City::all() as $item) {
            $citys[$item->id] = $item->nama_city;
        }

        return view('admin.dashboard.account', [
            "title" => "Account",
            "account" => Account::all(),
            "roles" => $roles,
            "citys" => $citys,
            "addcity" => City::all()
        ]);
    }

    public function storeAccount(Request $request)
    {
        // $request->validate([
        //     'nama_city' => 'required'
        // ]);

        Account::insert([
            // "id" => 2,
            "nama" => $request->nama,
            "nik" => $request->nik,
            "password" => Hash::make($request->password),
            "role" => $request->role,
            "id_nama_kota" => $request->id_nama_kota,
            "keterangan" => $request->keterangan
        ]);
        return redirect()->intended(route('admin.dashboard.account'))->with("success", "Berhasil menambahkan Account");
    }

    public function deleteAccount($id)
    {
        try {
            DB::beginTransaction();

            $account = Account::find($id);

            // Pengecekan di setiap tabel terkait
            // if ($account->laporanCommerce()->count() > 0) {
            //     throw new \Exception("Kota ini sedang digunakan di Tabel Account dan tidak dapat dihapus.");
            // }

            // Jika tidak ada pengecualian, hapus kota
            $account->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.account'))->with("success", "Berhasil menghapus Account");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.account'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.account'))->with("error", $e->getMessage());
        }
    }

    public function updateAccount(Request $request, $id)
    {
        if (isset($request->password)) {
            Account::where('id', $id)->update([
                "nama" => $request->nama,
                "nik" => $request->nik,
                "password" => Hash::make($request->password),
                "role" => $request->role,
                "id_nama_kota" => $request->id_nama_kota,
                "keterangan" => $request->keterangan
            ]);
        } else {
            Account::where('id', $id)->update([
                "nama" => $request->nama,
                "nik" => $request->nik,
                "role" => $request->role,
                "id_nama_kota" => $request->id_nama_kota,
                "keterangan" => $request->keterangan
            ]);
        }


        return redirect()->intended(route('admin.dashboard.account'))->with("success", "Berhasil mengubah Account");
    }
}
