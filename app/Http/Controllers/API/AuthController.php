<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function daftar(Request $request)
    {
        $user = new User();

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ];

        $messages = [
            'name.required' => 'Tolong isi form Nama',
            'email.required' => 'Tolong isi form Email',
            'email.email' => 'Tolong menggunakan email yang benar',
            'email.unique' => 'Email telah digunakan',
            'password.required' => 'Tolong isi form Password',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Gagal mendaftarkan akun',
                'data' => $validator->errors()
            ], 401);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil mendaftarkan akun'
        ], 201);
    }

    public function login(Request $request) 
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $messages = [
            'email.required' => 'Tolong isi form Email',
            'email.email' => 'Tolong menggunakan email yang benar',
            'password.required' => 'Tolong isi form Password',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Gagal login akun',
                'data' => $validator->errors()
            ], 401);
        }

        if (!Auth::attempt($request->only(['email','password']))) {
            return response()->json([
                'status' => false,
                'message' => 'Akun tidak ditemukan'
            ], 401);
        }

        $user = User::where('email',$request->email)->first();

        return response()->json([
            'status' => true,
            'message' => 'Login berhasil, silahkan simpan token anda',
            'token' => $user->createToken('api-Eligbor')->plainTextToken
        ], 200);

    }
}
