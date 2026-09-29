<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('confirmation_token_expires_at')->nullable()->after('confirmation_token');
        });

        DB::table('users')
            ->whereNotNull('confirmation_token')
            ->update(['confirmation_token_expires_at' => now()->addDay()]);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('confirmation_token_expires_at');
        });
    }
};