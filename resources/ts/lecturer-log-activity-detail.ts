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
  const fullscreenModal = document.getElementById('foto-fullscreen-modal') as HTMLElement;
  if (!modal) return;

  const closeButton = document.getElementById('close-detail-aktivitas') as HTMLElement;
  const closeFullscreenButton = document.getElementById('close-fullscreen') as HTMLElement;
  const fotoFullscreenButton = document.getElementById('foto-fullscreen') as HTMLElement;
  
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

  // Handle detail buttons - gunakan class selector yang spesifik untuk dosen
  document.addEventListener('click', async (e) => {
    const target = e.target as HTMLElement;
    const button = target.closest('button.dosen-detail-btn[data-log-id]') as HTMLButtonElement;
    
    if (!button) return;
    
    const id = button.getAttribute('data-log-id');
    const context = button.getAttribute('data-context');
    
    if (!id || context !== 'dosen') return;

    console.log('Fetching lecturer log activity detail for ID:', id);

    try {
      // Updated URL path to match the route
      const response = await axios.get<LecturerLogDetail>(`/dosen/log-aktivitas/${id}/detail`);
      const data = response.data;

      console.log('Lecturer response data:', data);

      // Populate basic fields
      fields.minggu.textContent = String(data.minggu);
      fields.judul.textContent = data.judul;
      fields.nama_mahasiswa.textContent = data.nama_mahasiswa;
      fields.nim.textContent = data.nim;
      fields.status.textContent = data.status;
      fields.deskripsi.textContent = data.deskripsi;
      fields.komentar.textContent = data.komentar || 'Belum ada komentar';
      fields.konfirmasi_pada.textContent = data.dikonfirmasi_pada || '-';

      // Handle profile photo
      if (data.foto_profil) {
        fields.foto_profil.src = data.foto_profil;
        fields.foto_profil.onerror = () => {
          console.warn('Failed to load profile photo:', data.foto_profil);
          fields.foto_profil.src = '/images/default-avatar.png';
        };
      } else {
        fields.foto_profil.src = '/images/default-avatar.png';
      }

      // Handle status badge
      const statusBadge = fields.status_badge;
      statusBadge.className = 'px-4 py-2 rounded-full text-sm font-medium';
      
      if (data.status === 'DISETUJUI') {
        statusBadge.classList.add('bg-green-100', 'text-green-800');
      } else if (data.status === 'DITOLAK') {
        statusBadge.classList.add('bg-red-100', 'text-red-800');
      } else {
        statusBadge.classList.add('bg-yellow-100', 'text-yellow-800');
      }

      // Handle activity photo
      console.log('Lecturer activity photo URL:', data.foto);
      
      if (data.foto && data.foto !== null && data.foto.trim() !== '') {
        console.log('Setting lecturer activity photo:', data.foto);
        
        // Show debug URL if debug element exists
        if (fields.foto_url_debug) {
          fields.foto_url_debug.textContent = data.foto;
        }
        
        // Set images
        fields.foto_preview.src = data.foto;
        fields.foto_fullscreen_img.src = data.foto;
        
        // Handle image load success
        fields.foto_preview.onload = () => {
          console.log('Lecturer activity photo loaded successfully');
          fields.foto_container.classList.remove('hidden');
          fields.no_foto.classList.add('hidden');
        };
        
        // Handle image load error
        fields.foto_preview.onerror = () => {
          console.error('Failed to load lecturer activity photo:', data.foto);
          fields.foto_container.classList.add('hidden');
          fields.no_foto.classList.remove('hidden');
          fields.no_foto.textContent = `Gagal memuat foto: ${data.foto}`;
        };
        
      } else {
        console.log('No lecturer activity photo available');
        fields.foto_container.classList.add('hidden');
        fields.no_foto.classList.remove('hidden');
        fields.no_foto.textContent = 'Tidak ada bukti foto';
      }

      // Show modal
      modal.classList.remove('hidden');
      modal.classList.add('flex');
      
    } catch (error: unknown) {
      // Proper error handling dengan type checking
      let errorMessage = 'Unknown error occurred';
      let errorDetails = '';

      if (error instanceof AxiosError) {
        errorMessage = `HTTP ${error.response?.status}: ${error.message}`;
        errorDetails = error.response?.data?.message || error.response?.data?.error || 'No additional details';
        
        console.error('Axios Error fetching lecturer log activity:', {
          status: error.response?.status,
          statusText: error.response?.statusText,
          data: error.response?.data,
          message: error.message,
          url: error.config?.url
        });
      } else if (error instanceof Error) {
        errorMessage = error.message;
        console.error('Error fetching lecturer log activity:', error.message);
      } else {
        console.error('Unknown error fetching lecturer log activity:', error);
      }

      console.error('Error details:', errorDetails);
      
      // Show error state in modal
      fields.minggu.textContent = '-';
      fields.judul.textContent = 'Error Loading Data';
      fields.nama_mahasiswa.textContent = 'Error';
      fields.nim.textContent = 'Error';
      fields.status.textContent = 'Error';
      fields.deskripsi.textContent = `Failed to load data: ${errorMessage}`;
      fields.komentar.textContent = errorDetails || 'No error details available';
      fields.konfirmasi_pada.textContent = '-';
      fields.foto_profil.src = '/images/default-avatar.png';
      
      // Handle status badge for error state
      const statusBadge = fields.status_badge;
      statusBadge.className = 'px-4 py-2 rounded-full text-sm font-medium bg-red-100 text-red-800';
      
      fields.foto_container.classList.add('hidden');
      fields.no_foto.classList.remove('hidden');
      fields.no_foto.textContent = 'Error loading activity photo';
      
      // Show modal even in error state so user can see what went wrong
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }
  });

  // Modal close handlers
  closeButton?.addEventListener('click', () => {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  });

  fotoFullscreenButton?.addEventListener('click', () => {
    if (fullscreenModal) {
      fullscreenModal.classList.remove('hidden');
      fullscreenModal.classList.add('flex');
    }
  });

  closeFullscreenButton?.addEventListener('click', () => {
    if (fullscreenModal) {
      fullscreenModal.classList.add('hidden');
      fullscreenModal.classList.remove('flex');
    }
  });

  // Close on outside click
  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }
  });

  fullscreenModal?.addEventListener('click', (e) => {
    if (e.target === fullscreenModal) {
      fullscreenModal.classList.add('hidden');
      fullscreenModal.classList.remove('flex');
    }
  });
});