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

// interface Pengalaman {
//   jenis: string;
//   posisi: string;
//   perusahaan: string;
//   deskripsi: string;
//   tanggal_mulai: string;
//   tanggal_selesai: string;
//   dokumen_pendukung: string;
// }

// interface Sertifikasi {
//   nama: string;
//   penyelenggara: string;
//   deskripsi: string;
//   tanggal_terbit: string;
//   tanggal_kadaluwarsa: string;
//   dokumen_pendukung: string;
// }

// interface Proyek {
//   nama: string;
//   role: string;
//   deskripsi: string;
//   url: string;
//   tanggal_mulai: string;
//   tanggal_selesai: string;
//   tools: string[];
// }

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
  // pengalaman: Pengalaman[];
  // sertifikasi: Sertifikasi[];
  // proyek: Proyek[];
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
  
  const namaMahasiswa = document.getElementById('nama_mahasiswa');
  const nim = document.getElementById('nim');
  const prodi = document.getElementById('prodi');
  const namaPerusahaan = document.getElementById('nama_perusahaan');
  const posisi = document.getElementById('posisi');
  const lokasi = document.getElementById('lokasi');
  const ipk = document.getElementById('ipk');
  
  const angkatan = document.getElementById('angkatan');
  const semester = document.getElementById('semester');
  const nomorTelepon = document.getElementById('nomor_telepon');
  const deskripsi = document.getElementById('deskripsi');
  
  const logoImg = document.getElementById('logo_perusahaan') as HTMLImageElement;
  const logoPlaceholder = document.getElementById('logo_placeholder');
  
  const cvNamaFile = document.getElementById('cv_nama_file');
  const cvDownload = document.getElementById('cv_download') as HTMLAnchorElement;
  
  const keahlianList = document.getElementById('keahlian_list');
  // const pengalamanList = document.getElementById('pengalaman_list');
  // const sertifikasiList = document.getElementById('sertifikasi_list');
  // const proyekList = document.getElementById('proyek_list');

  if (!namaMahasiswa || !nim || !prodi || !namaPerusahaan || !posisi || !lokasi || !ipk) return;

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

        namaMahasiswa.textContent = data.mahasiswa.nama_lengkap;
        nim.textContent = data.mahasiswa.nim;
        prodi.textContent = data.mahasiswa.program_studi;
        namaPerusahaan.textContent = data.pengajuan.nama_perusahaan_mitra;
        posisi.textContent = data.pengajuan.bidang_posisi;
        lokasi.textContent = data.pengajuan.lokasi;
        ipk.textContent = data.mahasiswa.ipk.toFixed(2);

        if (angkatan) angkatan.textContent = data.mahasiswa.angkatan;
        if (semester) semester.textContent = data.mahasiswa.semester;
        if (nomorTelepon) nomorTelepon.textContent = data.mahasiswa.nomor_telepon;
        if (deskripsi) deskripsi.textContent = data.mahasiswa.deskripsi;

        if (logoImg) {
          if (data.pengajuan.logo) {
            const logoUrl = data.pengajuan.logo.startsWith('storage/')
              ? `/${data.pengajuan.logo}`
              : data.pengajuan.logo.startsWith('/storage/')
                ? data.pengajuan.logo
                : `/storage/${data.pengajuan.logo}`;
                
            logoImg.src = logoUrl;
            logoImg.classList.remove('hidden');
            if (logoPlaceholder) logoPlaceholder.classList.add('hidden');
            
            logoImg.onerror = () => {
              console.error('Failed to load logo:', logoUrl);
              logoImg.classList.add('hidden');
              if (logoPlaceholder) logoPlaceholder.classList.remove('hidden');
            };
          } else {
            logoImg.classList.add('hidden');
            if (logoPlaceholder) logoPlaceholder.classList.remove('hidden');
          }
        } else if (logoPlaceholder) {
          logoPlaceholder.classList.remove('hidden');
        }

        if (cvNamaFile) cvNamaFile.textContent = data.mahasiswa.cv.nama_file;
        if (cvDownload) {
          if (data.mahasiswa.cv.url) {
              cvDownload.href = data.mahasiswa.cv.url;
              // Also update the view link
              const cvLink = document.getElementById('cv_link') as HTMLAnchorElement;
              if (cvLink) {
                  cvLink.href = data.mahasiswa.cv.url;
              }
          } else {
              cvDownload.style.display = 'none';
          }
        }

        if (keahlianList) {
          keahlianList.innerHTML = data.mahasiswa.keahlian.map(skill =>
            `<span class="text-sm bg-pink-400 text-white px-4 py-2 rounded-full mr-2">${skill}</span>`
          ).join('');
        }

        // if (pengalamanList) {
        //   if (data.mahasiswa.pengalaman.length > 0) {
        //     pengalamanList.innerHTML = data.mahasiswa.pengalaman.map(exp => `
        //       <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
        //         <div class="mb-2">
        //           <span class="font-semibold text-blue-800">${exp.jenis}</span>
        //           <span class="text-gray-600 ml-2">${exp.posisi}</span>
        //         </div>
        //         <div class="text-blue-700 font-medium mb-1">${exp.perusahaan}</div>
        //         <div class="text-gray-600 text-sm mb-2">${exp.deskripsi}</div>
        //         <div class="text-xs text-gray-500">
        //           <span class="bg-pink-100 text-pink-600 px-2 py-1 rounded mr-2">${exp.tanggal_mulai}</span>
        //           <span class="bg-pink-100 text-pink-600 px-2 py-1 rounded">${exp.tanggal_selesai}</span>
        //         </div>
        //         ${exp.dokumen_pendukung ? `
        //           <div class="mt-2">
        //             <span class="text-pink-500 text-sm">Dokumen Pendukung: ${exp.dokumen_pendukung}</span>
        //           </div>
        //         ` : ''}
        //       </div>
        //     `).join('');
        //   } else {
        //     pengalamanList.innerHTML = '<p class="text-gray-500 text-sm">Tidak ada pengalaman</p>';
        //   }
        // }

        // if (sertifikasiList) {
        //   if (data.mahasiswa.sertifikasi.length > 0) {
        //     sertifikasiList.innerHTML = data.mahasiswa.sertifikasi.map(cert => `
        //       <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
        //         <div class="mb-2">
        //           <span class="font-semibold text-purple-800">${cert.nama}</span>
        //         </div>
        //         <div class="text-purple-700 font-medium mb-1">${cert.penyelenggara}</div>
        //         <div class="text-gray-600 text-sm mb-2">${cert.deskripsi}</div>
        //         <div class="text-xs text-gray-500 space-y-1">
        //           <div>
        //             <span class="font-medium">Tanggal terbit: </span>
        //             <span class="bg-pink-100 text-pink-600 px-2 py-1 rounded">${cert.tanggal_terbit}</span>
        //           </div>
        //           ${cert.tanggal_kadaluwarsa ? `
        //             <div>
        //               <span class="font-medium">Tanggal kadaluwarsa: </span>
        //               <span class="bg-pink-100 text-pink-600 px-2 py-1 rounded">${cert.tanggal_kadaluwarsa}</span>
        //             </div>
        //           ` : ''}
        //         </div>
        //         ${cert.dokumen_pendukung ? `
        //           <div class="mt-2">
        //             <span class="text-pink-500 text-sm">Sertifikat: ${cert.dokumen_pendukung}</span>
        //           </div>
        //         ` : ''}
        //       </div>
        //     `).join('');
        //   } else {
        //     sertifikasiList.innerHTML = '<p class="text-gray-500 text-sm">Tidak ada sertifikasi</p>';
        //   }
        // }

        // if (proyekList) {
        //   if (data.mahasiswa.proyek.length > 0) {
        //     proyekList.innerHTML = data.mahasiswa.proyek.map(project => `
        //       <div class="bg-green-50 p-4 rounded-lg border border-green-200">
        //         <div class="mb-2">
        //           <span class="font-semibold text-green-800">${project.nama}</span>
        //           <span class="text-gray-600 ml-2">Role: ${project.role}</span>
        //         </div>
        //         <div class="text-gray-600 text-sm mb-2">${project.deskripsi}</div>
        //         ${project.url ? `
        //           <div class="mb-2">
        //             <a href="${project.url}" target="_blank" class="text-pink-500 text-sm hover:underline">
        //               <i class="fa-solid fa-link mr-1"></i>
        //               ${project.url}
        //             </a>
        //           </div>
        //         ` : ''}
        //         <div class="text-xs text-gray-500 mb-2">
        //           <span class="bg-pink-100 text-pink-600 px-2 py-1 rounded mr-2">${project.tanggal_mulai}</span>
        //           <span class="bg-pink-100 text-pink-600 px-2 py-1 rounded">${project.tanggal_selesai}</span>
        //         </div>
        //         ${project.tools && project.tools.length > 0 ? `
        //           <div class="mt-2">
        //             <span class="text-sm font-medium text-gray-700 mb-1 block">Alat:</span>
        //             <div class="flex flex-wrap gap-1">
        //               ${project.tools.map(tool => `<span class="badge badge-pink">${tool}</span>`).join('')}
        //             </div>
        //           </div>
        //         ` : ''}
        //       </div>
        //     `).join('');
        //   } else {
        //     proyekList.innerHTML = '<p class="text-gray-500 text-sm">Tidak ada proyek</p>';
        //   }
        // }

      } catch (error) {
        console.error('Error loading data:', error);
      }
    });
  });

  close.addEventListener('click', () => modal.classList.add('hidden'));

  modal.addEventListener('click', event => {
    if (event.target === modal) modal.classList.add('hidden');
  });
});