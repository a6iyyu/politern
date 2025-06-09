<section class="modal modal-tambah-lowongan fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <figure class="min-h-screen flex items-center justify-center w-full px-4">
        <form action="{{ route('admin.lowongan-magang.tambah') }}" method="POST" class="max-h-[90vh] overflow-y-auto w-full max-w-2xl rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('POST')
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-[#5955B2]">Tambah Lowongan Magang</h2>
                <button id="close-tambah-lowongan" type="button" class="text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-xmark close"></i>
                </button>
            </div>
            <hr class="border border-[var(--primary)] mb-6 " />
            <h5 class="bg-[var(--primary)] text-white text-left py-3 rounded-md text-sm font-medium mb-6 px-4">
                Tambah Lowongan Magang
            </h5>
            <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-select
                    label="Perusahaan"
                    name="id_perusahaan_mitra"
                    placeholder="Pilih nama perusahaan"
                    :options="$perusahaan ?? ['Tidak ada data.']"
                    :required="true"
                />
                <x-select
                    label="Bidang Posisi Magang"
                    name="id_bidang"
                    placeholder="Pilih jenis bidang"
                    :options="$bidang ?? ['Tidak ada data.']"
                    :required="true"
                />
                <div class="md:col-span-2">
                    <label for="keahlian-select" class="block text-sm font-medium text-gray-700 mb-1">
                        Pilih Keahlian <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-2 flex-col text-sm sm:flex-row">
                        <select id="keahlian-select" class="appearance-none flex-1 border rounded-lg p-2" >
                            <option value="">Pilih jenis keahlian magang</option>
                            @foreach($keahlian ?? [] as $id => $nama)
                                <option value="{{ $id }}">{{ $nama }}</option>
                            @endforeach
                        </select>
                        <button type="button" id="tambah-keahlian" class="w-full bg-[var(--primary)] text-white px-4 py-2 rounded transition sm:w-auto lg:hover:bg-[var(--primary)]/80">
                            Tambah
                        </button>
                    </div>
                    <div id="badge-keahlian" class="flex flex-wrap gap-2 mt-3">
                        {{-- Array keahlian akan muncul di sini. --}}
                    </div>
                    {{-- Masukan tersembunyi untuk mengirimkan array keahlian saat dikirim. --}}
                    <div id="input-keahlian"></div>
                </div>
                <x-select
                    label="Periode"
                    name="id_periode"
                    placeholder="Pilih periode magang"
                    :options="$periode ?? ['Tidak ada data.']"
                    :required="true"
                />
                <x-select
                    label="Jenis Lokasi Magang"
                    name="id_jenis_lokasi"
                    :required="true"
                    placeholder="Pilih jenis lokasi magang"
                    :options="$jenis_lokasi ?? ['Tidak ada data.']"
                />
                <x-select
                    label="Jenis Magang"
                    name="id_jenis_magang"
                    :required="true"
                    placeholder="Pilih jenis magang"
                    :options="$jenis_magang ?? ['Tidak ada data.']"
                />
                <x-select
                    label="Durasi Magang"
                    name="id_durasi_magang"
                    :required="true"
                    placeholder="Pilih durasi magang"
                    :options="$durasi ?? ['Tidak ada data.']"
                />
            </div>
            <fieldset class="flex flex-col gap-1 mt-6">
                <label for="deskripsi" class="text-sm font-medium text-gray-700">
                    Deskripsi <span class="text-red-500">*</span>
                </label>
                <textarea
                    id="deskripsi"
                    name="deskripsi"
                    class="p-3 border border-gray-300 rounded-lg resize-none focus:outline-none focus:ring focus:border-blue-300"
                    placeholder="Tuliskan deskripsi aktivitas di sini..."
                    rows="4"
                    required
                >{{ old('deskripsi') }}</textarea>
            </fieldset>
            <div class="grid grid-cols-1 gap-4 mt-6 lg:grid-cols-2">
                <x-input icon="fa-solid fa-user-group" label="Jumlah Kuota" type="number" name="kuota" placeholder="Masukkan jumlah kuota" :required="true" />
                <x-select 
                    icon="fa-solid fa-money-bill" 
                    label="Gaji" 
                    name="gaji" 
                    :required="true" 
                    placeholder="Pilih Gaji"
                    :options="['PAID' => 'PAID', 'UNPAID' => 'UNPAID']" 
                />
                <x-select icon="fa-solid fa-toggle-on" label="Status" name="status" :required="true" placeholder="Pilih Status" :options="['DIBUKA' => 'DIBUKA', 'DITUTUP' => 'DITUTUP']" />
                <x-input icon="fa-solid fa-calendar" label="Tanggal Mulai Pendaftaran" type="date" name="tanggal_mulai_pendaftaran" :required="true" />
                <x-input icon="fa-solid fa-calendar" label="Tanggal Selesai Pendaftaran" type="date" name="tanggal_selesai_pendaftaran" :required="true" />
            </div>
            <div class="mt-8">
                <button type="submit" class="w-full bg-[var(--primary)] text-sm text-white px-5 py-3 rounded transition-all duration-300 ease-in-out hover:bg-[var(--primary)]/80">
                    Tambah
                </button>
            </div>
        </form>
    </figure>
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('keahlian-select');
    const tambahBtn = document.getElementById('tambah-keahlian');
    const badgeContainer = document.getElementById('badge-keahlian');
    const inputContainer = document.getElementById('input-keahlian');
    let selectedKeahlian = [];

    function renderBadges() {
        badgeContainer.innerHTML = '';
        inputContainer.innerHTML = '';
        selectedKeahlian.forEach(({id, nama}) => {
            // Badge
            const badge = document.createElement('span');
            badge.className = 'inline-flex items-center px-3 py-1 rounded-full border border-pink-400 text-pink-500 text-sm mb-1';
            badge.innerHTML = `<span class="mr-2" style="cursor:pointer;">&times;</span> ${nama}`;
            badge.querySelector('span').onclick = () => {
                selectedKeahlian = selectedKeahlian.filter(k => k.id !== id);
                renderBadges();
            };
            badgeContainer.appendChild(badge);
            // Hidden input
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'id_keahlian[]';
            input.value = id;
            inputContainer.appendChild(input);
        });
    }

    tambahBtn.addEventListener('click', function () {
        const id = select.value;
        const nama = select.options[select.selectedIndex]?.text;
        if (!id || selectedKeahlian.some(k => k.id === id)) return;
        selectedKeahlian.push({id, nama});
        renderBadges();
        select.value = '';
    });

    // Jika ada old value dari validasi gagal
    @if(is_array(old('id_keahlian')))
        @foreach(old('id_keahlian') as $id)
            selectedKeahlian.push({id: '{{ $id }}', nama: '{{ $keahlian[$id] ?? $id }}'});
        @endforeach
        renderBadges();
    @endif
});
</script>