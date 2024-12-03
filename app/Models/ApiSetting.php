<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiSetting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function isApiEnabled(): bool
    {
        return (bool) static::where('key', 'api_enabled')->first()?->value ?? true;
    }
}
