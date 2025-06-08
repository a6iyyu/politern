/**
 * @fileoverview
 * File ini berisi logika frontend terkait fitur pencarian:
 * - Menunggu hingga seluruh dokumen dimuat (DOMContentLoaded).
 * - Mengambil elemen input dengan ID "search".
 * - Siap dikembangkan untuk menambahkan logika pencarian data secara dinamis.
 */

document.addEventListener('DOMContentLoaded', () => {
  const search = document.getElementById('search') as HTMLInputElement | null;
  const rows = document.querySelectorAll('.data-row'); // sesuaikan dengan class/item yang ingin difilter
  if (!search) return;

  search.addEventListener('input', () => {
    const keyword = search.value.toLowerCase();

    rows.forEach((row) => {
      const element = row as HTMLElement;
      const text = element.textContent?.toLowerCase() || '';
      element.style.display = text.includes(keyword) ? '' : 'none';
    });
  });
});