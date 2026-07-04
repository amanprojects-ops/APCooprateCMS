// ── Mobile Navigation ─────────────────────────────────────────
const hamburger  = document.getElementById('hamburger');
const navMenu    = document.getElementById('nav-menu');
const navOverlay = document.getElementById('nav-overlay');
const navClose   = document.getElementById('nav-close');

function openNav() {
    navMenu.classList.add('active');
    navOverlay.classList.add('active');
    navOverlay.setAttribute('aria-hidden', 'false');
    hamburger.setAttribute('aria-expanded', 'true');
    hamburger.setAttribute('aria-label', 'Close navigation menu');
    hamburger.querySelector('i').classList.replace('fa-bars', 'fa-times');
    document.body.style.overflow = 'hidden'; // prevent background scroll
}

function closeNav() {
    navMenu.classList.remove('active');
    navOverlay.classList.remove('active');
    navOverlay.setAttribute('aria-hidden', 'true');
    hamburger.setAttribute('aria-expanded', 'false');
    hamburger.setAttribute('aria-label', 'Open navigation menu');
    hamburger.querySelector('i').classList.replace('fa-times', 'fa-bars');
    document.body.style.overflow = '';
}

hamburger.addEventListener('click', () =>
    navMenu.classList.contains('active') ? closeNav() : openNav()
);

// Close via overlay click
navOverlay.addEventListener('click', closeNav);

// Close via × button inside drawer
if (navClose) navClose.addEventListener('click', closeNav);

// Close when a nav link is clicked
document.querySelectorAll('.nav-link').forEach(link =>
    link.addEventListener('click', closeNav)
);

// Close on Escape key
document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && navMenu.classList.contains('active')) closeNav();
});

// Sticky Header Scroll Effect
const header = document.querySelector('.header');
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// FAQ Accordion
const faqItems = document.querySelectorAll('.faq-item');
faqItems.forEach(item => {
    const question = item.querySelector('.faq-question');
    question.addEventListener('click', () => {
        const isActive = item.classList.contains('active');

        // Close all other items
        faqItems.forEach(otherItem => {
            otherItem.classList.remove('active');
        });

        // Toggle current item
        if (!isActive) {
            item.classList.add('active');
        }
    });
});

// Reveal Animations on Scroll
const revealElements = document.querySelectorAll('section, .feature-card, .step-card, .service-card, .pricing-card, .testimonial-card');

const revealOnScroll = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('active');
            revealOnScroll.unobserve(entry.target);
        }
    });
}, {
    threshold: 0.15
});

revealElements.forEach(el => {
    el.classList.add('reveal');
    revealOnScroll.observe(el);
});

// Smooth Scroll for anchor links (fallback for browsers that don't support scroll-behavior: smooth)
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;

        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            const headerOffset = 80;
            const elementPosition = targetElement.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        }
    });
});
