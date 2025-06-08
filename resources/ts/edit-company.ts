interface Perusahaan {
  nama: string;
  nib: string;
  nomor_telepon: string;
  email: string;
  website: string;
  status: string;
  id_lokasi: string;
}

interface Modal {
  perusahaan: Perusahaan;
}

document.addEventListener('DOMContentLoaded', () => {
  const buttons = document.querySelectorAll<HTMLAnchorElement>('.edit[data-id]');
  const modal = document.querySelector<HTMLElement>('.modal-edit-perusahaan');
  if (!buttons || !modal) return;

  const close = modal.querySelector('.close') as HTMLElement;
  const form = modal.querySelector('form') as HTMLFormElement;
  if (!close || !form) return;

  const nama = form.querySelector<HTMLInputElement>("input[name='nama']");
  const nib = form.querySelector<HTMLInputElement>("input[name='nib']");
  const nomor_telepon = form.querySelector<HTMLInputElement>("input[name='nomor_telepon']");
  const email = form.querySelector<HTMLInputElement>("input[name='email']");
  const website = form.querySelector<HTMLInputElement>("input[name='website']");
  const status = form.querySelector<HTMLSelectElement>("select[name='status']");
  const id_lokasi = form.querySelector<HTMLSelectElement>("select[name='id_lokasi']");

  const fetchPerusahaanData = async (id: string): Promise<Modal | null> => {
    try {
      const response = await fetch(`/admin/data-perusahaan/${id}/edit`, {
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

      const data = await fetchPerusahaanData(id);
      if (!data) return;
      modal.classList.remove('hidden');

      if (nama) nama.value = data.perusahaan.nama;
      if (nib) nib.value = data.perusahaan.nib;
      if (nomor_telepon) nomor_telepon.value = data.perusahaan.nomor_telepon;
      if (email) email.value = data.perusahaan.email;
      if (website) website.value = data.perusahaan.website;
      if (status) status.value = data.perusahaan.status;
      if (id_lokasi) id_lokasi.value = data.perusahaan.id_lokasi;
      form.action = `/admin/data-perusahaan/${id}/perbarui`;
    });
  });

  close.addEventListener('click', () => modal.classList.add('hidden'));

  modal.addEventListener('click', (event) => {
    if (event.target === modal) modal.classList.add('hidden');
  });
});