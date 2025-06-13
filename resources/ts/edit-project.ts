import axios from 'axios';

interface ProyekEdit {
  id_proyek: string;
  nama_proyek: string;
  peran: string;
  deskripsi: string;
  tautan: string;
  alat: string[];
  tanggal_mulai: string;
  tanggal_selesai: string;
}

document.addEventListener('DOMContentLoaded', () => {
  const modal = document.querySelector<HTMLElement>('.modal-edit-proyek-mahasiswa');
  if (modal == null) return;

  const form = modal.querySelector('form') as HTMLFormElement | null;
  const close = modal.querySelector('.close-modal-project');
  if (form == null || close == null) return;

  const nama = form.querySelector<HTMLInputElement>('input[name="edit_nama_proyek"]');
  const peran = form.querySelector<HTMLInputElement>('input[name="edit_peran_proyek"]');
  const deskripsi = form.querySelector<HTMLTextAreaElement>('textarea[name="edit_deskripsi_proyek"]');
  const tautan = form.querySelector<HTMLInputElement>('input[name="edit_tautan_proyek"]');
  const tanggal_mulai = form.querySelector<HTMLInputElement>('input[name="edit_tanggal_mulai_proyek"]');
  const tanggal_selesai = form.querySelector<HTMLInputElement>('input[name="edit_tanggal_selesai_proyek"]');
  const keahlian = form.querySelector<HTMLSelectElement>('#tools-select');
  const badge = form.querySelector<HTMLElement>('#badge-tools');
  const input = form.querySelector<HTMLElement>('#input-tools');
  if (nama == null || peran == null || deskripsi == null || tautan == null || tanggal_mulai == null || tanggal_selesai == null || keahlian == null || badge == null || input == null) return;

  let keahlian_terpilih: { id: string; nama: string }[] = [];

  function renderKeahlian() {
    if (!badge || !input) return;
    badge.innerHTML = '';
    input.innerHTML = '';

    keahlian_terpilih.forEach(({ id, nama }) => {
      const badge_element = document.createElement('span');
      badge_element.className = 'inline-flex items-center px-3 py-1 rounded-full border border-pink-400 text-pink-500 text-sm mb-1';
      badge_element.innerHTML = `<span class="mr-2" style="cursor:pointer;">&times;</span> ${nama}`;

      (badge_element.querySelector('span') as HTMLSpanElement).addEventListener('click', () => {
        keahlian_terpilih = keahlian_terpilih.filter(k => k.id !== id);
        renderKeahlian();
      });

      badge.appendChild(badge_element);

      const hidden = document.createElement('input');
      hidden.type = 'hidden';
      hidden.name = 'edit_alat_proyek[]';
      hidden.value = id;
      input.appendChild(hidden);
    });
  }

  document.querySelectorAll<HTMLButtonElement>('.edit-project[data-id]').forEach(button => {
    button.addEventListener('click', async () => {
      const id = button.dataset.id;
      if (!id) return;

      try {
        const response = await axios.get<ProyekEdit>(`/mahasiswa/profil/proyek/${id}/edit`, {
          headers: { Accept: 'application/json' },
        });

        const data = response.data;

        if (nama) nama.value = data.nama_proyek ?? '';
        if (peran) peran.value = data.peran ?? '';
        if (deskripsi) deskripsi.value = data.deskripsi ?? '';
        if (tautan) tautan.value = data.tautan ?? '';
        if (tanggal_mulai) tanggal_mulai.value = data.tanggal_mulai ?? '';
        if (tanggal_selesai) tanggal_selesai.value = data.tanggal_selesai ?? '';

        keahlian_terpilih = data.alat.map((nama) => ({ id: nama, nama }));
        renderKeahlian();

        form.action = `/mahasiswa/profil/proyek/${id}/edit`;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
      } catch (error) {
        console.error('Gagal mengambil data proyek:', error);
      }
    });
  });

  close.addEventListener('click', () => {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  });

  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }
  });

  const tambah = form.querySelector<HTMLButtonElement>('#add-tools');
  if (tambah == null) return;
  
  tambah.addEventListener('click', () => {
    const id = keahlian.value;
    const nama = keahlian.options[keahlian.selectedIndex].text;

    if (!id || keahlian_terpilih.some(k => k.id === id)) return;
    keahlian_terpilih.push({ id, nama });
    renderKeahlian();
    if (keahlian) keahlian.value = '';
  });
});