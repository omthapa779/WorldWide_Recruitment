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