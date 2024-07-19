<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create(config('analytics.database.table_names.analytics_events'), function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('type', 64);
            $table->jsonb('data');
            $table->text('user_agent')->null();
            $table->string('ip_address', 64)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('analytics.database.table_names.analytics_events'));
    }
};
