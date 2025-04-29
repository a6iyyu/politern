/**
 * @description
 * This file contains frontend logic related to the form.
 */

document.addEventListener("DOMContentLoaded", () => {
    const eyes = document.querySelectorAll(".fa-eye, .fa-eye-slash") as NodeListOf<HTMLElement>;

    eyes.forEach((eye) => {
        eye.classList.add("fa-eye");
        eye.classList.remove("fa-eye-slash");

        eye.addEventListener("click", () => {
            const container = eye.closest("div");
            if (!container) return;

            const input = container.querySelector("input[type='password'], input[type='text']") as HTMLInputElement | null;
            if (!input) return;

            input.type = input.type === "password" ? "text" : "password";
            eye.classList.toggle("fa-eye", !(input.type === "password"));
            eye.classList.toggle("fa-eye-slash", input.type === "password");
        });
    });
});