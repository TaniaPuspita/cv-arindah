// admin - public-galeri-items - edit: interaksi halaman ini.

document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('image');
            const container = document.getElementById('galeri-new-preview');
            const preview = document.getElementById('galeri-new-image');

            if (!input || !container || !preview) return;

            let objectUrl = null;

            input.addEventListener('change', function () {
                if (objectUrl) {
                    URL.revokeObjectURL(objectUrl);
                    objectUrl = null;
                }

                const file = this.files && this.files[0];

                if (!file) {
                    container.hidden = true;
                    preview.removeAttribute('src');
                    return;
                }

                objectUrl = URL.createObjectURL(file);
                preview.src = objectUrl;
                container.hidden = false;
            });
        });
