interface Pengajuan {
    id: number;
    status: string;
    catatan: string | null;
    bidang_posisi: string;
    nama_perusahaan_mitra: string;
    lokasi: string;
}

interface Mahasiswa {
    nim: string;
    nama_lengkap: string;
    program_studi: string;
    ipk: number;
    nomor_telepon: string;
    deskripsi: string;
}

interface ApiResponse {
    pengajuan: Pengajuan;
    mahasiswa: Mahasiswa;
}

document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll<HTMLAnchorElement>('.edit[data-id]');
    const modal = document.querySelector<HTMLElement>('.modal-edit-pengajuan');
    const closeButtons = document.querySelectorAll<HTMLElement>('.close-edit');
    const form = document.getElementById('editPengajuanForm') as HTMLFormElement | null;

    if (!modal || !form) return;

    // Open modal when edit button is clicked
    buttons.forEach((button: Element) => {
        button.addEventListener('click', async (e: Event) => {
            e.preventDefault();
            const id = button.getAttribute('data-id');
            if (!id) return;

            try {
                // Show loading state
                const submitBtn = form.querySelector<HTMLButtonElement>('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memuat...';
                }

                // Fetch pengajuan data
                const response = await fetch(`/admin/pengajuan-magang/${id}/edit`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) {
                    throw new Error('Gagal memuat data pengajuan');
                }

                const { pengajuan, mahasiswa } = await response.json() as ApiResponse;

                // Populate form
                const pengajuanIdInput = document.getElementById('editPengajuanId') as HTMLInputElement;
                const nimInput = document.getElementById('editNim') as HTMLInputElement;
                const namaInput = document.getElementById('editNama') as HTMLInputElement;
                const prodiInput = document.getElementById('editProdi') as HTMLInputElement;
                const ipkInput = document.getElementById('editIpk') as HTMLInputElement;
                const statusSelect = document.getElementById('editStatus') as HTMLSelectElement;
                const catatanTextarea = document.getElementById('editCatatan') as HTMLTextAreaElement;

                if (pengajuanIdInput) pengajuanIdInput.value = pengajuan.id.toString();
                if (nimInput) nimInput.value = mahasiswa.nim;
                if (namaInput) namaInput.value = mahasiswa.nama_lengkap;
                if (prodiInput) prodiInput.value = mahasiswa.program_studi;
                if (ipkInput) ipkInput.value = mahasiswa.ipk.toString();
                if (statusSelect) statusSelect.value = pengajuan.status;
                if (catatanTextarea) catatanTextarea.value = pengajuan.catatan || '';

                // Update form action
                form.action = `/admin/pengajuan-magang/${id}`;

                // Show modal
                modal.classList.remove('hidden');

            } catch (error) {
                console.error('Error:', error);
                alert(error instanceof Error ? error.message : 'Terjadi kesalahan saat memuat data');
            } finally {
                // Reset button state
                const submitBtn = form.querySelector<HTMLButtonElement>('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Simpan Perubahan';
                }
            }
        });
    });

    // Close modal
    closeButtons.forEach((button: Element) => {
        button.addEventListener('click', () => {
            if (modal) modal.classList.add('hidden');
        });
    });

    // Close when clicking outside modal
    modal.addEventListener('click', (e: Event) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });

    // Handle form submission
    form.addEventListener('submit', async (e: Event) => {
        e.preventDefault();
        
        if (!form.action) {
            console.error('Form action is not set');
            return;
        }

        const formData = new FormData(form);
        const submitBtn = form.querySelector<HTMLButtonElement>('button[type="submit"]');
        const csrfToken = document.querySelector<HTMLMetaElement>('meta[name="csrf-token"]')?.content;
        
        if (!csrfToken) {
            console.error('CSRF token not found');
            return;
        }

        try {
            // Show loading state
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
            }

            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                body: formData
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Terjadi kesalahan saat menyimpan data');
            }

            // Show success message
            alert('Data berhasil diperbarui');
            
            // Close modal and refresh page
            modal.classList.add('hidden');
            window.location.reload();

        } catch (error) {
            console.error('Error:', error);
            alert(error instanceof Error ? error.message : 'Terjadi kesalahan saat menyimpan data');
        } finally {
            // Reset button state
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Simpan Perubahan';
            }
        }
    });
});