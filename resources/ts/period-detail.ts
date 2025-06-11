/**
 * @fileoverview
 * This script handles fetching and displaying lecturer details in a modal.
 * When the page loads, it fetches lecturer data from the server and updates
 * the modal content with the fetched information, making the modal visible.
 */

interface Periode {
  nama_periode: string;
  tanggal_mulai: string;
  tanggal_selesai: string;
  status: string;
}

interface Modal {
  periode: Periode;
}

document.addEventListener('DOMContentLoaded', async () => {
  const buttons = document.querySelectorAll<HTMLAnchorElement>('.detail[data-id]');
  const modal = document.getElementById('modal-detail-periode');
  const close = document.getElementById('close-detail');
  if (!modal || !close) return;

  const detail_nama_periode = document.getElementById('detail_nama_periode');
  const tanggal_mulai = document.getElementById('tanggal_mulai');
  const tanggal_selesai = document.getElementById('tanggal_selesai');
  const status = document.getElementById('status');
  if (!detail_nama_periode || !tanggal_mulai || !tanggal_selesai || !status) return;

  const formattedDate = (date: string): string => {
    const [year, month, day] = date.split('-');
    return `${day}-${month}-${year}`;
  }

  buttons.forEach((button) => {
    button.addEventListener('click', async () => {
      const id = button.dataset.id;
      if (!id) return;
      modal.classList.remove('hidden');

      const data = await fetch(`/admin/periode/${id}/detail`, {
        headers: {
          Accept: 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        },
      });

      if (!data.ok) return;
      const response = (await data.json()) as Modal;

      detail_nama_periode.textContent = response.periode.nama_periode;
      tanggal_mulai.textContent = formattedDate(response.periode.tanggal_mulai);
      tanggal_selesai.textContent = formattedDate(response.periode.tanggal_selesai);
      status.textContent = response.periode.status;
    });
  });

  close.addEventListener('click', () => modal.classList.add('hidden'));

  modal.addEventListener('click', (event) => {
    if (event.target === modal) modal.classList.add('hidden');
  });
});