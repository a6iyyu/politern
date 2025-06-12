interface LogActivity {
  minggu: string;
  judul: string;
  deskripsi: string;
  foto: string | null;
}

document.addEventListener('DOMContentLoaded', () => {
  const buttons = document.querySelectorAll<HTMLButtonElement>('.log-edit[data-id]');
  const modal = document.querySelector<HTMLElement>('#modal-log-edit');
  if (buttons == null || modal == null) return;

  const close = modal.querySelector<HTMLElement>('.close');
  const form = modal.querySelector<HTMLFormElement>('form');
  if (close == null || form == null) return;

  const minggu = form.querySelector<HTMLInputElement>("input[name='minggu']");
  const judul = form.querySelector<HTMLInputElement>("input[name='judul']");
  const deskripsi = form.querySelector<HTMLTextAreaElement>("textarea[name='deskripsi']");
  const foto = modal.querySelector<HTMLImageElement>('#foto');
  if (minggu == null || judul == null || deskripsi == null || foto == null) return;

  const fetchLogData = async (id: string): Promise<LogActivity | null> => {
    try {
      const res = await fetch(`/mahasiswa/log-aktivitas/${id}/edit`, {
        headers: {
          Accept: 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        },
      });

      if (!res.ok) throw new Error('Gagal mengambil data log aktivitas.');
      return await res.json();
    } catch (err) {
      console.error(err);
      return null;
    }
  };

  buttons.forEach((btn) => {
    btn.addEventListener('click', async () => {
      const id = btn.dataset.id;
      if (!id || !modal || !form) return;

      const data = await fetchLogData(id);
      if (data == null) return;

      if (minggu) minggu.value = data.minggu;
      if (judul) judul.value = data.judul;
      if (deskripsi) deskripsi.value = data.deskripsi;

      if (foto && data.foto) {
        foto.src = data.foto;
        foto.classList.remove('hidden');
      }

      form.action = `/mahasiswa/log-aktivitas/${id}/perbarui`;
      modal.classList.remove('hidden');
    });
  });

  close.addEventListener('click', () => modal.classList.add('hidden'));

  modal.addEventListener('click', (event) => {
    if (event.target === modal) modal.classList.add('hidden');
  });
});