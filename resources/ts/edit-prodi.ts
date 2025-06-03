interface Prodi {
    kode_prodi: string;
    nama: string;
    jenjang_prodi_edit: string;
    jurusan_prodi: string;
    status_prodi_edit: string;
}

interface Modal {
    prodi: Prodi;
}
  
document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll<HTMLAnchorElement>('.edit[data-id]');
    const modal = document.querySelector<HTMLElement>('#modal-edit-prodi');
    const close = document.getElementById("close-edit");
    if (!buttons || !modal) return;
  
    const form = modal.querySelector('form') as HTMLFormElement;
    if (!close || !form) return;
  
    const nama = form.querySelector<HTMLInputElement>("input[name='nama']");
    const kode = form.querySelector<HTMLInputElement>("input[name='kode_prodi']");
    const jurusan = form.querySelector<HTMLInputElement>("input[name='jurusan_prodi']");
    const jenjang = form.querySelector<HTMLSelectElement>("select[name='jenjang_prodi']");
    const status = form.querySelector<HTMLSelectElement>("select[name='status_prodi']");
  
    const fetchProdiData = async (id: string): Promise<Modal | null> => {
        try {
            const response = await fetch(`/admin/data-prodi/${id}/edit`, {
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });
    
            if (!response.ok) throw new Error('Gagal mengambil data dosen.');
            return (await response.json()) as Modal;
        } catch (error) {
            console.error(error);
            return null;
        }
    };
  
    buttons.forEach((btn) => {
        btn.addEventListener('click', async () => {
            const id = btn.dataset.id;
            if (!id || !modal || !form) return;
    
            const data = await fetchProdiData(id);
            if (!data) return;
    
            modal.classList.remove('hidden');
    
            if (nama) nama.value = data.prodi.nama;
            if (kode) kode.value = data.prodi.kode_prodi;
            if (jurusan) jurusan.value = data.prodi.jurusan_prodi;
            if (jenjang) jenjang.value = data.prodi.jenjang_prodi_edit;
            if (status) status.value = data.prodi.status_prodi_edit;
    
            form.action = `/admin/data-prodi/${id}/perbarui`;
        });
    });
  
    close.addEventListener('click', () => modal.classList.add('hidden'));
  
    modal.addEventListener('click', (event) => {
      if (event.target === modal) modal.classList.add('hidden');
    });
});