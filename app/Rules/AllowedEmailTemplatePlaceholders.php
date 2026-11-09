<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AllowedEmailTemplatePlaceholders implements ValidationRule
{
    /** @param list<string> $allowed */
    public function __construct(private readonly array $allowed = ['nama', 'subjek', 'pesan']) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        preg_match_all('/{{\s*([^{}]*?)\s*}}/', (string) $value, $matches);

        $placeholders = array_map('trim', $matches[1]);
        $unknown = array_values(array_diff(array_unique($placeholders), $this->allowed));

        if ($unknown !== []) {
            $fail('Placeholder tidak dikenal: '.implode(', ', array_map(
                fn (string $name): string => '{{'.$name.'}}',
                $unknown
            )).'. Variabel yang tersedia: {{nama}}, {{subjek}}, {{pesan}}.');
        }
    }
}
