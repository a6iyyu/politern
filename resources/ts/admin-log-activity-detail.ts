import axios, { AxiosError } from 'axios';

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
  console.log('Admin log activity detail script loaded');
  
  // Check if modal exists
  const modal = document.getElementById('modal-detail-aktivitas-admin') as HTMLElement;
  if (!modal) {
    console.error('Admin modal not found - ID: modal-detail-aktivitas-admin');
    console.log('Available elements with "modal" in ID:', 
      Array.from(document.querySelectorAll('[id*="modal"]')).map(el => el.id)
    );
    return;
  }
  
  console.log('Admin modal found successfully');

  const fullscreenModal = document.getElementById('foto-fullscreen-modal-admin') as HTMLElement;
  const closeButton = document.getElementById('close-detail-aktivitas-admin') as HTMLElement;
  const closeFullscreenButton = document.getElementById('close-fullscreen-admin') as HTMLElement;
  const fotoFullscreenButton = document.getElementById('foto-fullscreen-admin') as HTMLElement;
  
  const fields = {
    minggu: document.getElementById('minggu_log_admin') as HTMLElement,
    judul: document.getElementById('judul_log_admin') as HTMLElement,
    nama_mahasiswa: document.getElementById('nama_mahasiswa_admin') as HTMLElement,
    nim: document.getElementById('nim_admin') as HTMLElement,
    status: document.getElementById('status_admin') as HTMLElement,
    status_badge: document.getElementById('status_badge_admin') as HTMLElement,
    deskripsi: document.getElementById('deskripsi_admin') as HTMLElement,
    komentar: document.getElementById('komentar_admin') as HTMLElement,
    konfirmasi_pada: document.getElementById('konfirmasi_pada_admin') as HTMLElement,
    foto_profil: document.getElementById('foto_profil_admin') as HTMLImageElement,
    foto_preview: document.getElementById('foto-preview-admin') as HTMLImageElement,
    foto_container: document.getElementById('foto-container-admin') as HTMLElement,
    no_foto: document.getElementById('no-foto-admin') as HTMLElement,
    foto_fullscreen_img: document.getElementById('foto-fullscreen-img-admin') as HTMLImageElement,
  };

  // Debug: check if all fields exist
  console.log('Admin fields check:', Object.entries(fields).map(([key, element]) => ({
    field: key,
    found: !!element,
    id: element?.id || 'not found'
  })));

  // Check if buttons exist
  console.log('Admin buttons found:', {
    adminButtons: document.querySelectorAll('button.admin-detail-btn').length,
    sampleButton: document.querySelector('button.admin-detail-btn')
  });

  // Handle admin detail buttons
  document.addEventListener('click', async (e) => {
    const target = e.target as HTMLElement;
    console.log('Click detected on:', target.tagName, target.className);
    
    const button = target.closest('button.admin-detail-btn[data-log-id]') as HTMLButtonElement;
    
    if (!button) {
      console.log('Not an admin detail button');
      return;
    }
    
    const id = button.getAttribute('data-log-id');
    const context = button.getAttribute('data-context');
    
    console.log('Admin button clicked:', { id, context, button });
    
    if (!id || context !== 'admin') {
      console.log('Invalid button data:', { id, context });
      return;
    }

    console.log('Fetching admin log activity detail for ID:', id);

    try {
      const response = await axios.get<AdminLogDetail>(`/admin/aktivitas-magang/${id}/detail`);
      const data = response.data;

      console.log('Admin response data:', data);

      // Populate fields
      if (fields.minggu) fields.minggu.textContent = String(data.minggu);
      if (fields.judul) fields.judul.textContent = data.judul;
      if (fields.nama_mahasiswa) fields.nama_mahasiswa.textContent = data.nama_mahasiswa;
      if (fields.nim) fields.nim.textContent = data.nim;
      if (fields.status) fields.status.textContent = data.status;
      if (fields.deskripsi) fields.deskripsi.textContent = data.deskripsi;
      if (fields.komentar) fields.komentar.textContent = data.komentar || 'Belum ada komentar';
      if (fields.konfirmasi_pada) fields.konfirmasi_pada.textContent = data.dikonfirmasi_pada || '-';

      // Handle profile photo
      if (fields.foto_profil) {
        fields.foto_profil.src = data.foto_profil || '/images/default-avatar.png';
      }

      // Handle status badge
      if (fields.status_badge) {
        const statusBadge = fields.status_badge;
        statusBadge.className = 'px-4 py-2 rounded-full text-sm font-medium';
        
        if (data.status === 'DISETUJUI') {
          statusBadge.classList.add('bg-green-100', 'text-green-800');
        } else if (data.status === 'DITOLAK') {
          statusBadge.classList.add('bg-red-100', 'text-red-800');
        } else {
          statusBadge.classList.add('bg-yellow-100', 'text-yellow-800');
        }
      }

      // Handle activity photo
      if (data.foto && data.foto.trim() !== '') {
        if (fields.foto_preview && fields.foto_fullscreen_img) {
          fields.foto_preview.src = data.foto;
          fields.foto_fullscreen_img.src = data.foto;
          
          fields.foto_preview.onload = () => {
            if (fields.foto_container) fields.foto_container.classList.remove('hidden');
            if (fields.no_foto) fields.no_foto.classList.add('hidden');
          };
          
          fields.foto_preview.onerror = () => {
            if (fields.foto_container) fields.foto_container.classList.add('hidden');
            if (fields.no_foto) {
              fields.no_foto.classList.remove('hidden');
              fields.no_foto.textContent = 'Gagal memuat foto';
            }
          };
        }
      } else {
        if (fields.foto_container) fields.foto_container.classList.add('hidden');
        if (fields.no_foto) {
          fields.no_foto.classList.remove('hidden');
          fields.no_foto.textContent = 'Tidak ada bukti foto';
        }
      }

      // Show modal
      modal.classList.remove('hidden');
      modal.classList.add('flex');
      console.log('Admin modal shown');
      
    } catch (error: unknown) {
      console.error('Error fetching admin log activity:', error);
      
      // Show error in modal
      if (fields.deskripsi) fields.deskripsi.textContent = 'Error loading data';
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