<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\RumahSakit;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        // Ambil data pasien dengan paginasi dan eager loading
        $pasiens = Pasien::with('rumahSakit')->latest()->paginate(10);
        $rumahSakits = RumahSakit::orderBy('nama_rs')->get();
        
        return view('pasien.index', compact('pasiens', 'rumahSakits'));
    }

    public function create()
    {
        $rumahSakits = RumahSakit::orderBy('nama_rs')->get();
        return view('pasien.create', compact('rumahSakits'));
    }

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
    
    public function edit(Pasien $pasien)
    {
        $rumahSakits = RumahSakit::orderBy('nama_rs')->get();
        return view('pasien.edit', compact('pasien', 'rumahSakits'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $this->authorize('update', $pasien);

        $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:15',
            'rumah_sakit_id' => 'required|exists:rumah_sakits,id',
        ]);

        $pasien->update($request->all());

        return redirect()->route('pasien.index')->with('success', 'Data Pasien berhasil diperbarui.');
    }

    public function destroy(Pasien $pasien)
    {
        $this->authorize('delete', $pasien);
        
        $pasien->delete();
        return response()->json(['success' => 'Data Pasien berhasil dihapus.']);
    }
    
    /**
     * Filter dan paginasi pasien via AJAX.
     */
    public function filter(Request $request)
    {
        $rumahSakitId = $request->input('rumah_sakit_id');
        $query = Pasien::with('rumahSakit')->latest();

        if ($rumahSakitId) {
            $query->where('rumah_sakit_id', $rumahSakitId);
        }

        // Selalu gunakan paginate() agar link paginasi tetap ada
        $pasiens = $query->paginate(10)->appends($request->query());

        // Jika ini adalah request AJAX, kembalikan hanya partial table
        if ($request->ajax()) {
            return view('pasien._table', compact('pasiens'));
        }

        // Jika bukan AJAX (misal, refresh halaman dengan filter), tampilkan halaman penuh
        $rumahSakits = RumahSakit::orderBy('nama_rs')->get();
        return view('pasien.index', compact('pasiens', 'rumahSakits'));
    }
}