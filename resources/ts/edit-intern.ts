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
    keahlian?: (
      keahlian: { id_keahlian: string; nama_keahlian: string }[]
    ) => void;
    edit_keahlian?: { id_keahlian: string; nama_keahlian: string }[];
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const modal_edit_lowongan = document.querySelector<HTMLElement>('.modal-edit-lowongan');
  if (!modal_edit_lowongan) return;

  const form_edit_lowongan = modal_edit_lowongan.querySelector('form') as HTMLFormElement | null;
  if (!form_edit_lowongan) return;

  const close_button = document.getElementById('close-edit-lowongan');
  if (!close_button) return;

  const perusahaan_select = form_edit_lowongan.querySelector<HTMLSelectElement>("select[name='id_perusahaan_mitra']");
  const bidang_select = form_edit_lowongan.querySelector<HTMLSelectElement>("select[name='id_bidang']");
  const periode_select = form_edit_lowongan.querySelector<HTMLSelectElement>("select[name='id_periode']");
  const jenis_lokasi_select = form_edit_lowongan.querySelector<HTMLSelectElement>("select[name='id_jenis_lokasi']");
  const jenis_magang_select = form_edit_lowongan.querySelector<HTMLSelectElement>("select[name='id_jenis_magang']");
  const durasi_select = form_edit_lowongan.querySelector<HTMLSelectElement>("select[name='id_durasi_magang']");
  const deskripsi_textarea = form_edit_lowongan.querySelector<HTMLTextAreaElement>("textarea[name='deskripsi']");
  const kuota_input = form_edit_lowongan.querySelector<HTMLInputElement>("input[name='kuota']");
  const gaji_select = form_edit_lowongan.querySelector<HTMLSelectElement>("select[name='gaji']");
  const status_select = form_edit_lowongan.querySelector<HTMLSelectElement>("select[name='status']");
  const tanggal_mulai_input = form_edit_lowongan.querySelector<HTMLInputElement>("input[name='tanggal_mulai_pendaftaran']");
  const tanggal_selesai_input = form_edit_lowongan.querySelector<HTMLInputElement>("input[name='tanggal_selesai_pendaftaran']");

  document.querySelectorAll<HTMLAnchorElement>('.btn-edit-lowongan[data-id]').forEach((button) => {
    button.addEventListener('click', async () => {
      const id = button.getAttribute('data-id');
      if (!id) return;

      try {
        const response = await axios.get<LowonganEdit>(`/admin/lowongan-magang/${id}/edit`, {
          headers: { Accept: 'application/json' },
        });

        const data = response.data;

        if (perusahaan_select) perusahaan_select.value = data.id_perusahaan_mitra ?? '';
        if (bidang_select) bidang_select.value = data.id_bidang ?? '';
        if (periode_select) periode_select.value = data.id_periode ?? '';
        if (jenis_lokasi_select) jenis_lokasi_select.value = data.id_jenis_lokasi ?? '';
        if (jenis_magang_select) jenis_magang_select.value = data.id_jenis_magang ?? '';
        if (durasi_select) durasi_select.value = data.id_durasi_magang ?? '';
        if (deskripsi_textarea) deskripsi_textarea.value = data.deskripsi ?? '';
        if (kuota_input) kuota_input.value = data.kuota?.toString() ?? '';
        if (gaji_select) gaji_select.value = data.gaji ?? '';
        if (status_select) status_select.value = data.status ?? '';
        if (tanggal_mulai_input) tanggal_mulai_input.value = data.tanggal_mulai_pendaftaran ?? '';
        if (tanggal_selesai_input) tanggal_selesai_input.value = data.tanggal_selesai_pendaftaran ?? '';

        window.keahlian = function (keahlian: { id_keahlian: string; nama_keahlian: string }[]) {
          const badge_container = document.getElementById('badge-keahlian-edit');
          const input_container = document.getElementById('input-keahlian-edit');
          if (!badge_container || !input_container) return;

          badge_container.innerHTML = '';
          input_container.innerHTML = '';

          keahlian.forEach(({ id_keahlian, nama_keahlian }) => {
            const badge = document.createElement('span');
            badge.className = 'inline-flex items-center px-3 py-1 rounded-full border border-pink-400 text-pink-500 text-sm mb-1';
            badge.innerHTML = `<span class="mr-2" style="cursor:pointer;">&times;</span> ${nama_keahlian}`;

            badge.querySelector('span')?.addEventListener('click', () => {
              const updated_keahlian = keahlian.filter((k) => k.id_keahlian !== id_keahlian);
              window.keahlian?.(updated_keahlian);
              window.edit_keahlian = updated_keahlian;
            });

            badge_container.appendChild(badge);

            const hidden_input = document.createElement('input');
            hidden_input.type = 'hidden';
            hidden_input.name = 'id_keahlian[]';
            hidden_input.value = id_keahlian;
            input_container.appendChild(hidden_input);
          });

          window.edit_keahlian = keahlian;
        };

        if (window.keahlian) window.keahlian(data.keahlian);

        form_edit_lowongan.action = `/admin/lowongan-magang/${id}/edit`;
        modal_edit_lowongan.classList.remove('hidden');
        modal_edit_lowongan.classList.add('flex');
      } catch (err) {
        console.error('Gagal mengambil data lowongan:', err);
      }
    });
  });

  close_button.addEventListener('click', () => {
    modal_edit_lowongan.classList.add('hidden');
    modal_edit_lowongan.classList.remove('flex');
  });

  modal_edit_lowongan.addEventListener('click', (event) => {
    if (event.target === modal_edit_lowongan) {
      modal_edit_lowongan.classList.add('hidden');
      modal_edit_lowongan.classList.remove('flex');
    }
  });
});