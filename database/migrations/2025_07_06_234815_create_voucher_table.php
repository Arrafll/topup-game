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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('packages_id');
            $table->string('redeem_code', 30);
            $table->boolean('is_used');
            $table->date('used_date');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->index('game_id');
            $table->index('packages_id');

            // Foreign keys bisa ditambahkan jika tabel game dan packages ada
            $table->foreign('game_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('packages_id')->references('id')->on('product_packages')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
