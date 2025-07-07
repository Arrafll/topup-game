<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('order_items', function (Blueprint $table) {
        $table->unsignedBigInteger('voucher_id')->nullable()->after('voucher_code');

        $table->foreign('voucher_id')->references('id')->on('vouchers')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('order_items', function (Blueprint $table) {
        $table->dropForeign(['voucher_id']);
        $table->dropColumn('voucher_id');
    });
}

};
