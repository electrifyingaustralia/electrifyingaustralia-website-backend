<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingOption extends Model
{

    protected $guarded = [];

    public static function getValue(string $key, ?string $default = null): string | null
    {
        $option = self::where("option_key", $key)->first();

        if (!$option) return $default;

        return $option->option_value ?? $default;
    }

    public static function setValue(string $key, mixed $value = null): string | null
    {
        $option = self::where("option_key", $key)->first();

        if ($option) {
            $option->option_value = $value;
            $option->save();
            return $option;
        }

        return self::create([
            "option_key" => $key,
            "option_value" => $value,
        ]);
    }
}
