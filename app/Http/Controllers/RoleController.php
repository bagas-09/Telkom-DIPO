<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    //
    public function index()
    {
        $role = array();
        return view('admin.dashboard.role', [
            "title" => "Role",
            "role" => Role::all()
            // dd(["role" => Role::all()]),
        ]);
    }
    public function storeRole(Request $request)
    {
        // $request->validate([
        //     'nama_city' => 'required'
        // ]);

        Role::insert([
            // "id" => 2,
            "nama_role" => $request->nama_role,
        ]);
        return redirect()->intended(route('admin.dashboard.role'))->with("success", "Berhasil menambahkan Role");
    }

    public function deleteRole($id)
    {
        try {
            DB::beginTransaction();

            $role = Role::find($id);

            // Pengecekan di setiap tabel terkait
            if ($role->accounts()->count() > 0) {
                throw new \Exception("Role ini sedang digunakan di Tabel Account dan tidak dapat dihapus.");
            }

            // if ($role->laporans()->count() > 0) {
            //     throw new \Exception("Kota ini sedang digunakan di Tabel Laporan dan tidak dapat dihapus.");
            // }

            // Jika tidak ada pengecualian, hapus kota
            $role->delete();

            DB::commit();

            return redirect()->intended(route('admin.dashboard.role'))->with("success", "Berhasil menghapus Role");
        } catch (QueryException $e) {
            DB::rollback();

            // Tangkap pengecualian QueryException jika terjadi kesalahan database
            return redirect()->intended(route('admin.dashboard.role'))->with("error", "Terjadi kesalahan database. Silakan coba lagi.");
        } catch (\Exception $e) {
            DB::rollback();

            // Tangkap pengecualian umum dan tampilkan pesan error
            return redirect()->intended(route('admin.dashboard.role'))->with("error", $e->getMessage());
        }
    }
    public function updateRole(Request $request, $id)
    {
        Role::where('id', $id)->update([
            "nama_role" => $request->nama_role,
        ]);

        return redirect()->intended(route('admin.dashboard.role'))->with("success", "Berhasil mengubah Role");
    }
}
?>