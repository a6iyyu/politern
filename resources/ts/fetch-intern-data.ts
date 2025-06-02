import axios from "axios";

interface Intern {
    lowongan: {
        status: "AKTIF" | "TIDAK AKTIF" | string;
        judul: string;
        deskripsi: string;
        kuota: number;
        gaji: string;
        nilai_minimal: number | null;
        ipk: number | null;
        tanggal_mulai_pendaftaran: string;
        tanggal_selesai_pendaftaran: string;
        bidang: { nama_bidang: string };
        perusahaan_mitra: { nama: string; lokasi: { nama_lokasi: string } };
        jenis_lokasi: { nama_jenis_lokasi: string };
        periode_magang: { durasi: string };
        keahlian: { nama_keahlian: string };
    };
};

document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modal-detail-lowongan") as HTMLElement;
    if (!modal) return;

    const close = modal.querySelector(".close") as HTMLElement;
    if (!close) return;

    const fields = {
        status: document.getElementById("status") as HTMLElement,
        nama_bidang: document.getElementById("nama_bidang") as HTMLElement,
        nama: document.getElementById("nama") as HTMLElement,
        nama_lokasi: document.getElementById("nama_lokasi") as HTMLElement,
        nama_jenis_lokasi: document.getElementById("nama_jenis_lokasi") as HTMLElement,
        nama_keahlian: document.getElementById("nama_keahlian") as HTMLElement,
        durasi: document.getElementById("durasi") as HTMLElement,
        nilai_minimal: document.getElementById("nilai_minimal") as HTMLElement,
        gaji: document.getElementById("gaji") as HTMLElement,
        kuota: document.getElementById("kuota") as HTMLElement,
        tanggal_mulai_pendaftaran: document.getElementById("tanggal_mulai_pendaftaran") as HTMLElement,
        tanggal_selesai_pendaftaran: document.getElementById("tanggal_selesai_pendaftaran") as HTMLElement,
        deskripsi: document.getElementById("deskripsi") as HTMLElement,
    };

    document.querySelectorAll("a.detail[data-id]").forEach((button) => {
        button.addEventListener("click", async () => {
            const id = button.getAttribute("data-id");
            if (!id) return;

            try {
                const response = await axios.get<Intern>(`/admin/lowongan-magang/${id}/detail`);
                const data = response.data.lowongan;

                fields.status.textContent = data.status;
                fields.nama_bidang.textContent = data.bidang.nama_bidang;
                fields.nama.textContent = data.perusahaan_mitra.nama;
                fields.nama_lokasi.textContent = data.perusahaan_mitra.lokasi.nama_lokasi;
                fields.nama_jenis_lokasi.textContent = data.jenis_lokasi.nama_jenis_lokasi;
                fields.nama_keahlian.textContent = data.keahlian.nama_keahlian;
                fields.durasi.textContent = data.periode_magang.durasi;
                fields.nilai_minimal.textContent = data.ipk != null ? data.ipk.toString() : "-";
                fields.gaji.textContent = data.gaji;
                fields.kuota.textContent = data.kuota.toString();
                fields.tanggal_mulai_pendaftaran.textContent = new Date(data.tanggal_mulai_pendaftaran).toLocaleDateString();
                fields.tanggal_selesai_pendaftaran.textContent = new Date( data.tanggal_selesai_pendaftaran).toLocaleDateString();
                fields.deskripsi.textContent = data.deskripsi;

                modal.classList.remove("hidden");
                modal.classList.add("flex");
            } catch (err) {
                console.error("Error fetching detail:", err);
                fields.status.textContent = "Error fetching data";
                modal.classList.remove("hidden");
                modal.classList.add("flex");
            }
        });
    });

    close.addEventListener("click", () => {
        modal.classList.toggle("hidden");
        modal.classList.toggle("flex");
    });
});