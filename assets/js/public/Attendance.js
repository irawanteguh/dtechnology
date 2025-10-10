const BASE_URL     = `${window.location.origin}/dtechnology`;
const CENTER       = { lat: 1.286021521387019, lon: 101.19285692429884 };
const RADIUS_LIMIT = 0.1;
const video        = document.getElementById('video');
const captureBtn   = document.getElementById('capture');

if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia){
    navigator.mediaDevices.getUserMedia({ video: true }).then(stream => video.srcObject = stream).catch(err => console.error("Kamera error:", err));
} else {
    console.error("Browser tidak mendukung kamera atau situs tidak aman (HTTP).");
    alert("Kamera tidak dapat digunakan. Gunakan HTTPS atau browser terbaru.");
}

updateLocation();
setInterval(updateTime, 1000); 

function getDistanceFromCenter(lat1, lon1, lat2, lon2) {
    const R = 6371; // Radius bumi (km)
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLon = (lon2 - lon1) * Math.PI / 180;
    const a =
        Math.sin(dLat / 2) ** 2 +
        Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
        Math.sin(dLon / 2) ** 2;
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c;
}

async function getAddress(lat, lon) {
    try {
        const res = await fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`);
        const data = await res.json();
        return data.display_name || "Alamat tidak ditemukan";
    } catch (err) {
        console.error("Gagal mengambil alamat:", err);
        return "Alamat tidak tersedia";
    }
}

async function updateLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(async pos => {
            const lat = pos.coords.latitude;
            const lon = pos.coords.longitude;

            $('#infoLat').html(lat.toFixed(6));
            $('#infoLon').html(lon.toFixed(6));

            const distance = getDistanceFromCenter(lat, lon, CENTER.lat, CENTER.lon);
            $('#infoRadius').html(distance.toFixed(3) + " km");

            // get address from coordinates
            const alamat = await getAddress(lat, lon);
            $('#infoStatus').html(alamat);

            currentLocation = { lat, lon, alamat };

            if (distance <= RADIUS_LIMIT) {
                $('#infoValid').html("? Within location (OK)");
            } else {
                $('#infoValid').html("? Outside location");
            }

        }, err => {
            console.warn("Geolocation error:", err);
            currentLocation = { lat: "-", lon: "-", alamat: "Unavailable" };
            $('#infoLat').html("-");
            $('#infoLon').html("-");
            $('#infoStatus').html(currentLocation.alamat);
            $('#infoRadius').html("-");
            $('#infoValid').html("-");
        });
    } else {
        currentLocation = { lat: "-", lon: "-", alamat: "Not supported" };
        $('#infoLat').html("-");
        $('#infoLon').html("-");
        $('#infoStatus').html(currentLocation.alamat);
        $('#infoRadius').html("-");
        $('#infoValid').html("-");
    }
}

function updateTime() {
    const now = new Date();
    const options = {
        year  : 'numeric',
        month : 'numeric',
        day   : 'numeric',
        hour  : '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true
    };

    $('#infoWaktu').html(now.toLocaleString('en-US', options));
}

captureBtn.addEventListener('click', async () => {
    // ambil frame dari video
    const canvas        = document.createElement('canvas');
          canvas.width  = video.videoWidth;
          canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);

    const dataUrl = canvas.toDataURL('image/jpeg'); // hasil base64

    try {
        const res = await fetch(url+"index.php/public/attendance/save_image", {
            method : 'POST',
            headers: { 'Content-Type': 'application/json' },
            body   : JSON.stringify({ image: dataUrl })
        });

        const data = await res.json();

        if(data.responCode === "00"){

        }

        toastr[data.responHead](data.responDesc, "INFORMATION");
    } catch (err) {
        console.error('Error capture:', err);
        alert('Terjadi kesalahan saat menyimpan.');
    }
});