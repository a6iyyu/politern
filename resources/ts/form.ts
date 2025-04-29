/**
 * @description
 * This file contains frontend logic related to the form.
 */

document.addEventListener("DOMContentLoaded", () => {
    const eye = document.querySelector(".fa-eye, .fa-eye-slash") as HTMLElement;
    const password = document.querySelector("input[name='kata_sandi']") as HTMLInputElement;

    if (!password || !eye) return;

    if (password.type === "password") {
        eye.classList.add("fa-eye");
        eye.classList.remove("fa-eye-slash");
    } else {
        eye.classList.add("fa-eye-slash");
        eye.classList.remove("fa-eye");
    }

    eye.addEventListener("click", () => {
        password.type = password.type === "password" ? "text" : "password";
        eye.classList.toggle("fa-eye", password.type === "password");
        eye.classList.toggle("fa-eye-slash", password.type === "text");
    });
});