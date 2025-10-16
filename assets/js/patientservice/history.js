let typingTimer;
const typingDelay = 1000;

daftaralergipasien();
soapie();
catatanperawat();

document.getElementById('searchPatientGlobal').addEventListener('keyup', function() {
    clearTimeout(typingTimer);
    const searchValue = this.value.trim();

    typingTimer = setTimeout(() => {
        daftarpasien(searchValue);
    }, typingDelay);
});

// === Function utama ===
function daftarpasien(keyword = ""){
    $.ajax({
        url        : url + "index.php/patientservice/history/daftarpasien",
        data       : { keyword: keyword }, // ⬅️ kirim keyword ke backend
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function(){
            $("#resultdatadaftarpasien").html("<tr><td colspan='8' class='text-center text-muted py-5'>Loading...</td></tr>");
        },
        success:function(data){
            var tableresult = "";

            if (data.responCode === "00") {
                let result = data.responResult;
                if (result.length > 0) {
                    for (var i in result) {
                        tableresult += "<tr>";
                        tableresult += "<td class='ps-4'><div>"+result[i].nm_pasien+"</div><div class='badge badge-pill badge-light-info'>"+result[i].no_rkm_medis+"</div></td>";
                        tableresult += "<td>" + result[i].no_ktp + "</td>";
                        tableresult += "<td class='text-center'>" + result[i].tgllahir + "</td>";
                        tableresult += "<td>" + result[i].jeniskelamin + "</td>";
                        tableresult += "<td>" + result[i].alamat + "</td>";
                        tableresult += "<td>" + result[i].nm_ibu + "</td>";
                        tableresult += "<td class='text-end'><a class='btn btn-sm btn-primary'><i class='bi bi-eye me-2'></i>View History</a></td>";
                        tableresult += "</tr>";
                    }
                } else {
                    tableresult = "<tr><td colspan='8' class='text-center text-muted py-5'>No data found</td></tr>";
                }
            } else {
                tableresult = "<tr><td colspan='8' class='text-center text-danger py-5'>"+data.responDesc+"</td></tr>";
            }

            $("#resultdatadaftarpasien").html(tableresult);
        },
        complete: function(){
            toastr.clear();
		},
        error: function(xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>"+error+"</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : {confirmButton: "btn btn-danger"},
                showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		}
    });

    return false;
}

function daftaralergipasien(){
    $.ajax({
        url        : url+"index.php/patientservice/history/daftaralergipasien",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function(){
            $("#areaalergi").html("");
        },
        success:function(data){
            var result              = "";
            var tableresult         = "";

            if(data.responCode==="00"){
                result        = data.responResult;
                for (var i in result) {
                    let alergiText = result[i].alergi || '';
                        alergiText = alergiText.replace(/\s+dan\s+/gi, ',');
                    let alergiList = alergiText.split(/[,/]/);

                    alergiList.forEach(function(item) {
                        item = item.trim();
                        if (item !== '') {
                            tableresult += "<span class='badge badge-pill badge-danger m-1'>" + item + "</span>";
                        }
                    });
                }
            }

            $("#areaalergi").html(tableresult);
        },
        complete: function(){
            toastr.clear();
		},
        error: function(xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>"+error+"</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : {
                    confirmButton: "btn btn-danger"
                },
                showClass: {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass: {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		}
    });
    return false;
};

function soapie(){
    $.ajax({
        url        : url+"index.php/patientservice/history/soapie",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function(){
            $("#areasoapie").html(`
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="mt-3 text-gray-600 fw-semibold">Memuat data, mohon tunggu...</div>
                </div>
            `);
        },
        success:function(data){
            var result              = "";
            var tableresult         = "";

            if (data.responCode === "00") {
                result = data.responResult;
                for (var i in result) {
                    // ubah newline jadi <br> biar baris baru ikut tampil di HTML
                    let keluhan     = (result[i].keluhan || '').replace(/\n/g, '<br>');
                    let pemeriksaan = (result[i].pemeriksaan || '').replace(/\n/g, '<br>');
                    let penilaian   = (result[i].penilaian || '').replace(/\n/g, '<br>');
                    let rtl         = (result[i].rtl || '').replace(/\n/g, '<br>');
                    let instruksi   = (result[i].instruksi || '').replace(/\n/g, '<br>');
                    let evaluasi    = (result[i].evaluasi || '').replace(/\n/g, '<br>');

                    tableresult += "<div class='card mb-10'>";
                    tableresult += "<div class='card-body p-8'>";
                    tableresult += "<div class='d-flex justify-content-between flex-wrap align-items-start'>";

                        // === BAGIAN BADGE VITAL SIGN ===
                        tableresult += "<div class='mb-3'>";
                            if (result[i].suhu_tubuh && result[i].suhu_tubuh != 0)
                                tableresult += "<span class='badge badge-pill badge-light-info m-1'>Temperature: " + result[i].suhu_tubuh + "°C</span>";
                            if (result[i].tensi && result[i].tensi != 0)
                                tableresult += "<span class='badge badge-pill badge-light-info m-1'>Blood Pressure: " + result[i].tensi + " mmHg</span>";
                            if (result[i].nadi && result[i].nadi != 0)
                                tableresult += "<span class='badge badge-pill badge-light-info m-1'>Pulse: " + result[i].nadi + " bpm</span>";
                            if (result[i].respirasi && result[i].respirasi != 0)
                                tableresult += "<span class='badge badge-pill badge-light-info m-1'>Respiratory Rate: " + result[i].respirasi + " x/min</span>";
                            if (result[i].tinggi && result[i].tinggi != 0)
                                tableresult += "<span class='badge badge-pill badge-light-info m-1'>Height: " + result[i].tinggi + " cm</span>";
                            if (result[i].berat && result[i].berat != 0)
                                tableresult += "<span class='badge badge-pill badge-light-info m-1'>Weight: " + result[i].berat + " kg</span>";
                            if (result[i].spo2 && result[i].spo2 != 0)
                                tableresult += "<span class='badge badge-pill badge-light-info m-1'>Saturation: " + result[i].spo2 + "%</span>";
                            if (result[i].gcs && result[i].gcs != 0)
                                tableresult += "<span class='badge badge-pill badge-light-info m-1'>GCS: " + result[i].gcs + "</span>";
                        tableresult += "</div>";
                        // === BAGIAN NAMA & TANGGAL (rata kiri) ===
                        tableresult += "<div class='text-end'>";
                            tableresult += "<h6 class='fw-bold mb-0'>" + (result[i].nama || '-') + "</h6>";
                            tableresult += "<h6 class='text-muted small'>" + (result[i].tgl_perawatan || '-') + " " + (result[i].jam_rawat || '-') + "</h6>";
                        tableresult += "</div>";

                    tableresult += "</div>"; // tutup d-flex

                    tableresult += "<div class='separator separator-dashed border-secondary border-3 mb-5 mt-5'></div>";

                    // === BAGIAN SOAP + INSTRUKSI + EVALUASI ===
                    tableresult += `
                        <div class="mt-5">
                            <div><h3>Subject :</h3></div>
                            <div class="border-primary border-dashed border-3 p-2 rounded bg-light-primary">${keluhan}</div>
                        </div>
                        <div class="mt-5">
                            <div><h3>Object :</h3></div>
                            <div class="border-primary border-dashed border-3 p-2 rounded bg-light-primary">${pemeriksaan}</div>
                        </div>
                        <div class="mt-5">
                            <div><h3>Assessment :</h3></div>
                            <div class="border-primary border-dashed border-3 p-2 rounded bg-light-primary">${penilaian}</div>
                        </div>
                        <div class="mt-5">
                            <div><h3>Plan :</h3></div>
                            <div class="border-primary border-dashed border-3 p-2 rounded bg-light-primary">${rtl}</div>
                        </div>
                        <div class="mt-5">
                            <div><h3>Instruction :</h3></div>
                            <div class="border-primary border-dashed border-3 p-2 rounded bg-light-primary">${instruksi}</div>
                        </div>
                        <div class="mt-5">
                            <div><h3>Evaluation :</h3></div>
                            <div class="border-primary border-dashed border-3 p-2 rounded bg-light-primary">${evaluasi}</div>
                        </div>
                    `;

                    tableresult += "</div>"; // card-body
                    tableresult += "</div>"; // card
                }
            }

            $("#areasoapie").html(tableresult);
        },
        complete: function(){

		},
        error: function(xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>"+error+"</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : {
                    confirmButton: "btn btn-danger"
                },
                showClass: {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass: {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		}
    });
    return false;
};

function catatanperawat(){
    $.ajax({
        url        : url+"index.php/patientservice/history/catatanperawat",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function(){
            $("#areacatatanperawat").html(`
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="mt-3 text-gray-600 fw-semibold">Memuat data, mohon tunggu...</div>
                </div>
            `);
        },
        success:function(data){
            var result              = "";
            var tableresult         = "";

            if (data.responCode === "00") {
                result = data.responResult;
                for (var i in result) {
                    // ubah newline jadi <br> biar baris baru ikut tampil di HTML
                    let uraian     = (result[i].uraian || '').replace(/\n/g, '<br>');

                    tableresult += "<div class='d-flex justify-content-between flex-wrap align-items-start'>";
                        
                        tableresult += "<div class='mb-3'>";
                        tableresult += "</div>";

                        // === BAGIAN NAMA & TANGGAL (rata kiri) ===
                        tableresult += "<div class='text-end'>";
                            tableresult += "<h6 class='fw-bold mb-0'>" + (result[i].nama || '-') + "</h6>";
                            tableresult += "<h6 class='text-muted small'>" + (result[i].tanggal || '-') + " " + (result[i].jam || '-') + "</h6>";
                        tableresult += "</div>";

                    tableresult += "</div>"; // tutup d-flex

                    tableresult += `
                        <div class="mb-10">
                            <div><h3>Catatan :</h3></div>
                            <div class="border-primary border-dashed border-3 p-2 rounded bg-light-primary">${uraian}</div>
                        </div>
                    `;

                    // tableresult += "<div class='separator separator-dashed border-secondary border-2 mb-5 mt-5'></div>";
                }
            }

            $("#areacatatanperawat").html(tableresult);
        },
        complete: function(){

		},
        error: function(xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>"+error+"</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : {
                    confirmButton: "btn btn-danger"
                },
                showClass: {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass: {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		}
    });
    return false;
};