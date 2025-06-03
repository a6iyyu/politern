interface Periode {
    nama_periode: string;
    durasi: string;
    tanggal_mulai: string;
    tanggal_selesai: string;
    status: string;
  }
  
  interface Modal {
    periode: Periode;
  }
  
  // Fungsi bantu format tanggal ke YYYY-MM-DD untuk input date
  function formatDateToInput(dateStr: string): string {
    const d = new Date(dateStr);
    const year = d.getFullYear();
    const month = (d.getMonth() + 1).toString().padStart(2, '0');
    const day = d.getDate().toString().padStart(2, '0');
    return `${year}-${month}-${day}`;
  }
  
  document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll<HTMLAnchorElement>('.edit[data-id]');
    const modal = document.querySelector<HTMLElement>('.modal-edit-periode');
    if (!buttons || !modal) return;
  
    const close = modal.querySelector('.close') as HTMLElement;
    const form = modal.querySelector('form') as HTMLFormElement;
    if (!close || !form) return;
  
    const inputNamaPeriode = form.querySelector<HTMLInputElement>("input[name='nama_periode']");
    const inputDurasi = form.querySelector<HTMLSelectElement>("select[name='durasi']");
    const inputTanggalMulai = form.querySelector<HTMLInputElement>("input[name='tanggal_mulai']");
    const inputTanggalSelesai = form.querySelector<HTMLInputElement>("input[name='tanggal_selesai']");
    const inputStatus = form.querySelector<HTMLSelectElement>("select[name='status']");
  
    const fetchPeriodeData = async (id: string): Promise<Modal | null> => {
      try {
        const response = await fetch(`/admin/periode-magang/${id}/edit`, {
          headers: {
            Accept: 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
          },
        });
        if (!response.ok) throw new Error('Gagal mengambil data periode.');
        return (await response.json()) as Modal;
      } catch (error) {
        console.error(error);
        return null;
      }
    };
  
    buttons.forEach((btn) => {
      btn.addEventListener('click', async () => {
        const id = btn.dataset.id;
        if (!id || !modal || !form) return;
  
        const data = await fetchPeriodeData(id);
        console.log('Fetching data for id:', id);
        console.log('Data received:', data);
        if (!data) return;
  
        // Set action form secara dinamis
        form.action = `/admin/periode-magang/${id}/perbarui`;
  
        // Set value input dengan data dari API
        if (inputNamaPeriode) inputNamaPeriode.value = data.periode.nama_periode;
        if (inputDurasi) inputDurasi.value = data.periode.durasi;
        if (inputTanggalMulai) inputTanggalMulai.value = formatDateToInput(data.periode.tanggal_mulai);
        if (inputTanggalSelesai) inputTanggalSelesai.value = formatDateToInput(data.periode.tanggal_selesai);
        if (inputStatus) inputStatus.value = data.periode.status;
  
        // Setelah data diisi, tampilkan modal
        modal.classList.remove('hidden');
      });
    });
  
    close.addEventListener('click', () => {
      modal.classList.add('hidden');
      form.reset(); // reset form saat modal ditutup
    });
  
    modal.addEventListener('click', (event) => {
      if (event.target === modal) {
        modal.classList.add('hidden');
        form.reset();
      }
    });
  });
  