interface Lecturer {
    nama_pengguna: string;
    email: string;
    nip: string;
    nama: string;
}

interface User {
    nama_pengguna: string;
    email: string;
}

interface Modal {
    dosen: Lecturer;
    pengguna: User;
}

document.addEventListener("DOMContentLoaded", () => {
    const editButtons = document.querySelectorAll<HTMLAnchorElement>(".edit[data-id]");
    const editModal = document.querySelector<HTMLElement>(".modal-edit-dosen");
    const closeEditButton = editModal?.querySelector(".close");
    const editForm = editModal?.querySelector("form");

    const inputNamaPengguna = editForm?.querySelector<HTMLInputElement>("input[name='nama_pengguna']");
    const inputKataSandi = editForm?.querySelector<HTMLInputElement>("input[name='kata_sandi']");
    const inputEmail = editForm?.querySelector<HTMLInputElement>("input[name='email']");
    const inputNama = editForm?.querySelector<HTMLInputElement>("input[name='nama']");
    const inputNip = editForm?.querySelector<HTMLInputElement>("input[name='nip']");

    const fetchDosenData = async (id: string): Promise<Modal | null> => {
        try {
            const response = await fetch(`/admin/data-dosen/${id}/edit`, {
                headers: {
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                },
            });
            if (!response.ok) throw new Error("Gagal mengambil data dosen.");
            return (await response.json()) as Modal;
        } catch (error) {
            console.error(error);
            return null;
        }
    };

    editButtons.forEach((btn) => {
        btn.addEventListener("click", async () => {
            const id = btn.dataset.id;
            if (!id || !editModal || !editForm) return;

            const data = await fetchDosenData(id);
            if (!data) return;

            editModal.classList.remove("hidden");

            if(inputNamaPengguna) inputNamaPengguna.value = data.pengguna.nama_pengguna;
            if(inputKataSandi) inputKataSandi.value = ""; 
            if(inputEmail) inputEmail.value = data.pengguna.email;
            if(inputNama) inputNama.value = data.dosen.nama;
            if(inputNip) inputNip.value = data.dosen.nip;

            editForm.action = `/admin/data-dosen/${id}/update`;
        });
    });

    closeEditButton?.addEventListener("click", () => {
        editModal?.classList.add("hidden");
    });

    editModal?.addEventListener("click", (event) => {
        if (event.target === editModal) {
            editModal.classList.add("hidden");
        }
    });
});