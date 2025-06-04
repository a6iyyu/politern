document.addEventListener('DOMContentLoaded', () => {
  const buttons = document.querySelectorAll<HTMLAnchorElement>('.detail[data-id]');
  const modal = document.getElementById('modal-detail-mahasiswa') as HTMLElement;
  const close = document.getElementById('close-detail') as HTMLElement;
  if (!buttons.length || !close || !modal) return;

  const fetchCompanyData = async (id: string) => {
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
      if (!data) return;

      modal.classList.remove('hidden');
    });
  });

  close.addEventListener('click', () => modal.classList.add('hidden'));
});