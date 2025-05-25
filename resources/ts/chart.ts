/**
 * @fileoverview
 * File ini berfungsi untuk memvisualisasikan beberapa model grafik
 * yang diambil dari data pada controller PHP.
 */

import { ArcElement, BarController, CategoryScale, Chart, DoughnutController, Legend, LinearScale, LineController, LineElement, PointElement, Title, Tooltip } from "chart.js";

interface BidangMagang {
    id_bidang: number;
    jumlah_bidang: number;
    nama_bidang: string;
    persentase: number;
}

interface Grafik {
    kategori_bidang_magang_terbanyak: BidangMagang[];
}

Chart.register(ArcElement, BarController, CategoryScale, DoughnutController, Legend, LinearScale, LineController, LineElement, PointElement, Title, Tooltip);

document.addEventListener("DOMContentLoaded", async () => {
    const kategori_bidang = document.getElementById("kategori-bidang-magang-terbanyak") as HTMLCanvasElement;
    const keterangan_kategori_bidang = document.getElementById("keterangan-kategori-bidang-magang-terbanyak") as HTMLLegendElement;
    const progres_magang_mingguan = document.getElementById("progres-magang-mingguan") as HTMLCanvasElement;
    if (!kategori_bidang || !keterangan_kategori_bidang || !progres_magang_mingguan) return;

    try {
        const response = await fetch("/admin/grafik", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement).getAttribute("content") as string,
            },
        });

        if (!response.ok) throw new Error(response.statusText);
        const data = await response.json() as Grafik;

        /**
         * Menampilkan data progres magang mingguan menggunakan grafik garis.
         * TODO: Mengambil data progres magang mingguan berdasarkan model
         * yang sesuai pada database. Kode dibawah hanyalah dummy saja,
         * agar mengetahui bentuk dari visualisasi grafik garis.
        */
        new Chart(progres_magang_mingguan, {
            type: "line",
            data: {
                labels: data.kategori_bidang_magang_terbanyak.map((item) => item.nama_bidang),
                datasets: [
                    {
                        label: "Jumlah",
                        data: data.kategori_bidang_magang_terbanyak.map((item) => item.jumlah_bidang),
                        backgroundColor: "rgba(85, 145, 178, 1)",
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    x: {
                        ticks: {
                            maxRotation: 90,
                            minRotation: 90,
                        },
                    },
                },
            },
        });

        /** Menampilkan data kategori magang terbanyak menggunakan grafik lingkaran. */
        new Chart(kategori_bidang, {
            type: "doughnut",
            data: {
                datasets: [
                    {
                        label: "Jumlah",
                        data: data.kategori_bidang_magang_terbanyak.map((item) => item.jumlah_bidang),
                        backgroundColor: [
                            "rgba(89, 85, 178, 1)",
                            "rgba(253, 232, 73, 1)",
                            "rgba(85, 145, 178, 1)",
                            "rgba(232, 107, 177, 1)",
                            "rgba(214, 214, 214, 1)",
                        ],
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
            },
        });

        keterangan_kategori_bidang.innerHTML = data.kategori_bidang_magang_terbanyak.map((item: BidangMagang, index: number) => {
            const colors = ["rgba(89, 85, 178, 1)", "rgba(253, 232, 73, 1)", "rgba(85, 145, 178, 1)", "rgba(232, 107, 177, 1)", "rgba(214, 214, 214, 1)"];
            const color = colors[index % colors.length];

            return `
                <section class="flex justify-between items-center py-2">
                    <div class="flex items-center gap-3">
                        <span class="w-4 h-4 rounded-full" style="background-color: ${color}"></span>
                        <h6>${item.nama_bidang}</h6>
                    </div>
                    <div class="flex items-center gap-3 text-right">
                        <h6>${item.jumlah_bidang}</h6>
                        <span class="w-0.5 h-4 bg-gray-300"></span>
                        <h6>${item.persentase}%</h6>
                    </div>
                </section>
            `;
        }).join("");
    } catch (error) {
        console.error(`Terjadi kesalahan saat memuat grafik: ${error}`);
        throw error;
    }
});