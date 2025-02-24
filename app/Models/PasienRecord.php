<?php

namespace App\Models;

use App\Models\Dokter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PasienRecord extends Model
{
    /** @use HasFactory<\Database\Factories\PasienRecordFactory> */
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function dokter(){
        return $this->belongsTo(Dokter::class, 'idDokter');
    }
}
