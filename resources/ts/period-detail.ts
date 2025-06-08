/**
 * @fileoverview
 * This script handles fetching and displaying lecturer details in a modal.
 * When the page loads, it fetches lecturer data from the server and updates
 * the modal content with the fetched information, making the modal visible.
 */

interface Periode {
  nama_periode: string;
  durasi: string;
  tanggal_mulai: string;
  tanggal_selesai: string;
  status: string;
  created_at: string;
}

interface Modal {
  periode: Periode;
}

document.addEventListener('DOMContentLoaded', async () => {
  const buttons = document.querySelectorAll<HTMLAnchorElement>('.detail[data-id]');
  const modal = document.getElementById('modal-detail-periode');
  const close = document.getElementById('close-detail');
  if (!modal || !close) return;

  const nama_periode = document.getElementById('nama_periode');
  const durasi = document.getElementById('durasi');
  const tanggal_mulai = document.getElementById('tanggal_mulai');
  const tanggal_selesai = document.getElementById('tanggal_selesai');
  const status = document.getElementById('status');
  const tanggal_dibuat = document.getElementById('tanggal_dibuat');
  if (!nama_periode || !durasi || !tanggal_mulai || !tanggal_selesai || !status || !tanggal_dibuat) return;

  buttons.forEach((button) => {
    button.addEventListener('click', async () => {
      const id = button.dataset.id;
      if (!id) return;
      modal.classList.remove('hidden');

      const data = await fetch(`/admin/periode-magang/${id}/detail`, {
        headers: {
          Accept: 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        },
      });

      if (!data.ok) return;
      const response = (await data.json()) as Modal;

      nama_periode.textContent = response.periode.nama_periode;
      tanggal_mulai.textContent = response.periode.tanggal_mulai;
      tanggal_selesai.textContent = response.periode.tanggal_selesai;
      durasi.textContent = response.periode.durasi;
      status.textContent = response.periode.status;

      tanggal_dibuat.textContent = new Date(
        response.periode.created_at
      ).toLocaleDateString('id-ID', {
        day: '2-digit',
        month: 'long',
        year: 'numeric',
      });
    });
  });

  close.addEventListener('click', () => modal.classList.add('hidden'));

  modal.addEventListener('click', (event) => {
    if (event.target === modal) modal.classList.add('hidden');
  });
});