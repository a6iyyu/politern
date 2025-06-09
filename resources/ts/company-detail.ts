interface Perusahaan {
  nama: string;
  nib: string;
  nomor_telepon: string;
  email: string;
  website: string;
  status: string;
  id_lokasi: string;
  created_at: string;
  logo?: string;
}

interface Modal {
  perusahaan: Perusahaan;
}

document.addEventListener('DOMContentLoaded', () => {
  const buttons = document.querySelectorAll<HTMLAnchorElement>('.detail[data-id]');
  const modal = document.getElementById('modal-detail-perusahaan') as HTMLElement;
  const close = document.getElementById('close-detail') as HTMLElement;
  if (!buttons.length || !close || !modal) return;

  const nama = document.getElementById('nama');
  const nib = document.getElementById('nib');
  const nomor_telepon = document.getElementById('nomor_telepon');
  const email = document.getElementById('email');
  const website = document.getElementById('website');
  const status = document.getElementById('status');
  const tanggal_dibuat = document.getElementById('tanggal_dibuat');
  const logo_perusahaan = document.getElementById('logo_perusahaan') as HTMLImageElement;
  if (!nama || !nib || !nomor_telepon || !email || !website || !status || !tanggal_dibuat || !logo_perusahaan) return;

  const fetchCompanyData = async (id: string): Promise<Modal | null> => {
    try {
      const response = await fetch(`/admin/data-perusahaan/${id}/detail`, {
        headers: {
          Accept: 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        },
      });

      if (!response.ok) throw new Error('Gagal memuat data');
      return await response.json();
    } catch (error) {
      console.error(error);
      return null;
    }
  };

  buttons.forEach((button) => {
    button.addEventListener('click', async (event) => {
      event.preventDefault();

      const id = button.dataset.id;
      if (!id) return;

      const data = await fetchCompanyData(id);
      if (!data || !data.perusahaan) return;

      nama.textContent = data.perusahaan.nama;
      nib.textContent = data.perusahaan.nib;
      nomor_telepon.textContent = data.perusahaan.nomor_telepon;
      email.textContent = data.perusahaan.email;
      website.textContent = data.perusahaan.website;
      logo_perusahaan.src = data.perusahaan.logo ? `/storage/${data.perusahaan.logo.replace('storage/', '')}` : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=';

      tanggal_dibuat.textContent = new Date(data.perusahaan.created_at).toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
      });

      const statusText = data.perusahaan.status;
      status.textContent = statusText;
      status.classList.remove('bg-green-100', 'text-green-700', 'bg-red-100', 'text-red-700', 'bg-yellow-100', 'text-yellow-700');

      const lowerStatus = statusText.toLowerCase();
      if (lowerStatus === 'aktif') {
        status.classList.add('bg-green-100', 'text-green-700');
      } else if (lowerStatus === 'tidak aktif') {
        status.classList.add('bg-red-100', 'text-red-700');
      } else {
        status.classList.add('bg-yellow-100', 'text-yellow-700');
      }

      modal.classList.remove('hidden');
    });
  });

  close.addEventListener('click', () => modal.classList.add('hidden'));
});