document.addEventListener('DOMContentLoaded', () => {
  const sorter = document.querySelectorAll('.fa-sort') as NodeListOf<HTMLElement>;

  sorter.forEach((sort) => {
    let ascending = true;

    sort.addEventListener('click', () => {
      const header = sort.closest('th');
      if (!header || !header.parentElement) return;

      const index = Array.from(header.parentElement.children).indexOf(header);
      const tbody = document.querySelector('tbody') as HTMLTableSectionElement;
      const tr = Array.from(tbody.querySelectorAll('tr')) as HTMLTableRowElement[];
      if (!index || !tbody || !tr) return;

      const sorted_rows = tr.sort((a, b) => {
        const cell_a_text = a.querySelectorAll('td')[index].textContent?.trim().toLowerCase() || '';
        const cell_b_text = b.querySelectorAll('td')[index].textContent?.trim().toLowerCase() || '';
        return ascending ? cell_a_text.localeCompare(cell_b_text) : cell_b_text.localeCompare(cell_a_text);
      });

      ascending = !ascending;
      tbody.innerHTML = '';
      sorted_rows.forEach((row) => tbody.appendChild(row));
    });
  });
});