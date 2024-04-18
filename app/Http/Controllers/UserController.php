<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function __construct(protected User $user)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = $this->user->get();

        return response()->json($user);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt($data)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['user' => $user, 'token' => $token]);
        }
        else {
            return response()->json('Email atau Password salah');
        }
    }

    public function logout() {
        $user = Auth::user();
        $user->tokens()->delete();
        Auth::guard('web')->logout();

        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $user = $this->user;

        $user->nama = $data['nama'];
        $user->email = $data['email'];
        $user->role = $data['role'];
        $user->alamat = $data['alamat'];
        $user->telepon = $data['telepon'];
        $user->password = Hash::make($data['password']);

        $user->save();

        return response()->json($user);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = $this->user->find($id);
        if ($user == null) {
            return response()->json('Data dengan id ' . $id . ' tidak ditemukan');
        }

        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->validated();
        $user = $this->user->find($id);
        if ($user == null) {
            return response()->json('Data dengan id ' . $id . ' tidak ditemukan');
        }

        $user->nama = $data['nama'];
        $user->email = $data['email'];
        $user->role = $data['role'];
        $user->alamat = $data['alamat'];
        $user->telepon = $data['telepon'];
        $user->password = Hash::make($data['password']);

        $user->update();

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);
        if ($user == null) {
            return response()->json('Data dengan id ' . $id . ' tidak ditemukan');
        }
        $user->delete();

        return response()->json($user);
    }
}
