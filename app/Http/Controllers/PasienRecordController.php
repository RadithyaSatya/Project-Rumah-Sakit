<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dokter;
use App\Models\Ruangan;
use App\Models\PasienRecord;
use Illuminate\Http\Request;

class PasienRecordController extends Controller
{
    /**
     * Menampilkan daftar pasien.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $pasiens = PasienRecord::when($search, function ($query) use ($search) {
                return $query->where('namaPasien', 'like', "%$search%")
                             ->orWhere('nomorRekamMedis', 'like', "%$search%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pasien.index', compact('pasiens'));
    }

    /**
     * Menampilkan form untuk menambah pasien baru.
     */
    public function create()
    {
        $dokters = Dokter::all();
        return view('pasien.create', compact('dokters'));
    }

    /**
     * Menyimpan data pasien baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomorRekamMedis' => 'required|unique:pasien_records|max:50',
            'namaPasien' => 'required|max:100',
            'tanggalLahir' => 'required|date',
            'jenisKelamin' => 'required|in:L,P',
            'alamatPasien' => 'required',
            'kotaPasien' => 'required|max:100',
            'idDokter' => 'required|exists:dokters,id',
            'tanggalMasuk' => 'required|date',
            'tanggalKeluar' => 'nullable|date|after_or_equal:tanggalMasuk',
        ]);

        // Hitung usia berdasarkan tanggal lahir
        $tanggalLahir = Carbon::parse($request->tanggalLahir);
        $usiaPasien = $tanggalLahir->age;

        // Ambil spesialisasi dokter berdasarkan idDokter
        $dokter = Dokter::findOrFail($request->idDokter);
        $spesialisasi = $dokter->spesialisasi;

        // Ambil kata terakhir dari spesialisasi dokter sebagai default penyakit
        $words = explode(' ', $spesialisasi);
        $penyakitDefault = end($words); // Mengambil kata terakhir

        // Jika penyakitPasien kosong, gunakan default dari spesialisasi dokter
        $penyakitPasien = $request->penyakitPasien ?? "Penyakit $penyakitDefault";

        $ruangan = Ruangan::where('namaRuangan',$dokter->lokasiPraktik)->first();
        if ($ruangan->dayaTampung <= 0) {
            return redirect()->back()->withErrors(['idDokter' => 'Ruangan untuk dokter ini sudah penuh.']);
        }

        // Simpan data pasien
        PasienRecord::create([
            'nomorRekamMedis' => $request->nomorRekamMedis,
            'namaPasien' => $request->namaPasien,
            'tanggalLahir' => $request->tanggalLahir,
            'jenisKelamin' => $request->jenisKelamin,
            'alamatPasien' => $request->alamatPasien,
            'kotaPasien' => $request->kotaPasien,
            'usiaPasien' => $usiaPasien,
            'penyakitPasien' => $penyakitPasien,
            'idDokter' => $request->idDokter,
            'tanggalMasuk' => $request->tanggalMasuk,
            'tanggalKeluar' => $request->tanggalKeluar,
        ]);

        $ruangan->dayaTampung -= 1;
        $ruangan->save();

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail pasien.
     */
    public function show($id)
    {
        $pasien = PasienRecord::findOrFail($id);
        $ruangan = Ruangan::where('namaRuangan',$pasien->dokter->lokasiPraktik)->first();
        return view('pasien.show', compact('pasien', 'ruangan'));
    }

    /**
     * Menampilkan form edit pasien.
     */
    public function edit($id)
    {
        $pasien = PasienRecord::findOrFail($id);
        $dokters = Dokter::all();
        return view('pasien.edit', compact('pasien', 'dokters'));
    }

    /**
     * Memperbarui data pasien di database.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'nomorRekamMedis' => 'required|max:50|unique:pasien_records,nomorRekamMedis,' . $id,
        'namaPasien' => 'required|max:100',
        'tanggalLahir' => 'required|date',
        'jenisKelamin' => 'required|in:L,P',
        'alamatPasien' => 'required',
        'kotaPasien' => 'required|max:100',
        'idDokter' => 'required|exists:dokters,id',
        'tanggalMasuk' => 'required|date',
        'tanggalKeluar' => 'nullable|date|after_or_equal:tanggalMasuk',
    ]);

    $pasien = PasienRecord::findOrFail($id);
    $ruanganLama = Ruangan::where("namaRuangan",$pasien->dokter->namaRuangan)->first();
    $dokterBaru = Dokter::where('id',$request->idDokter)->first();
    $ruanganBaru = Ruangan::where("namaRuangan",$dokterBaru->lokasiPraktik)->first();

    // Hitung usia dari tanggal lahir
    $tanggalLahir = Carbon::parse($request->tanggalLahir);
    $usiaPasien = $tanggalLahir->age;

    // Ambil spesialisasi dokter untuk default penyakit
    $dokter = Dokter::findOrFail($request->idDokter);
    $words = explode(' ', $dokter->spesialisasi);
    $penyakitDefault = end($words);
    $penyakitPasien = $request->penyakitPasien ?? "Penyakit $penyakitDefault";

    // **Jika pasien pindah ruangan**
    if ($pasien->idRuangan != $request->idRuangan) {
        // **Cek apakah ruangan baru penuh**
        if ($ruanganBaru->dayaTampung <= 0) {
            return redirect()->back()->with('error', 'Ruangan baru sudah penuh!');
        }

        // **Tambahkan kapasitas ruangan lama**
        if ($ruanganLama) {
            $ruanganLama->dayaTampung += 1;
            $ruanganLama->save();
        }

        // **Kurangi kapasitas ruangan baru**
        $ruanganBaru->dayaTampung -= 1;
        $ruanganBaru->save();
    }

    // **Jika pasien keluar (tanggalKeluar diisi), daya tampung ruangan bertambah**
    if ($request->tanggalKeluar && !$pasien->tanggalKeluar) {
        $ruanganBaru->dayaTampung += 1;
        $ruanganBaru->save();
    }

    // **Update data pasien**
    $pasien->update([
        'nomorRekamMedis' => $request->nomorRekamMedis,
        'namaPasien' => $request->namaPasien,
        'tanggalLahir' => $request->tanggalLahir,
        'jenisKelamin' => $request->jenisKelamin,
        'alamatPasien' => $request->alamatPasien,
        'kotaPasien' => $request->kotaPasien,
        'usiaPasien' => $usiaPasien,
        'penyakitPasien' => $penyakitPasien,
        'idDokter' => $request->idDokter,
        'idRuangan' => $request->idRuangan,
        'tanggalMasuk' => $request->tanggalMasuk,
        'tanggalKeluar' => $request->tanggalKeluar,
    ]);

    return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui!');
}


    /**
     * Menghapus data pasien dari database.
     */
    public function destroy($id)
    {
        $pasien = PasienRecord::findOrFail($id);
        if($pasien->tanggalKeluar == null){
            $ruangan = Ruangan::where("namaRuangan",$pasien->dokter->lokasiPraktik)->first();
            $ruangan->dayaTampung += 1;
            $ruangan->save();
        }
        $pasien->delete();

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus!');
    }
}
