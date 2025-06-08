import axios from 'axios';

interface Intern {
  lowongan: {
    status: 'DIBUKA' | 'DITUTUP' | string;
    deskripsi: string;
    kuota: number;
    gaji: string;
    tanggal_mulai_pendaftaran: string;
    tanggal_selesai_pendaftaran: string;
    bidang: { nama_bidang: string };
    perusahaan: {
      nama: string;
      logo: string;
      lokasi: { nama_lokasi: string };
    };
    jenis_lokasi: { nama_jenis_lokasi: string };
    periode_magang: { nama_periode: string };
    keahlian: { nama_keahlian: string };
    jenis_magang: { nama_jenis: string };
    durasi: { nama_durasi: string };
  };
}

document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('modal-detail-lowongan') as HTMLElement;
  if (!modal) return;

  const close = modal.querySelector('.close') as HTMLElement;
  if (!close) return;

  const fields = {
    status: document.getElementById('status') as HTMLElement,
    nama_bidang: document.getElementById('nama_bidang') as HTMLElement,
    nama: document.getElementById('nama') as HTMLElement,
    nama_lokasi: document.getElementById('nama_lokasi') as HTMLElement,
    nama_jenis_lokasi: document.getElementById('nama_jenis_lokasi') as HTMLElement,
    nama_keahlian: document.getElementById('nama_keahlian') as HTMLElement,
    nama_periode: document.getElementById('nama_periode') as HTMLElement,
    gaji: document.getElementById('gaji') as HTMLElement,
    kuota: document.getElementById('kuota') as HTMLElement,
    tanggal_mulai_pendaftaran: document.getElementById('tanggal_mulai_pendaftaran') as HTMLElement,
    tanggal_selesai_pendaftaran: document.getElementById('tanggal_selesai_pendaftaran') as HTMLElement,
    deskripsi: document.getElementById('deskripsi') as HTMLElement,
    logo_perusahaan: document.getElementById('logo_perusahaan') as HTMLImageElement,
    jenis_magang: document.getElementById('jenis_magang') as HTMLElement,
    durasi: document.getElementById('durasi') as HTMLElement,
  };

  document.querySelectorAll('a.detail[data-id]').forEach((button) => {
    button.addEventListener('click', async () => {
      const id = button.getAttribute('data-id');
      if (!id) return;

      try {
        const response = await axios.get<Intern>(`/admin/lowongan-magang/${id}/detail`);
        const data = response.data.lowongan;

        const status = data.status;
        if (status === 'DIBUKA') {
          fields.status.innerHTML = `<span class="inline-block px-5 py-2 rounded-2xl bg-green-200 text-green-800">DIBUKA</span>`;
        } else if (status === 'DITUTUP') {
          fields.status.innerHTML = `<span class="inline-block px-5 py-2 rounded-2xl bg-yellow-200 text-yellow-800">DITUTUP</span>`;
        } else {
          fields.status.textContent = status;
        }

        fields.nama_bidang.textContent = data.bidang.nama_bidang;
        fields.nama.textContent = data.perusahaan.nama;
        fields.nama_lokasi.textContent = data.perusahaan.lokasi.nama_lokasi;
        fields.nama_jenis_lokasi.textContent = data.jenis_lokasi.nama_jenis_lokasi;

        const keahlian = data.keahlian.nama_keahlian.split(',').map((s) => s.trim());
        fields.nama_keahlian.innerHTML = keahlian.map((k) =>`<span class="bg-[#E86BB1] text-white px-5 py-2 rounded-2xl">${k}</span>`).join(' ');

        fields.nama_periode.textContent = data.periode_magang.nama_periode;
        fields.gaji.textContent = data.gaji;
        fields.kuota.textContent = `${data.kuota} orang`;
        fields.tanggal_mulai_pendaftaran.textContent = data.tanggal_mulai_pendaftaran;
        fields.tanggal_selesai_pendaftaran.textContent = data.tanggal_selesai_pendaftaran;
        fields.deskripsi.textContent = data.deskripsi;
        fields.jenis_magang.textContent = data.jenis_magang.nama_jenis;
        fields.durasi.textContent = data.durasi.nama_durasi;

        if (fields.logo_perusahaan) {
          fields.logo_perusahaan.src = data.perusahaan.logo ? `/storage/${data.perusahaan.logo.replace('storage/', '')}` : '/img/default-logo.png';
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
      } catch (err) {
        console.error('Error fetching detail:', err);
        fields.status.textContent = 'Error fetching data';
        modal.classList.remove('hidden');
        modal.classList.add('flex');
      }
    });
  });

  close.addEventListener('click', () => {
    modal.classList.toggle('hidden');
    modal.classList.toggle('flex');
  });
});