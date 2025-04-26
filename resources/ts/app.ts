import Alpine from "alpinejs";
import "./bootstrap";
import "./carousel";

declare global {
    interface Window {
        Alpine: typeof Alpine;
    }
}

window.Alpine = Alpine;
Alpine.start();