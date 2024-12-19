<?php

namespace App\Models;

use App\Traits\Relations\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use BelongsToUser;

    protected $fillable = [
        'user_id',
        'started_at',
        'stopped_at',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'timestamp',
            'stopped_at' => 'timestamp',
        ];
    }
}
