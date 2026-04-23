document.addEventListener('DOMContentLoaded', function() {
    // ============================================================
    // HERO VIDEO
    // ============================================================

    const heroVideo = document.querySelector('.hero-video');
    const playBtn = document.querySelector('.hero-play-btn');
    const isMobile = window.matchMedia('(max-width: 768px)').matches;

    if (heroVideo) {
        heroVideo.muted = true;
        heroVideo.defaultMuted = true;
        heroVideo.volume = 0;
        heroVideo.playsInline = true;
        heroVideo.setAttribute('muted', '');
        heroVideo.setAttribute('playsinline', '');
        heroVideo.setAttribute('preload', 'auto');

        function attemptDesktopPlay() {
            const playPromise = heroVideo.play();

            if (playPromise !== undefined) {
                playPromise
                    .catch((err) => {
                        // Play failed silently - video may autoplay later
                    });
            }
        }

        if (isMobile) {
            if (playBtn) {
                playBtn.addEventListener('click', () => {
                    heroVideo.load();
                    heroVideo.classList.add('is-visible');

                    const playPromise = heroVideo.play();

                    if (playPromise !== undefined) {
                        playPromise
                            .then(() => {
                                playBtn.style.display = 'none';
                            })
                            .catch((err) => {
                                // Play failed silently
                            });
                    }
                });
            }
        } else {
            heroVideo.addEventListener('canplay', attemptDesktopPlay);
            heroVideo.addEventListener('loadeddata', attemptDesktopPlay);

            if (heroVideo.readyState >= 2) {
                attemptDesktopPlay();
            }

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        attemptDesktopPlay();
                    } else {
                        heroVideo.pause();
                    }
                });
            }, { threshold: 0.1 });

            observer.observe(heroVideo);
        }
    }

    // ============================================================
    // TESTIMONIALS CAROUSEL - INFINITE LOOP
    // ============================================================

    const carousel = document.querySelector('.testimonials-carousel');
    const track = document.querySelector('.testimonials-track');
    const dots = document.querySelectorAll('.testimonial-dot');
    const items = document.querySelectorAll('.testimonial-item');

    if (carousel && track && dots.length > 0) {

    const totalSlides = items.length;
    const clonesCount = 3;
    let currentIndex = 0;
    let autoScrollTimer = null;
    const autoScrollInterval = 5000;
    let isTransitioning = false;

    for (let i = 0; i < clonesCount; i++) {
        const clone = items[i].cloneNode(true);
        clone.setAttribute('aria-hidden', 'true');
        track.appendChild(clone);
    }

    const allItems = document.querySelectorAll('.testimonial-item');
    const totalSlidesWithClones = allItems.length;

    function goToSlide(index) {
        if (isTransitioning) return;

        currentIndex = index;
        isTransitioning = true;

        track.classList.remove('no-transition');

        const translateX = -(currentIndex * 100);
        track.style.transform = `translateX(${translateX}%)`;

        const realIndex = ((currentIndex % totalSlides) + totalSlides) % totalSlides;
        dots.forEach((dot, i) => {
            const isActive = i === realIndex;
            dot.classList.toggle('active', isActive);
            dot.setAttribute('aria-current', isActive ? 'true' : 'false');
        });
    }

    track.addEventListener('transitionend', (e) => {
        if (e.propertyName !== 'transform') return;

        if (currentIndex >= totalSlides) {
            track.classList.add('no-transition');
            currentIndex = currentIndex - totalSlides;
            track.style.transform = `translateX(${-(currentIndex * 100)}%)`;
        } else if (currentIndex < 0) {
            track.classList.add('no-transition');
            currentIndex = totalSlides + currentIndex;
            track.style.transform = `translateX(${-(currentIndex * 100)}%)`;
        }

        setTimeout(() => {
            track.classList.remove('no-transition');
            isTransitioning = false;
        }, 20);
    });

    function startAutoScroll() {
        if (autoScrollTimer) {
            clearInterval(autoScrollTimer);
        }
        autoScrollTimer = setInterval(() => {
            goToSlide(currentIndex + 1);
        }, autoScrollInterval);
    }

    function stopAutoScroll() {
        if (autoScrollTimer) {
            clearInterval(autoScrollTimer);
            autoScrollTimer = null;
        }
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            goToSlide(index);
            stopAutoScroll();
            startAutoScroll();
        });
    });

    carousel.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            e.preventDefault();
            goToSlide(currentIndex - 1);
            stopAutoScroll();
            startAutoScroll();
        } else if (e.key === 'ArrowRight') {
            e.preventDefault();
            goToSlide(currentIndex + 1);
            stopAutoScroll();
            startAutoScroll();
        }
    });

    carousel.addEventListener('mouseenter', stopAutoScroll);
    carousel.addEventListener('mouseleave', startAutoScroll);

    let touchStartX = 0;
    let touchEndX = 0;

    carousel.addEventListener('touchstart', (e) => {
        touchStartX = e.touches[0].clientX;
        stopAutoScroll();
    }, { passive: true });

    carousel.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].clientX;
        const diff = touchStartX - touchEndX;

        if (Math.abs(diff) > 50) {
            if (diff > 0) {
                goToSlide(currentIndex + 1);
            } else {
                goToSlide(currentIndex - 1);
            }
        }
        startAutoScroll();
    }, { passive: true });

    startAutoScroll();

    } // fine if testimonials

    // ============================================================
    // CURATED SELECTION - MOBILE CAROUSEL DOTS
    // ============================================================

    const curatedSection = document.querySelector('.curated-selection-section');
    const curatedProductsList = curatedSection ? curatedSection.querySelector('ul.products') : null;
    const curatedProducts = curatedProductsList ? curatedProductsList.querySelectorAll('li.product') : null;

    let dotsContainer = null;
    let dotObserver = null;

    function createCuratedDots() {
        if (window.innerWidth > 768) return;
        if (!curatedProductsList || !curatedProducts) return;

        dotsContainer = document.createElement('div');
        dotsContainer.className = 'curated-dots';
        dotsContainer.setAttribute('aria-label', 'Navigazione prodotti');

        const leftArrow = document.createElement('button');
        leftArrow.className = 'curated-dot curated-arrow-left';
        leftArrow.setAttribute('aria-label', 'Prodotto precedente');

        leftArrow.addEventListener('click', () => {
            const currentScroll = curatedProductsList.scrollLeft;
            const cardWidth = curatedProducts[0].offsetWidth;
            const newIndex = Math.max(0, Math.round(currentScroll / cardWidth) - 1);
            if (newIndex >= 0) {
                curatedProducts[newIndex].scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'start'
                });
            }
        });

        dotsContainer.appendChild(leftArrow);

        const rightArrow = document.createElement('button');
        rightArrow.className = 'curated-dot curated-arrow-right';
        rightArrow.setAttribute('aria-label', 'Prodotto successivo');

        rightArrow.addEventListener('click', () => {
            const currentScroll = curatedProductsList.scrollLeft;
            const cardWidth = curatedProducts[0].offsetWidth;
            const newIndex = Math.min(curatedProducts.length - 1, Math.round(currentScroll / cardWidth) + 1);
            if (newIndex < curatedProducts.length) {
                curatedProducts[newIndex].scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'start'
                });
            }
        });

        dotsContainer.appendChild(rightArrow);

        curatedProductsList.parentNode.insertBefore(dotsContainer, curatedProductsList.nextSibling);

        const observerOptions = {
            root: curatedProductsList,
            threshold: 0.5
        };

        dotObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const productIndex = Array.from(curatedProducts).indexOf(entry.target);
                    const leftArrow = dotsContainer.querySelector('.curated-arrow-left');
                    const rightArrow = dotsContainer.querySelector('.curated-arrow-right');

                    if (leftArrow) {
                        leftArrow.disabled = productIndex === 0;
                        leftArrow.classList.toggle('disabled', productIndex === 0);
                    }

                    if (rightArrow) {
                        rightArrow.disabled = productIndex === curatedProducts.length - 1;
                        rightArrow.classList.toggle('disabled', productIndex === curatedProducts.length - 1);
                    }
                }
            });
        }, observerOptions);

        curatedProducts.forEach(product => {
            dotObserver.observe(product);
        });
    }

    function removeCuratedDots() {
        if (dotsContainer && dotsContainer.parentNode) {
            dotsContainer.parentNode.removeChild(dotsContainer);
            dotsContainer = null;
        }
        if (dotObserver) {
            dotObserver.disconnect();
            dotObserver = null;
        }
    }

    if (!dotsContainer) {
        createCuratedDots();
    }

    const mq = window.matchMedia('(max-width: 768px)');
    mq.addEventListener('change', (e) => {
        if (!e.matches) {
            removeCuratedDots();
        } else if (!dotsContainer) {
            createCuratedDots();
        }
    });

    // ============================================================
    // EDITORIAL TICKER — Infinite Loop
    // ============================================================

    const ticker = document.querySelector('.ticker-track');

    if (ticker) {
        const tickerContent = ticker.innerHTML;
        ticker.innerHTML = tickerContent + tickerContent;

        const totalWidth = ticker.scrollWidth / 2;

        let position = 0;
        const speed = 0.5;

        function animateTicker() {
            position -= speed;
            if (Math.abs(position) >= totalWidth) {
                position = 0;
            }
            ticker.style.transform = `translateX(${position}px)`;
            requestAnimationFrame(animateTicker);
        }

        requestAnimationFrame(animateTicker);
    }
});