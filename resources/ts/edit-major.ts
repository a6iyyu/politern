interface Prodi {
  id_prodi: number;
  kode: string;
  nama: string;
  jenjang: string;
  jurusan: string;
  status: string;
}

document.addEventListener('DOMContentLoaded', () => {
  const buttons = document.querySelectorAll<HTMLAnchorElement>('.edit[data-id]');
  const modal = document.querySelector<HTMLElement>('#modal-edit-prodi');
  const close = document.getElementById('close-edit');
  if (!buttons || !modal) return;

  const form = modal.querySelector('form') as HTMLFormElement;
  if (!close || !form) return;

  const nama = form.querySelector<HTMLInputElement>("input[name='nama']");
  const kode = form.querySelector<HTMLInputElement>("input[name='kode']");
  const jurusan = form.querySelector<HTMLInputElement>("input[name='jurusan']");
  const jenjang = form.querySelector<HTMLSelectElement>("select[name='jenjang']");
  const status = form.querySelector<HTMLSelectElement>("select[name='status']");

  const fetchProdiData = async (id: string): Promise<Prodi | null> => {
    try {
      const response = await fetch(`/admin/data-prodi/${id}/edit`, {
        headers: {
          Accept: 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        },
      });

      if (!response.ok) throw new Error('Gagal mengambil data dosen.');
      return (await response.json()) as Prodi;
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

      if (nama) nama.value = data.nama;
      if (kode) kode.value = data.kode;
      if (jurusan) jurusan.value = data.jurusan;
      if (jenjang) jenjang.value = data.jenjang;
      if (status) status.value = data.status;

      form.action = `/admin/data-prodi/${id}/perbarui`;
    });
  });

  close.addEventListener('click', () => modal.classList.add('hidden'));

  modal.addEventListener('click', (event) => {
    if (event.target === modal) modal.classList.add('hidden');
  });
});