/**
 * @description
 * Entry point for Laravel frontend application JavaScript.
 * You can also use this file to import your custom JavaScript files.
 */

import Alpine from "alpinejs";
import "./bootstrap";
import "./form";

declare global {
    interface Window {
        Alpine: typeof Alpine;
    }
}

window.Alpine = Alpine;
Alpine.start();