<section class="modal modal-tambah-proyek-mahasiswa fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <form action="{{ route('mahasiswa.profil.proyek.tambah') }}" method="POST" enctype="multipart/form-data" class="max-h-[90vh] overflow-y-auto w-full max-w-xl rounded-xl bg-white px-7 py-5 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('POST')
            <span class="mb-3 flex items-center justify-between">
                <h2 class="cursor-default text-sm font-semibold text-[var(--primary)] lg:text-base">
                    Tambah Proyek
                </h2>
                <i class="close fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
            </span>
            <hr class="mb-4 border border-[var(--primary)]"/>
            <span class="mb-4 grid grid-cols-1 gap-4 md:grid-cols-2">
                <x-input
                    icon="fa-solid fa-briefcase"
                    label="Posisi"
                    name="tambah_nama_proyek"
                    placeholder="Cth. Mindsea"
                    type="text"
                    :required="true"
                />
                <x-input
                    icon="fa-solid fa-building"
                    label="Nama Proyek"
                    name="tambah_peran_proyek"
                    placeholder="Cth. Manajer Proyek"
                    type="text"
                    :required="true"
                />
            </span>
            <fieldset class="my-4 flex flex-col gap-1">
                <label for="tambah_deskripsi_proyek" class="text-sm font-medium text-[var(--primary-text)]">
                    Deskripsi <span class="text-red-500">*</span>
                </label>
                <textarea
                    id="deskripsi"
                    name="tambah_deskripsi_proyek"
                    class="p-3 border border-gray-300 rounded-lg resize-none text-sm focus:outline-none focus:ring focus:border-blue-300"
                    placeholder="Tuliskan deskripsi proyek di sini..."
                    rows="4"
                    required
                ></textarea>
            </fieldset>
            <x-input
                icon="fa-solid fa-link"
                label="Tautan"
                name="tambah_tautan_proyek"
                placeholder="Cth. https://google.com"
                type="text"
                :required="true"
            />
            <fieldset class="my-4 text-[var(--primary-text)] md:col-span-2">
                <label for="tools-select" class="block text-sm font-medium mb-4">
                    Alat <span class="text-red-500">*</span>
                </label>
                <div class="flex gap-2 flex-col text-sm sm:flex-row">
                    <select id="tools-select" class="appearance-none flex-1 border rounded-lg p-2">
                        <option value="">Pilih beberapa alat</option>
                        @foreach($keahlian ?? [] as $id => $nama)
                            <option value="{{ $id }}">{{ $nama }}</option>
                        @endforeach
                    </select>
                    <button type="button" id="add-tools" class="cursor-pointer w-fit bg-[var(--primary)] text-white px-4 py-2 rounded transition-all duration-300 ease-in-out sm:w-auto lg:hover:bg-[var(--primary)]/80">
                        Tambah
                    </button>
                </div>
                <div id="badge-tools" class="flex flex-wrap gap-2 mt-3">
                    {{-- Badge akan muncul di sini --}}
                </div>
                <div id="input-tools">
                    {{-- Hidden input array --}}
                </div>
            </fieldset>
            <span class="my-4 grid grid-cols-1 gap-4 md:grid-cols-2">
                <x-input
                    icon="fa-solid fa-calendar"
                    label="Tanggal Mulai"
                    type="date"
                    name="tambah_tanggal_mulai_proyek"
                    :required="true"
                />
                <x-input
                    icon="fa-solid fa-calendar"
                    label="Tanggal Selesai"
                    type="date"
                    name="tambah_tanggal_selesai_proyek"
                    :required="true"
                />
            </span>
            <button type="submit" class="cursor-pointer mt-8 mb-2 w-full bg-[var(--primary)] text-white text-sm px-5 py-3 rounded-md transition-all hover:bg-[#5955b2]/90 duration-300 ">
                Simpan
            </button>
        </form>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('tools-select');
        const add_tools = document.getElementById('add-tools');
        const badge_tools = document.getElementById('badge-tools');
        const input_tools = document.getElementById('input-tools');
        let keahlian_yang_terpilih = [];

        function renderBadges() {
            badge_tools.innerHTML = '';
            input_tools.innerHTML = '';
            keahlian_yang_terpilih.forEach(({id, nama}) => {
                const badge = document.createElement('span');
                badge.className = 'inline-flex items-center px-3 py-1 rounded-full border border-pink-400 text-pink-500 text-sm mb-1';
                badge.innerHTML = `<span class="mr-2" style="cursor:pointer">&times;</span> ${nama}`;
                badge.querySelector('span').onclick = () => {
                    keahlian_yang_terpilih = keahlian_yang_terpilih.filter(k => k.id !== id);
                    renderBadges();
                };

                badge_tools.appendChild(badge);

                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'tambah_alat_proyek[]';
                input.value = id;
                input_tools.appendChild(input);
            });
        }

        add_tools.addEventListener('click', function () {
            const id = select.value;
            const nama = select.options[select.selectedIndex]?.text;
            if (!id || keahlian_yang_terpilih.some(k => k.id === id)) return;
            keahlian_yang_terpilih.push({id, nama});
            renderBadges();
            select.value = '';
        });

        @if(is_array(old('id_keahlian')))
            @foreach(old('id_keahlian') as $id)
                keahlian_yang_terpilih.push({id: '{{ $id }}', nama: '{{ $keahlian[$id] ?? $id }}'});
            @endforeach
            renderBadges();
        @endif
    });
</script>