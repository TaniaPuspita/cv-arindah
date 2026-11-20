// public - produk: interaksi halaman ini.

document.addEventListener('DOMContentLoaded', function () {

    const animatedItems = document.querySelectorAll(
        '#produk .arindah-product-card, ' +
        '#layanan .arindah-service-card, ' +
        '#layanan .arindah-service-image, ' +
        '#kontak .arindah-cta-card, ' +
        '#kontak .arindah-cta-image'
    );

    // Jeda animasi kartu produk
    document.querySelectorAll('#produk .arindah-product-card')
        .forEach((item, index) => {
            item.style.transitionDelay = `${index * 90}ms`;
        });

    // Jeda animasi kartu layanan
    document.querySelectorAll('#layanan .arindah-service-card')
        .forEach((item, index) => {
            item.style.transitionDelay = `${index * 100}ms`;
        });

    // Tampilkan elemen jika IntersectionObserver tidak tersedia
    if (!('IntersectionObserver' in window)) {
        animatedItems.forEach(item => {
            item.classList.add('is-visible');
        });

        return;
    }

    const observer = new IntersectionObserver(
        (entries, currentObserver) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    currentObserver.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.12,
            rootMargin: '0px 0px -35px 0px'
        }
    );

    animatedItems.forEach(item => {
        observer.observe(item);
    });

});
