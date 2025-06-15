import axios, { AxiosError } from 'axios';

interface LecturerLogDetail {
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
  const modal = document.getElementById('modal-detail-aktivitas') as HTMLElement;
  const fullscreen_modal = document.getElementById('foto-fullscreen-modal') as HTMLElement;
  if (!modal) return;

  const close_button = document.getElementById('close-detail-aktivitas') as HTMLElement;
  const close_fullscreen_button = document.getElementById('close-fullscreen') as HTMLElement;
  const foto_fullscreen_button = document.getElementById('foto-fullscreen') as HTMLElement;

  const fields = {
    minggu: document.getElementById('minggu_log') as HTMLElement,
    judul: document.getElementById('judul_log') as HTMLElement,
    nama_mahasiswa: document.getElementById('nama_mahasiswa') as HTMLElement,
    nim: document.getElementById('nim') as HTMLElement,
    status: document.getElementById('status') as HTMLElement,
    status_badge: document.getElementById('status_badge') as HTMLElement,
    deskripsi: document.getElementById('deskripsi') as HTMLElement,
    komentar: document.getElementById('komentar') as HTMLElement,
    konfirmasi_pada: document.getElementById('konfirmasi_pada') as HTMLElement,
    foto_profil: document.getElementById('foto_profil') as HTMLImageElement,
    foto_preview: document.getElementById('foto-preview') as HTMLImageElement,
    foto_container: document.getElementById('foto-container') as HTMLElement,
    no_foto: document.getElementById('no-foto') as HTMLElement,
    foto_fullscreen_img: document.getElementById('foto-fullscreen-img') as HTMLImageElement,
    foto_url_debug: document.getElementById('foto-url-debug') as HTMLElement,
  };

  const load_profile_photo = (url: string | null) => {
    const fallback = '/shared/profil.png';
    fields.foto_profil.onerror = null;

    if (!url || url.trim() === '') {
      fields.foto_profil.src = fallback;
      return;
    }

    fields.foto_profil.onerror = () => {
      console.warn('Failed to load profile photo:', url);
      fields.foto_profil.onerror = null;
      fields.foto_profil.src = fallback;
    };

    fields.foto_profil.src = url;
  };

  const apply_status_badge = (status: string) => {
    const badge = fields.status_badge;
    badge.className = 'hidden w-fit px-4 py-2 rounded-full text-sm font-medium lg:inline';
    badge.classList.remove('bg-green-100', 'text-green-800', 'bg-red-100', 'text-red-800', 'bg-yellow-100', 'text-yellow-800');

    switch (status) {
      case 'DISETUJUI':
        badge.classList.add('bg-green-100', 'text-green-800');
        break;
      case 'DITOLAK':
        badge.classList.add('bg-red-100', 'text-red-800');
        break;
      default:
        badge.classList.add('bg-yellow-100', 'text-yellow-800');
    }
  };

  const load_foto_preview = (foto_url: string | null) => {
    if (foto_url && foto_url.trim() !== '') {
      if (fields.foto_url_debug) fields.foto_url_debug.textContent = foto_url;

      fields.foto_preview.src = foto_url;
      fields.foto_fullscreen_img.src = foto_url;

      fields.foto_preview.onload = () => {
        fields.foto_container.classList.remove('hidden');
        fields.no_foto.classList.add('hidden');
      };

      fields.foto_preview.onerror = () => {
        console.error('Failed to load lecturer activity photo:', foto_url);
        fields.foto_container.classList.add('hidden');
        fields.no_foto.classList.remove('hidden');
        fields.no_foto.textContent = `Gagal memuat foto: ${foto_url}`;
      };
    } else {
      fields.foto_container.classList.add('hidden');
      fields.no_foto.classList.remove('hidden');
      fields.no_foto.textContent = 'Tidak ada bukti foto';
    }
  };

  const tampilkan_modal_detail = (data: LecturerLogDetail) => {
    fields.minggu.textContent = String(data.minggu);
    fields.judul.textContent = data.judul;
    fields.nama_mahasiswa.textContent = data.nama_mahasiswa;
    fields.nim.textContent = data.nim;
    fields.status.textContent = data.status;
    fields.deskripsi.textContent = data.deskripsi;
    fields.komentar.textContent = data.komentar || 'Belum ada komentar';
    fields.konfirmasi_pada.textContent = data.dikonfirmasi_pada || '-';

    load_profile_photo(data.foto_profil);
    apply_status_badge(data.status);
    load_foto_preview(data.foto);

    modal.classList.remove('hidden');
    modal.classList.add('flex');
  };

  const tampilkan_modal_error = (error: unknown) => {
    let pesan_error = 'Unknown error occurred';
    let detail_error = '';

    if (error instanceof AxiosError) {
      pesan_error = `HTTP ${error.response?.status}: ${error.message}`;
      detail_error = error.response?.data?.message || error.response?.data?.error || 'No additional details';

      console.error('Axios Error:', { status: error.response?.status, message: error.message, data: error.response?.data });
    } else if (error instanceof Error) {
      pesan_error = error.message;
      console.error('Generic Error:', error.message);
    } else {
      console.error('Unknown Error:', error);
    }

    console.error('Error details:', detail_error);

    fields.minggu.textContent = '-';
    fields.judul.textContent = 'Error Loading Data';
    fields.nama_mahasiswa.textContent = 'Error';
    fields.nim.textContent = 'Error';
    fields.status.textContent = 'Error';
    fields.deskripsi.textContent = `Failed to load data: ${pesan_error}`;
    fields.komentar.textContent = detail_error || 'No error details available';
    fields.konfirmasi_pada.textContent = '-';
    fields.foto_profil.src = '/shared/profil.png';

    fields.status_badge.className = 'px-4 py-2 rounded-full text-sm font-medium bg-red-100 text-red-800';
    fields.foto_container.classList.add('hidden');
    fields.no_foto.classList.remove('hidden');
    fields.no_foto.textContent = 'Error loading activity photo';

    modal.classList.remove('hidden');
    modal.classList.add('flex');
  };

  const handle_detail_click = async (id: string) => {
    try {
      const response = await axios.get<LecturerLogDetail>(`/dosen/log-aktivitas/${id}/detail`);
      tampilkan_modal_detail(response.data);
    } catch (error) {
      tampilkan_modal_error(error);
    }
  };

  document.addEventListener('click', async (e) => {
    const target = e.target as HTMLElement;
    const button = target.closest('button.dosen-detail-btn[data-log-id]') as HTMLButtonElement;
    if (!button) return;

    const log_id = button.getAttribute('data-log-id');
    const context = button.getAttribute('data-context');
    if (!log_id || context !== 'dosen') return;

    await handle_detail_click(log_id);
  });

  close_button?.addEventListener('click', () => {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  });

  foto_fullscreen_button?.addEventListener('click', () => {
    fullscreen_modal?.classList.remove('hidden');
    fullscreen_modal?.classList.add('flex');
  });

  close_fullscreen_button?.addEventListener('click', () => {
    fullscreen_modal?.classList.add('hidden');
    fullscreen_modal?.classList.remove('flex');
  });

  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }
  });

  fullscreen_modal?.addEventListener('click', (e) => {
    if (e.target === fullscreen_modal) {
      fullscreen_modal.classList.add('hidden');
      fullscreen_modal.classList.remove('flex');
    }
  });
});