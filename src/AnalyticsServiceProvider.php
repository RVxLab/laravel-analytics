<?php

declare(strict_types=1);

namespace RVxLab\Analytics;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AnalyticsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfig();
    }

    public function boot(): void
    {
        $this->publishConfig();

        $this->loadMigrations();
        $this->publishMigrations();
    }

    private function generateMigrationFileName(string $fileName, Carbon $now): string
    {
        $timestamp = $now->format('Y_m_d_His');
        return database_path("migrations/{$timestamp}_{$fileName}");
    }

    private function mergeConfig(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php',
            'analytics',
        );
    }

    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    private function publishConfig(): void
    {
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('analytics.php'),
        ], 'analytics-config');
    }

    private function publishMigrations(): void
    {
        $now = Carbon::now();

        $migrationFilesPublishes = array_reduce(glob(__DIR__ . '/../database/migrations/*.php'), function (array $migrationFiles, string $migrationFile) use ($now): array {
            $migrationFileName = (string) pathinfo($migrationFile, PATHINFO_BASENAME);

            $migrationFiles[$migrationFile] = $this->generateMigrationFileName($migrationFileName, $now);

            return $migrationFiles;
        }, []);

        $this->publishes($migrationFilesPublishes, 'analytics-migrations');
    }
}
