/**
 * @fileoverview
 * File ini berisi logika frontend terkait modal.
 */

interface Data {
    nama: string;
    program_studi: string;
    judul: string;
    deskripsi: string;
    status: "DISETUJUI" | "DITOLAK" | "MENUNGGU";
}

document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll<HTMLAnchorElement>("a[data-id]");
    const modal = document.getElementById("modal");
    const close = document.getElementById("tutup");
    if (!modal || !close) return;

    const nama = document.getElementById("nama");
    const prodi = document.getElementById("prodi");
    const judul = document.getElementById("judul");
    const deskripsi = document.getElementById("deskripsi");
    const status = document.getElementById("status_log_aktivitas");
    if (!nama || !prodi || !judul || !deskripsi || !status) return;

    buttons.forEach((button) => {
        button.addEventListener("click", async () => {
            const id = button.dataset.id;
            if (!id) return;

            try {
                const response = await fetch(`/dosen/log-aktivitas/${id}`, {
                    headers: {
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                    },
                });

                if (!response.ok) {
                    alert("Gagal memuat detail log aktivitas.");
                    return;
                }

                const data = await response.json() as Data;
                if (nama) nama.textContent = data.nama;
                if (prodi) prodi.textContent = data.program_studi;
                if (judul) judul.textContent = data.judul;
                if (deskripsi) deskripsi.textContent = data.deskripsi;
                if (status) status.textContent = data.status.toLowerCase().charAt(0).toUpperCase() + data.status.toLowerCase().slice(1);
                modal.classList.remove("hidden");
            } catch (error) {
                alert("Terjadi kesalahan saat memuat data.");
                console.error(error);
            }
        });
    });

    close.addEventListener("click", () => modal.classList.add("hidden"));

    modal.addEventListener("click", (event) => {
        if (event.target === modal) modal.classList.add("hidden");
    });
});