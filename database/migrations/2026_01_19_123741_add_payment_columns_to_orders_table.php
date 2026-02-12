<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // $table->string('payment_status')->nullable()->after('status')
            //       ->comment('paid, unpaid, pending');
            // $table->string('payment_method')->nullable()->after('payment_status')
            //       ->comment('cash, card, online');
            // $table->string('invoice_token')->nullable()->after('payment_method')
            //       ->comment('Unique invoice token for payment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_status', 'payment_method', 'invoice_token']);
        });
    }
};
