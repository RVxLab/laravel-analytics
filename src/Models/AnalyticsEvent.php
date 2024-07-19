<?php

declare(strict_types=1);

namespace RVxLab\Analytics\Models;

use Illuminate\Database\Eloquent;

/**
 * @property string $type
 * @property array<array-key, mixed> $data
 * @property ?string $ip_address
 * @property ?string $user_agent
 */
class AnalyticsEvent extends Eloquent\Model
{
    use Eloquent\Concerns\HasUuids;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'data' => 'json',
    ];

    public function getConnectionName(): ?string
    {
        /** @var ?string */
        $connection = config('analytics.database.connection', parent::getConnectionName());

        return $connection;
    }

    public function getTable(): ?string
    {
        /** @var ?string */
        $table = config('analytics.database.table_names.analytics_events');

        return $table;
    }

    /** @return array{ data: 'json' } */
    protected function casts(): array
    {
        return $this->casts;
    }
}
