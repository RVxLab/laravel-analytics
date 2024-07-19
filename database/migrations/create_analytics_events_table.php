<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create($this->getTableName(), function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('type', 64);
            $table->jsonb('data');
            $table->text('user_agent')->nullable();
            $table->string('ip_address', 64)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->getTableName());
    }

    private function getTableName(): string
    {
        $table = config('analytics.database.table_names.analytics_events');

        assert(is_string($table));

        return $table;
    }
};
