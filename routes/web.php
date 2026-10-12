<?php

use Illuminate\Support\Facades\Route;

//BERANDA
Route::get('/', function () {
    return view('home');
})->name('home');

//TENTANG KAMI 
Route::get('/tentang-kami', function () {
    return view('tentang');
})->name('tentang');

//PRODUK & LAYANAN
Route::get('/produk-layanan', function () {
    return view('produk');
})->name('produk');

//DETAIL PRODUK FURNITURE
//CARD 1 
Route::get('/produk/komputer', function () {
    return view('komputer');
})->name('produk.komputer');

//CARD 2
Route::get('/produk/elektronik-furniture', function () {
    return view('produk_elektronik_furniture');
})->name('produk.elektronik');

//CARD 3 
Route::get('/produk/perlengkapan_kantor', function () {
    return view('perlengkapan_kantor');
})->name('produk.perlengkapan_kantor');

//CARD4
Route::get('/produk/audio_video', function () {
    return view('audio_video');
})->name('produk.audio_video');

//CARD5
Route::get('/produk/laboratorium_kesehatan', function () {
    return view('laboratorium_kesehatan');
})->name('produk.laboratorium_kesehatan');

//CARD6
Route::get('/produk/kebutuhan_sehari_hari', function () {
    return view('kebutuhan_seharihari');
})->name('produk.kebutuhan_sehari_hari');

//GALERI
Route::get('/galeri', function () {
    return view('galeri');
})->name('galeri');

//HUBUNGI KAMI 
Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');