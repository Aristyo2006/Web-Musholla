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
        Schema::table('campaigns', function (Blueprint $table) {
            $table->boolean('show_name')->default(true)->after('end_date');
            $table->boolean('show_email')->default(true)->after('show_name');
            $table->boolean('show_message')->default(true)->after('show_email');
            $table->boolean('show_address')->default(true)->after('show_message');
        });

        Schema::table('donations', function (Blueprint $table) {
            $table->string('donator_address')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn(['show_name', 'show_email', 'show_message', 'show_address']);
        });

        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn('donator_address');
        });
    }
};
