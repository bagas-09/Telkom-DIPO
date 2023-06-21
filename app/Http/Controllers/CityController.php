<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

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
        // $messages = [
        //     'required' => ':attribute wajib diisi ',
        //     'min' => ':attribute harus diisi minimal :min karakter !!!',
        //     'max' => ':attribute harus diisi maksimal :max karakter !!!',
        //     'numeric' => ':attribute harus diisi angka !!!',
        //     'email' => ':attribute harus diisi dalam bentuk email !!!',
        // ];

        // $this->validate($request, [
        //     "nama_city" => 'required',
        // ], $messages);

        City::insert([
            // "id" => 2,
            "nama_city" => $request->nama_city,
        ]);
        return redirect()->intended(route('admin.dashboard.city'));;
        // ->with('success', 'Kategori telah ditambahkan');
    }
}
