startTimer();

var timeout; // Variabel untuk menyimpan ID timeout

function resetTimeout()
{
    clearTimeout(timeout); // Menghapus timeout yang ada sebelumnya
    timeout = setTimeout(logscreen, 30 * 60 * 1000); // Menetapkan timeout selama 30 menit (30 * 60 * 1000 milidetik)
}

function logscreen()
{
    // Kode aksi yang akan dijalankan ketika aplikasi tidak digunakan selama 30 menit
    console.log('Aplikasi tidak digunakan selama 30 menit');
  
    // Tambahkan kode lain yang ingin Anda jalankan saat aplikasi tidak digunakan selama 30 menit
    window.location.href = url+"auth/lockscreen";
}

function startTimer()
{
    document.addEventListener('mousemove', resetTimeout); // Memulai timer saat ada aksi mousemove
    document.addEventListener('mousedown', resetTimeout); // Memulai timer saat ada aksi mousedown
    document.addEventListener('keypress', resetTimeout); // Memulai timer saat ada aksi keypress
    document.addEventListener('touchmove', resetTimeout); // Memulai timer saat ada aksi touchmove
  
    resetTimeout(); // Memulai penghitungan waktu 30 menit
}