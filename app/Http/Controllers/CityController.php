<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    //
    public function index()
    {
        $city = array();
        return view('admin.dashboard.city', [
            "title" => "City",
            "city" => City::all(),
        ]);
    }

    public function storeCity(Request $request)
    {
        // $request->validate([
        //     'nama_city' => 'required'
        // ]);

        $validator = Validator::make($request->all(), City::$rules, City::$messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        City::insert([
            // "id" => 2,
            "nama_city" => $request->nama_city,
        ]);
        return redirect()->intended(route('admin.dashboard.city'))->with("success", "Berhasil menambahkan Kota");
    }

    // public function deleteCity($id)
    // {
    // City::where('id', $id)->delete();
    // return redirect()->intended(route('admin.dashboard.city'))->with("success", "Berhasil menghapus Kota");
    // }

    // public function deleteCity($id)
    // {
    //     $city = City::find($id);

    //     // Cek apakah kota digunakan di tabel lain
    //     if ($city->accounts()->count() > 0) {
    //         return redirect()->intended(route('admin.dashboard.city'))->with("error", "Kota ini sedang digunakan di tabel Account dan tidak dapat dihapus.");
    //     }
    //     // Jika tidak digunakan, hapus kota
    //     $city->delete();
    //     return redirect()->intended(route('admin.dashboard.city'))->with("success", "Berhasil menghapus Kota");
    // }

    public function deleteCity($id)
    {
        try {
            DB::beginTransaction();

            $city = City::find($id);

            // Pengecekan di setiap tabel terkait
            if ($city->accounts()->count() > 0) {
                throw new \Exception("Kota ini sedang digunakan di Tabel Account dan tidak dapat dihapus.");
            }

            // if ($city->laporans()->count() > 0) {
            //     throw new \Exception("Kota ini sedang digunakan di Tabel Laporan dan tidak dapat dihapus.");
            // }

            // Jika tidak ada pengecualian, hapus kota
            $city->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.city'))->with("success", "Berhasil menghapus Kota");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.city'))->with("error", "Terjadi Error karena data ini sedang digunakan");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.city'))->with("error", "Terjadi Error karena data ini sedang digunakan");
        }
    }

    public function updateCity(Request $request, $id)
    {
        // Ambil aturan validasi dari model
        $rules = City::$rules;
        $messages = City::$messages;

        // Modifikasi aturan validasi untuk keperluan update
        $rules['nama_city'] = 'unique:city,nama_city,'.$id.',id';

        // Buat validator dengan aturan validasi yang telah dimodifikasi
        $validator = Validator::make($request->all(), $rules, $messages);

        // Lakukan validasi
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        City::where('id', $id)->update([
            "nama_city" => $request->nama_city,
        ]);

        return redirect()->intended(route('admin.dashboard.city'))->with("success", "Berhasil mengubah Kota");
    }
}