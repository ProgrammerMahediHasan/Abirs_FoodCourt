<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // $table->string('payment_status')->nullable()->after('status'); // paid / unpaid
            // $table->string('payment_method')->nullable()->after('payment_status'); // cash / card / online
            // $table->string('invoice_token')->nullable()->after('payment_method');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_status', 'payment_method', 'invoice_token']);
        });
    }
};
