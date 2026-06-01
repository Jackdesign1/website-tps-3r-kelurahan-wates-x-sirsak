<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bank_sampah_mitra', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->string('ketua')->nullable();
            $table->text('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('bank_sampah_mitra'); }
};
