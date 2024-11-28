<?php

namespace Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use StringTemplate\Engine;

/**
 * Represent an entry of config in the database
 */
class Config extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
    ];

    protected $primaryKey = 'name';

    public $timestamps = false;

    /**
     * Get the float value of this config entry
     *
     * @param  string  $name  The name of the config entry
     */
    public static function number(string $name): float
    {
        return floatval(static::findOrFail($name)->value);
    }

    /**
     * Get the int value of this config entry
     *
     * @param  string  $name  The name of the config entry
     */
    public static function integer(string $name): int
    {
        return intval(static::findOrFail($name)->value);
    }

    /**
     * Get the string value of this config entry
     *
     * @param  string  $name  The name of the config entry
     * @param  array|string  $param  The data to use for the template
     */
    public static function format(string $name, $param): string
    {
        $engine = new Engine;

        return $engine->render(static::findOrFail($name)->value, $param);
    }
}
