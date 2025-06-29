interface Student {
  nama_pengguna: string;
  email: string;
  nim: string;
  nama_lengkap: string;
  angkatan: string;
  semester: string;
  nama_prodi: string;
  ipk: number;
  status: string;
}

interface Prodi {
  nama: string;
}

interface Status {
  status: string;
}

interface Edit {
  mahasiswa: Student;
  pengguna: User;
  prodi: Prodi;
  status: Status;
}

document.addEventListener('DOMContentLoaded', () => {
  const buttons = document.querySelectorAll<HTMLAnchorElement>('.edit[data-id]');
  const modal = document.querySelector<HTMLElement>('.modal-edit-mahasiswa');
  if (!buttons || !modal) return;

  const close = modal.querySelector('.close') as HTMLElement;
  const form = modal.querySelector('#form-edit-mahasiswa') as HTMLFormElement;
  if (!close || !form) return;

  const nim = form.querySelector<HTMLInputElement>("input[name='nim']");
  const nama_lengkap = form.querySelector<HTMLInputElement>("input[name='nama_lengkap']");
  const angkatan = form.querySelector<HTMLSelectElement>("select[name='angkatan']");
  const semester = form.querySelector<HTMLInputElement>("input[name='semester']");
  const nama_prodi = form.querySelector<HTMLSelectElement>("select[name='program_studi']");
  const ipk = form.querySelector<HTMLInputElement>("input[name='ipk']");
  const status = form.querySelector<HTMLSelectElement>("select[name='status']");

  const fetchMahasiswaData = async (id: string): Promise<Edit | null> => {
    try {
      const response = await fetch(`/admin/data-mahasiswa/${id}/edit`, {
        headers: {
          Accept: 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        },
      });

      if (!response.ok) throw new Error('Gagal mengambil data mahasiswa.');
      return (await response.json()) as Edit;
    } catch (error) {
      console.error(error);
      return null;
    }
  };

  buttons.forEach((btn) => {
    btn.addEventListener('click', async () => {
      const id = btn.dataset.id;
      if (!id || !modal || !form) return;

      form.action = `/admin/data-mahasiswa/${id}/perbarui`;

      const data = await fetchMahasiswaData(id);
      if (!data) return;

      modal.classList.remove('hidden');

      if (nim) nim.value = data.mahasiswa.nim;
      if (nama_lengkap) nama_lengkap.value = data.mahasiswa.nama_lengkap;
      if (angkatan) angkatan.value = data.mahasiswa.angkatan;
      if (semester) semester.value = data.mahasiswa.semester;
      if (nama_prodi) nama_prodi.value = data.mahasiswa.nama_prodi;
      if (ipk) ipk.value = (Math.round(data.mahasiswa.ipk * 100) / 100).toString();
      if (status) status.value = data.status.status;
    });
  });

  close.addEventListener('click', () => modal.classList.add('hidden'));

  modal.addEventListener('click', (event) => {
    if (event.target === modal) modal.classList.add('hidden');
  });
});