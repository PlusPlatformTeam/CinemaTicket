<?php

namespace App\Rules;

use App\Models\Cinema;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CinemaExists implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!Cinema::where('id', $value)->exists())
        {
            $fail('سینما مورد نظر یافت نشد');
        }
    }
}
