// public - galeri: interaksi halaman ini.

document.addEventListener('DOMContentLoaded', function () {

    const $ = (id) => document.getElementById(id);

    const modal = $('galleryModal');
    const modalContent = $('galleryModalContent');
    const stage = $('galleryStage');
    const img = $('galleryModalImage');
    const backdrop = $('galleryModalBackdrop');
    const fitBtn = $('fitToggle');
    const thumbsEl = $('galleryThumbs');
    const titleEl = $('galleryModalTitle');
    const counterEl = $('galleryModalCounter');
    const zoomLabel = $('zoomReset');

    const allItems = Array.from(document.querySelectorAll('.gallery-item'));

    /* =====================================================
       FILTER KATEGORI
    ===================================================== */

    const filterBtns = Array.from(document.querySelectorAll('.filter-btn'));

    const ON = ['bg-[#0969D8]', 'text-white'];

    const OFF = [
        'bg-white',
        'text-[#4F6683]',
        'ring-1',
        'ring-[#DCE8F4]',
        'hover:bg-[#EAF4FF]'
    ];

    function setFilter(cat) {
        filterBtns.forEach(function (b) {
            const active = b.dataset.filter === cat;

            b.classList.remove(...ON, ...OFF);
            b.classList.add(...(active ? ON : OFF));
            b.setAttribute('aria-selected', active);
        });

        allItems.forEach(function (it) {
            it.classList.toggle(
                'hidden',
                !(cat === 'all' || it.dataset.cat === cat)
            );
        });
    }

    filterBtns.forEach(function (b) {
        b.addEventListener('click', function () {
            setFilter(b.dataset.filter);
        });
    });

    setFilter('all');

    const visibleItems = () =>
        allItems.filter((it) => !it.classList.contains('hidden'));


    /* =====================================================
       STATE LIGHTBOX DAN ZOOM
    ===================================================== */

    let list = [];
    let index = 0;
    let fill = true;

    const MIN = 1;
    const MAX = 4;
    const STEP = 0.5;

    let scale = 1;
    let posX = 0;
    let posY = 0;

    let dragging = false;
    let sx = 0;
    let sy = 0;
    let ox = 0;
    let oy = 0;
    let pinchDist = 0;
    let pinchScale = 1;

    const pointers = new Map();


    /* =====================================================
       ZOOM DAN POSISI GAMBAR
    ===================================================== */

    function clampPan() {
        const mx = stage.clientWidth * (scale - 1) / 2;
        const my = stage.clientHeight * (scale - 1) / 2;

        posX = Math.max(-mx, Math.min(mx, posX));
        posY = Math.max(-my, Math.min(my, posY));
    }

    function render(animate) {
        img.style.transition = animate ? 'transform .2s ease' : 'none';

        img.style.transform =
            `translate(${posX}px, ${posY}px) scale(${scale})`;

        zoomLabel.textContent = Math.round(scale * 100) + '%';

        stage.style.cursor = scale > 1
            ? (dragging ? 'grabbing' : 'grab')
            : 'zoom-in';
    }

    function setScale(v, animate = true) {
        scale = Math.max(MIN, Math.min(MAX, v));

        if (scale === 1) {
            posX = 0;
            posY = 0;
        }

        clampPan();
        render(animate);
    }

    function resetZoom() {
        scale = 1;
        posX = 0;
        posY = 0;

        render(false);
    }


    /* =====================================================
       MODE TAMPILAN GAMBAR
    ===================================================== */

    function setFill(v) {
        fill = v;

        img.classList.toggle('object-cover', fill);
        img.classList.toggle('object-contain', !fill);

        backdrop.classList.toggle('hidden', fill);

        fitBtn.textContent = fill ? 'Foto Utuh' : 'Isi Penuh';
    }

    fitBtn.addEventListener('click', function () {
        setFill(!fill);
    });


    /* =====================================================
       THUMBNAIL
    ===================================================== */

    function buildThumbs() {
        thumbsEl.innerHTML = '';

        list.forEach(function (it, i) {
            const b = document.createElement('button');

            b.type = 'button';
            b.setAttribute('aria-label', it.dataset.title);

            b.className =
                'h-12 w-16 shrink-0 overflow-hidden rounded-lg ring-2 ring-transparent transition duration-300 opacity-50 hover:opacity-100';

            const t = document.createElement('img');

            t.src = it.dataset.image;
            t.alt = '';
            t.className = 'h-full w-full object-cover';
            t.style.objectPosition = it.dataset.pos || 'center';

            b.appendChild(t);

            b.addEventListener('click', function () {
                index = i;
                show();
            });

            thumbsEl.appendChild(b);
        });
    }

    function markThumb() {
        Array.from(thumbsEl.children).forEach(function (b, i) {
            const on = i === index;

            b.classList.toggle('ring-white', on);
            b.classList.toggle('ring-transparent', !on);
            b.classList.toggle('opacity-100', on);
            b.classList.toggle('opacity-50', !on);

            if (on) {
                b.scrollIntoView({
                    block: 'nearest',
                    inline: 'center',
                    behavior: 'smooth'
                });
            }
        });
    }


    /* =====================================================
       MENAMPILKAN FOTO
    ===================================================== */

    function show() {
        const it = list[index];

        if (!it) return;

        resetZoom();

        img.src = it.dataset.image;
        backdrop.src = it.dataset.image;

        img.alt = it.dataset.title;
        img.style.objectPosition = it.dataset.pos || 'center';

        titleEl.textContent = it.dataset.title;
        counterEl.textContent = `${index + 1} / ${list.length}`;

        markThumb();
    }

    function open(item) {
        list = visibleItems();
        index = Math.max(0, list.indexOf(item));

        setFill(true);
        buildThumbs();
        show();

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        document.body.classList.add('overflow-hidden');

        requestAnimationFrame(function () {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        });
    }

    function close() {
        modal.classList.add('opacity-0');

        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');

        setTimeout(function () {
            modal.classList.add('hidden');
            modal.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');

            img.src = '';
            backdrop.src = '';

            resetZoom();
        }, 250);
    }

    const prev = () => {
        if (list.length) {
            index = (index - 1 + list.length) % list.length;
            show();
        }
    };

    const next = () => {
        if (list.length) {
            index = (index + 1) % list.length;
            show();
        }
    };


    /* =====================================================
       EVENT FOTO DAN TOMBOL
    ===================================================== */

    allItems.forEach(function (it) {
        it.addEventListener('click', function () {
            open(it);
        });
    });

    $('galleryClose').addEventListener('click', close);
    $('galleryPrev').addEventListener('click', prev);
    $('galleryNext').addEventListener('click', next);

    $('zoomIn').addEventListener('click', function () {
        setScale(scale + STEP);
    });

    $('zoomOut').addEventListener('click', function () {
        setScale(scale - STEP);
    });

    zoomLabel.addEventListener('click', function () {
        setScale(1);
    });

    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            close();
        }
    });


    /* =====================================================
       INTERAKSI ZOOM DENGAN MOUSE
    ===================================================== */

    stage.addEventListener('wheel', function (e) {
        e.preventDefault();

        setScale(
            scale + (e.deltaY < 0 ? STEP : -STEP),
            false
        );
    }, { passive: false });

    stage.addEventListener('dblclick', function () {
        setScale(scale > 1 ? 1 : 2.5);
    });


    /* =====================================================
       DRAG DAN PINCH ZOOM
    ===================================================== */

    stage.addEventListener('pointerdown', function (e) {
        stage.setPointerCapture(e.pointerId);

        pointers.set(e.pointerId, {
            x: e.clientX,
            y: e.clientY
        });

        if (pointers.size === 2) {
            const [a, b] = Array.from(pointers.values());

            pinchDist = Math.hypot(a.x - b.x, a.y - b.y);
            pinchScale = scale;

            dragging = false;

        } else if (scale > 1) {
            dragging = true;

            sx = e.clientX;
            sy = e.clientY;

            ox = posX;
            oy = posY;

            render(false);
        }
    });

    stage.addEventListener('pointermove', function (e) {
        if (!pointers.has(e.pointerId)) return;

        pointers.set(e.pointerId, {
            x: e.clientX,
            y: e.clientY
        });

        if (pointers.size === 2) {
            const [a, b] = Array.from(pointers.values());

            if (pinchDist) {
                setScale(
                    pinchScale *
                    Math.hypot(a.x - b.x, a.y - b.y) / pinchDist,
                    false
                );
            }

        } else if (dragging) {
            posX = ox + e.clientX - sx;
            posY = oy + e.clientY - sy;

            clampPan();
            render(false);
        }
    });

    function endPointer(e) {
        pointers.delete(e.pointerId);

        if (pointers.size < 2) {
            pinchDist = 0;
        }

        if (!pointers.size) {
            dragging = false;
            render(false);
        }
    }

    stage.addEventListener('pointerup', endPointer);
    stage.addEventListener('pointercancel', endPointer);


    /* =====================================================
       KEYBOARD NAVIGATION
    ===================================================== */

    document.addEventListener('keydown', function (e) {
        if (modal.classList.contains('hidden')) return;

        if (e.key === 'Escape') close();
        if (e.key === 'ArrowLeft') prev();
        if (e.key === 'ArrowRight') next();
        if (e.key === '+' || e.key === '=') setScale(scale + STEP);
        if (e.key === '-' || e.key === '_') setScale(scale - STEP);
        if (e.key === '0') setScale(1);
    });


    /* =====================================================
       SCROLL REVEAL
    ===================================================== */

    if ('IntersectionObserver' in window) {
        const io = new IntersectionObserver(function (entries) {
            entries.forEach(function (en) {
                if (en.isIntersecting) {
                    en.target.classList.remove('opacity-0', 'translate-y-5');
                    io.unobserve(en.target);
                }
            });
        }, { threshold: 0.01 });

        allItems.forEach(function (it) {
            if (it.getBoundingClientRect().top > window.innerHeight) {
                it.classList.add('opacity-0', 'translate-y-5');
                io.observe(it);
            }
        });

        setTimeout(function () {
            allItems.forEach(function (it) {
                it.classList.remove('opacity-0', 'translate-y-5');
            });
        }, 2500);
    }

});
