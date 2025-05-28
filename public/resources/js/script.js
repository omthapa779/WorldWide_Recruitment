// Initialize Lenis
const lenis = new Lenis({
  autoRaf: true,
});

// Listen for the scroll event and log the event data
lenis.on('scroll', (e) => {
  console.log(e);
});

// sticky navbar
// document.addEventListener("DOMContentLoaded", () => {
//     gsap.registerPlugin(ScrollTrigger);

//     const navbar = document.getElementById("navbar");

//     ScrollTrigger.create({
//         trigger: "#hero",
//         start: "bottom top",
//         duration: 0.5,
//         onEnter: () => navbar.classList.add("show"),
//         onLeaveBack: () => navbar.classList.remove("show"),
//     });
// });

