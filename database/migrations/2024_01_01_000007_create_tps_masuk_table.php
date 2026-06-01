<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tps_masuk', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->decimal('total_kg', 10, 2);
            $table->text('keterangan')->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->index('tanggal');
        });
    }
    public function down(): void { Schema::dropIfExists('tps_masuk'); }
};
