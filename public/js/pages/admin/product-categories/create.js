// admin - product-categories - create: interaksi halaman ini.

document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('image');
    const container = document.getElementById('imagePreviewContainer');
    const preview = document.getElementById('imagePreview');
    const removeButton = document.getElementById('removeImage');

    if (!input || !container || !preview || !removeButton) return;

    let previewUrl = null;

    input.addEventListener('change', function () {
        const file = this.files && this.files[0];

        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }

        if (!file) {
            preview.removeAttribute('src');
            container.hidden = true;
            return;
        }

        if (!file.type.startsWith('image/')) {
            this.value = '';
            preview.removeAttribute('src');
            container.hidden = true;
            alert('Silakan pilih file gambar yang valid.');
            return;
        }

        previewUrl = URL.createObjectURL(file);
        preview.src = previewUrl;
        container.hidden = false;
    });

    removeButton.addEventListener('click', function () {
        input.value = '';
        preview.removeAttribute('src');
        container.hidden = true;

        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }
    });
});
