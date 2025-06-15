interface Lecturer {
  nomor_telepon: string;
  nip: string;
  nama: string;
}

interface Modal {
  dosen: Lecturer;
  pengguna: User;
}

document.addEventListener('DOMContentLoaded', () => {
  const buttons = document.querySelectorAll<HTMLAnchorElement>('.edit[data-id]');
  const modal = document.querySelector<HTMLElement>('.modal-edit-dosen');
  if (!buttons || !modal) return;

  const close = modal.querySelector('.close') as HTMLElement;
  const form = modal.querySelector('form') as HTMLFormElement;
  if (!close || !form) return;

  const nama = form.querySelector<HTMLInputElement>("input[name='nama']");
  const nip = form.querySelector<HTMLInputElement>("input[name='nip']");
  const nomor_telepon = form.querySelector<HTMLInputElement>("input[name='nomor_telepon']");

  const fetchDosenData = async (id: string): Promise<Modal | null> => {
    try {
      const response = await fetch(`/admin/data-dosen/${id}/edit`, {
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

      const data = await fetchDosenData(id);
      if (!data) return;

      modal.classList.remove('hidden');

      if (nama) nama.value = data.dosen.nama;
      if (nip) nip.value = data.dosen.nip;
      if (nomor_telepon) nomor_telepon.value = data.dosen.nomor_telepon;

      form.action = `/admin/data-dosen/${id}/perbarui`;
    });
  });

  close.addEventListener('click', () => modal.classList.add('hidden'));

  modal.addEventListener('click', (event) => {
    if (event.target === modal) modal.classList.add('hidden');
  });
});