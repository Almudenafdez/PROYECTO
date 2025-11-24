document.addEventListener("DOMContentLoaded", () => {
    const faders = document.querySelectorAll('.fade-in-up');

    const appearOnScroll = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.2 });

    faders.forEach(fader => {
        appearOnScroll.observe(fader);
    });
});

//INDEX RESERVA
document.addEventListener("DOMContentLoaded", function () {
    const benefits = document.querySelectorAll(".benefit");

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("animate");
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.2
    });

    benefits.forEach(b => observer.observe(b));
});
