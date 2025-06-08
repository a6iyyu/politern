interface Perusahaan {
  nama: string;
  nib: string;
  nomor_telepon: string;
  email: string;
  website: string;
  status: string;
  id_lokasi: string;
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
  const id_lokasi = document.getElementById('id_lokasi');
  if (!nama || !nib || !nomor_telepon || !email || !website || !status || !id_lokasi) return;

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
      status.textContent = data.perusahaan.status;
      id_lokasi.textContent = data.perusahaan.id_lokasi;

      modal.classList.remove('hidden');
    });
  });

  close.addEventListener('click', () => modal.classList.add('hidden'));
});
