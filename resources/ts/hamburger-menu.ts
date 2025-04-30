/**
 * @description
 * This file contains frontend logic related to the hamburger menu.
 */

document.addEventListener("DOMContentLoaded", () => {
    const hamburger = document.querySelector("i[id='hamburger-menu']") as HTMLElement;
    const sidebar = document.querySelector("aside") as HTMLElement;

    if (!hamburger || !sidebar) return;
    let visible = false;

    const show = () => {
        sidebar.classList.remove("hidden");
        setTimeout(() => (sidebar.classList.add("translate-x-0"), sidebar.classList.remove("-translate-x-full")), 10);
        visible = true;
    };

    const hide = () => {
        sidebar.classList.add("-translate-x-full");
        sidebar.classList.remove("translate-x-0");
        setTimeout(() => !visible && sidebar.classList.add("hidden"), 300);
        visible = false;
    };

    hamburger.addEventListener("click", () => visible ? hide() : show());

    document.addEventListener("click", (e) => {
        if (visible && sidebar && !sidebar.contains(e.target as Node) && !hamburger.contains(e.target as Node)) hide();
    });
});