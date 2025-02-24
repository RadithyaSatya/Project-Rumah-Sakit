<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pasien_records', function (Blueprint $table) {
            $table->id();
            $table->string('nomorRekamMedis', 50)->unique();
            $table->string('namaPasien', 100);
            $table->date('tanggalLahir');
            $table->enum('jenisKelamin', ['L', 'P']);
            $table->text('alamatPasien');
            $table->string('kotaPasien', 100);
            $table->integer('usiaPasien');
            $table->string('penyakitPasien', 150)->nullable();
            $table->unsignedBigInteger('idDokter');
            $table->dateTime('tanggalMasuk');
            $table->dateTime('tanggalKeluar')->nullable();
            // $table->unsignedBigInteger('idRuangan');
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('idDokter')->references('id')->on('dokters')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('idRuangan')->references('id')->on('ruangans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien_records');
    }
};
