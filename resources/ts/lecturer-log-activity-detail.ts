import axios from 'axios';

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

  // Handle detail buttons
  document.addEventListener('click', async (e) => {
    const target = e.target as HTMLElement;
    const button = target.closest('button[data-log-id]') as HTMLButtonElement;
    
    if (!button) return;
    
    const id = button.getAttribute('data-log-id');
    if (!id) return;

    console.log('Fetching log activity detail for ID:', id);

    try {
      const response = await axios.get<LecturerLogDetail>(`/dosen/log-aktivitas/${id}/detail`);
      const data = response.data;

      console.log('Response data:', data);

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
      console.log('Activity photo URL from API:', data.foto);
      
      if (data.foto && data.foto !== null && data.foto.trim() !== '') {
        console.log('Setting activity photo:', data.foto);
        
        // Show debug URL
        fields.foto_url_debug.textContent = data.foto;
        
        // Set images
        fields.foto_preview.src = data.foto;
        fields.foto_fullscreen_img.src = data.foto;
        
        // Handle image load success
        fields.foto_preview.onload = () => {
          console.log('Activity photo loaded successfully');
          fields.foto_container.classList.remove('hidden');
          fields.no_foto.classList.add('hidden');
        };
        
        // Handle image load error
        fields.foto_preview.onerror = () => {
          console.error('Failed to load activity photo:', data.foto);
          fields.foto_container.classList.add('hidden');
          fields.no_foto.classList.remove('hidden');
          fields.no_foto.textContent = `Gagal memuat foto: ${data.foto}`;
        };
        
      } else {
        console.log('No activity photo available');
        fields.foto_container.classList.add('hidden');
        fields.no_foto.classList.remove('hidden');
        fields.no_foto.textContent = 'Tidak ada bukti foto';
      }

      // Show modal
      modal.classList.remove('hidden');
      modal.classList.add('flex');
      
    } catch (err) {
      console.error('Error fetching log activity:', err);
      
      // Show error state
      Object.keys(fields).forEach(key => {
        const field = fields[key as keyof typeof fields];
        if (field && field.textContent !== undefined) {
          field.textContent = 'Error loading data';
        }
      });
      
      fields.foto_container.classList.add('hidden');
      fields.no_foto.classList.remove('hidden');
      fields.no_foto.textContent = 'Gagal memuat data aktivitas';
      
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