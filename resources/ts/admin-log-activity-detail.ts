import axios from 'axios';

interface AdminLogDetail {
  minggu: number;
  judul: string;
  deskripsi: string;
  foto: string | null;
  foto_profil: string;
  nama_mahasiswa: string;
  nim: string;
  status: string;
  komentar: string;
  dikonfirmasi_pada: string | null;
}

document.addEventListener('DOMContentLoaded', () => {
  const element = (id: string): HTMLElement => document.getElementById(id) as HTMLElement;
  const image = (id: string): HTMLImageElement => document.getElementById(id) as HTMLImageElement;

  const modal = element('modal-detail-aktivitas-admin');
  const fullscreen_modal = element('foto-fullscreen-modal-admin');
  const close_btn = element('close-detail-aktivitas-admin');
  const close_fullscreen_btn = element('close-fullscreen-admin');
  const fullscreen_img_trigger = element('foto-fullscreen-admin');

  const fields = {
    minggu: element('minggu_log_admin'),
    judul: element('judul_log_admin'),
    nama_mahasiswa: element('nama_mahasiswa_admin'),
    nim: element('nim_admin'),
    status: element('status_admin'),
    status_badge: element('status_badge_admin'),
    deskripsi: element('deskripsi_admin'),
    komentar: element('komentar_admin'),
    konfirmasi_pada: element('konfirmasi_pada_admin'),
    foto_profil: image('foto_profil_admin'),
    foto_preview: image('foto-preview-admin'),
    foto_container: element('foto-container-admin'),
    no_foto: element('no-foto-admin'),
    foto_fullscreen_img: image('foto-fullscreen-img-admin'),
  };

  document.addEventListener('click', async (e) => {
    const target = e.target as HTMLElement;
    const btn = target.closest('button.admin-detail-btn[data-log-id]') as HTMLButtonElement;
    if (!btn || btn.getAttribute('data-context') !== 'admin') return;

    const id = btn.getAttribute('data-log-id');
    if (!id) return;

    try {
      const { data } = await axios.get<AdminLogDetail>(`/admin/aktivitas-magang/${id}/detail`);
      populate_fields(data);
      toggle_modal(modal, true);
    } catch (err) {
      console.error('Gagal mengambil data log aktivitas:', err);
      fields.deskripsi.textContent = 'Error loading data';
      toggle_modal(modal, true);
    }
  });

  close_btn?.addEventListener('click', () => toggle_modal(modal, false));
  fullscreen_img_trigger?.addEventListener('click', () => toggle_modal(fullscreen_modal, true));
  close_fullscreen_btn?.addEventListener('click', () => toggle_modal(fullscreen_modal, false));

  modal?.addEventListener('click', (e) => {
    if (e.target === modal) toggle_modal(modal, false);
  });

  fullscreen_modal?.addEventListener('click', (e) => {
    if (e.target === fullscreen_modal) toggle_modal(fullscreen_modal, false);
  });

  const toggle_modal = (el: HTMLElement | null, show: boolean): void => {
    if (!el) return;
    el.classList.toggle('hidden', !show);
    el.classList.toggle('flex', show);
  };

  const populate_fields = (data: AdminLogDetail): void => {
    fields.minggu.textContent = String(data.minggu);
    fields.judul.textContent = data.judul;
    fields.nama_mahasiswa.textContent = data.nama_mahasiswa;
    fields.nim.textContent = data.nim;
    fields.status.textContent = data.status;
    fields.deskripsi.textContent = data.deskripsi;
    fields.komentar.textContent = data.komentar || 'Belum ada komentar';
    fields.konfirmasi_pada.textContent = data.dikonfirmasi_pada || '-';
    fields.foto_profil.src = data.foto_profil || '/images/default-avatar.png';

    update_badge(data.status);
    handle_foto(data.foto);
  };

  const update_badge = (status: string): void => {
    const badge = fields.status_badge;
    badge.className = 'px-4 py-2 rounded-full text-xs font-medium w-fit hidden lg:inline';

    const status_classes: Record<string, string[]> = {
      DISETUJUI: ['bg-green-100', 'text-green-800'],
      DITOLAK: ['bg-red-100', 'text-red-800'],
      MENUNGGU: ['bg-yellow-100', 'text-yellow-800'],
    };

    badge.classList.add(...(status_classes[status] || []));
  };

  const handle_foto = (foto_url: string | null): void => {
    const valid = !!foto_url && foto_url.trim() !== '';
    if (!valid) return tampilkan_tidak_ada_foto('Tidak ada bukti foto');

    const final_url = normalisasi_url(foto_url);
    fields.foto_preview.src = final_url;
    fields.foto_fullscreen_img.src = final_url;

    fields.foto_preview.onload = () => {
      fields.foto_container.classList.remove('hidden');
      fields.no_foto.classList.add('hidden');
    };

    fields.foto_preview.onerror = () => {
      tampilkan_tidak_ada_foto('Gagal memuat foto');
    };
  };

  const tampilkan_tidak_ada_foto = (pesan: string): void => {
    fields.foto_container.classList.add('hidden');
    fields.no_foto.classList.remove('hidden');
    fields.no_foto.textContent = pesan;
  };

  const normalisasi_url = (path: string): string => {
    if (path.startsWith('/storage/')) return path;
    if (path.startsWith('storage/')) return `/${path}`;
    return `/storage/${path}`;
  };
});