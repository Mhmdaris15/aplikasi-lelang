<?php

namespace App\Http\Controllers;

use App\Models\Lelang;
use App\Http\Requests\StoreLelangRequest;
use App\Http\Requests\UpdateLelangRequest;

class LelangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreLelangRequest $request)
    {

        // return "Hello World";
        // Validate the request
        $validated = $request->validated();

        // Create Lelang
        try {
            Lelang::create($validated);
        } catch (\Throwable $th) {
            return redirect('/lelang-management')->with('error', 'Gagal menambahkan lelang');
        }

        return redirect('/lelang-management')->with('success', 'Berhasil menambahkan lelang');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lelang $lelang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lelang $lelang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLelangRequest $request, Lelang $lelang)
    {
        // Update Lelang
        echo $request;
        $lelang = Lelang::find($lelang->id);
        try {
            $lelang->update($request->all());
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal mengubah lelang');
        }

        return  redirect()->back()->with('success', 'Berhasil mengubah lelang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lelang $lelang)
    {
        // Delete Lelang
        try {
            $lelang->delete();
        } catch (\Throwable $th) {
            return redirect('/lelang-management')->with('error', 'Gagal menghapus lelang');
        }

        return redirect('/lelang-management')->with('success', 'Berhasil menghapus lelang');
    }
}
