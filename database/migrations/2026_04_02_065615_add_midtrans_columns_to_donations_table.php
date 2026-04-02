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
        Schema::table('donations', function (Blueprint $table) {
            $table->string('order_id')->nullable()->unique()->after('id');
            $table->string('snap_token')->nullable()->after('order_id');
            $table->string('payment_type')->nullable()->after('snap_token');
            $table->string('email')->nullable()->after('donator_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn(['order_id', 'snap_token', 'payment_type', 'email']);
        });
    }
};
