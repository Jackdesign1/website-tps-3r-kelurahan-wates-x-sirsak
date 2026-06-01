<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('info_tps', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kelurahan');
            $table->string('kota');
            $table->text('alamat');
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('jam_operasional')->nullable();
            $table->string('kepala_tps')->nullable();
            $table->text('deskripsi')->nullable();
            $table->year('berdiri_sejak')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('info_tps'); }
};
