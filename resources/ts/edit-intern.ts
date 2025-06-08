import axios from 'axios';

interface LowonganEdit {
  id_lowongan: string;
  id_perusahaan_mitra: string;
  id_bidang: string;
  id_periode: string;
  id_jenis_lokasi: string;
  id_jenis_magang: string;
  id_durasi_magang: string;
  deskripsi: string;
  kuota: number;
  gaji: string;
  status: string;
  tanggal_mulai_pendaftaran: string;
  tanggal_selesai_pendaftaran: string;
  keahlian: { id_keahlian: string; nama_keahlian: string }[];
}

declare global {
  interface Window {
    renderKeahlianBadges?: (
      keahlian: { id_keahlian: string; nama_keahlian: string }[]
    ) => void;
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const modal = document.querySelector<HTMLElement>('.modal-edit-lowongan');
  if (!modal) return;

  // Lebih aman: cari form di dalam modal
  const form = modal.querySelector('form') as HTMLFormElement | null;
  if (!form) return;

  const close = document.getElementById('close-edit-lowongan');
  if (!close) return;

  // Field references
  const perusahaan = form.querySelector<HTMLSelectElement>(
    "select[name='id_perusahaan_mitra']"
  );
  const bidang = form.querySelector<HTMLSelectElement>(
    "select[name='id_bidang']"
  );
  const periode = form.querySelector<HTMLSelectElement>(
    "select[name='id_periode']"
  );
  const jenis_lokasi = form.querySelector<HTMLSelectElement>(
    "select[name='id_jenis_lokasi']"
  );
  const jenis_magang = form.querySelector<HTMLSelectElement>(
    "select[name='id_jenis_magang']"
  );
  const durasi = form.querySelector<HTMLSelectElement>(
    "select[name='id_durasi_magang']"
  );
  const deskripsi = form.querySelector<HTMLTextAreaElement>(
    "textarea[name='deskripsi']"
  );
  const kuota = form.querySelector<HTMLInputElement>("input[name='kuota']");
  const gaji = form.querySelector<HTMLSelectElement>("select[name='gaji']");
  const status = form.querySelector<HTMLSelectElement>("select[name='status']");
  const tanggal_mulai = form.querySelector<HTMLInputElement>(
    "input[name='tanggal_mulai_pendaftaran']"
  );
  const tanggal_selesai = form.querySelector<HTMLInputElement>(
    "input[name='tanggal_selesai_pendaftaran']"
  );
  // Keahlian badge handled by JS

  document
    .querySelectorAll<HTMLAnchorElement>('.btn-edit-lowongan[data-id]')
    .forEach((button) => {
      button.addEventListener('click', async () => {
        const id = button.getAttribute('data-id');
        console.log('[Edit] Tombol diklik, id:', id);
        if (!id) return;

        try {
          const response = await axios.get<LowonganEdit>(
            `/admin/lowongan-magang/${id}/edit`,
            {
              headers: { Accept: 'application/json' },
            }
          );
          console.log('[Edit] Data dari server:', response.data);
          const data = response.data;

          // Isi form
          if (perusahaan) perusahaan.value = data.id_perusahaan_mitra ?? '';
          if (bidang) bidang.value = data.id_bidang ?? '';
          if (periode) periode.value = data.id_periode ?? '';
          if (jenis_lokasi) jenis_lokasi.value = data.id_jenis_lokasi ?? '';
          if (jenis_magang) jenis_magang.value = data.id_jenis_magang ?? '';
          if (durasi) durasi.value = data.id_durasi_magang ?? '';
          if (deskripsi) deskripsi.value = data.deskripsi ?? '';
          if (kuota) kuota.value = data.kuota?.toString() ?? '';
          if (gaji) gaji.value = data.gaji ?? '';
          if (status) status.value = data.status ?? '';
          if (tanggal_mulai)
            tanggal_mulai.value = data.tanggal_mulai_pendaftaran ?? '';
          if (tanggal_selesai)
            tanggal_selesai.value = data.tanggal_selesai_pendaftaran ?? '';

          window.renderKeahlianBadges = function (
            keahlian: { id_keahlian: string; nama_keahlian: string }[]
          ) {
            const container = document.getElementById('badge-keahlian-edit');
            const inputContainer = document.getElementById('input-keahlian-edit');
            if (!container || !inputContainer) return;
            container.innerHTML = '';
            inputContainer.innerHTML = '';

            keahlian.forEach(({ id_keahlian, nama_keahlian }) => {
              // Badge
              const badge = document.createElement('span');
              badge.className =
                'inline-flex items-center px-3 py-1 rounded-full border border-pink-400 text-pink-500 text-sm mb-1';
              badge.innerHTML = `<span class="mr-2" style="cursor:pointer;">&times;</span> ${nama_keahlian}`;
              // Tombol hapus badge
              badge.querySelector('span')?.addEventListener('click', () => {
                // Hapus badge dari array dan render ulang
                const newKeahlian = keahlian.filter(
                  (k) => k.id_keahlian !== id_keahlian
                );
                window.renderKeahlianBadges?.(newKeahlian);
                // Simpan ke state global jika perlu
                (window as any)._keahlianEdit = newKeahlian;
              });
              container.appendChild(badge);

              // Hidden input
              const input = document.createElement('input');
              input.type = 'hidden';
              input.name = 'id_keahlian[]';
              input.value = id_keahlian;
              inputContainer.appendChild(input);
            });

            // Simpan ke state global agar bisa diakses saat tambah/hapus
            (window as any)._keahlianEdit = keahlian;
          };

          // Keahlian: trigger badge render jika ada fungsi JS-nya
          if (
            window.renderKeahlianBadges &&
            typeof window.renderKeahlianBadges === 'function'
          ) {
            console.log('[Edit] Memanggil renderKeahlianBadges', data.keahlian);
            window.renderKeahlianBadges(data.keahlian);
          }

          // Set form action
          form.action = `/admin/lowongan-magang/${id}/edit`;

          // Tampilkan modal
          console.log('[Edit] Modal akan ditampilkan');
          modal.classList.remove('hidden');
          modal.classList.add('flex');
        } catch (err) {
          console.error('Gagal mengambil data lowongan:', err);
        }
      });
    });

  close.addEventListener('click', () => {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  });
  modal.addEventListener('click', (event) => {
    if (event.target === modal) {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }
  });
});
