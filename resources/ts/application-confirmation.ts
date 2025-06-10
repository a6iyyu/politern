interface PengajuanData {
    pengajuan: {
        bidang_posisi: string;
        nama_perusahaan_mitra: string;
        lokasi: string;
    };
    mahasiswa: {
        nim: string;
        nama_lengkap: string;
    };
}

document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll<HTMLAnchorElement>('.konfirmasi[data-id]');
    const modal = document.querySelector<HTMLElement>('.modal-konfirmasi');
    if (!buttons || !modal) return;
    
    const close = modal.querySelector<HTMLElement>('.close-konfirmasi');
    const form = modal.querySelector<HTMLFormElement>('.konfirmasiForm');
    const dosen_pembimbing = form?.querySelector<HTMLSelectElement>("select[name='dosen_pembimbing']");
    const terimaBtn = form?.querySelector<HTMLButtonElement>("button#terimaBtn");
    const tolakBtn = form?.querySelector<HTMLButtonElement>("button#tolakBtn");
    const nim = document.getElementById('nim_konfirmasi'); 
    const nama_lengkap = document.getElementById('nama_lengkap_konfirmasi');
    const posisi = document.getElementById('posisi_konfirmasi');
    const nama_perusahaan = document.getElementById('nama_perusahaan_konfirmasi');
    const lokasi = document.getElementById('lokasi_konfirmasi');

    if (!close || !form || !dosen_pembimbing || !terimaBtn || !tolakBtn || !nim || !nama_lengkap || !posisi || !nama_perusahaan || !lokasi) return;

    terimaBtn.addEventListener('click', async (e) => {
        e.preventDefault();
        await handleFormSubmission('DISETUJUI');
    });
    
    tolakBtn.addEventListener('click', async (e) => {
        e.preventDefault();
        await handleFormSubmission('DITOLAK');
    });
    
    // Add this new function to handle form submission
    const handleFormSubmission = async (status: string) => {
        const statusInput = form.querySelector<HTMLInputElement>('input[name="status"]');
        if (!statusInput) return;
    
        statusInput.value = status;
        const formData = new FormData(form);
    
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                body: formData
            });
    
            const result = await response.json();
    
            if (!response.ok) {
                throw new Error(result.message || 'Terjadi kesalahan saat memproses data');
            }
    
            // Show success message and redirect to main page
            alert('Data berhasil disimpan');
            window.location.href = '/admin/pengajuan-magang'; // Adjust this URL to your main page
    
        } catch (error) {
            console.error('Error:', error);
            alert(error instanceof Error ? error.message : 'Terjadi kesalahan saat menyimpan data');
        }
    };

    close.addEventListener('click', () => modal.classList.add('hidden'));
    modal.addEventListener('click', event => {
        if (event.target === modal) modal.classList.add('hidden');
    });
});