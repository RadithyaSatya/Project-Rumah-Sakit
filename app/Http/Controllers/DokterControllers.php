<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class DokterControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $dktr = Dokter::when($search, function ($query, $search) {
            return $query->where('namaDokter', 'like', '%' . $search . '%');
        })
        ->paginate(10);

        return view('dktr.index', compact('dktr'))->with('i', (request()->input('page', 1) - 1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ruangan = Ruangan::all();
        return view('dktr.create', compact('ruangan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idDokter'=> 'required',
            'namaDokter'=> 'required',
            'tanggalLahir'=> 'required',
            'spesialisasi'=> 'required',
            'lokasiPraktik'=> 'required',
            'jamPraktik'=> 'required',
        ]);

        Dokter::create($request->all());
        return redirect()->route('dktr.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dokter $dktr)
    {
        return view('dktr.show', compact('dktr'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dokter $dktr)
    {
        $ruangan = Ruangan::all();
        return view('dktr.edit', compact('dktr', 'ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dokter $dktr)
    {
        $request->validate([
            'idDokter'=> 'required',
            'namaDokter'=> 'required',
            'tanggalLahir'=> 'required',
            'spesialisasi'=> 'required',
            'lokasiPraktik'=> 'required',
            'jamPraktik'=> 'required',
        ]);

        $dktr->update($request->all());
        return redirect()->route('dktr.index')->with('success','Data Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dokter $dktr)
    {
        $dktr->delete();
        return redirect()->route('dktr.index')->with('success','Dokter Berhasil di Hapus');
    }
}
