<?php

namespace App\Models;

use Closure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Arr;
use Jlab\LaravelUtilities\BaseModel;

class Config extends BaseModel
{
    use HasFactory;

    public $fillable = ['yaml', 'comments'];

    public static $rules = [
        'yaml' => 'required',
        'comments' => '',
    ];

    /**
     * Retrieves a configuration value using dot notation.
     *
     *  ex: retrieve('mya.dates.begin')
     *
     * Returns null if key does not exist.
     *
     * @return mixed
     */
    public function retrieve($key)
    {
        $parsed = yaml_parse($this->yaml);

        return Arr::get($parsed, $key, null);
    }

    /**
     * Override dynamic validation rules.
     *
     * @return string[]
     */
    public function rules(): array
    {
        $rules = static::$rules;
        $rules['yaml'] = Arr::wrap($rules['yaml']);
        // Create a custom closure-based validation rule to sanity check that what is about to
        // be stored in the yaml column is plausibly valid.
        $rules['yaml'][] = function (string $attribute, mixed $value, Closure $fail) {
            $parsed = yaml_parse($value);
            if (! is_array($parsed)) {
                $fail("The {$attribute} formatting is not valid.");
            } else {
                foreach (['ced', 'nodes', 'mya', 'edges', 'output'] as $key) {
                    if (! array_key_exists($key, $parsed)) {
                        $fail("The {$attribute} lacks {$key} key.");
                    }
                }
            }
        };

        return $rules;
    }
}
