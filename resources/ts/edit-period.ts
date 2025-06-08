interface Periode {
  nama_periode: string;
  durasi: string;
  tanggal_mulai: string;
  tanggal_selesai: string;
  status: string;
}

interface Modal {
  periode: Periode;
}

const formattedDate = (input: string): string => {
  const date = new Date(input);
  const year = date.getFullYear();
  const month = (date.getMonth() + 1).toString().padStart(2, '0');
  const day = date.getDate().toString().padStart(2, '0');
  return `${year}-${month}-${day}`;
};

document.addEventListener('DOMContentLoaded', () => {
  const buttons = document.querySelectorAll<HTMLAnchorElement>('.edit[data-id]');
  const modal = document.querySelector<HTMLElement>('.modal-edit-periode');
  if (!buttons || !modal) return;

  const close = modal.querySelector('.close') as HTMLElement;
  const form = modal.querySelector('form') as HTMLFormElement;
  if (!close || !form) return;

  const nama_periode = form.querySelector<HTMLInputElement>("input[name='nama_periode']");
  const durasi = form.querySelector<HTMLSelectElement>("select[name='durasi']");
  const tanggal_mulai = form.querySelector<HTMLInputElement>("input[name='tanggal_mulai']");
  const tanggal_selesai = form.querySelector<HTMLInputElement>("input[name='tanggal_selesai']");
  const status = form.querySelector<HTMLSelectElement>("select[name='status']");

  const fetchPeriodeData = async (id: string): Promise<Modal | null> => {
    try {
      const response = await fetch(`/admin/periode-magang/${id}/edit`, {
        headers: {
          Accept: 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        },
      });

      if (!response.ok) throw new Error('Gagal mengambil data periode.');
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

      const data = await fetchPeriodeData(id);
      if (!data) return;
      form.action = `/admin/periode-magang/${id}/perbarui`;

      if (nama_periode) nama_periode.value = data.periode.nama_periode;
      if (durasi) durasi.value = data.periode.durasi;
      if (tanggal_mulai) tanggal_mulai.value = formattedDate(data.periode.tanggal_mulai);
      if (tanggal_selesai) tanggal_selesai.value = formattedDate(data.periode.tanggal_selesai);
      if (status) status.value = data.periode.status;
      modal.classList.remove('hidden');
    });
  });

  close.addEventListener('click', () => {
    modal.classList.add('hidden');
    form.reset();
  });

  modal.addEventListener('click', (event) => {
    if (event.target === modal) {
      modal.classList.add('hidden');
      form.reset();
    }
  });
});