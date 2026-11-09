<?php

use App\Models\EmailTemplate;
use App\Services\EmailTemplateRenderer;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    EmailTemplate::create([
        'key' => 'contact_auto_reply',
        'name' => 'Balasan Pesan Kontak',
        'subject' => 'Re: {{ subjek }}',
        'body' => '<p>Yth. {{nama}}</p><p>{{pesan}}</p><p>{{tidak_dikenal}}</p>',
    ]);
});

it('renders known variables and escapes visitor values in HTML', function (): void {
    $result = app(EmailTemplateRenderer::class)->render('contact_auto_reply', [
        'nama' => '<img src=x onerror=alert(1)>',
        'subjek' => 'Bantuan',
        'pesan' => "Baris satu\nBaris dua",
    ]);

    expect($result['subject'])->toBe('Re: Bantuan')
        ->and($result['body'])->toContain('&lt;img src=x onerror=alert(1)&gt;')
        ->and($result['body'])->toContain("Baris satu<br>\nBaris dua")
        ->and($result['body'])->toContain('{{tidak_dikenal}}');
});

it('keeps unknown variables unchanged', function (): void {
    $result = app(EmailTemplateRenderer::class)->renderPlain('contact_auto_reply', [
        'nama' => 'Ayu',
        'subjek' => 'Informasi',
        'pesan' => 'Halo',
    ]);

    expect($result['body'])->toContain('{{tidak_dikenal}}');
});

it('converts template markup before inserting plain text visitor content', function (): void {
    $result = app(EmailTemplateRenderer::class)->renderPlain('contact_auto_reply', [
        'nama' => 'Ayu',
        'subjek' => 'Informasi',
        'pesan' => '<strong>teks pengunjung</strong>',
    ]);

    expect($result['body'])->toContain('<strong>teks pengunjung</strong>');
});
