<section id="modal-detail-perusahaan" class="cursor-default fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
  <div class="flex items-center justify-center min-h-screen px-4">
    <figure class="w-full max-w-2xl rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)]">
      <span class="mb-3 flex items-center justify-between">
        <h2 class="cursor-default font-semibold text-[var(--primary)]">
          Detail Perusahaan Mitra
        </h2>
        <i id="close-detail" class="fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
      </span>
      <hr class="mb-3 border border-[var(--primary)]" />

      <!-- Nama Perusahaan -->
      <span class="mt-3 flex items-center gap-2 text-sm">
        <span class="font-medium text-[var(--primary-text)]">Nama Perusahaan Mitra:</span>
        <span id="nama" class="text-[var(--secondary-text)]">-</span>
      </span>

      <!-- NIB -->
      <span class="mt-2 flex items-center gap-2 text-sm">
        <span class="font-medium text-[var(--primary-text)]">NIB:</span>
        <span id="nib" class="text-[var(--secondary-text)]">-</span>
      </span>

      <!-- Email & Nomor Telepon -->
      <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
        <div>
          <span class="font-medium text-[var(--primary-text)]">Email</span>
          <p id="email" class="text-[var(--secondary-text)]">-</p>
        </div>
        <div>
          <span class="font-medium text-[var(--primary-text)]">Nomor Telepon</span>
          <p id="nomor_telepon" class="text-[var(--secondary-text)]">-</p>
        </div>
      </div>

      <!-- Website & Status -->
      <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
        <div>
          <span class="font-medium text-[var(--primary-text)]">Website</span>
          <p id="website" class="text-[var(--secondary-text)]">-</p>
        </div>
        <div>
          <span class="font-medium text-[var(--primary-text)]">Status</span>
          <p id="status" class="inline-block rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-700">-</p>
        </div>
      </div>

      <!-- Tanggal Dibuat -->
      <div class="mt-4 text-sm">
        <span class="font-medium text-[var(--primary-text)]">Tanggal Dibuat</span>
        <p id="tanggal_dibuat" class="text-[var(--secondary-text)]">-</p>
      </div>
    </figure>
  </div>
</section>
