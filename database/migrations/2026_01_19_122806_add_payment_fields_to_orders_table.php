<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        // $table->string('payment_status')->nullable()->after('status');
        // $table->string('payment_method')->nullable()->after('payment_status');
        // $table->string('invoice_token')->nullable()->after('payment_method');
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn(['payment_status', 'payment_method', 'invoice_token']);
    });
}

};
