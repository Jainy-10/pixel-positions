<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ValidJobTitle implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $bannedWords = [
            'click here', 
            'earn money fast',
            'guaranteed',
            'sex', 
            'sexy'
        ];

        if (in_array(strtolower($value), $bannedWords)) {
            $fail("The Job title contains prohibited words");
        }
    }
}
