interface Lecturer {
    username: string;
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
    console.log(response.dosen.nama);
});