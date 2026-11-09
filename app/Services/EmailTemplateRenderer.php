<?php

namespace App\Services;

use App\Models\EmailTemplate;

class EmailTemplateRenderer
{
    /** @var array<string, list<string>> */
    private const ALLOWED_VARIABLES = [
        'contact_auto_reply' => ['nama', 'subjek', 'pesan'],
    ];

    /** @return array{subject: string, body: string} */
    public function render(string $key, array $data): array
    {
        $template = $this->templateFor($key);
        $variables = $this->allowedData($key, $data);

        return [
            'subject' => $this->replaceVariables($template['subject'], $variables, false),
            'body' => $this->replaceVariables($template['body'], $variables, true),
        ];
    }

    /** @return array{subject: string, body: string} */
    public function renderPlain(string $key, array $data): array
    {
        $template = $this->templateFor($key);
        $variables = $this->allowedData($key, $data);

        return [
            'subject' => $this->replaceVariables($template['subject'], $variables, false),
            'body' => $this->replaceVariables($this->htmlToText($template['body']), $variables, false),
        ];
    }

    /** @return array{subject: string, body: string} */
    public function renderPreview(string $subject, string $body, array $data): array
    {
        $variables = $this->allowedData('contact_auto_reply', $data);

        return [
            'subject' => $this->replaceVariables($subject, $variables, false),
            'body' => $this->replaceVariables($body, $variables, true),
        ];
    }

    public function htmlToText(string $html): string
    {
        $text = preg_replace('/<br\s*\/?\s*>/i', "\n", $html) ?? $html;
        $text = preg_replace('/<li\b[^>]*>/i', "\n- ", $text) ?? $text;
        $text = preg_replace('/<\/(?:p|div|h[1-6]|li|tr|blockquote)\s*>/i', "\n", $text) ?? $text;
        $text = strip_tags($text);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = preg_replace('/[\t ]+\n/', "\n", $text) ?? $text;
        $text = preg_replace('/\n[\t ]+/', "\n", $text) ?? $text;
        $text = preg_replace('/\n{3,}/', "\n\n", $text) ?? $text;

        return trim($text);
    }

    /** @return array{subject: string, body: string} */
    private function templateFor(string $key): array
    {
        $template = EmailTemplate::query()->where('key', $key)->first();

        if ($template) {
            return ['subject' => $template->subject, 'body' => $template->body];
        }

        if ($key === 'contact_auto_reply') {
            return [
                'subject' => 'Re: {{subjek}}',
                'body' => '<p>Yth. {{nama}},</p>'
                    .'<p>Terima kasih telah menghubungi CV Arindah terkait pesan Anda mengenai <strong>{{subjek}}</strong>.</p>'
                    .'<p>Pesan Anda telah kami terima dengan rincian sebagai berikut:</p>'
                    .'<p>Subjek: {{subjek}}<br>Pesan: {{pesan}}</p>'
                    .'<p>Tim CV Arindah akan meninjau pesan Anda dan menghubungi Anda kembali apabila diperlukan.</p>'
                    .'<p>Terima kasih atas perhatian dan kepercayaan Anda kepada CV Arindah.</p>'
                    .'<p>Salam,<br>Tim CV Arindah</p>',
            ];
        }

        return ['subject' => '', 'body' => ''];
    }

    /** @return array<string, string> */
    private function allowedData(string $key, array $data): array
    {
        $allowed = self::ALLOWED_VARIABLES[$key] ?? [];
        $values = [];

        foreach ($allowed as $name) {
            $values[$name] = (string) ($data[$name] ?? '');
        }

        return $values;
    }

    /** @param array<string, string> $variables */
    private function replaceVariables(string $content, array $variables, bool $escapeHtml): string
    {
        return preg_replace_callback('/{{\s*([a-zA-Z_][a-zA-Z0-9_]*)\s*}}/', function (array $matches) use ($variables, $escapeHtml): string {
            if (! array_key_exists($matches[1], $variables)) {
                return $matches[0];
            }

            $value = $variables[$matches[1]];

            if ($escapeHtml) {
                return nl2br(e($value), false);
            }

            return $value;
        }, $content) ?? $content;
    }
}
