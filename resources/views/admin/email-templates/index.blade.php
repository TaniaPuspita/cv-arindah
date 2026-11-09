@extends('admin.layouts.app')

@section('title', 'Template Email | CV Arindah')
@section('page-title', 'Template Email')

@section('content')
<div class="container-fluid px-0">
    <section class="dashboard-intro mb-4">
        <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>
        <h1 class="page-title">Template Email</h1>
        <p class="page-description">Kelola isi balasan untuk pesan yang masuk melalui formulir kontak.</p>
    </section>

    <div class="table-responsive bg-white rounded-3 border">
        <table class="table align-middle mb-0">
            <thead><tr><th class="p-3">Nama Template</th><th>Subjek email</th><th class="text-end p-3">Aksi</th></tr></thead>
            <tbody>
                @forelse ($templates as $template)
                    <tr>
                        <td class="p-3 fw-semibold">{{ $template->name }}</td>

                        <td>{{ $template->subject }}</td>
                        <td class="text-end p-3"><a class="btn btn-primary btn-sm" href="{{ route('admin.email-templates.edit', $template) }}">Edit isi email</a></td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="p-4 text-center text-muted">Belum ada template email.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
