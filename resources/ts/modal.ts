/**
 * @fileoverview
 * Mengatur tampilan berbagai modal di halaman secara global.
 *
 * @listens DOMContentLoaded
 */

document.addEventListener('DOMContentLoaded', () => {
  const open = document.querySelectorAll('.open') as NodeListOf<HTMLElement>;
  const close = document.querySelectorAll('.close') as NodeListOf<HTMLElement>;
  const modals = document.querySelectorAll('.modal') as NodeListOf<HTMLElement>;

  open.forEach((button) => {
    button.addEventListener('click', () => {
      const target = button.getAttribute('data-target');
      const modal = document.querySelector(`.modal-${target}`) as HTMLElement;
      if (!modal || !target) return;
      modal.classList.remove('hidden');
    });
  });

  close.forEach((button) => {
    button.addEventListener('click', () => {
      const modal = button.closest('.modal') as HTMLElement;
      if (!modal) return;
      modal.classList.add('hidden');
    });
  });

  modals.forEach((modal) => {
    modal.addEventListener('click', (e) => {
      if (e.target === modal) modal.classList.add('hidden');
    });
  });
});