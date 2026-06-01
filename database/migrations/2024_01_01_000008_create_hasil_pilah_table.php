<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hasil_pilah', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('nama_sampah_id')->constrained('nama_sampah')->cascadeOnDelete();
            $table->decimal('berat_kg', 10, 2);
            $table->decimal('harga_per_kg', 12, 2);
            $table->decimal('total_harga', 14, 2);
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->index('tanggal');
            $table->index('nama_sampah_id');
        });
    }
    public function down(): void { Schema::dropIfExists('hasil_pilah'); }
};
