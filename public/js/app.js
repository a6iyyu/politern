import { Carousel } from "./carousel";
import "./bootstrap";

document.addEventListener("DOMContentLoaded", () => {
    const carousel = new Carousel();
    window.addEventListener("pagehide", () => carousel.destroy());
});