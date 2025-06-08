/**
 * @fileoverview
 * File ini menangani logika frontend untuk menu hamburger:
 * - Mengatur padding header dan main berdasarkan status sidebar.
 * - Menampilkan dan menyembunyikan sidebar serta overlay.
 * - Merespons perubahan ukuran layar.
 */

document.addEventListener('DOMContentLoaded', () => {
  const hamburger = document.querySelector("i[id='hamburger-menu']") as HTMLElement;
  const header = document.querySelector('header') as HTMLElement;
  const sidebar = document.querySelector('aside') as HTMLElement;
  const main = document.querySelector('main') as HTMLElement;
  const overlay = document.getElementById('overlay') as HTMLElement;
  const desktop = () => window.innerWidth >= 1024;
  let visible = false;

  if (!hamburger || !header || !sidebar || !main || !overlay) return;

  const padding = () => {
    header.classList.remove('pl-84', 'pl-10');
    main.classList.remove('pl-84', 'pl-10');

    if (desktop()) {
      const add = visible ? 'pl-84' : 'pl-10';
      header.classList.add(add);
      main.classList.add(add);
    }
  };

  const show = () => {
    sidebar.classList.remove('hidden', '-translate-x-full');
    sidebar.classList.add('translate-x-0');
    visible = true;
    if (!desktop()) overlay.classList.remove('hidden');
    padding();
  };

  const hide = () => {
    sidebar.classList.remove('translate-x-0');
    sidebar.classList.add('-translate-x-full');
    visible = false;
    overlay.classList.add('hidden');
    padding();
    setTimeout(() => !visible && sidebar.classList.add('hidden'), 300);
  };

  hamburger.addEventListener('click', () => (visible ? hide() : show()));
  overlay.addEventListener('click', () => hide());

  window.addEventListener('resize', () => {
    if (!desktop()) hide();
    padding();
  });

  visible = !sidebar.classList.contains('hidden') && sidebar.classList.contains('translate-x-0');
  padding();
  if (!desktop()) hide();
});