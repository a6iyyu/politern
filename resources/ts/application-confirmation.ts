interface PengajuanData {
  pengajuan: {
    bidang_posisi: string;
    nama_perusahaan_mitra: string;
    lokasi: string;
  };
  mahasiswa: {
    nim: string;
    nama_lengkap: string;
  };
}

document.addEventListener('DOMContentLoaded', () => {
  const buttons = document.querySelectorAll<HTMLAnchorElement>('.konfirmasi[data-id]');
  const modal = document.querySelector<HTMLElement>('.modal-konfirmasi');
  if (!buttons || !modal) return;

  const close = modal.querySelector<HTMLElement>('.close-konfirmasi');
  const form = modal.querySelector<HTMLFormElement>('.konfirmasi');
  if (!close || !form) return;

  const dosen_pembimbing = form.querySelector<HTMLSelectElement>("select[name='dosen_pembimbing']");
  const terima = form?.querySelector<HTMLButtonElement>('button#terima');
  const tolak = form?.querySelector<HTMLButtonElement>('button#tolak');
  const nim = document.getElementById('nim_konfirmasi');
  const nama_lengkap = document.getElementById('nama_lengkap_konfirmasi');
  const posisi = document.getElementById('posisi_konfirmasi');
  const nama_perusahaan = document.getElementById('nama_perusahaan_konfirmasi');
  const lokasi = document.getElementById('lokasi_konfirmasi');
  const status = form.querySelector<HTMLInputElement>('input[name="status"]')
  if (close == null || form == null || dosen_pembimbing == null || terima == null || tolak == null || nim == null || nama_lengkap == null || posisi == null || nama_perusahaan == null || lokasi == null || status == null) return;

  terima.addEventListener('click', () => {
    status.value = 'DISETUJUI';
    form.submit();
  });

  tolak.addEventListener('click', () => {
    status.value = 'DITOLAK';
    form.submit();
  });

  form.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') e.preventDefault();
  });

  buttons.forEach((button) => {
    button.addEventListener('click', async () => {
      const id = button.getAttribute('data-id');
      if (id) {
        form.action = `/admin/pengajuan-magang/${id}/konfirmasi`;

        try {
          const response = await fetch(`/admin/pengajuan-magang/${id}/detail`, {
            headers: {
              Accept: 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
            },
          });

          if (!response.ok) {
            console.error('Failed to fetch:', response.status, response.statusText);
            return;
          }

          const data: PengajuanData = await response.json();

          if (nama_lengkap) nama_lengkap.textContent = data.mahasiswa.nama_lengkap;
          if (nim) nim.textContent = data.mahasiswa.nim;
          if (nama_perusahaan) nama_perusahaan.textContent = data.pengajuan.nama_perusahaan_mitra;
          if (posisi) posisi.textContent = data.pengajuan.bidang_posisi;
          if (lokasi) lokasi.textContent = data.pengajuan.lokasi;

          modal.classList.remove('hidden');
        } catch (error) {
          console.error('Error fetching application details:', error);
          alert('Gagal memuat detail pengajuan. Silakan coba lagi.');
        }
      }
    });
  });

  close.addEventListener('click', () => modal.classList.add('hidden'));

  modal.addEventListener('click', (event) => {
    if (event.target === modal) modal.classList.add('hidden');
  });
});