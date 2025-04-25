import { Carousel } from "./carousel";
import Alpine from "alpinejs";
import "./bootstrap";

window.Alpine = Alpine;
Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    const carousel = new Carousel();
    window.addEventListener("pagehide", () => carousel.destroy());
});