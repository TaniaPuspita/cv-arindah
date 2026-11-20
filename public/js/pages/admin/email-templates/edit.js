// admin/email-templates/edit: interaksi editor dan pratinjau email.

const emailEditor = new Quill('#email-editor', {
        theme: 'snow',
        modules: {toolbar: '#editor-toolbar'},
        formats: ['bold', 'italic', 'underline', 'list', 'link']
    });
    const templateForm = document.getElementById('email-template-form');
    const emailBodyField = document.getElementById('body');
    const initialBody = templateForm.dataset.initialBody;
    emailEditor.clipboard.dangerouslyPasteHTML(initialBody, 'silent');
    const syncEmailBody = () => { emailBodyField.value = emailEditor.root.innerHTML; };
    emailEditor.on('text-change', syncEmailBody);
    syncEmailBody();

    document.querySelectorAll('.insert-variable').forEach((button) => {
        button.addEventListener('click', () => {
            const selection = emailEditor.getSelection(true);
            emailEditor.insertText(selection.index, '{' + '{' + button.dataset.variable + '}' + '}');
            emailEditor.setSelection(selection.index + button.dataset.variable.length + 4);
            syncEmailBody();
        });
    });

    document.getElementById('preview-button').addEventListener('click', async () => {
        const form = templateForm;
        syncEmailBody();
        const panel = document.getElementById('preview-panel');
        const error = document.getElementById('preview-error');
        error.textContent = '';
        panel.classList.remove('d-none');
        try {
            const response = await fetch(templateForm.dataset.previewUrl, {
                method: 'POST',
                headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': form.querySelector('[name=_token]').value, 'Accept': 'application/json'},
                body: JSON.stringify({name: form.elements.name.value, subject: form.elements.subject.value, body: form.elements.body.value})
            });
            const result = await response.json();
            if (!response.ok) throw new Error(Object.values(result.errors || {}).flat().join(' ' ) || 'Pratinjau gagal dibuat.');
            document.getElementById('preview-subject').textContent = `Subjek: ${result.subject}`;
            document.getElementById('preview-body').srcdoc = `<!doctype html><html><body style="font-family:Arial,sans-serif;line-height:1.6">${result.body}</body></html>`;
        } catch (exception) {
            error.textContent = exception.message;
        }
    });

    templateForm.addEventListener('submit', syncEmailBody);
