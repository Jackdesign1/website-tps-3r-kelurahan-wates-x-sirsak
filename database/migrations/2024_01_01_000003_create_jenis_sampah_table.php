<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jenis_sampah', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10)->unique();
            $table->string('nama');
            $table->string('warna', 7)->default('#16a34a');
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('jenis_sampah'); }
};
