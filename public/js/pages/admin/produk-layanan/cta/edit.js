// admin - produk-layanan - cta - edit: interaksi halaman ini.

document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('image');
            const wrapper = document.getElementById('image-preview-wrapper');
            const preview = document.getElementById('image-preview');

            if (!input || !wrapper || !preview) {
                return;
            }

            let previousObjectUrl = null;

            input.addEventListener('change', function () {
                const file = this.files && this.files[0];

                if (previousObjectUrl) {
                    URL.revokeObjectURL(previousObjectUrl);
                    previousObjectUrl = null;
                }

                if (!file) {
                    preview.removeAttribute('src');
                    wrapper.hidden = true;
                    return;
                }

                if (!file.type.startsWith('image/')) {
                    this.value = '';
                    preview.removeAttribute('src');
                    wrapper.hidden = true;
                    return;
                }

                previousObjectUrl = URL.createObjectURL(file);
                preview.src = previousObjectUrl;
                wrapper.hidden = false;
            });
        });
