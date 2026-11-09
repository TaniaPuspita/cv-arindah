@extends('admin.layouts.app')

@section('title', 'Edit Template Email | CV Arindah')
@section('page-title', 'Edit Template Email')

@section('content')
<div class="container-fluid px-0">
    <section class="dashboard-intro mb-4">
        <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>
        <div class="d-flex flex-wrap align-items-start justify-content-between gap-3">
            <div>
                <h1 class="page-title">Edit Template Email</h1>
                <p class="page-description">Gunakan variabel yang tersedia untuk mengisi data pesan secara otomatis.</p>
            </div>
        </div>
    </section>

    @if ($errors->any())
        <div class="alert alert-danger"><strong>Template belum dapat disimpan.</strong><ul class="mb-0 mt-2">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <form id="email-template-form" method="POST" action="{{ route('admin.email-templates.update', $emailTemplate) }}">
        @csrf
        @method('PUT')
        <div class="card border-0 shadow-sm"><div class="card-body p-4">
            <div class="mb-3">
                <label class="form-label" for="name">Nama template</label>
                <input class="form-control" id="name" name="name" value="{{ old('name', $emailTemplate->name) }}" required maxlength="150">
            </div>
            <div class="mb-4">
                <label class="form-label" for="subject">Subjek email</label>
                <input class="form-control" id="subject" name="subject" value="{{ old('subject', $emailTemplate->subject) }}" required maxlength="255">
                @error('subject')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="row g-4">
                <div class="col-12 col-xl-9">
                    <label class="form-label" for="body">Isi email</label>
                    <input type="hidden" id="body" name="body" value="">
                    <div id="editor-toolbar" class="border rounded-top p-2 bg-light">
                        <button class="ql-bold" type="button" aria-label="Tebal"></button>
                        <button class="ql-italic" type="button" aria-label="Miring"></button>
                        <button class="ql-underline" type="button" aria-label="Garis bawah"></button>
                        <button class="ql-list" value="ordered" type="button" aria-label="Daftar bernomor"></button>
                        <button class="ql-list" value="bullet" type="button" aria-label="Daftar poin"></button>
                        <button class="ql-link" type="button" aria-label="Tautan"></button>
                        <button class="ql-clean" type="button" aria-label="Hapus format"></button>
                    </div>
                    <div id="email-editor" class="bg-white border border-top-0" style="min-height: 340px;"></div>
                    @error('body')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <aside class="col-12 col-xl-3">
                    <div class="border rounded-3 p-3 h-100">
                        <h2 class="h6 fw-bold">Data otomatis dari pesan</h2>
                        <p class="small text-muted">Sisipkan data ke posisi kursor. Saat balasan disiapkan, placeholder akan diganti dengan data pengirim.</p>
                        <div class="d-grid gap-2">
                            @foreach (['nama' => 'nama pengirim', 'subjek' => 'subjek pesan', 'pesan' => 'isi pesan'] as $variable => $label)
                                <button type="button" class="btn btn-outline-primary btn-sm text-start insert-variable" data-variable="{{ $variable }}"><span>Sisipkan {{ $label }}</span> <code>&#123;&#123;{{ $variable }}&#125;&#125;</code></button>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>
            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-outline-secondary" id="preview-button" type="button">Pratinjau contoh</button>
            </div>
            <div class="cms-form-actions">
                <button type="submit" class="primary-button">
                    <i class="bi bi-floppy me-1"></i>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.email-templates.index') }}" class="secondary-button">
                    Batal
                </a>
            </div>
            <div id="preview-panel" class="border rounded-3 p-3 mt-4 d-none">
                <h2 class="h6 fw-bold">Pratinjau (data contoh)</h2>
                <div class="small text-muted mb-2" id="preview-subject"></div>
                <iframe id="preview-body" title="Pratinjau isi email" sandbox="" class="w-100 border rounded-2" style="min-height: 260px;"></iframe>
                <div id="preview-error" class="text-danger small mt-2"></div>
            </div>
        </div></div>
    </form>
</div>

<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script>
    const emailEditor = new Quill('#email-editor', {
        theme: 'snow',
        modules: {toolbar: '#editor-toolbar'},
        formats: ['bold', 'italic', 'underline', 'list', 'link']
    });
    const emailBodyField = document.getElementById('body');
    const initialBody = @json($editorBody);
    emailEditor.clipboard.dangerouslyPasteHTML(initialBody, 'silent');
    const syncEmailBody = () => { emailBodyField.value = emailEditor.root.innerHTML; };
    emailEditor.on('text-change', syncEmailBody);
    syncEmailBody();

    document.querySelectorAll('.insert-variable').forEach((button) => {
        button.addEventListener('click', () => {
            const selection = emailEditor.getSelection(true);
            emailEditor.insertText(selection.index, '{' + '{' + button.dataset.variable + '}' + '}');
            emailEditor.setSelection(selection.index + button.dataset.variable.length + 4);
            syncEmailBody();
        });
    });

    document.getElementById('preview-button').addEventListener('click', async () => {
        const form = document.getElementById('email-template-form');
        syncEmailBody();
        const panel = document.getElementById('preview-panel');
        const error = document.getElementById('preview-error');
        error.textContent = '';
        panel.classList.remove('d-none');
        try {
            const response = await fetch(@json(route('admin.email-templates.preview')), {
                method: 'POST',
                headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': form.querySelector('[name=_token]').value, 'Accept': 'application/json'},
                body: JSON.stringify({name: form.elements.name.value, subject: form.elements.subject.value, body: form.elements.body.value})
            });
            const result = await response.json();
            if (!response.ok) throw new Error(Object.values(result.errors || {}).flat().join(' ' ) || 'Pratinjau gagal dibuat.');
            document.getElementById('preview-subject').textContent = `Subjek: ${result.subject}`;
            document.getElementById('preview-body').srcdoc = `<!doctype html><html><body style="font-family:Arial,sans-serif;line-height:1.6">${result.body}</body></html>`;
        } catch (exception) {
            error.textContent = exception.message;
        }
    });

    document.getElementById('email-template-form').addEventListener('submit', syncEmailBody);
</script>
@endsection
