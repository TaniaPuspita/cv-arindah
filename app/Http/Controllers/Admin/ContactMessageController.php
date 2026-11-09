<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Services\EmailTemplateRenderer;
use Illuminate\Support\Str;

class ContactMessageController extends Controller
{
    /**
     * Menampilkan daftar pesan masuk di CMS.
     */
    public function index()
    {
        $messages = ContactMessage::query()
            ->latest('created_at')
            ->latest('id')
            ->paginate(10);

        $unreadCount = ContactMessage::query()
            ->where('is_read', false)
            ->count();

        return view('admin.contact-messages.index', [
            'messages' => $messages,
            'unreadCount' => $unreadCount,
        ]);
    }

    /**
     * Menampilkan detail pesan dan menandainya sudah dibaca.
     */
    public function show(ContactMessage $contactMessage, EmailTemplateRenderer $renderer)
    {
        if (! $contactMessage->is_read) {
            $contactMessage->update([
                'is_read' => true,
            ]);
        }

        $reply = $renderer->renderPlain('contact_auto_reply', [
            'nama' => $contactMessage->nama,
            'subjek' => ucfirst($contactMessage->subjek),
            'pesan' => Str::limit($contactMessage->pesan, 500),
        ]);
        $gmailUrl = 'https://mail.google.com/mail/?view=cm&fs=1'
            .'&to='.rawurlencode($contactMessage->email)
            .'&su='.rawurlencode($reply['subject'])
            .'&body='.rawurlencode($reply['body']);

        return view('admin.contact-messages.show', [
            'contactMessage' => $contactMessage,
            'gmailUrl' => $gmailUrl,
        ]);
    }

    /**
     * Menandai pesan sebagai belum dibaca.
     */
    public function markUnread(ContactMessage $contactMessage)
    {
        $contactMessage->update([
            'is_read' => false,
        ]);

        return redirect()
            ->route('admin.contact-messages.index')
            ->with('success', 'Pesan ditandai belum dibaca.');
    }

    /**
     * Menghapus pesan masuk.
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()
            ->route('admin.contact-messages.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}
