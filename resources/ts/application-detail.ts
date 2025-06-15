interface Pengajuan {
  bidang_posisi: string;
  logo: string | null;
  nama_perusahaan_mitra: string;
  lokasi: string;
}

interface CV {
  nama_file: string;
  url: string | null;
}

interface Mahasiswa {
  nim: string;
  nama_lengkap: string;
  angkatan: string;
  semester: string;
  program_studi: string;
  ipk: number;
  nomor_telepon: string;
  deskripsi: string;
  cv: CV;
  keahlian: string[];
}

interface ApplicationDetail {
  pengajuan: Pengajuan;
  mahasiswa: Mahasiswa;
}

document.addEventListener('DOMContentLoaded', () => {
  const buttons = document.querySelectorAll<HTMLButtonElement>('.detail[data-id]');
  const modal = document.getElementById('modal-konfirmasi-pengajuan');
  const close = document.getElementById('close-konfirmasi');
  if (!modal || !close) return;
  
  const nama_mahasiswa = document.getElementById('nama_mahasiswa');
  const nim = document.getElementById('nim');
  const prodi = document.getElementById('prodi');
  const nama_perusahaan = document.getElementById('nama_perusahaan');
  const posisi = document.getElementById('posisi');
  const lokasi = document.getElementById('lokasi');
  const ipk = document.getElementById('ipk');
  const angkatan = document.getElementById('angkatan');
  const semester = document.getElementById('semester');
  const nomor_telepon = document.getElementById('nomor_telepon');
  const deskripsi = document.getElementById('deskripsi');
  const logo_perusahaan = document.getElementById('logo_perusahaan') as HTMLImageElement;
  const logo_placeholder = document.getElementById('logo_placeholder');
  const nama_file_cv = document.getElementById('cv_nama_file');
  const unduh_cv = document.getElementById('cv_download') as HTMLAnchorElement;
  const daftar_keahlian = document.getElementById('keahlian_list');

  if (!nama_mahasiswa || !nim || !prodi || !nama_perusahaan || !posisi || !lokasi || !ipk) return;

  buttons.forEach(button => {
    button.addEventListener('click', async () => {
      const id = button.dataset.id;
      if (!id) return;
      modal.classList.remove('hidden');

      try {
        const response = await fetch(`/admin/pengajuan-magang/${id}/detail`, {
          headers: {
            Accept: 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
          },
        });

        if (!response.ok) return;
        const data = (await response.json()) as ApplicationDetail;

        nama_mahasiswa.textContent = data.mahasiswa.nama_lengkap;
        nim.textContent = data.mahasiswa.nim;
        prodi.textContent = data.mahasiswa.program_studi;
        nama_perusahaan.textContent = data.pengajuan.nama_perusahaan_mitra;
        posisi.textContent = data.pengajuan.bidang_posisi;
        lokasi.textContent = data.pengajuan.lokasi;
        ipk.textContent = data.mahasiswa.ipk.toFixed(2);

        if (angkatan) angkatan.textContent = data.mahasiswa.angkatan;
        if (semester) semester.textContent = data.mahasiswa.semester;
        if (nomor_telepon) nomor_telepon.textContent = data.mahasiswa.nomor_telepon;
        if (deskripsi) deskripsi.textContent = data.mahasiswa.deskripsi;

        if (!logo_perusahaan) {
          if (logo_placeholder) logo_placeholder.classList.remove('hidden');
          return;
        }

        const logo = data.pengajuan.logo;

        if (!logo) {
        logo_perusahaan.classList.add('hidden');
        if (logo_placeholder) logo_placeholder.classList.remove('hidden');
        return;
        }

        const logoUrl = logo.startsWith('storage/')
          ? `/${logo}`
          : logo.startsWith('/storage/')
            ? logo
            : `/storage/${logo}`;

        logo_perusahaan.src = logoUrl;
        logo_perusahaan.classList.remove('hidden');
        if (logo_placeholder) logo_placeholder.classList.add('hidden');

        logo_perusahaan.onerror = () => {
        console.error(`Gagal memuat logo ${logoUrl} karena kesalahan pada server.`);
        logo_perusahaan.classList.add('hidden');
        if (logo_placeholder) logo_placeholder.classList.remove('hidden');
        };

        if (nama_file_cv) nama_file_cv.textContent = data.mahasiswa.cv.nama_file;
        if (unduh_cv) {
          if (data.mahasiswa.cv.url) {
              unduh_cv.href = data.mahasiswa.cv.url;
              const cvLink = document.getElementById('cv_link') as HTMLAnchorElement;
              if (cvLink) cvLink.href = data.mahasiswa.cv.url;
          } else {
              unduh_cv.style.display = 'none';
          }
        }

        if (daftar_keahlian) daftar_keahlian.innerHTML = data.mahasiswa.keahlian.map(skill => `<span class="text-sm bg-pink-400 text-white px-4 py-2 rounded-full mr-2">${skill}</span>`).join('');
      } catch (error) {
        console.error('Gagal memuat data:', error);
      }
    });
  });

  close.addEventListener('click', () => modal.classList.add('hidden'));

  modal.addEventListener('click', event => {
    if (event.target === modal) modal.classList.add('hidden');
  });
});