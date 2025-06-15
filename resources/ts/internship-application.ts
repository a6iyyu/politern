interface Pengajuan {
  bidang_posisi: string;
  logo: string | null;
  nama_perusahaan_mitra: string;
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

interface Lokasi {
  nama_lokasi: string;
}

interface Modal {
  pengajuan: Pengajuan;
  mahasiswa: Mahasiswa;
  lokasi: Lokasi;
}

document.addEventListener('DOMContentLoaded', async () => {
  const buttons = document.querySelectorAll<HTMLAnchorElement>('.apply[data-id]');
  const modal = document.getElementById('modal-detail-lamaran');
  if (!modal || !buttons) return;

  const close = modal.querySelector('.close') as HTMLElement;
  if (!close) return;

  const bidang_posisi = document.getElementById('bidang_posisi') as HTMLSpanElement;
  const logo = document.getElementById('logo') as HTMLImageElement;
  const nama_perusahaan = document.getElementById('nama_perusahaan') as HTMLSpanElement;
  const nama_lokasi = document.getElementById('lokasi') as HTMLSpanElement;
  const nim = document.getElementById('nim_mahasiswa') as HTMLSpanElement;
  const nama_lengkap = document.getElementById('nama_lengkap_mahasiswa') as HTMLSpanElement;
  const angkatan = document.getElementById('angkatan_mahasiswa') as HTMLSpanElement;
  const semester = document.getElementById('semester_mahasiswa') as HTMLSpanElement;
  const program_studi = document.getElementById('program_studi_mahasiswa') as HTMLSpanElement;
  const ipk = document.getElementById('ipk_mahasiswa') as HTMLSpanElement;
  const nomor_telepon = document.getElementById('nomor_telepon_mahasiswa') as HTMLSpanElement;
  const status = document.getElementById('status_mahasiswa') as HTMLSpanElement;
  if (bidang_posisi == null || logo == null || nama_perusahaan == null || nim == null || nama_lengkap == null || angkatan == null || semester == null || program_studi == null || ipk == null || nomor_telepon == null || status == null || nama_lokasi == null) return;

  buttons.forEach((btn) => {
    btn.addEventListener('click', async () => {
      const id = btn.dataset.id;
      if (!id) return;
      modal.classList.remove('hidden');

      const data = await fetch(`/mahasiswa/lowongan/${id}/lamar`, {
        headers: {
          Accept: 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        },
      });

      if (!data.ok) return;
      const response = (await data.json()) as Modal;

      bidang_posisi.textContent = response.pengajuan.bidang_posisi;

      if (response.pengajuan.logo) {
        logo.setAttribute('src', `${window.location.origin}/${response.pengajuan.logo}`);
      } else {
        logo.setAttribute('src', '/assets/images/default-logo.png');
      }

      if (window.innerWidth >= 1024) logo.classList.remove('hidden');
      nama_perusahaan.textContent = response.pengajuan.nama_perusahaan_mitra;
      nim.textContent = response.mahasiswa.nim;
      nama_lengkap.textContent = response.mahasiswa.nama_lengkap;
      angkatan.textContent = response.mahasiswa.angkatan;
      semester.textContent = response.mahasiswa.semester;
      program_studi.textContent = response.mahasiswa.program_studi;
      ipk.textContent = response.mahasiswa.ipk.toFixed(2);
      nomor_telepon.textContent = response.mahasiswa.nomor_telepon;
      status.textContent = response.mahasiswa.status;
      nama_lokasi.textContent = response.lokasi.nama_lokasi;
    });
  });

  close.addEventListener('click', () => {
    modal.classList.add('hidden');
    logo.classList.add('hidden');
  });

  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.classList.add('hidden');
      logo.classList.add('hidden');
    }
  });
});