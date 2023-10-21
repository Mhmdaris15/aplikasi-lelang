<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
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
    public function store(StoreBarangRequest $request)
    {
        // Validate the request...
        $validated = $request->validate([
            'nama_barang' => 'required|max:255|min:2',
            'harga' => 'required|integer',
            'tanggal' => 'required|date',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'required|max:255|min:2',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = $this->generateFilename($file);

            $file->storeAs('public/images', $filename);
            $validated['foto'] = $filename;
        }

        try {
            $barang = Barang::create($validated);
        } catch (\Throwable $th) {
            return redirect('/barang-management')->with('error', 'Gagal menambahkan barang');
        }

        return redirect('/barang-management')->with('success', 'Berhasil menambahkan barang');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBarangRequest $request, Barang $barang)
    {
        $barang = Barang::find($barang->id);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = $this->generateFilename($file);

            $file->storeAs('public/images', $filename);

            $barang['foto'] = $filename;
        }

        try {
            // $barang->update($request->all());
            $barang->update($request->except(['foto']));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the barang.');
        }

        return redirect()->back()->with('success', 'Barang updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang = Barang::find($barang->id);

        try {
            $barang->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the barang.');
        }

        return redirect()->back()->with('success', 'Barang deleted successfully.');
    }

    private function generateFilename($file)
    {
        $time = time();
        $originalName = $file->getClientOriginalName();
        $extension = $file->extension();

        return $time . '-' . $originalName;
    }
}
