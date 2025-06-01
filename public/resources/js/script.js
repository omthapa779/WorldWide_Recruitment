// Initialize Lenis
const lenis = new Lenis({
  autoRaf: true,
});

// Listen for the scroll event and log the event data
lenis.on('scroll', (e) => {
  console.log(e);
});

// sticky navbar
document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(ScrollTrigger);

    const navbar = document.getElementById("navbar");
    const hero = document.getElementById("hero");

    if (hero) {
        // Only run this if #hero section exists (welcome page)
        ScrollTrigger.create({
            trigger: hero,
            start: "bottom top",
            onEnter: () => navbar.classList.add("show"),
            onLeaveBack: () => navbar.classList.remove("show"),
        });
    } else {
        // Else, make navbar visible by default on other pages
        navbar.classList.add("show");
    }
});

// Admin Sidebar Toggle
document.addEventListener("DOMContentLoaded", () => {
    const menuToggle = document.getElementById('menuToggle');
    const adminSidebar = document.getElementById('adminSidebar');
    const body = document.body;

    if (menuToggle && adminSidebar) {
        // Toggle menu when clicking the button
        menuToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            adminSidebar.classList.toggle('show_sidebar');
            menuToggle.classList.toggle('active');
            body.classList.toggle('menu_open');
        });

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!adminSidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                adminSidebar.classList.remove('show_sidebar');
                menuToggle.classList.remove('active');
                body.classList.remove('menu_open');
            }
        });

        // Prevent clicks inside sidebar from closing it
        adminSidebar.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const newsHolder = document.querySelector('.news_holder');
    if (!newsHolder) return;

    let autoRotate = setInterval(rotateNews, 5000); // Rotate every 5 seconds

    function rotateNews() {
        const mainNews = newsHolder.querySelector('.main_news');
        const newsCards = Array.from(newsHolder.querySelectorAll('.news_card'));
        
        if (!mainNews || newsCards.length === 0) return;

        // Store main news content
        const mainNewsHTML = mainNews.outerHTML;
        
        // Move first news card to main news position
        mainNews.outerHTML = newsCards[0].outerHTML;
        
        // Shift other news cards up
        for (let i = 0; i < newsCards.length - 1; i++) {
            newsCards[i].outerHTML = newsCards[i + 1].outerHTML;
        }
        
        // Put main news as last card
        newsCards[newsCards.length - 1].outerHTML = mainNewsHTML;
    }

    // Pause rotation on hover
    newsHolder.addEventListener('mouseenter', () => clearInterval(autoRotate));
    newsHolder.addEventListener('mouseleave', () => autoRotate = setInterval(rotateNews, 5000));
});


document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu Toggle
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const body = document.body;

    menuToggle.addEventListener('click', () => {
        mobileMenu.classList.toggle('active');
        menuToggle.classList.toggle('active');
        body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
    });

    // Navbar Sticky Behavior
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

    // Counter Animation
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
                start: "top center+=100",
                toggleActions: "play none none reverse"
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('adminMenuToggle');
    const mobileMenu = document.getElementById('adminMobileMenu');
    const body = document.body;

    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            menuToggle.classList.toggle('active');
            body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
            
            // Toggle menu icon
            const icon = menuToggle.querySelector('i');
            icon.classList.toggle('ri-menu-3-line');
            icon.classList.toggle('ri-close-line');
        });

        // Close menu when clicking links
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