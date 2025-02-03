<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokters';
    protected $primaryKey = 'id';

    protected $fillable = [
        'idDokter','namaDokter','tanggalLahir','spesialisasi','lokasiPraktik','jamPraktik'
    ];
}
