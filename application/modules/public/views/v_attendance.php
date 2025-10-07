<style>
    #spinnerOverlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(255,255,255,0.5);
        justify-content: center;
        align-items: center;
        border-radius: 1rem;
        z-index: 5;
        display: none;
        opacity: 0;
        transition: opacity 0.5s ease;
        pointer-events: none; /* ← ini penting agar tidak menutupi klik */
    }

    #spinnerOverlay.show {
        display: flex;
        opacity: 1;
        pointer-events: all; /* aktif hanya saat overlay muncul */
    }

    @keyframes fadeInOut {
        0% { opacity: 0; transform: scale(0.5) rotate(0deg); }
        50% { opacity: 1; transform: scale(1.2) rotate(180deg); }
        100% { opacity: 0; transform: scale(0.5) rotate(360deg); }
    }

    .fa-spin-custom {
        font-size: 3rem;
        color: #0d6efd;
        animation: fadeInOut 1s infinite;
    }

    #video {
        border-radius: 1rem;
        margin-bottom: 15px;
        position: relative;
        z-index: 1;
    }

    .bgi-responsive {
        background-image: url('<?php echo base_url();?>assets/images/svg/misc/taieri.svg');
        background-position: center bottom;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        transition: background-size 0.3s ease, background-position 0.3s ease;
    }

    @media (max-width: 992px) {
        .bgi-responsive {
            background-size: contain;
            background-position: center bottom;
        }
    }

    @media (max-width: 576px) {
        .bgi-responsive {
            background-size: 180% auto;
            background-attachment: scroll;
            background-position: center bottom;
        }
        #panelinformasi {
            font-size: 0.9rem;
            padding: 0.75rem;
        }
        #video {
            border-radius: 0.75rem;
        }
    }
</style>

<div class="d-flex flex-column flex-column-fluid bgi-responsive">
    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
        <a href="" class="mb-12">
            <img alt="Logo" src="<?php echo base_url();?>assets/images/logo/dtechnology.png" class="h-70px" />
        </a>

        <div class="w-lg-500px bg-body rounded shadow-sm p-4 p-lg-15 mx-auto shadow-lg">
            <div class="text-center mb-10">
                <h1 class="text-dark mb-3">Absence Attendance</h1>
            </div>

            <div style="position: relative;">
                <video id="video" width="100%" autoplay></video>

                <!-- Spinner overlay -->
                <div id="spinnerOverlay">
                    <i class="bi bi-stars fa-spin-custom"></i>
                </div>

                <div id="panelinformasi" class="card shadow-sm p-3 mt-1" style="background: rgba(255,255,255,0.9); border-radius: 15px;">
                    <div class="d-flex justify-content-between border-bottom py-1">
                        <span class="text-muted">NIK</span>
                        <span id="infoNIK" class="fw-semibold text-dark">-</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-1">
                        <span class="text-muted">Name</span>
                        <span id="infoNama" class="fw-semibold text-dark">-</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-1">
                        <span class="text-muted">Latitude</span>
                        <span id="infoLat" class="fw-semibold text-dark">-</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-1">
                        <span class="text-muted">Longitude</span>
                        <span id="infoLon" class="fw-semibold text-dark">-</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-1">
                        <span class="text-muted">Address</span>
                        <span id="infoStatus" class="fw-semibold text-dark text-end">-</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-1">
                        <span class="text-muted">Distance from Set Point</span>
                        <span id="infoRadius" class="fw-semibold text-dark">-</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-1">
                        <span class="text-muted">Absence Status</span>
                        <span id="infoValid" class="fw-semibold text-success">-</span>
                    </div>
                    <div class="d-flex justify-content-between pt-2">
                        <span class="text-muted">Date Time</span>
                        <span id="infoWaktu" class="fw-semibold text-dark">-</span>
                    </div>
                </div>

                <!-- Tombol Capture -->
                <div class="d-flex justify-content-center mt-5">
                    <button class="btn btn-primary btn-md" id="capture" name="capture">📸 Capture & Recognize</button>
                </div>
            </div>
        </div>
    </div>
</div>