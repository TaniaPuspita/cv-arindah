<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageSubmissionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'telepon' => ['nullable', 'string', 'max:30'],
            'subjek' => ['required', 'in:produk,layanan,kerjasama,lainnya'],
            'pesan' => ['required', 'string', 'max:5000'],
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'subjek.required' => 'Silakan pilih subjek pesan.',
            'subjek.in' => 'Pilihan subjek tidak valid.',
            'pesan.required' => 'Pesan wajib diisi.',
        ]);

        ContactMessage::create($validated);

        return redirect()
            ->route('kontak')
            ->with('success', 'Pesan berhasil dikirim. Terima kasih telah menghubungi CV Arindah!');
    }
}
