<?php

namespace App\Http\Controllers;

use App\Models\RumahSakit;
use Illuminate\Http\Request;

class RumahSakitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rumahSakits = RumahSakit::latest()->paginate(10);
        return view('rumah_sakit.index', compact('rumahSakits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rumah_sakit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_rs' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:rumah_sakits,email',
            'telepon' => 'required|string|max:15',
        ]);

        RumahSakit::create($request->all());

        return redirect()->route('rumah_sakit.index')->with('success', 'Data Rumah Sakit berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RumahSakit $rumahSakit)
    {
        return view('rumah_sakit.edit', compact('rumahSakit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RumahSakit $rumahSakit)
    {
        $request->validate([
            'nama_rs' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:rumah_sakits,email,' . $rumahSakit->id,
            'telepon' => 'required|string|max:15',
        ]);

        $rumahSakit->update($request->all());

        return redirect()->route('rumah_sakit.index')->with('success', 'Data Rumah Sakit berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RumahSakit $rumahSakit)
    {
        // Pastikan tidak ada pasien yang terkait sebelum menghapus
        if ($rumahSakit->pasiens()->count() > 0) {
            return response()->json(['error' => 'Hapus dulu data pasien di rumah sakit ini!'], 422);
        }

        $rumahSakit->delete();
        
        return response()->json(['success' => 'Data Rumah Sakit berhasil dihapus.']);
    }
}
