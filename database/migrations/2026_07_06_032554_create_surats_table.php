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
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')
                ->constrained('wargas')
                ->onDelete('cascade');
            $table->string('jenis_surat'); // pengantar, domisili, tidak mampu, dll
            $table->text('keperluan');
            $table->date('tanggal_pengajuan');
            $table->enum('status', ['diajukan', 'diproses', 'selesai'])
                ->default('diajukan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
