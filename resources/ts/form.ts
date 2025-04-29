/**
 * @description
 * This file contains frontend logic related to the form.
 */

document.addEventListener("DOMContentLoaded", () => {
    const eye = document.querySelector(".fa-eye, .fa-eye-slash") as HTMLElement;
    const eyeKonfirmasi = document.querySelector("#eye-konf") as HTMLElement;
    const password = document.querySelector("input[name='kata_sandi']") as HTMLInputElement;
    const konfirmasiKataSandi = document.querySelector("input[name='konfirmasi_kata_sandi']") as HTMLInputElement;

    if (!password || !eye || !konfirmasiKataSandi || !eyeKonfirmasi) return;

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

    eyeKonfirmasi.addEventListener("click", () => {
        konfirmasiKataSandi.type = konfirmasiKataSandi.type === "password" ? "text" : "password";
        eyeKonfirmasi.classList.toggle("fa-eye", konfirma   siKataSandi.type === "password");
        eyeKonfirmasi.classList.toggle("fa-eye-slash", konfirmasiKataSandi.type === "text");
    });
});