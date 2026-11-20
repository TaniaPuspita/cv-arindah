// admin - produk-layanan - category-details - edit: interaksi halaman ini.

document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.detail-content-tab');
    const panels = document.querySelectorAll('.detail-tab-panel');

    function activateTab(tab) {
        if (!tab) return;

        const targetId = tab.dataset.target;

        tabs.forEach(function (item) {
            const active = item === tab;

            item.classList.toggle('active', active);
            item.setAttribute('aria-selected', active ? 'true' : 'false');
            item.setAttribute('tabindex', active ? '0' : '-1');
        });

        panels.forEach(function (panel) {
            const active = panel.id === targetId;

            panel.classList.toggle('active', active);
            panel.hidden = !active;
        });
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            activateTab(tab);
        });

        tab.addEventListener('keydown', function (event) {
            if (!['ArrowLeft', 'ArrowRight'].includes(event.key)) return;

            event.preventDefault();

            const tabList = Array.from(tabs);
            const currentIndex = tabList.indexOf(tab);
            const direction = event.key === 'ArrowRight' ? 1 : -1;
            const nextIndex = (currentIndex + direction + tabList.length) % tabList.length;

            tabList[nextIndex].focus();
            activateTab(tabList[nextIndex]);
        });
    });

    // Buka tab yang berisi error validasi.
    const firstError = document.querySelector(
        '.field-error, .cms-alert-error'
    );

    if (firstError) {
        const panel = firstError.closest('.detail-tab-panel');

        if (panel) {
            const matchingTab = document.querySelector(
                '.detail-content-tab[data-target="' + panel.id + '"]'
            );

            if (matchingTab) {
                activateTab(matchingTab);
            }
        }
    }

    // Pemilih Bootstrap Icons.
    document.querySelectorAll('[data-icon-picker]').forEach(function (picker) {
        const fieldName = picker.dataset.iconPicker;
        const input = document.getElementById(fieldName);
        const options = picker.querySelectorAll('[data-icon-value]');
        const preview = picker.querySelector('[data-icon-preview]');
        const nameLabel = picker.querySelector('[data-icon-name]');

        if (!input || !preview || !nameLabel) return;

        function selectIcon(button) {
            const iconClass = button.dataset.iconValue;

            input.value = iconClass;
            preview.className = iconClass;
            nameLabel.textContent = iconClass;

            options.forEach(function (option) {
                const selected = option === button;

                option.classList.toggle('selected', selected);
                option.setAttribute('aria-pressed', selected ? 'true' : 'false');
            });
        }

        options.forEach(function (button) {
            button.addEventListener('click', function () {
                selectIcon(button);
            });
        });

        // Tetap tampilkan nilai yang sudah tersimpan.
        const currentOption = Array.from(options).find(function (button) {
            return button.dataset.iconValue === input.value;
        });

        if (currentOption) {
            selectIcon(currentOption);
        }
    });
});
