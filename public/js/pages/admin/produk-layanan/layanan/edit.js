// admin - produk-layanan - layanan - edit: interaksi halaman ini.

document.addEventListener('DOMContentLoaded', function () {
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        const imageName = document.getElementById('image-name');

        if (!imageInput || !imagePreview || !imageName) {
            return;
        }

        imageInput.addEventListener('change', function () {
            const file = this.files && this.files[0];

            if (!file) {
                imageName.textContent = 'Belum ada gambar baru yang dipilih.';
                return;
            }

            imageName.textContent = 'Gambar dipilih: ' + file.name;

            if (!file.type.startsWith('image/')) {
                imageName.textContent = 'File harus berupa gambar.';
                return;
            }

            imagePreview.src = URL.createObjectURL(file);
        });
    });
