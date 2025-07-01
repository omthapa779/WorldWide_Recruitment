// --- Lenis Smooth Scroll ---
const lenis = new Lenis({ autoRaf: true });
lenis.on('scroll', (e) => { console.log(e); });

// --- Sticky Navbar ---
document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(ScrollTrigger);
    const navbar = document.getElementById("navbar");
    const hero = document.getElementById("hero");
    if (hero) {
        ScrollTrigger.create({
            trigger: hero,
            start: "bottom top",
            onEnter: () => navbar.classList.add("show"),
            onLeaveBack: () => navbar.classList.remove("show"),
        });
    } else {
        navbar.classList.add("show");
    }
});

// --- Admin Sidebar Toggle ---
document.addEventListener("DOMContentLoaded", () => {
    const menuToggle = document.getElementById('menuToggle');
    const adminSidebar = document.getElementById('adminSidebar');
    const body = document.body;
    if (menuToggle && adminSidebar) {
        menuToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            adminSidebar.classList.toggle('show_sidebar');
            menuToggle.classList.toggle('active');
            body.classList.toggle('menu_open');
        });
        document.addEventListener('click', (e) => {
            if (!adminSidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                adminSidebar.classList.remove('show_sidebar');
                menuToggle.classList.remove('active');
                body.classList.remove('menu_open');
            }
        });
        adminSidebar.addEventListener('click', (e) => { e.stopPropagation(); });
    }
});

// --- News Auto-Rotate ---
document.addEventListener('DOMContentLoaded', function() {
    const newsHolder = document.querySelector('.news_holder');
    if (!newsHolder) return;
    let autoRotate = setInterval(rotateNews, 5000);
    function rotateNews() {
        const mainNews = newsHolder.querySelector('.main_news');
        const newsCards = Array.from(newsHolder.querySelectorAll('.news_card'));
        if (!mainNews || newsCards.length === 0) return;
        const mainNewsHTML = mainNews.outerHTML;
        mainNews.outerHTML = newsCards[0].outerHTML;
        for (let i = 0; i < newsCards.length - 1; i++) {
            newsCards[i].outerHTML = newsCards[i + 1].outerHTML;
        }
        newsCards[newsCards.length - 1].outerHTML = mainNewsHTML;
    }
    newsHolder.addEventListener('mouseenter', () => clearInterval(autoRotate));
    newsHolder.addEventListener('mouseleave', () => autoRotate = setInterval(rotateNews, 5000));
});

// --- Mobile Menu Toggle & Sticky Navbar on Home ---
document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const body = document.body;
    menuToggle.addEventListener('click', () => {
        mobileMenu.classList.toggle('active');
        menuToggle.classList.toggle('active');
        body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
    });
    const navbar = document.getElementById('navbar');
    const isHomePage = document.body.classList.contains('is_home');
    if (isHomePage) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > window.innerHeight * 0.9) {
                navbar.classList.add('visible');
            } else {
                navbar.classList.remove('visible');
            }
        });
    }
    // --- Counter Animation ---
    gsap.registerPlugin(ScrollTrigger);
    const counters = document.querySelectorAll('[data-count]');
    counters.forEach(counter => {
        const target = parseInt(counter.dataset.count);
        gsap.to(counter, {
            textContent: target,
            duration: 2,
            ease: "power1.out",
            snap: { textContent: 1 },
            scrollTrigger: {
                trigger: counter,
                start: "top bottom",
                toggleActions: "play none none reverse"
            }
        });
    });
});

// --- Hero Arrow Animation & Scroll ---
document.addEventListener('DOMContentLoaded', function() {
    // Animate the arrow icon up and down
    anime({
        targets: '.ri-arrow-down-s-line',
        translateY: [
            { value: 10, duration: 700 },
            { value: 0, duration: 700 }
        ],
        loop: true,
        easing: 'easeInOutSine',
        direction: 'alternate'
    });
    // Scroll 50vh down when h5 is clicked
    const scrollH5 = document.querySelector('.hero_section h5');
    if(scrollH5) {
        scrollH5.style.cursor = 'pointer';
        scrollH5.addEventListener('click', function() {
            window.scrollBy({ top: window.innerHeight * 1, left: 0, behavior: 'smooth' });
        });
    }
});

// --- Admin Mobile Menu Toggle ---
document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('adminMenuToggle');
    const mobileMenu = document.getElementById('adminMobileMenu');
    const body = document.body;
    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            menuToggle.classList.toggle('active');
            body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
            const icon = menuToggle.querySelector('i');
            icon.classList.toggle('ri-menu-3-line');
            icon.classList.toggle('ri-close-line');
        });
        const mobileLinks = document.querySelectorAll('.mobile_link');
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
                menuToggle.classList.remove('active');
                body.style.overflow = '';
                const icon = menuToggle.querySelector('i');
                icon.classList.add('ri-menu-3-line');
                icon.classList.remove('ri-close-line');
            });
        });
    }
});

// --- Service Card Hover Animations ---
document.addEventListener('DOMContentLoaded', () => {
    const serviceCards = document.querySelectorAll('.service_card');
    serviceCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            anime({
                targets: card.querySelector('.service_image'),
                scale: 1.1,
                duration: 800,
                easing: 'easeOutCubic'
            });
            anime({
                targets: card.querySelector('.service_icon'),
                opacity: [0, 1],
                translateY: [20, 0],
                duration: 600,
                easing: 'easeOutCubic'
            });
            anime({
                targets: card.querySelector('.service_text'),
                translateY: [-10, 0],
                duration: 600,
                easing: 'easeOutCubic'
            });
            anime({
                targets: card.querySelector('.overlay'),
                opacity: [0.8, 0.9],
                duration: 600,
                easing: 'easeOutCubic'
            });
        });
        card.addEventListener('mouseleave', () => {
            anime({
                targets: card.querySelector('.service_image'),
                scale: 1,
                duration: 800,
                easing: 'easeOutCubic'
            });
            anime({
                targets: card.querySelector('.service_icon'),
                opacity: 0,
                translateY: 20,
                duration: 600,
                easing: 'easeOutCubic'
            });
            anime({
                targets: card.querySelector('.service_text'),
                translateY: 0,
                duration: 600,
                easing: 'easeOutCubic'
            });
            anime({
                targets: card.querySelector('.overlay'),
                opacity: 0.8,
                duration: 600,
                easing: 'easeOutCubic'
            });
        });
    });
});