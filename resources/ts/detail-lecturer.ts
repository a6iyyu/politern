interface Lecturer {
    nama_pengguna: string;
    email: string;
    nip: string;
    nama: string;
    nomor_telepon: string;
    jumlah_bimbingan: number;
}

interface Modal {
    dosen: Lecturer;
}

document.addEventListener("DOMContentLoaded", async () => {
    const data = await fetch(`/admin/data-dosen/1/detail`, {
        headers: {
            Accept: "application/json",
            "X-Requested-With": "XMLHttpRequest",
        },
    });

    if (!data.ok) {
        alert("Gagal memuat data dosen.");
        return;
    }

    const response = (await data.json()) as Modal;

    const usernameElement = document.getElementById("modal-username");
    const emailElement = document.getElementById("modal-email");
    const nipElement = document.getElementById("modal-nip");
    const namaElement = document.getElementById("modal-nama");
    const teleponElement = document.getElementById("modal-telepon");
    const bimbinganElement = document.getElementById("modal-bimbingan");

    if (usernameElement) usernameElement.textContent = response.dosen.nama_pengguna;
    if (emailElement) emailElement.textContent = response.dosen.email;
    if (nipElement) nipElement.textContent = response.dosen.nip;
    if (namaElement) namaElement.textContent = response.dosen.nama;
    if (teleponElement) teleponElement.textContent = response.dosen.nomor_telepon;
    if (bimbinganElement) bimbinganElement.textContent = response.dosen.jumlah_bimbingan.toString();

    const modalElement = document.querySelector<HTMLElement>(".modal-detail-dosen");
    if (modalElement) {
        modalElement.classList.remove("hidden");
    }
});
