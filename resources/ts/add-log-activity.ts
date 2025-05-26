/**
 * @fileoverview
 * Menambahkan event listener pada tombol "Tambah Log Aktivitas"
 * dan "Tutup" pada modal.
 *
 * @listens DomContentLoaded
 */
document.addEventListener("DOMContentLoaded", () => {
    const open = document.getElementById("open") as HTMLButtonElement;
    const modal = document.getElementById("modal") as HTMLDivElement;
    const close = document.getElementById("close") as HTMLButtonElement;
    if (!open || !modal || !close) return;

    open.addEventListener("click", () => modal.classList.remove("hidden"));
    close.addEventListener("click", () => modal.classList.add("hidden"));
});
