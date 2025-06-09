<section class="modal modal-edit-lowongan fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <figure class="min-h-screen flex items-center justify-center w-full px-4">
        <form method="POST" id="form-edit-lowongan" class="max-h-[90vh] overflow-y-auto w-full max-w-2xl rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('PUT')
            <figcaption class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-[#5955B2]">Edit Lowongan Magang</h2>
                <button id="close-edit-lowongan" type="button" class="text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-xmark close"></i>
                </button>
            </figcaption>
            <hr class="border border-[var(--primary)] mb-6 " />
            <figcaption class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-select label="Perusahaan" name="id_perusahaan_mitra" :options="$perusahaan" :required="true" />
                <x-select label="Bidang Posisi Magang" name="id_bidang" :options="$bidang" :required="true" />
                <span class="md:col-span-2">
                    <label for="keahlian-select-edit" class="block text-sm font-medium text-gray-700 mb-1">
                        Pilih Keahlian <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-2 flex-col text-sm sm:flex-row">
                        <select id="keahlian-select-edit" class="appearance-none flex-1 border rounded-lg p-2">
                            <option value="">Pilih jenis keahlian magang</option>
                            @foreach($keahlian as $id => $nama)
                                <option value="{{ $id }}">{{ $nama }}</option>
                            @endforeach
                        </select>
                        <button type="button" id="tambah-keahlian-edit" class="cursor-pointer w-full bg-[var(--primary)] text-white px-4 py-2 rounded transition-all duration-300 ease-in-out lg:hover:bg-[var(--primary)]/80 sm:w-auto">
                            Tambah
                        </button>
                    </div>
                    <div id="badge-keahlian-edit" class="flex flex-wrap gap-2 mt-3"></div>
                    <div id="input-keahlian-edit"></div>
                </span>
                <x-select label="Periode" name="id_periode" :options="$periode" :required="true" />
                <x-select label="Jenis Lokasi Magang" name="id_jenis_lokasi" :options="$jenis_lokasi" :required="true" />
                <x-select label="Jenis Magang" name="id_jenis_magang" :options="$jenis_magang" :required="true" />
                <x-select label="Durasi Magang" name="id_durasi_magang" :options="$durasi" :required="true" />
            </figcaption>
            <fieldset class="flex flex-col gap-1 mt-6">
                <label for="deskripsi-edit" class="text-sm font-medium text-gray-700">
                    Deskripsi <span class="text-red-500">*</span>
                </label>
                <textarea id="deskripsi-edit" name="deskripsi" class="p-3 border border-gray-300 rounded-lg resize-none focus:outline-none focus:ring focus:border-blue-300" placeholder="Tuliskan deskripsi aktivitas di sini..." rows="4" required></textarea>
            </fieldset>
            <div class="grid grid-cols-1 gap-4 mt-6 lg:grid-cols-2">
                <x-input icon="fa-solid fa-user-group" label="Jumlah Kuota" type="number" name="kuota" placeholder="Masukkan jumlah kuota" :required="true" />
                <x-select icon="fa-solid fa-money-bill" label="Gaji" name="gaji" :required="true" :options="['PAID' => 'PAID', 'UNPAID' => 'UNPAID']" />
                <x-select icon="fa-solid fa-toggle-on" label="Status" name="status" :required="true" :options="['DIBUKA' => 'DIBUKA', 'DITUTUP' => 'DITUTUP']" />
                <x-input icon="fa-solid fa-calendar" label="Tanggal Mulai Pendaftaran" type="date" name="tanggal_mulai_pendaftaran" :required="true" />
                <x-input icon="fa-solid fa-calendar" label="Tanggal Selesai Pendaftaran" type="date" name="tanggal_selesai_pendaftaran" :required="true" />
            </div>
            <div class="mt-8">
                <button type="submit" class="cursor-pointer w-full bg-[var(--primary)] text-sm text-white px-5 py-3 rounded transition-all duration-300 ease-in-out hover:bg-[var(--primary)]/80">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </figure>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('keahlian-select-edit');
    const tambah = document.getElementById('tambah-keahlian-edit');
    const badge = document.getElementById('badge-keahlian-edit');
    const input = document.getElementById('input-keahlian-edit');
    let keahlian = [];

    @if(isset($lowongan) && $lowongan->keahlian)
        @foreach($lowongan->keahlian as $k)
            keahlian.push({id: '{{ $k->id_keahlian }}', nama: '{{ $k->nama_keahlian }}'});
        @endforeach
    @endif

    function render_badges() {
        badge.innerHTML = '';
        input.innerHTML = '';
        keahlian.forEach(({id, nama}) => {
            const badge_element = document.createElement('span');
            badge_element.className = 'inline-flex items-center px-3 py-1 rounded-full border border-pink-400 text-pink-500 text-sm mb-1';
            badge_element.innerHTML = `<span class="mr-2" style="cursor:pointer;">&times;</span> ${nama}`;
            badge_element.querySelector('span').onclick = () => { keahlian = keahlian.filter(k => k.id !== id); render_badges() };
            badge.appendChild(badge_element);

            const input_element = document.createElement('input');
            input_element.type = 'hidden';
            input_element.name = 'id_keahlian[]';
            input_element.value = id;
            input.appendChild(input_element);
        });
    }

    tambah.addEventListener('click', function () {
        const id = select.value;
        const nama = select.options[select.selectedIndex]?.text;
        if (!id || keahlian.some(k => k.id === id)) return;
        keahlian.push({id, nama});
        render_badges();
        select.value = '';
    });

    render_badges();
});
</script>