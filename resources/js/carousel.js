import { gsap } from "gsap";

export class Carousel {
    constructor() {
        this.current_index = 0;
        this.images = document.querySelectorAll(".carousel-image");
        this.indicators = document.querySelectorAll(".carousel-indicator");
        this.total_slides = this.images.length;
        this.interval = null;
        this.duration = 0.5;
        this.auto_play_delay = 5;
        this.handlers = new Map();

        if (this.total_slides === 0) return;
        this.init();
    }

    init() {
        gsap.set(this.images, { opacity: 0 });
        gsap.set(this.images[0], { opacity: 1 });

        for (const [index, indicator] of this.indicators.entries()) {
            const handler = () => this.go_to_slide(index);
            this.handlers.set(indicator, handler); // Store the handler
            indicator.addEventListener("click", handler);
        }

        this.start_auto_play();
    }

    go_to_slide(index) {
        if (index === this.current_index) return;

        this.indicators[this.current_index].classList.remove("bg-white");
        this.indicators[index].classList.add("bg-white");

        gsap.to(this.images[this.current_index], {
            opacity: 0,
            duration: this.duration,
            ease: "power2.inOut",
        });

        gsap.to(this.images[index], {
            opacity: 1,
            duration: this.duration,
            ease: "power2.inOut",
        });

        this.current_index = index;
        this.reset_auto_play();
    }

    next_slide() {
        const nextIndex = (this.current_index + 1) % this.total_slides;
        this.go_to_slide(nextIndex);
    }

    start_auto_play() {
        this.interval = setInterval(() => this.next_slide(), this.auto_play_delay * 1000);
    }

    reset_auto_play() {
        clearInterval(this.interval);
        this.start_auto_play();
    }

    destroy() {
        clearInterval(this.interval);
        for (const [indicator, handler] of this.handlers.entries()) indicator.removeEventListener("click", handler);
        this.handlers.clear();
    }
}