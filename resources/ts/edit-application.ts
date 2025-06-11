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
  const close = document.querySelectorAll<HTMLElement>('.close-edit');
  const form = document.getElementById('edit-formulir-pengajuan') as HTMLFormElement | null;

  if (!modal || !form) return;

  buttons.forEach((button) => {
    button.addEventListener('click', async (e) => {
      e.preventDefault();
      const id = button.getAttribute('data-id');
      if (!id) return;

      const submit = form.querySelector<HTMLButtonElement>('button[type="submit"]');
      if (!submit) return;
      submit.disabled = true;
      submit.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memuat...';

      try {
        const response = await fetch(`/admin/pengajuan-magang/${id}/edit`, {
          headers: {
            Accept: 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
          },
        });

        if (!response.ok) throw new Error('Gagal memuat data pengajuan');
        const { pengajuan, mahasiswa } = (await response.json()) as ApiResponse;

        const id_edit_pengajuan = document.getElementById('id_edit_pengajuan') as HTMLInputElement | null;
        const edit_nim = document.getElementById('edit_nim') as HTMLInputElement | null;
        const edit_nama = document.getElementById('edit_nama') as HTMLInputElement | null;
        const edit_prodi = document.getElementById('edit_prodi') as HTMLInputElement | null;
        const edit_ipk = document.getElementById('edit_ipk') as HTMLInputElement | null;
        const edit_status = document.getElementById('edit_status') as HTMLSelectElement | null;
        const catatan = document.getElementById('catatan') as HTMLTextAreaElement | null;
        if (id_edit_pengajuan == null || edit_nim == null || edit_nama == null || edit_prodi == null || edit_ipk == null || edit_status == null || catatan == null) return;

        id_edit_pengajuan.value = pengajuan.id.toString();
        edit_nim.value = mahasiswa.nim;
        edit_nama.value = mahasiswa.nama_lengkap;
        edit_prodi.value = mahasiswa.program_studi;
        edit_ipk.value = mahasiswa.ipk.toString();
        edit_status.value = pengajuan.status;
        catatan.value = pengajuan.catatan || '';

        form.action = `/admin/pengajuan-magang/${id}/perbarui`;
        modal.classList.remove('hidden');
      } catch (error) {
        console.error(`Terjadi kesalahan: ${error}`);
        throw error;
      } finally {
        submit.disabled = false;
        submit.innerHTML = 'Simpan Perubahan';
      }
    });
  });

  close.forEach((button) => button.addEventListener('click', () => modal.classList.add('hidden')));

  modal.addEventListener('click', (e) => {
    if (e.target === modal) modal.classList.add('hidden');
  });

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const submit = form.querySelector<HTMLButtonElement>('button[type="submit"]');
    const csrf = document.querySelector<HTMLMetaElement>('meta[name="csrf-token"]');
    if (!submit || !csrf) return;

    try {
      submit.disabled = true;
      submit.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';

      const response = await fetch(form.action, {
        method: 'POST',
        headers: {
          Accept: 'application/json',
          'X-CSRF-TOKEN': csrf.content,
          'X-Requested-With': 'XMLHttpRequest',
        },
        body: new FormData(form),
      });

      const data = await response.json();
      if (!response.ok) throw new Error(data.message || 'Terjadi kesalahan saat menyimpan');

      modal.classList.add('hidden');
      window.location.reload();
    } catch (error) {
      console.error(`Terjadi kesalahan: ${error}`);
      throw error;
    } finally {
      submit.disabled = false;
      submit.innerHTML = 'Simpan Perubahan';
    }
  });
});