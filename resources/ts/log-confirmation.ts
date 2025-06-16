interface LogAktivitas {
    komentar: string;
}

document.addEventListener('DOMContentLoaded', () => {
    const konfirmasiButtons = document.querySelectorAll<HTMLAnchorElement>('.btn-konfirmasi[data-id]');
    const konfirmasiModal = document.querySelector<HTMLElement>('.modal-konfirmasi');
    const konfirmasiForm = document.querySelector<HTMLFormElement>('#form-konfirmasi');
    const closeKonfirmasi = document.querySelector<HTMLElement>('.close-konfirmasi');
    
    const tolakButtons = document.querySelectorAll<HTMLAnchorElement>('.btn-tolak[data-id]');
    const tolakModal = document.querySelector<HTMLElement>('.modal-tolak');
    const tolakForm = document.querySelector<HTMLFormElement>('#form-tolak');
    const closeTolak = document.querySelector<HTMLElement>('.close-tolak');

    if (konfirmasiButtons && konfirmasiModal && konfirmasiForm && closeKonfirmasi) {
        const konfirmasiStatus = konfirmasiForm.querySelector<HTMLInputElement>("input[name='status']");
        const konfirmasiSubmit = konfirmasiForm.querySelector<HTMLButtonElement>('button[type="submit"]');
        
        konfirmasiButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const id = button.getAttribute('data-id');
                const context = button.getAttribute('data-context');
                if (id && context) {
                    const baseUrl = context === 'admin' ? '/admin/aktivitas-magang' : '/dosen/log-aktivitas';
                    konfirmasiForm.action = `${baseUrl}/${id}/confirm`;
                    konfirmasiModal.classList.remove('hidden');
                }
            });
        });

        closeKonfirmasi.addEventListener('click', () => {
            konfirmasiModal.classList.add('hidden');
        });
        konfirmasiModal.addEventListener('click', (event) => {
            if (event.target === konfirmasiModal) {
                konfirmasiModal.classList.add('hidden');
            }
        });

        if (konfirmasiSubmit) {
            konfirmasiForm.addEventListener('submit', (e) => {
                e.preventDefault();
                if (konfirmasiStatus) {
                    konfirmasiStatus.value = 'DISETUJUI';
                    
                    const formData = new FormData(konfirmasiForm);
                    
                    fetch(konfirmasiForm.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                            'X-HTTP-Method-Override': 'PUT',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            comment: formData.get('komentar')
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert(data.message || 'Terjadi kesalahan saat memproses konfirmasi.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengirim data.');
                    });
                }
            });
        }
    }

    if (tolakButtons && tolakModal && tolakForm && closeTolak) {
        const tolakStatus = tolakForm.querySelector<HTMLInputElement>("input[name='status']");
        const tolakSubmit = tolakForm.querySelector<HTMLButtonElement>('button[type="submit"]');
        
        tolakButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const id = button.getAttribute('data-id');
                const context = button.getAttribute('data-context');
                if (id && context) {
                    const baseUrl = context === 'admin' ? '/admin/aktivitas-magang' : '/dosen/log-aktivitas';
                    tolakForm.action = `${baseUrl}/${id}/reject`;
                    tolakModal.classList.remove('hidden');
                }
            });
        });

        closeTolak.addEventListener('click', () => {
            tolakModal.classList.add('hidden');
        });
        tolakModal.addEventListener('click', (event) => {
            if (event.target === tolakModal) {
                tolakModal.classList.add('hidden');
            }
        });

        if (tolakSubmit) {
            tolakForm.addEventListener('submit', (e) => {
                e.preventDefault();
                if (tolakStatus) {
                    tolakStatus.value = 'DITOLAK';
                    
                    const formData = new FormData(tolakForm);
                    
                    fetch(tolakForm.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                            'X-HTTP-Method-Override': 'PUT',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            comment: formData.get('komentar')
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert(data.message || 'Terjadi kesalahan saat memproses penolakan.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengirim data.');
                    });
                }
            });
        }
    }

    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        textarea.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
            }
        });
    });
});