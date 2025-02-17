<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil query pencarian
        $search = $request->get('search');

        // Query data ruangan dengan pencarian
        $ruangan = Ruangan::when($search, function ($query, $search) {
            return $query->where('namaRuangan', 'like', '%' . $search . '%');
        })
        ->paginate(10);

        return view('ruangan.index', compact('ruangan'))->with('i', (request()->input('page', 1) - 1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ruangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kodeRuangan'=> 'required',
            'namaRuangan'=> 'required',
            'dayaTampung'=> 'required',
            'lokasi'=> 'required'
        ]);

        Ruangan::create($request->all());
        return redirect()->route('ruangan.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ruangan $ruangan)
    {
        return view('ruangan.show', compact('ruangan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ruangan $ruangan)
    {
        return view('ruangan.edit', compact('ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'kodeRuangan'=> 'required',
            'namaRuangan'=> 'required',
            'dayaTampung'=> 'required',
            'lokasi'=> 'required'
        ]);

        $ruangan->update($request->all());
        return redirect()->route('ruangan.index')->with('success','Data Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();
        return redirect()->route('ruangan.index')->with('success','Dokter Berhasil di Hapus');
    }
}
