/**
 * @fileoverview
 * File ini menangani logika frontend terkait pengelolaan foto profil:
 * - Mendeteksi klik pada dokumen.
 * - Mengambil elemen gambar dengan class "profile-photo".
 * - Cocok untuk pengembangan fitur edit atau pratinjau foto profil.
 */

document.addEventListener("click", () => {
    const img = document.querySelector("img.profile-photo") as HTMLImageElement | null;
    if (!img) return;

    // TODO: Tambahkan logika edit atau menampilkan foto profil di sini
});