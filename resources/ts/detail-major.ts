interface Prodi {
  kode_prodi: string;
  nama: string;
  jenjang_prodi: string;
  jurusan_prodi: string;
  status_prodi: string;
}

interface Modal {
  prodi: Prodi;
}

document.addEventListener('DOMContentLoaded', async () => {
  const buttons = document.querySelectorAll<HTMLAnchorElement>('.detail[data-id]');
  const modal = document.getElementById('modal-detail-prodi');
  const close = document.getElementById('close-detail');
  if (!modal || !close) return;

  const kode = document.getElementById('kode_prodi');
  const nama = document.getElementById('nama');
  const jenjang = document.getElementById('jenjang_prodi_detail');
  const jurusan = document.getElementById('jurusan_prodi');
  const status = document.getElementById('status_prodi');
  if (!kode || !nama || !jenjang || !jurusan || !status) return;

  buttons.forEach((button) => {
    button.addEventListener('click', async () => {
      const id = button.dataset.id;
      if (!id) return;
      modal.classList.remove('hidden');

      const data = await fetch(`/admin/data-prodi/${id}/detail`, {
        headers: {
          Accept: 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        },
      });

      if (!data.ok) return;
      const response = (await data.json()) as Modal;

      kode.textContent = response.prodi.kode_prodi;
      nama.textContent = response.prodi.nama;
      jenjang.textContent = response.prodi.jenjang_prodi;
      jurusan.textContent = response.prodi.jurusan_prodi;
      status.textContent = response.prodi.status_prodi;
    });
  });

  close.addEventListener('click', () => modal.classList.add('hidden'));

  modal.addEventListener('click', (event) => {
    if (event.target === modal) modal.classList.add('hidden');
  });
});