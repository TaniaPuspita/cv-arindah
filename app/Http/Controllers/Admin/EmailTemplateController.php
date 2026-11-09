<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateEmailTemplateRequest;
use App\Models\EmailTemplate;
use App\Services\EmailTemplateHtmlSanitizer;
use App\Services\EmailTemplateRenderer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class EmailTemplateController extends Controller
{
    public function index(): View
    {
        $templates = EmailTemplate::query()->orderBy('name')->get();

        return view('admin.email-templates.index', compact('templates'));
    }

    public function edit(EmailTemplate $emailTemplate, EmailTemplateHtmlSanitizer $sanitizer): View
    {
        abort_unless($emailTemplate->key === 'contact_auto_reply', 404);

        return view('admin.email-templates.edit', [
            'emailTemplate' => $emailTemplate,
            'editorBody' => $sanitizer->sanitize(old('body', $emailTemplate->body)),
        ]);
    }

    public function update(
        UpdateEmailTemplateRequest $request,
        EmailTemplate $emailTemplate,
        EmailTemplateHtmlSanitizer $sanitizer
    ): RedirectResponse {
        abort_unless($emailTemplate->key === 'contact_auto_reply', 404);

        $emailTemplate->update([
            'name' => $request->validated('name'),
            'subject' => $request->validated('subject'),
            'body' => $sanitizer->sanitize($request->validated('body')),
        ]);

        return redirect()
            ->route('admin.email-templates.index')
            ->with('success', 'Template email berhasil diperbarui.');
    }

    public function preview(
        UpdateEmailTemplateRequest $request,
        EmailTemplateHtmlSanitizer $sanitizer,
        EmailTemplateRenderer $renderer
    ): JsonResponse {
        $preview = $renderer->renderPreview(
            $request->validated('subject'),
            $sanitizer->sanitize($request->validated('body')),
            [
                'nama' => 'Andi Contoh',
                'subjek' => 'Informasi layanan',
                'pesan' => "Saya ingin mengetahui informasi lebih lanjut.\nMohon dibantu.",
            ]
        );

        return response()->json($preview);
    }
}
