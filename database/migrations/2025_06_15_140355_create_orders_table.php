<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('code');
            $table->text('snap_token')->nullable();
            $table->text('note')->nullable();
            $table->string('status');
            $table->string('pay_method');
            $table->integer('pay_total')->nullable();
            $table->string('pay_status')->nullable();
            $table->string('pay_cred')->nullable();
            $table->dateTime('payed_at')->nullable();
            $table->dateTime('processed_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
