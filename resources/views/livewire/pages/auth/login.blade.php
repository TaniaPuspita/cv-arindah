<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.guest');
form(LoginForm::class);

$login = function () {
    $this->validate();

    $this->form->authenticate();

    Session::regenerate();

    $this->redirectIntended(
        default: route('dashboard', absolute: false),
        navigate: true
    );
};

?>

<div class="login-card">

    {{-- PANEL KIRI --}}
    <section class="login-intro">

        <div class="brand">
            <a href="/" wire:navigate aria-label="Kembali ke website CV Arindah">
                <img
                    src="{{ asset('images/cv arindah.png') }}"
                    alt="Logo CV Arindah"
                    class="brand-logo"
                >
            </a>

            <div>
                <p class="brand-name">CV Arindah</p>
                <p class="brand-caption">OFFICIAL WEBSITE</p>
            </div>
        </div>

        <div class="admin-badge">
            <span></span>
            ADMINISTRATOR AREA
        </div>

        <h1 class="intro-title">
            Kelola Website<br>
            dengan <span>Lebih Mudah.</span>
        </h1>

        <p class="intro-description">
            Selamat datang di panel administrator CV Arindah.
            Masuk ke akun admin untuk mengelola informasi dan
            konten website perusahaan.
        </p>

        <div class="feature-list">

            <div class="feature-item">
                <span class="feature-check">✓</span>
                <span>Pengelolaan konten website</span>
            </div>

            <div class="feature-item">
                <span class="feature-check">✓</span>
                <span>Informasi perusahaan terorganisasi</span>
            </div>

            <div class="feature-item">
                <span class="feature-check">✓</span>
                <span>Akses administrasi dalam satu tempat</span>
            </div>

        </div>

    </section>


    {{-- PANEL KANAN --}}
    <section class="login-content">

        <p class="welcome-label">WELCOME BACK</p>

        <h2 class="login-title">Admin Login</h2>

        <p class="login-description">
            Masukkan email dan password untuk melanjutkan
            ke halaman administrator.
        </p>

        <form wire:submit="login" class="login-form">

            @if (session('status'))
                <div class="login-status" role="status">
                    {{ session('status') }}
                </div>
            @endif

            @if (
                $errors->has('form.email') ||
                $errors->has('form.password')
            )
                <div class="login-error" role="alert">
                    Email atau password tidak valid.
                    Silakan periksa kembali.
                </div>
            @endif

            {{-- EMAIL ADMIN --}}
            <div class="field-group">

                <label for="email" class="field-label">
                    Email Admin
                </label>

                <div class="input-wrap">

                    <span class="input-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8">
                            <rect x="3" y="5" width="18" height="14" rx="3"/>
                            <path d="m4 7 8 6 8-6"/>
                        </svg>
                    </span>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        wire:model="form.email"
                        placeholder="nama@email.com"
                        autocomplete="username"
                        required
                        autofocus
                    >

                </div>

                <x-input-error
                    :messages="$errors->get('form.email')"
                    class="mt-2"
                />

            </div>


            {{-- PASSWORD --}}
            <div class="field-group">

                <label for="password" class="field-label">
                    Password
                </label>

                <div class="input-wrap">

                    <span class="input-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8">
                            <rect x="5" y="10" width="14" height="11" rx="2"/>
                            <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
                            <path d="M12 14v3"/>
                        </svg>
                    </span>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        wire:model="form.password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >

                </div>

                <x-input-error
                    :messages="$errors->get('form.password')"
                    class="mt-2"
                />

            </div>


            {{-- INGAT SAYA --}}
            <label for="remember" class="remember-row">

                <input
                    id="remember"
                    type="checkbox"
                    name="remember"
                    wire:model="form.remember"
                >

                <span>Ingat saya</span>

            </label>


            {{-- TOMBOL LOGIN TANPA IKON PANAH --}}
            <button
                type="submit"
                class="login-button"
                wire:loading.attr="disabled"
                wire:target="login"
            >
                <span wire:loading.remove wire:target="login">
                    Masuk ke Dashboard
                </span>

                <span wire:loading wire:target="login">
                    Memproses...
                </span>
            </button>

        </form>


        {{-- KEMBALI KE WEBSITE --}}
        <a href="/" class="back-link" wire:navigate>
            Kembali ke <strong>Website CV Arindah</strong>
        </a>

    </section>

</div>
