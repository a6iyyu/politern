document.addEventListener('DOMContentLoaded', () => {
  const buttons = document.querySelectorAll<HTMLButtonElement>('.edit[data-id]');
  const modal = document.querySelector<HTMLElement>('.modal-edit-pengalaman-mahasiswa');
  if (!buttons || !modal) return;

  const close = modal.querySelector('.close') as HTMLElement;
  const form = modal.querySelector('form') as HTMLFormElement;

  buttons.forEach(button => {
    button.addEventListener('click', async () => {
      const id = button.dataset.id;
      if (!id || !modal || !form) return;

      try {
        const res = await fetch(`/mahasiswa/profil/pengalaman/${id}/edit`);
        if (!res.ok) throw new Error('Gagal mengambil data pengalaman.');

        const data = await res.json();

        (form.querySelector('[name="edit_posisi_pengalaman"]') as HTMLInputElement).value = data.posisi;
        (form.querySelector('[name="edit_nama_lembaga_pengalaman"]') as HTMLInputElement).value = data.nama_lembaga;
        (form.querySelector('[name="edit_jenis_pengalaman"]') as HTMLSelectElement).value = data.jenis_pengalaman;
        (form.querySelector('[name="edit_deskripsi_pengalaman"]') as HTMLTextAreaElement).value = data.deskripsi;
        (form.querySelector('[name="edit_tanggal_mulai_pengalaman"]') as HTMLInputElement).value = data.tanggal_mulai;
        (form.querySelector('[name="edit_tanggal_selesai_pengalaman"]') as HTMLInputElement).value = data.tanggal_selesai;

        form.action = `/mahasiswa/profil/pengalaman/${id}/edit`;

        modal.classList.remove('hidden');
        modal.classList.add('flex');

      } catch (error) {
        console.error(error);
        alert('Terjadi kesalahan saat memuat data.');
      }
    });
  });

  close.addEventListener('click', () => {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  });
});