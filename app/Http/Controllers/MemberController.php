<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function __construct(protected Member $member)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member = $this->member->get();

        return response()->json($member);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberRequest $request)
    {
        $data = $request->validated();
        $member = $this->member;

        $member->nama = $data['nama'];
        $member->alamat = $data['alamat'];
        $member->telepon = $data['telepon'];

        $member->save();
        return response()->json($member);
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member, $id)
    {
        $member = $this->member->where('memberID', $id)->first();
        if ($member == null) {
            return response()->json('Data dengan id ' . $id . ' tidak ditemukan');
        }

        return response()->json($member);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberRequest $request, $id)
    {
        $data = $request->validated();
        $member = $this->member->find($id);
        if ($member == null) {
            return response()->json('Data dengan id ' . $id . ' tidak ditemukan');
        }

        $member->nama = $data['nama'];
        $member->alamat = $data['alamat'];
        $member->telepon = $data['telepon'];

        $member->update();

        return response()->json($member);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $member = $this->member->find($id);
        if ($member == null) {
            return response()->json('Data dengan id ' . $id . ' tidak ditemukan');
        }
        $member->delete();

        return response()->json($member);
    }
}
