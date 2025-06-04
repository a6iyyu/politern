/**
 * @fileoverview
 * This script handles fetching and displaying lecturer details in a modal.
 * When the page loads, it fetches lecturer data from the server and updates
 * the modal content with the fetched information, making the modal visible.
 */

interface Student {
    nama_pengguna: string;
    email: string;
    nim: string;
    nama_lengkap: string;
    angkatan: string;
    semester: string;
    nama_prodi: string;
    ipk: string;
    status: string;
}

interface User {
    nama_pengguna: string;
    email: string;
}

interface Prodi {
    nama: string;
}

interface Status {
    status: string;
}

interface Modal {
    mahasiswa: Student;
    pengguna: User;
    prodi: Prodi;
    status: Status;
}

document.addEventListener("DOMContentLoaded", async () => {
    const buttons = document.querySelectorAll<HTMLAnchorElement>(".detail[data-id]");
    const modal = document.getElementById("modal-detail-mahasiswa");
    const close = document.getElementById("close-detail");
    if (!modal || !close) return;

    const nama_pengguna = document.getElementById("nama_pengguna");
    const email = document.getElementById("email");
    const nim = document.getElementById("nim");
    const nama_lengkap = document.getElementById("detail_nama_lengkap");
    const angkatan = document.getElementById("detail_angkatan");
    const semester = document.getElementById("detail_semester");
    const nama_prodi = document.getElementById("nama_prodi");
    const ipk = document.getElementById("ipk");
    const status = document.getElementById("detail_status");
    if (!nama_pengguna || !email || !nim || !nama_lengkap || !angkatan || !semester || !nama_prodi || !ipk || !status) return;

    buttons.forEach((button) => {
        button.addEventListener("click", async () => {
            const id = button.dataset.id;
            if (!id) return;
            modal.classList.remove("hidden");

            const data = await fetch(`/admin/data-mahasiswa/${id}/detail`, {
                headers: {
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                },
            });

            if (!data.ok) return;
            const response = (await data.json()) as Modal;
            console.log(response.mahasiswa.angkatan);
            console.log("Angkatan: ", response.mahasiswa.angkatan);
            console.log("Element:", angkatan);
            console.log("Angkatan innerText:", angkatan.innerText);

            nama_pengguna.textContent = response.pengguna.nama_pengguna;
            email.textContent = response.pengguna.email;
            nim.textContent = response.mahasiswa.nim;
            nama_lengkap.textContent = response.mahasiswa.nama_lengkap;
            angkatan.textContent = response.mahasiswa.angkatan;
            semester.textContent = response.mahasiswa.semester;
            nama_prodi.textContent = response.prodi.nama;
            ipk.textContent = response.mahasiswa.ipk;
            status.textContent = response.status.status;
        });
    });

    close.addEventListener("click", () => modal.classList.add("hidden"));

    modal.addEventListener("click", (event) => {
        if (event.target === modal) modal.classList.add("hidden");
    });
});