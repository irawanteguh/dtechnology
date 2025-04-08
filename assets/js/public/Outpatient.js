document.querySelectorAll('[data-kt-plan]').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();

        // Hapus kelas 'active' dari semua tombol
        document.querySelectorAll('[data-kt-plan]').forEach(b => b.classList.remove('active'));

        // Tambahkan kelas 'active' ke tombol yang diklik
        this.classList.add('active');

        // Ambil data target yang diklik
        const target = this.getAttribute('data-kt-plan');

        // Sembunyikan semua konten
        document.querySelectorAll('.plan-content').forEach(div => {
            div.classList.add('d-none');
        });

        // Tampilkan konten yang sesuai
        document.getElementById(target).classList.remove('d-none');
    });
});