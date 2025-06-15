/**
 * @fileoverview
 * This script handles fetching and displaying lecturer details in a modal.
 * When the page loads, it fetches lecturer data from the server and updates
 * the modal content with the fetched information, making the modal visible.
 */

interface Lecturer {
  nama_pengguna: string;
  email: string;
  nip: string;
  nama: string;
  nomor_telepon: string;
  jumlah_bimbingan: string;
}

interface User {
  nama_pengguna: string;
  email: string;
}

interface Modal {
  dosen: Lecturer;
  pengguna: User;
}

document.addEventListener('DOMContentLoaded', async () => {
  const buttons = document.querySelectorAll<HTMLAnchorElement>('.detail[data-id]');
  const modal = document.getElementById('modal-detail-dosen');
  const close = document.getElementById('close-detail');
  if (!modal || !close) return;

  const nama_pengguna = document.getElementById('nama_pengguna');
  const email = document.getElementById('email');
  const nip = document.getElementById('nip');
  const nama_dosen = document.getElementById('nama_dosen');
  const nomor_telepon = document.getElementById('nomor_telepon');
  const jumlah_bimbingan = document.getElementById('jumlah_bimbingan');
  if (!nama_pengguna || !email || !nip || !nama_dosen || !nomor_telepon || !jumlah_bimbingan) return;

  buttons.forEach((button) => {
    button.addEventListener('click', async () => {
      const id = button.dataset.id;
      if (!id) return;
      modal.classList.remove('hidden');

      const data = await fetch(`/admin/data-dosen/${id}/detail`, {
        headers: {
          Accept: 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        },
      });

      if (!data.ok) return;
      const response = (await data.json()) as Modal;

      nama_pengguna.textContent = response.pengguna.nama_pengguna;
      email.textContent = response.pengguna.email;
      nip.textContent = response.dosen.nip;
      nama_dosen.textContent = response.dosen.nama;
      nomor_telepon.textContent = response.dosen.nomor_telepon;
      jumlah_bimbingan.textContent = response.dosen.jumlah_bimbingan || '0';
    });
  });

  close.addEventListener('click', () => modal.classList.add('hidden'));

  modal.addEventListener('click', (event) => {
    if (event.target === modal) modal.classList.add('hidden');
  });
});