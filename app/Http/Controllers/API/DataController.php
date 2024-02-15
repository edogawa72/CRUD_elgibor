<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Data;

class DataController extends Controller
{

    public function index()
    {
        $data = Data::all();

        return response()->json([
            'status' => true,
            'message' => 'Data Elgibor',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $data = new Data();

        $rules = [
            'nik' => 'required|numeric|digits:16|unique:data,nik',
            'nama' => 'required',
            'telp' => 'required|numeric|digits_between:11,13',
            'alamat' => 'required',
            'kota' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ];

        $messages = [
            'nik.required' => 'Tolong isi form NIK',
            'nik.numeric' => 'NIK harus berupa angka',
            'nik.digits' => 'Nik harus terdiri dari 16 angka',
            'nik.unique' => 'NIK telah digunakan',
            'nama.required' => 'Tolong isi form Nama',
            'telp.required' => 'Tolong isi form Nomer Telepon',
            'telp.numeric' => 'Tolong isi menggunakan angka',
            'telp.digits_between' => 'Nomer Telepon minimal 11 angka dan maksimal 13 angka',
            'alamat.required' => 'Tolong isi form Alamat',
            'kota.required' => 'Tolong isi form Kota',
            'latitude.required' => 'Tolong isi form Latitude',
            'longitude.required' => 'Tolong isi form Longitude',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menambahkan data',
                'data' => $validator->errors()
            ], 401);
        }

        $data->nik = $request->nik;
        $data->nama = $request->nama;
        $data->telp = $request->telp;
        $data->alamat = $request->alamat;
        $data->kota = $request->kota;
        $data->latitude = $request->latitude;
        $data->longitude = $request->longitude;

        $post = $data->save();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambahkan'
        ], 201);
    }

    public function show(string $id)
    {
        $data = Data::find($id);
        if(empty($data)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'data' => $data
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Lihat Data',
            'data' => $data
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $data = Data::find($id);
        if(empty($data)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'data' => $data
            ], 404);
        }

        $rules = [
            'nik' => 'required|numeric|digits:16|unique:data,nik,'.$id,
            'nama' => 'required',
            'telp' => 'required|numeric|digits_between:11,13',
            'alamat' => 'required',
            'kota' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ];

        $messages = [
            'nik.required' => 'Tolong isi form NIK',
            'nik.numeric' => 'NIK harus berupa angka',
            'nik.digits' => 'Nik harus terdiri dari 16 angka',
            'nik.unique' => 'NIK telah digunakan',
            'nama.required' => 'Tolong isi form Nama',
            'telp.required' => 'Tolong isi form Nomer Telepon',
            'telp.numeric' => 'Tolong isi menggunakan angka',
            'telp.digits_between' => 'Nomer Telepon minimal 11 angka dan maksimal 13 angka',
            'alamat.required' => 'Tolong isi form Alamat',
            'kota.required' => 'Tolong isi form Kota',
            'latitude.required' => 'Tolong isi form Latitude',
            'longitude.required' => 'Tolong isi form Longitude',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengubah data',
                'data' => $validator->errors()
            ], 401);
        }

        $data->nik = $request->nik;
        $data->nama = $request->nama;
        $data->telp = $request->telp;
        $data->alamat = $request->alamat;
        $data->kota = $request->kota;
        $data->latitude = $request->latitude;
        $data->longitude = $request->longitude;

        $post = $data->update();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diubah'
        ], 201);
    }

    public function destroy(string $id)
    {
        $data = Data::find($id);
        if(empty($data)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'data' => $data
            ], 404);
        }

        $post = $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}
