/**
 * @fileoverview
 * Mengatur logika untuk menampilkan atau menyembunyikan menu profil saat
 * pengguna mengklik foto profil.
 *
 * @listens DOMContentLoaded
 */
document.addEventListener('DOMContentLoaded', () => {
  const picture = document.getElementById('profile-picture') as HTMLElement | null;
  const menu = document.getElementById('profile-menu') as HTMLElement | null;
  if (!picture || !menu) return;

  picture.addEventListener('click', (event: MouseEvent) => {
    event.stopPropagation();

    menu.classList.toggle('hidden');
    void (menu.classList.contains('hidden') ? menu.classList.remove('flex') : menu.classList.add('flex'));
  });

  document.body.addEventListener('click', () => {
    menu.classList.add('hidden');
    menu.classList.remove('flex');
  });
});