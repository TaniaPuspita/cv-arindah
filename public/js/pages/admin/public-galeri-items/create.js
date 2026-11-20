// admin - public-galeri-items - create: interaksi halaman ini.

document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('image');
            const container = document.getElementById('galeri-preview-container');
            const preview = document.getElementById('galeri-preview-image');
            const fileName = document.getElementById('galeri-preview-name');

            if (!input || !container || !preview || !fileName) {
                return;
            }

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
                    fileName.textContent = '';
                    return;
                }

                objectUrl = URL.createObjectURL(file);
                preview.src = objectUrl;
                fileName.textContent = file.name;
                container.hidden = false;
            });
        });
