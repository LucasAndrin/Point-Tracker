<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    /** @use HasFactory<\Database\Factories\TenantFactory> */
    use HasDatabase, HasDomains, HasFactory;

    public function getIncrementing(): bool
    {
        return true;
    }

    public static function getCustomColumns(): array
    {
        return [
            'name',
        ];
    }
}
