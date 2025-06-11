import axios from 'axios';

interface LogDetail {
  minggu: number;
  judul: string;
  deskripsi: string;
  foto: string | null;
  nama_perusahaan: string;
  nama_lokasi: string;
  nama_bidang: string;
  nama_dosen: string;
}

document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('modal-log-detail') as HTMLElement;
  if (!modal) return;

  const close = modal.querySelector('.close') as HTMLElement;
  if (!close) return;

  const fields = {
    nama_perusahaan: document.getElementById('nama_perusahaan') as HTMLElement,
    nama_lokasi: document.getElementById('nama_lokasi') as HTMLElement,
    nama_bidang: document.getElementById('nama_bidang') as HTMLElement,
    nama_dosen: document.getElementById('nama_dosen') as HTMLElement,
    minggu: document.getElementById('minggu') as HTMLElement,
    judul: document.getElementById('judul_log') as HTMLElement,
    deskripsi: document.getElementById('deskripsi_log') as HTMLElement,
    foto: document.getElementById('foto') as HTMLImageElement,
  };

  document.querySelectorAll('button.log-detail[data-id]').forEach((button) => {
    button.addEventListener('click', async () => {
      const id = button.getAttribute('data-id');
      console.log(`Fetching data for ID: ${id}`); // Debugging
      if (!id) return;

      try {
        const response = await axios.get<LogDetail>(`/mahasiswa/log-aktivitas/${id}/detail`);
        console.log(response.data); // Debugging
        const data = response.data;

        fields.nama_perusahaan.textContent = data.nama_perusahaan;
        fields.nama_lokasi.textContent = data.nama_lokasi;
        fields.nama_bidang.textContent = data.nama_bidang;
        fields.nama_dosen.textContent = data.nama_dosen;
        fields.minggu.textContent = String(data.minggu);
        fields.judul.textContent = data.judul;
        fields.deskripsi.textContent = data.deskripsi;

        if (data.foto) {
          const imagePath = `/storage/${data.foto}`;
          fields.foto.src = imagePath;

          fields.foto.onerror = () => {
            console.warn(`Failed to load image: ${imagePath}. Using default image.`);
            fields.foto.src = `/shared/aktivitas.png`;
          };

          fields.foto.classList.remove('hidden');
        } else {
          fields.foto.classList.remove('hidden');
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
      } catch (err) {
        console.error('Error fetching log detail:', err);
        fields.nama_perusahaan.textContent = 'Error fetching data';
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