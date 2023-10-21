<?php

namespace App\Http\Controllers;

use App\Models\HistoryLelang;
use App\Http\Requests\StoreHistoryLelangRequest;
use App\Http\Requests\UpdateHistoryLelangRequest;

class HistoryLelangController extends Controller
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
    public function store(StoreHistoryLelangRequest $request)
    {
        // Create a new history lelang
        try {
            $historyLelang = HistoryLelang::create($request->validated());
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'History lelang gagal ditambahkan');
        }

        // Redirect to the history lelang page
        return redirect()->back()->with('success', 'History lelang berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(HistoryLelang $historyLelang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HistoryLelang $historyLelang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHistoryLelangRequest $request, HistoryLelang $historyLelang)
    {
        // update the history lelang
        try {
            $historyLelang->update($request->validated());
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'History lelang gagal diupdate');
        }

        // Redirect to the history lelang page
        return redirect()->back()->with('success', 'History lelang berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistoryLelang $historyLelang)
    {
        //
    }
}
