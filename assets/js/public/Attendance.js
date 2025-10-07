let   currentLocation = { lat: "-", lon: "-", alamat: "Unknown" };
// const BASE_URL        = 'http://10.12.120.58:5000';
const BASE_URL        = url;
const CENTER          = { lat: -6.200000, lon: 106.816666 };
const RADIUS_LIMIT    = 0.1;                                        // km (100 meter)
const video           = document.getElementById('video');
const captureBtn      = document.getElementById('capture');
const spinner         = document.getElementById('spinnerOverlay');
                             
navigator.mediaDevices.getUserMedia({ video: true }).then(stream => video.srcObject = stream).catch(err => console.error("Kamera error:", err));

updateLocation();
setInterval(updateTime, 1000); 
// setInterval(updateLocation, 5000);

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
                $('#infoValid').html("✅ Within location (OK)");
            } else {
                $('#infoValid').html("❌ Outside location");
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

function showSpinner() {
    spinner.style.display = 'flex';
    setTimeout(() => spinner.classList.add('show'), 50);
}

function hideSpinner() {
    spinner.classList.remove('show');
    setTimeout(() => spinner.style.display = 'none', 500);
}

captureBtn.addEventListener('click', async () => {
    try {
        video.pause();
        showSpinner();

        // ambil gambar dari video
        const canvas        = document.createElement('canvas');
              canvas.width  = video.videoWidth;
              canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0);
        const dataUrl = canvas.toDataURL('image/jpeg');

        // kirim ke server Python (recognize)
        const res = await fetch(`${BASE_URL}/recognize`, {
            method : 'POST',
            headers: { 'Content-Type': 'application/json' },
            body   : JSON.stringify({ image: dataUrl })
        });

        const data = await res.json();
        
        if(data.username){
            $('#infoNIK').html( data.username);
        }else{
            $('#infoNIK').html("-");
            $('#infoNama').html("Wajah tidak dikenali");
        }

        // simpan hasil capture + lokasi + alamat
        await fetch(`${BASE_URL}/save_capture`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                image: dataUrl,
                location: currentLocation
            })
        });

    } catch (err) {
        console.error("Error capture:", err);
    } finally {
        hideSpinner();
        video.play();
    }
});