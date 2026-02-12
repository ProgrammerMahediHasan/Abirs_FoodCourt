<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');      // Restaurant name
            $table->string('email')->nullable();  // Optional email
            $table->string('phone')->nullable();  // Optional phone
            $table->text('address')->nullable();  // Optional address
            $table->tinyInteger('status')->default(1); // 1 = Active, 0 = Inactive
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
