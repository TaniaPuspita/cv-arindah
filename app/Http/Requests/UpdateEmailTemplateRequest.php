<?php

namespace App\Http\Requests;

use App\Rules\AllowedEmailTemplatePlaceholders;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmailTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /** @return array<string, array<int, mixed>> */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'subject' => ['required', 'string', 'max:255', new AllowedEmailTemplatePlaceholders],
            'body' => ['required', 'string', 'max:50000', new AllowedEmailTemplatePlaceholders],
        ];
    }
}
