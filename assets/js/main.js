/**
 * Wisata Bahari — Main JavaScript
 * Vanilla JS — No Framework
 */

(function () {
    'use strict';

    // ==============================
    // LOADING SCREEN
    // ==============================
    const loader = document.getElementById('loader');
    window.addEventListener('load', function () {
        setTimeout(function () {
            loader.classList.add('hidden');
            // Trigger initial animations after load
            animateOnScroll();
            startCounters();
        }, 600);
    });

    // ==============================
    // NAVBAR — Scroll & Active State
    // ==============================
    const navbar = document.getElementById('navbar');
    const navLinks = document.querySelectorAll('.navbar__link');
    const mobileLinks = document.querySelectorAll('.navbar__mobile-link');
    const sections = document.querySelectorAll('section[id]');
    const backToTop = document.getElementById('backToTop');

    // Scroll handler: Sticky navbar + Active link + Back to top
    function handleScroll() {
        const scrollY = window.scrollY;

        // Navbar background change
        if (scrollY > 50) {
            navbar.classList.add('navbar--scrolled');
        } else {
            navbar.classList.remove('navbar--scrolled');
        }

        // Back to top visibility
        if (scrollY > 500) {
            backToTop.classList.add('visible');
        } else {
            backToTop.classList.remove('visible');
        }

        // Active section highlighting
        updateActiveNav(scrollY);
    }

    // Determine which section is currently in view
    function updateActiveNav(scrollY) {
        var currentSection = '';
        sections.forEach(function (section) {
            var sectionTop = section.offsetTop - 120;
            var sectionHeight = section.offsetHeight;
            if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                currentSection = section.getAttribute('id');
            }
        });

        // Update desktop links
        navLinks.forEach(function (link) {
            link.classList.remove('active');
            if (link.getAttribute('data-section') === currentSection) {
                link.classList.add('active');
            }
        });

        // Update mobile links
        mobileLinks.forEach(function (link) {
            link.classList.remove('active');
            if (link.getAttribute('data-section') === currentSection) {
                link.classList.add('active');
            }
        });
    }

    // Throttle scroll events for performance
    var scrollTimeout;
    window.addEventListener('scroll', function () {
        if (scrollTimeout) return;
        scrollTimeout = setTimeout(function () {
            handleScroll();
            animateOnScroll();
            scrollTimeout = null;
        }, 16); // ~60fps
    });

    // Back to top click
    backToTop.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // ==============================
    // HAMBURGER MENU
    // ==============================
    var hamburger = document.getElementById('hamburger');
    var mobileMenu = document.getElementById('mobileMenu');

    hamburger.addEventListener('click', function () {
        var isOpen = hamburger.classList.toggle('active');
        mobileMenu.classList.toggle('active');
        mobileMenu.setAttribute('aria-hidden', !isOpen);
        hamburger.setAttribute('aria-expanded', isOpen);
        document.body.style.overflow = isOpen ? 'hidden' : '';
    });

    // Close mobile menu when a link is clicked
    mobileMenu.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            hamburger.classList.remove('active');
            mobileMenu.classList.remove('active');
            mobileMenu.setAttribute('aria-hidden', 'true');
            hamburger.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        });
    });

    // ==============================
    // SMOOTH SCROLL (for all anchor links)
    // ==============================
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            var targetId = this.getAttribute('href');
            if (targetId === '#') return;
            var target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // ==============================
    // SCROLL ANIMATIONS
    // ==============================
    function animateOnScroll() {
        var animatedElements = document.querySelectorAll('[data-animate]');
        animatedElements.forEach(function (el) {
            if (el.classList.contains('animated')) return;

            var rect = el.getBoundingClientRect();
            var windowHeight = window.innerHeight;
            var threshold = windowHeight * 0.85;

            if (rect.top < threshold) {
                var delay = parseInt(el.getAttribute('data-delay') || '0', 10);
                setTimeout(function () {
                    el.classList.add('animated');
                }, delay);
            }
        });
    }

    // ==============================
    // COUNTER ANIMATION (Hero Stats)
    // ==============================
    var countersStarted = false;

    function startCounters() {
        if (countersStarted) return;
        countersStarted = true;

        var counters = document.querySelectorAll('.hero__stat-number[data-count]');
        counters.forEach(function (counter) {
            var target = parseInt(counter.getAttribute('data-count'), 10);
            var duration = 2000; // 2 seconds
            var start = 0;
            var startTime = null;

            function step(timestamp) {
                if (!startTime) startTime = timestamp;
                var progress = Math.min((timestamp - startTime) / duration, 1);
                // Easing: ease-out quad
                var eased = 1 - (1 - progress) * (1 - progress);
                counter.textContent = Math.floor(eased * target);

                if (progress < 1) {
                    requestAnimationFrame(step);
                } else {
                    counter.textContent = target;
                }
            }

            requestAnimationFrame(step);
        });
    }

    // ==============================
    // KALKULATOR HARGA
    // ==============================
    var kalkulatorForm = document.getElementById('kalkulatorForm');
    var pilihPaket = document.getElementById('pilihPaket');
    var jumlahOrang = document.getElementById('jumlahOrang');
    var btnMinus = document.getElementById('btnMinus');
    var btnPlus = document.getElementById('btnPlus');
    var kalkulatorResult = document.getElementById('kalkulatorResult');

    // Counter buttons
    btnMinus.addEventListener('click', function () {
        var val = parseInt(jumlahOrang.value, 10) || 1;
        if (val > 1) jumlahOrang.value = val - 1;
    });

    btnPlus.addEventListener('click', function () {
        var val = parseInt(jumlahOrang.value, 10) || 1;
        if (val < 500) jumlahOrang.value = val + 1;
    });

    // Validate number input
    jumlahOrang.addEventListener('change', function () {
        var val = parseInt(this.value, 10);
        if (isNaN(val) || val < 1) this.value = 1;
        if (val > 500) this.value = 500;
    });

    // Format Rupiah helper
    function formatRupiah(number) {
        return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    // Calculate price
    kalkulatorForm.addEventListener('submit', function (e) {
        e.preventDefault();

        var selectedOption = pilihPaket.options[pilihPaket.selectedIndex];
        if (!selectedOption || !selectedOption.value) {
            pilihPaket.focus();
            return;
        }

        var hargaPerOrang = parseInt(selectedOption.getAttribute('data-harga'), 10);
        var namaPaket = selectedOption.getAttribute('data-nama');
        var jumlah = parseInt(jumlahOrang.value, 10) || 1;
        var subtotal = hargaPerOrang * jumlah;
        var diskon = 0;
        var total = subtotal;

        // Diskon 10% untuk rombongan >= 20 orang
        var discountRow = document.getElementById('discountRow');
        if (jumlah >= 20) {
            diskon = Math.round(subtotal * 0.1);
            total = subtotal - diskon;
            document.getElementById('resultDiskon').textContent = '- ' + formatRupiah(diskon);
            discountRow.hidden = false;
        } else {
            discountRow.hidden = true;
        }

        // Populate results
        document.getElementById('resultPaket').textContent = namaPaket;
        document.getElementById('resultHargaOrang').textContent = formatRupiah(hargaPerOrang);
        document.getElementById('resultJumlah').textContent = jumlah + ' orang';
        document.getElementById('resultTotal').textContent = formatRupiah(total);

        // Show results
        kalkulatorResult.hidden = false;
        kalkulatorResult.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });

    // ==============================
    // ITINERARY TABS
    // ==============================
    // Main package tabs
    var mainTabs = document.querySelectorAll('.itinerary__tab');
    var mainPanels = document.querySelectorAll('.itinerary__panel');

    mainTabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            var target = this.getAttribute('data-tab');

            // Update tab states
            mainTabs.forEach(function (t) {
                t.classList.remove('itinerary__tab--active');
                t.setAttribute('aria-selected', 'false');
            });
            this.classList.add('itinerary__tab--active');
            this.setAttribute('aria-selected', 'true');

            // Update panel states
            mainPanels.forEach(function (panel) {
                panel.classList.remove('itinerary__panel--active');
                panel.hidden = true;
            });
            var targetPanel = document.getElementById('panel-' + target);
            if (targetPanel) {
                targetPanel.classList.add('itinerary__panel--active');
                targetPanel.hidden = false;

                // Reset day sub-tabs to first day
                var dayTabs = targetPanel.querySelectorAll('.itinerary__day-tab');
                var dayPanels = targetPanel.querySelectorAll('.itinerary__day-panel');
                dayTabs.forEach(function (dt, index) {
                    if (index === 0) {
                        dt.classList.add('itinerary__day-tab--active');
                        dt.setAttribute('aria-selected', 'true');
                    } else {
                        dt.classList.remove('itinerary__day-tab--active');
                        dt.setAttribute('aria-selected', 'false');
                    }
                });
                dayPanels.forEach(function (dp, index) {
                    if (index === 0) {
                        dp.classList.add('itinerary__day-panel--active');
                        dp.hidden = false;
                    } else {
                        dp.classList.remove('itinerary__day-panel--active');
                        dp.hidden = true;
                    }
                });
            }
        });
    });

    // Day sub-tabs (using event delegation)
    document.addEventListener('click', function (e) {
        var dayTab = e.target.closest('.itinerary__day-tab');
        if (!dayTab) return;

        var targetDay = dayTab.getAttribute('data-day');
        var parentPanel = dayTab.closest('.itinerary__panel');
        if (!parentPanel) return;

        // Update day tab states within parent
        parentPanel.querySelectorAll('.itinerary__day-tab').forEach(function (dt) {
            dt.classList.remove('itinerary__day-tab--active');
            dt.setAttribute('aria-selected', 'false');
        });
        dayTab.classList.add('itinerary__day-tab--active');
        dayTab.setAttribute('aria-selected', 'true');

        // Update day panels within parent
        parentPanel.querySelectorAll('.itinerary__day-panel').forEach(function (dp) {
            dp.classList.remove('itinerary__day-panel--active');
            dp.hidden = true;
        });
        var targetDayPanel = parentPanel.querySelector('[data-day-panel="' + targetDay + '"]');
        if (targetDayPanel) {
            targetDayPanel.classList.add('itinerary__day-panel--active');
            targetDayPanel.hidden = false;
        }
    });

    // ==============================
    // CONTACT FORM
    // ==============================
    var kontakForm = document.getElementById('kontakForm');
    kontakForm.addEventListener('submit', function (e) {
        e.preventDefault();

        // Simple client-side validation is already handled by 'required' attributes
        // Show success message
        var formWrap = kontakForm.parentElement;
        kontakForm.style.display = 'none';

        var successDiv = document.createElement('div');
        successDiv.className = 'kontak__success';
        successDiv.innerHTML =
            '<h3>✅ Pesan Berhasil Dikirim!</h3>' +
            '<p>Terima kasih! Tim kami akan menghubungi Anda dalam 1x24 jam.</p>';
        formWrap.appendChild(successDiv);

        // Reset form after 5 seconds
        setTimeout(function () {
            kontakForm.reset();
            kontakForm.style.display = '';
            if (successDiv.parentNode) {
                successDiv.parentNode.removeChild(successDiv);
            }
        }, 5000);
    });

    // ==============================
    // INITIAL STATE
    // ==============================
    handleScroll();

})();
