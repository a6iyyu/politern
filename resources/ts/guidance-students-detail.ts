interface Magang {
  bidang_posisi: string;
  logo: string | null;
  nama_perusahaan_mitra: string;
  lokasi: string;
}
  
interface StatusMagang {
    status: string;
    class: string;
}

interface Mahasiswa {
    nim: string;
    nama_lengkap: string;
    angkatan: string;
    semester: string;
    program_studi: string;
    ipk: number;
    nomor_telepon: string;
    keahlian: string[];
    status_magang: StatusMagang;
}

interface DetailMahasiswaBimbingan {
  magang: Magang;
  mahasiswa: Mahasiswa;
}

document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll<HTMLButtonElement>('.detail[data-id]');
    const modal = document.getElementById('modal-detail-mahasiswa-bimbingan');
    const close = document.getElementById('close-detail-mahasiswa-bimbingan');
    
    if (!modal || !close) return;
    
    const nama_mahasiswa = document.getElementById('nama_mahasiswa_bimbingan');
    const nim = document.getElementById('nim_bimbingan');
    const prodi = document.getElementById('prodi_bimbingan');
    const nama_perusahaan = document.getElementById('nama_perusahaan_bimbingan');
    const posisi = document.getElementById('posisi_bimbingan');
    const lokasi = document.getElementById('lokasi_bimbingan');
    const ipk = document.getElementById('ipk_bimbingan');
    const angkatan = document.getElementById('angkatan_bimbingan');
    const semester = document.getElementById('semester_bimbingan');
    const nomor_telepon = document.getElementById('nomor_telepon_bimbingan');
    const deskripsi = document.getElementById('deskripsi_bimbingan');
    const logo_perusahaan = document.getElementById('logo_perusahaan_bimbingan') as HTMLImageElement;
    const logo_placeholder = document.getElementById('logo_placeholder_bimbingan');
    const daftar_keahlian = document.getElementById('keahlian_list_bimbingan');
    const status_magang = document.getElementById('status_magang_bimbingan');
  
    if (!nama_mahasiswa || !nim || !prodi || !nama_perusahaan || !posisi || !lokasi || !ipk || !status_magang) return;
  
    buttons.forEach(button => {
      button.addEventListener('click', async () => {
        const id = button.dataset.id;
        if (!id) return;
        modal.classList.remove('hidden');
  
        try {
          const response = await fetch(`/dosen/data-mahasiswa/detail/${id}`, {
            headers: {
              Accept: 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
            },
          });
  
          if (!response.ok) return;
          const data = (await response.json()) as DetailMahasiswaBimbingan;
  
          nama_mahasiswa.textContent = data.mahasiswa.nama_lengkap;
          nim.textContent = data.mahasiswa.nim;
          prodi.textContent = data.mahasiswa.program_studi;
          ipk.textContent = data.mahasiswa.ipk.toFixed(2);
          nama_perusahaan.textContent = data.magang.nama_perusahaan_mitra;
          posisi.textContent = data.magang.bidang_posisi;
          lokasi.textContent = data.magang.lokasi;
  
          if (angkatan) angkatan.textContent = data.mahasiswa.angkatan;
          if (semester) semester.textContent = data.mahasiswa.semester;
          if (nomor_telepon) nomor_telepon.textContent = data.mahasiswa.nomor_telepon;
          if (deskripsi) deskripsi.textContent = data.mahasiswa.deskripsi;
          if (status_magang) {
              status_magang.textContent = data.mahasiswa.status_magang.status;
              status_magang.className = `text-xs font-medium px-5 py-2 rounded-2xl ${data.mahasiswa.status_magang.class}`;
          }
  
          if (logo_perusahaan) {
            if (data.magang.logo) {
              const logoUrl = data.magang.logo.startsWith('storage/')
                ? `/${data.magang.logo}`
                : data.magang.logo.startsWith('/storage/')
                  ? data.magang.logo
                  : `/storage/${data.magang.logo}`;
                  
              logo_perusahaan.src = logoUrl;
              logo_perusahaan.classList.remove('hidden');
              if (logo_placeholder) logo_placeholder.classList.add('hidden');
              
              logo_perusahaan.onerror = () => {
                console.error('Gagal memuat logo:', logoUrl);
                logo_perusahaan.classList.add('hidden');
                if (logo_placeholder) logo_placeholder.classList.remove('hidden');
              };
            } else {
              logo_perusahaan.classList.add('hidden');
              if (logo_placeholder) logo_placeholder.classList.remove('hidden');
            }
          } else if (logo_placeholder) {
            logo_placeholder.classList.remove('hidden');
          }
  
          if (daftar_keahlian) {
            daftar_keahlian.innerHTML = data.mahasiswa.keahlian.map(skill => `<span class="text-sm bg-pink-400 text-white px-4 py-2 rounded-full mr-2">${skill}</span>`).join('');
          }
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