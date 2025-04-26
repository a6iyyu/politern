import { gsap } from "gsap";

const Carousel = () => {
    const images: NodeListOf<HTMLElement> = document.querySelectorAll(".carousel-image");
    const indicators: NodeListOf<HTMLElement> = document.querySelectorAll(".carousel-indicator");
    let current_index: number = 0;
    let interval: NodeJS.Timeout | number;

    if (images.length === 0) return;

    const init = () => {
        gsap.set(images, { opacity: 0 });
        gsap.set(images[0], { opacity: 1 });

        indicators.forEach((indicator, index) => {
            const handler = () => go_to_slide(index);
            new Map().set(indicator, handler);
            indicator.addEventListener("click", handler);
        });

        start_auto_play();
    };

    const go_to_slide = (index: number) => {
        if (index === current_index) return;
        indicators[current_index].classList.remove("bg-white");
        indicators[index].classList.add("bg-white");
        gsap.to(images[current_index], { duration: 0.5, ease: "power2.inOut", opacity: 0 });
        gsap.to(images[index], { duration: 0.5, ease: "power2.inOut", opacity: 1 });
        current_index = index;
        reset_auto_play();
    };

    const start_auto_play = () => (interval = setInterval(() => go_to_slide((current_index + 1) % images.length), 5000));

    const reset_auto_play = () => {
        clearInterval(interval);
        start_auto_play();
    };

    const destroy = () => {
        clearInterval(interval);
        new Map().forEach((handler: () => void, indicator: HTMLElement) => indicator.removeEventListener("click", handler));
        new Map().clear();
    };

    init();
    return { destroy };
};

document.addEventListener("DOMContentLoaded", () => {
    const carousel = Carousel();
    window.addEventListener("pagehide", () => carousel!.destroy());
});