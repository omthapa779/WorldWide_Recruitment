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


