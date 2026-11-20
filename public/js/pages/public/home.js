// public - home: interaksi halaman ini.

document.addEventListener('DOMContentLoaded', function () {
    const viewport = document.getElementById('galeri-viewport');
    const track = document.getElementById('galeri-track');
    const prevBtn = document.getElementById('galeri-prev');
    const nextBtn = document.getElementById('galeri-next');
    const counter = document.getElementById('galeri-counter');
    const progress = document.getElementById('galeri-progress');

    if (!viewport || !track || !prevBtn || !nextBtn) return;

    const slides = Array.from(track.querySelectorAll('.galeri-slide'));
    if (!slides.length) return;


    let current = slides.length > 1 ? 1 : 0;
    let startX = 0;
    let dragging = false;
    let moved = 0;
    let baseX = 0;
    let resizeTimer;

    function centeredOffset(slide) {
        return slide.offsetLeft + slide.offsetWidth / 2 - track.clientWidth / 2;
    }

    function maxScroll() {
        return Math.max(0, centeredOffset(slides[slides.length - 1]));
    }

    function clampScroll(position) {
        return Math.max(0, Math.min(position, maxScroll()));
    }

    function getMaxIndex() {
        return slides.length - 1;
    }

    function update() {
        const maxIndex = getMaxIndex();
        current = Math.max(0, Math.min(current, maxIndex));

        const x = clampScroll(centeredOffset(slides[current]));
        track.style.transform = `translate3d(${-x}px, 0, 0)`;

        // Tentukan foto yang paling dekat dengan bagian tengah viewport.
        const center = x + track.clientWidth / 2;
        let active = 0;
        let best = Infinity;

        slides.forEach((slide, index) => {
            const distance = Math.abs(
                slide.offsetLeft + slide.offsetWidth / 2 - center
            );

            if (distance < best) {
                best = distance;
                active = index;
            }
        });

        slides.forEach((slide, index) => {
            slide.classList.toggle('is-active', index === active);
        });

        if (counter) {
            counter.textContent = `${active + 1} / ${slides.length}`;
        }

        if (progress) {
            progress.style.width = `${((active + 1) / slides.length) * 100}%`;
        }

        prevBtn.disabled = current === 0;
        nextBtn.disabled = current >= maxIndex;

        prevBtn.classList.toggle('opacity-40', prevBtn.disabled);
        nextBtn.classList.toggle('opacity-40', nextBtn.disabled);
        prevBtn.classList.toggle('cursor-not-allowed', prevBtn.disabled);
        nextBtn.classList.toggle('cursor-not-allowed', nextBtn.disabled);
    }

    function go(direction) {
        current += direction;
        update();
    }

    prevBtn.addEventListener('click', () => go(-1));
    nextBtn.addEventListener('click', () => go(1));

    // Geser foto dengan mouse atau sentuhan.
    viewport.addEventListener('pointerdown', function (event) {
        if (event.pointerType === 'mouse' && event.button !== 0) return;

        dragging = true;
        startX = event.clientX;
        moved = 0;
        baseX = clampScroll(centeredOffset(slides[current]));

        viewport.classList.add('is-dragging');

        if (viewport.setPointerCapture) {
            viewport.setPointerCapture(event.pointerId);
        }
    });

    viewport.addEventListener('pointermove', function (event) {
        if (!dragging) return;

        moved = event.clientX - startX;

        const nextPosition = Math.max(
            0,
            Math.min(baseX - moved, maxScroll())
        );

        track.style.transform = `translate3d(${-nextPosition}px, 0, 0)`;
    });

    function endDrag() {
        if (!dragging) return;

        dragging = false;
        viewport.classList.remove('is-dragging');

        if (moved < -50) {
            current += 1;
        } else if (moved > 50) {
            current -= 1;
        }

        update();
    }

    viewport.addEventListener('pointerup', endDrag);
    viewport.addEventListener('pointercancel', endDrag);

    // Navigasi keyboard.
    document.addEventListener('keydown', function (event) {
        const target = event.target;

        if (
            target &&
            ['INPUT', 'TEXTAREA', 'SELECT'].includes(target.tagName)
        ) {
            return;
        }

        if (event.key === 'ArrowLeft') go(-1);
        if (event.key === 'ArrowRight') go(1);
    });

    // Hitung ulang posisi slider saat ukuran layar berubah.
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(update, 120);
    });

    window.addEventListener('load', update);

    // Perbarui posisi setelah gambar selesai dimuat.
    slides.forEach(slide => {
        const img = slide.querySelector('img');

        if (img && !img.complete) {
            img.addEventListener('load', update, { once: true });
            img.addEventListener('error', update, { once: true });
        }
    });

    update();
});

// Animasi UX saat konten mulai terlihat di layar.
document.addEventListener('DOMContentLoaded', function () {
    const revealTargets = document.querySelectorAll(
        '#tentang > div, #produk > div > div, #produk .grid > div, ' +
        '#layanan > div > div, #kontak > div > div'
    );

    revealTargets.forEach(function (element, index) {
        element.classList.add('ux-reveal');
        element.style.setProperty('--ux-delay', `${(index % 4) * 80}ms`);
    });

    if (!('IntersectionObserver' in window)) {
        revealTargets.forEach(element => element.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver(function (entries, currentObserver) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                currentObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.12,
        rootMargin: '0px 0px -35px 0px'
    });

    revealTargets.forEach(element => observer.observe(element));
});
