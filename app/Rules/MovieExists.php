<?php

namespace App\Rules;

use App\Models\Movie;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MovieExists implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!Movie::where('id', $value)->exists())
        {
            $fail('فیلم مورد نظر یافت نشد');
        }
    }
}
