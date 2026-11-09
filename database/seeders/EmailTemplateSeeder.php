<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    public function run(): void
    {
        EmailTemplate::firstOrCreate(
            ['key' => 'contact_auto_reply'],
            [
                'name' => 'Balasan Pesan Kontak',
                'subject' => 'Re: {{subjek}}',
                'body' => <<<'HTML'
<p>Yth. {{nama}},</p>
<p>Terima kasih telah menghubungi CV Arindah terkait pesan Anda mengenai <strong>{{subjek}}</strong>.</p>
<p>Pesan Anda telah kami terima dengan rincian sebagai berikut:</p>
<p>Subjek: {{subjek}}<br>Pesan: {{pesan}}</p>
<p>Tim CV Arindah akan meninjau pesan Anda dan menghubungi Anda kembali apabila diperlukan.</p>
<p>Terima kasih atas perhatian dan kepercayaan Anda kepada CV Arindah.</p>
<p>Salam,<br>Tim CV Arindah</p>
HTML,
            ]
        );
    }
}
