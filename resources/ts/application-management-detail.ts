interface Pengajuan {
  bidang_posisi: string;
  logo: string | null;
  nama_perusahaan_mitra: string;
  lokasi: string;
}

interface Mahasiswa {
  nim: string;
  nama_lengkap: string;
  angkatan: string;
  semester: string;
  program_studi: string;
  ipk: number;
  nomor_telepon: string;
  status: string;
}

interface FileDownload {
  nama_file: string;
  url: string;
}

interface lokasi {
  nama_lokasi: string;
}

interface Modal {
  pengajuan: Pengajuan;
  mahasiswa: Mahasiswa;
  lokasi: lokasi;
  file_downloads: FileDownload[];
}

document.addEventListener('DOMContentLoaded', async () => {
  const buttons = document.querySelectorAll<HTMLAnchorElement>('.detail[data-id]');
  const modal = document.getElementById('modal-detail-lamaran');
  const close = document.getElementById('close-detail');
  if (!modal || !close) return;

  const bidang_posisi = document.getElementById('bidang_posisi');
  const logo = document.getElementById('logo');
  const nama_perusahaan = document.getElementById('nama_perusahaan');
  const lokasi = document.getElementById('lokasi');

  const nim = document.getElementById('nim');
  const nama_lengkap = document.getElementById('nama_lengkap');
  const angkatan = document.getElementById('angkatan');
  const semester = document.getElementById('semester');
  const program_studi = document.getElementById('program_studi');
  const ipk = document.getElementById('ipk');
  const nomor_telepon = document.getElementById('nomor_telepon');
  const status = document.getElementById('status');
  const nama_lokasi = document.getElementById('nama_lokasi');
  const file_downloads = document.getElementById('file-downloads');
  if (bidang_posisi == null || logo == null || nama_perusahaan == null || lokasi == null || nim == null || nama_lengkap == null || angkatan == null || semester == null || program_studi == null || ipk == null || nomor_telepon == null || status == null || file_downloads == null
      || nama_lokasi == null) return;

  buttons.forEach((button) => {
    button.addEventListener('click', async () => {
      const id = button.dataset.id;
      if (!id) return;
      modal.classList.remove('hidden');

      const data = await fetch(`/mahasiswa/kelola-lamaran/${id}/detail`, {
        headers: {
          Accept: 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        },
      });

      if (!data.ok) return;
      const response = (await data.json()) as Modal;

      bidang_posisi.textContent = response.pengajuan.bidang_posisi;
      logo.setAttribute('src', response.pengajuan.logo as string);
      nama_perusahaan.textContent = response.pengajuan.nama_perusahaan_mitra;
      lokasi.textContent = response.pengajuan.lokasi;
      nim.textContent = response.mahasiswa.nim;
      nama_lengkap.textContent = response.mahasiswa.nama_lengkap;
      angkatan.textContent = response.mahasiswa.angkatan;
      semester.textContent = response.mahasiswa.semester;
      program_studi.textContent = response.mahasiswa.program_studi;
      ipk.textContent = response.mahasiswa.ipk.toFixed(2);
      nomor_telepon.textContent = response.mahasiswa.nomor_telepon;
      status.textContent = response.mahasiswa.status;
      nama_lokasi.textContent = response.lokasi.nama_lokasi;
      file_downloads.innerHTML = '';

      response.file_downloads.forEach((file) => {
        const link = document.createElement('a');
        link.href = file.url;
        link.textContent = file.nama_file;
        link.classList.add('block', 'text-blue-500', 'hover:underline');
        file_downloads.appendChild(link);
      });
    });

    close.addEventListener('click', () => {
      modal.classList.add('hidden');
      file_downloads.innerHTML = '';
    });

    modal.addEventListener('click', (event) => {
      if (event.target === modal) {
        modal.classList.add('hidden');
        file_downloads.innerHTML = '';
      }
    });
  });
});