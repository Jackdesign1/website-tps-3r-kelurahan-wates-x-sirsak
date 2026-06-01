<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('nama_sampah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_sampah_id')->constrained('jenis_sampah')->cascadeOnDelete();
            $table->string('nama');
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('nama_sampah'); }
};
