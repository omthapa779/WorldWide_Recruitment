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