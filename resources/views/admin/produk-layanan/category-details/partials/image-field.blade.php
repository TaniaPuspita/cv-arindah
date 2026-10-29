
<div class="cms-form-group">
    <label for="{{ $field }}">{{ $label }}</label>

    @if ($currentImage)
        @php
            $imagePath = ltrim($currentImage, '/');

            if (\Illuminate\Support\Str::startsWith(
                $imagePath,
                ['http://', 'https://']
            )) {
                $currentImageUrl = $imagePath;
            } elseif (
                \Illuminate\Support\Str::startsWith(
                    $imagePath,
                    ['images/', 'storage/']
                )
            ) {
                $currentImageUrl = asset($imagePath);
            } else {
                $currentImageUrl = asset('storage/' . $imagePath);
            }
        @endphp

        <div class="current-image">
            <p><strong>Gambar yang tersimpan saat ini:</strong></p>

            <img
                src="{{ $currentImageUrl }}"
                alt="{{ $label }}"
                loading="eager"
                onerror="
                    this.style.display='none';
                    this.nextElementSibling.style.display='block';
                "
            >

            <p class="image-load-error">
                Gambar gagal dimuat. Pastikan file tersedia dan path-nya benar.
            </p>

            <small class="field-hint">
                Path gambar: {{ $currentImage }}
            </small>
        </div>
    @else
        <div class="current-image">
            <p>Belum ada gambar yang tersimpan.</p>
        </div>
    @endif

    <input
        type="file"
        id="{{ $field }}"
        name="{{ $field }}"
        class="cms-input cms-file"
        accept=".jpg,.jpeg,.png,.webp"
    >

    <small class="field-hint">
        Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
        Kosongkan jika tidak ingin mengganti gambar.
    </small>

    @error($field)
        <small class="field-error">{{ $message }}</small>
    @enderror
</div>
