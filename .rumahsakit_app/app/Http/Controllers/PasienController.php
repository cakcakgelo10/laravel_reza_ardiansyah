<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\RumahSakit;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pasiens = Pasien::with('rumahSakit')->latest()->paginate(10);
        $rumahSakits = RumahSakit::orderBy('nama_rs')->get();
        return view('pasien.index', compact('pasiens', 'rumahSakits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rumahSakits = RumahSakit::orderBy('nama_rs')->get();
        return view('pasien.create', compact('rumahSakits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:15',
            'rumah_sakit_id' => 'required|exists:rumah_sakits,id',
        ]);

        Pasien::create($request->all());

        return redirect()->route('pasien.index')->with('success', 'Data Pasien berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pasien $pasien)
    {
        $rumahSakits = RumahSakit::orderBy('nama_rs')->get();
        return view('pasien.edit', compact('pasien', 'rumahSakits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:15',
            'rumah_sakit_id' => 'required|exists:rumah_sakits,id',
        ]);

        $pasien->update($request->all());

        return redirect()->route('pasien.index')->with('success', 'Data Pasien berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasien $pasien)
    {
        $pasien->delete();
        return response()->json(['success' => 'Data Pasien berhasil dihapus.']);
    }

    /**
     * Filter pasiens based on rumah sakit for AJAX request.
     */
    public function filter(Request $request)
    {
        $rumahSakitId = $request->input('rumah_sakit_id');
        $query = Pasien::with('rumahSakit')->latest();

        if ($rumahSakitId) {
            $query->where('rumah_sakit_id', $rumahSakitId);
        }

        $pasiens = $query->get();

        return view('pasien._table', compact('pasiens'));
    }
}
