let today = new Date();
today.setDate(today.getDate() - 1); // Kurangi 1 hari
let startDate = today.toISOString().split('T')[0]; // Format: YYYY-MM-DD

dataharian(startDate);
databulanan();
datatahunan();

window.onload = function () {
    const width  = window.innerWidth;
    const height = window.innerHeight;
    alert("Ukuran layar saat ini: " + width + " x " + height);
};

flatpickr('[name="dateperiode"]', {
    enableTime: false,
    dateFormat: "Y-m-d",
    maxDate: "today",
    defaultDate: new Date(),
    onChange: function (selectedDates, dateStr, instance) {
        instance.close();
        dataharian(dateStr);
    }
});

$(document).on("change", "select[name='yearsperiode']", function (e) {
    e.preventDefault();
    datatahunan();
});

$(document).on("change", "select[name='monthperiode']", function (e) {
    e.preventDefault();
    databulanan();
});

function dataharian(startDate){
    $.ajax({
        url       : url + "index.php/sb/insight/dataharian",
        data      : {startDate:startDate},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            const orgCodes = ["rsms", "rsiabm", "rst", "rmb"];
            const categories = [
                "umum", "asuransi", "bpjs", "mcu", "obat", "lain",
                "medis", "rumah_tangga", "atk_percetakan", "it", "gizi_dapur", "farmasi"
            ];

            orgCodes.forEach(code => {
                categories.forEach(cat => {
                    $(`#${code}${cat}datependapatan`).html("Rp. 0");
                    $(`#${code}${cat}datepengeluaran`).html("Rp. 0");
                });

                $(`#${code}datependapatantotal`).html("Rp. 0");
                $(`#${code}datepengeluarantotal`).html("Rp. 0");
                $(`#${code}dateselisihtotal`).html("Rp. 0");

                $(`#total_pendapatan${code}date`).html("Rp. 0");
                $(`#total_pengeluaran${code}date`).html("Rp. 0");
                $(`#saldo_akhir${code}date`).html("Rp. 0");

                $(`#${code}datependapatanlabel`).html("");
                $(`#${code}datepengeluaranlabel`).html("");
                $(`#${code}dateselisihlabel`).html("");
            });

            Swal.fire({
                title            : 'Sending request...',
                text             : 'Please wait',
                allowOutsideClick: false,
                allowEscapeKey   : false,
                didOpen          : () => Swal.showLoading()
            });
        },
        success: function (data) {
            Swal.fire({
                title            : 'Memproses data...',
                text             : 'Menyiapkan tampilan data rumah sakit.',
                allowOutsideClick: false,
                allowEscapeKey   : false,
                didOpen          : () => Swal.showLoading()
            });

            if (data.responCode === "00") {
                const result = data.responResult;

                const orgMap = {
                    "10c84edd-500b-49e3-93a5-a2c8cd2c8524": "rsms",
                    "d5e63fbc-01ec-4ba8-90b8-fb623438b99d": "rsiabm",
                    "a4633f72-4d67-4f65-a050-9f6240704151": "rst",
                };

                const categories = [
                    "umum", "asuransi", "bpjs", "mcu", "obat", "lain",
                    "medis", "rumah_tangga", "atk_percetakan", "it", "gizi_dapur", "farmasi"
                ];

                const pengeluaranCategories = [
                    "medis", "rumah_tangga", "atk_percetakan", "it", "gizi_dapur", "farmasi"
                ];

                // Siapkan penampung total per kategori untuk RMB
                let rmbTotals = {};
                categories.forEach(cat => rmbTotals[cat] = 0);

                result.forEach((row) => {
                    const code = orgMap[row.org_id];
                    if (!code) return;

                    let totalPendapatan = 0;
                    let totalPengeluaran = 0;

                    categories.forEach((cat) => {
                        const value = parseFloat(row[cat] || 0);
                        rmbTotals[cat] += value;

                        if (pengeluaranCategories.includes(cat)) {
                            $(`#${code}${cat}datepengeluaran`).html("Rp. " + todesimal(value));
                            totalPengeluaran += value;
                        } else {
                            $(`#${code}${cat}datependapatan`).html("Rp. " + todesimal(value));
                            totalPendapatan += value;
                        }
                    });

                    const selisih = totalPendapatan - totalPengeluaran;

                    $(`#${code}datependapatantotal`).html("Rp. " + todesimal(totalPendapatan));
                    $(`#${code}datepengeluarantotal`).html("Rp. " + todesimal(totalPengeluaran));
                    $(`#${code}dateselisihtotal`).html("Rp. " + todesimal(selisih));

                    $(`#total_pendapatan${code}date`).html("Rp. " + todesimal(totalPendapatan));
                    $(`#total_pengeluaran${code}date`).html("Rp. " + todesimal(totalPengeluaran));
                    $(`#saldo_akhir${code}date`).html("Rp. " + todesimal(selisih));

                    $(`#${code}datependapatanlabel`).html(startDate);
                    $(`#${code}datepengeluaranlabel`).html(startDate);
                    $(`#${code}dateselisihlabel`).html(startDate);
                });

                // ===== TOTAL RMB (RUMAH BERSAMA) =====
                let totalPendapatanRmb = 0;
                let totalPengeluaranRmb = 0;

                categories.forEach((cat) => {
                    const value = rmbTotals[cat];

                    if (pengeluaranCategories.includes(cat)) {
                        $(`#rmb${cat}datepengeluaran`).html("Rp. " + todesimal(value));
                        totalPengeluaranRmb += value;
                    } else {
                        $(`#rmb${cat}datependapatan`).html("Rp. " + todesimal(value));
                        totalPendapatanRmb += value;
                    }
                });

                const selisihRmb = totalPendapatanRmb - totalPengeluaranRmb;

                $(`#rmbdatependapatantotal`).html("Rp. " + todesimal(totalPendapatanRmb));
                $(`#rmbdatepengeluarantotal`).html("Rp. " + todesimal(totalPengeluaranRmb));
                $(`#rmbdateselisihtotal`).html("Rp. " + todesimal(selisihRmb));

                $(`#total_pendapatanrmbdate`).html("Rp. " + todesimal(totalPendapatanRmb));
                $(`#total_pengeluaranrmbdate`).html("Rp. " + todesimal(totalPengeluaranRmb));
                $(`#saldo_akhirrmbdate`).html("Rp. " + todesimal(selisihRmb));

                $(`#rmbdatependapatanlabel`).html(startDate);
                $(`#rmbdatepengeluaranlabel`).html(startDate);
                $(`#rmbdateselisihlabel`).html(startDate);
            }
        },
        complete: function () {
            Swal.close();
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>" + error + "</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : { confirmButton: "btn btn-danger" },
                showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });

    return false;
};

function databulanan(){
    const startDate = $("select[name='monthperiode']").val();
    $.ajax({
        url       : url + "index.php/sb/insight/databulanan",
        data      : {startDate:startDate},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            const orgCodes = ["rsms", "rsiabm", "rst", "rmb"];
            const categories = [
                "umum", "asuransi", "bpjs", "mcu", "obat", "lain",
                "medis", "rumah_tangga", "atk_percetakan", "it", "gizi_dapur", "farmasi"
            ];

            orgCodes.forEach(code => {
                categories.forEach(cat => {
                    $(`#${code}${cat}monthpendapatan`).html("Rp. 0");
                    $(`#${code}${cat}monthpengeluaran`).html("Rp. 0");
                });

                $(`#${code}monthpendapatantotal`).html("Rp. 0");
                $(`#${code}monthpengeluarantotal`).html("Rp. 0");
                $(`#${code}monthselisihtotal`).html("Rp. 0");

                $(`#total_pendapatan${code}month`).html("Rp. 0");
                $(`#total_pengeluaran${code}month`).html("Rp. 0");
                $(`#saldo_akhir${code}month`).html("Rp. 0");

                $(`#${code}monthpendapatanlabel`).html("");
                $(`#${code}monthpengeluaranlabel`).html("");
                $(`#${code}monthselisihlabel`).html("");
            });

            // Tampilkan loading
            Swal.fire({
                title            : 'Sending request...',
                text             : 'Please wait',
                allowOutsideClick: false,
                allowEscapeKey   : false,
                didOpen          : () => Swal.showLoading()
            });
        },
        success: function (data) {
            Swal.fire({
                title            : 'Memproses data...',
                text             : 'Menyiapkan tampilan data rumah sakit.',
                allowOutsideClick: false,
                allowEscapeKey   : false,
                didOpen          : () => Swal.showLoading()
            });

            if (data.responCode === "00") {
                const result = data.responResult;

                const orgMap = {
                    "10c84edd-500b-49e3-93a5-a2c8cd2c8524": "rsms",
                    "d5e63fbc-01ec-4ba8-90b8-fb623438b99d": "rsiabm",
                    "a4633f72-4d67-4f65-a050-9f6240704151": "rst",
                };

                const categories = [
                    "umum", "asuransi", "bpjs", "mcu", "obat", "lain",
                    "medis", "rumah_tangga", "atk_percetakan", "it", "gizi_dapur", "farmasi"
                ];

                const pengeluaranCategories = [
                    "medis", "rumah_tangga", "atk_percetakan", "it", "gizi_dapur", "farmasi"
                ];

                // Siapkan penampung total per kategori untuk RMB
                let rmbTotals = {};
                categories.forEach(cat => rmbTotals[cat] = 0);

                result.forEach((row) => {
                    const code = orgMap[row.org_id];
                    if (!code) return;

                    let totalPendapatan = 0;
                    let totalPengeluaran = 0;

                    categories.forEach((cat) => {
                        const value = parseFloat(row[cat] || 0);
                        rmbTotals[cat] += value;

                        if (pengeluaranCategories.includes(cat)) {
                            $(`#${code}${cat}monthpengeluaran`).html("Rp. " + todesimal(value));
                            totalPengeluaran += value;
                        } else {
                            $(`#${code}${cat}monthpendapatan`).html("Rp. " + todesimal(value));
                            totalPendapatan += value;
                        }
                    });

                    const selisih = totalPendapatan - totalPengeluaran;

                    $(`#${code}monthpendapatantotal`).html("Rp. " + todesimal(totalPendapatan));
                    $(`#${code}monthpengeluarantotal`).html("Rp. " + todesimal(totalPengeluaran));
                    $(`#${code}monthselisihtotal`).html("Rp. " + todesimal(selisih));

                    $(`#total_pendapatan${code}month`).html("Rp. " + todesimal(totalPendapatan));
                    $(`#total_pengeluaran${code}month`).html("Rp. " + todesimal(totalPengeluaran));
                    $(`#saldo_akhir${code}month`).html("Rp. " + todesimal(selisih));

                    $(`#${code}monthpendapatanlabel`).html(startDate);
                    $(`#${code}monthpengeluaranlabel`).html(startDate);
                    $(`#${code}monthselisihlabel`).html(startDate);
                });

                // ===== TOTAL RMB (RUMAH BERSAMA) =====
                let totalPendapatanRmb = 0;
                let totalPengeluaranRmb = 0;

                categories.forEach((cat) => {
                    const value = rmbTotals[cat];

                    if (pengeluaranCategories.includes(cat)) {
                        $(`#rmb${cat}monthpengeluaran`).html("Rp. " + todesimal(value));
                        totalPengeluaranRmb += value;
                    } else {
                        $(`#rmb${cat}monthpendapatan`).html("Rp. " + todesimal(value));
                        totalPendapatanRmb += value;
                    }
                });

                const selisihRmb = totalPendapatanRmb - totalPengeluaranRmb;

                $(`#rmbmonthpendapatantotal`).html("Rp. " + todesimal(totalPendapatanRmb));
                $(`#rmbmonthpengeluarantotal`).html("Rp. " + todesimal(totalPengeluaranRmb));
                $(`#rmbmonthselisihtotal`).html("Rp. " + todesimal(selisihRmb));

                $(`#total_pendapatanrmbmonth`).html("Rp. " + todesimal(totalPendapatanRmb));
                $(`#total_pengeluaranrmbmonth`).html("Rp. " + todesimal(totalPengeluaranRmb));
                $(`#saldo_akhirrmbmonth`).html("Rp. " + todesimal(selisihRmb));

                $(`#rmbmonthpendapatanlabel`).html(startDate);
                $(`#rmbmonthpengeluaranlabel`).html(startDate);
                $(`#rmbmonthselisihlabel`).html(startDate);
            }
        },
        complete: function () {
            Swal.close();
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>" + error + "</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : { confirmButton: "btn btn-danger" },
                showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });

    return false;
};

function datatahunan(){
    const startDate = $("select[name='yearsperiode']").val();
    $.ajax({
        url       : url + "index.php/sb/insight/datatahunan",
        data      : {startDate:startDate},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            // Reset semua nilai elemen ke "Rp. 0" atau label kosong
            const orgCodes = ["rsms", "rsiabm", "rst", "rmb"];
            const categories = [
                "umum", "asuransi", "bpjs", "mcu", "obat", "lain",
                "medis", "rumah_tangga", "atk_percetakan", "it", "gizi_dapur", "farmasi"
            ];

            orgCodes.forEach(code => {
                categories.forEach(cat => {
                    $(`#${code}${cat}yearspendapatan`).html("Rp. 0");
                    $(`#${code}${cat}yearspengeluaran`).html("Rp. 0");
                });

                $(`#${code}yearspendapatantotal`).html("Rp. 0");
                $(`#${code}yearspengeluarantotal`).html("Rp. 0");
                $(`#${code}yearsselisihtotal`).html("Rp. 0");

                $(`#total_pendapatan${code}years`).html("Rp. 0");
                $(`#total_pengeluaran${code}years`).html("Rp. 0");
                $(`#saldo_akhir${code}years`).html("Rp. 0");

                $(`#${code}yearspendapatanlabel`).html("");
                $(`#${code}yearspengeluaranlabel`).html("");
                $(`#${code}yearsselisihlabel`).html("");
            });

            // Tampilkan loading
            Swal.fire({
                title            : 'Sending request...',
                text             : 'Please wait',
                allowOutsideClick: false,
                allowEscapeKey   : false,
                didOpen          : () => Swal.showLoading()
            });
        },
        success: function (data) {
            Swal.fire({
                title            : 'Memproses data...',
                text             : 'Menyiapkan tampilan data rumah sakit.',
                allowOutsideClick: false,
                allowEscapeKey   : false,
                didOpen          : () => Swal.showLoading()
            });
            
            if (data.responCode === "00") {
                const result = data.responResult;

                const orgMap = {
                    "10c84edd-500b-49e3-93a5-a2c8cd2c8524": "rsms",
                    "d5e63fbc-01ec-4ba8-90b8-fb623438b99d": "rsiabm",
                    "a4633f72-4d67-4f65-a050-9f6240704151": "rst",
                };

                const categories = [
                    "umum", "asuransi", "bpjs", "mcu", "obat", "lain",
                    "medis", "rumah_tangga", "atk_percetakan", "it", "gizi_dapur", "farmasi"
                ];

                const pengeluaranCategories = [
                    "medis", "rumah_tangga", "atk_percetakan", "it", "gizi_dapur", "farmasi"
                ];

                // Siapkan penampung total per kategori untuk RMB
                let rmbTotals = {};
                categories.forEach(cat => rmbTotals[cat] = 0);

                result.forEach((row) => {
                    const code = orgMap[row.org_id];
                    if (!code) return;

                    let totalPendapatan = 0;
                    let totalPengeluaran = 0;

                    categories.forEach((cat) => {
                        const value = parseFloat(row[cat] || 0);
                        rmbTotals[cat] += value;

                        if (pengeluaranCategories.includes(cat)) {
                            $(`#${code}${cat}yearspengeluaran`).html("Rp. " + todesimal(value));
                            totalPengeluaran += value;
                        } else {
                            $(`#${code}${cat}yearspendapatan`).html("Rp. " + todesimal(value));
                            totalPendapatan += value;
                        }
                    });

                    const selisih = totalPendapatan - totalPengeluaran;

                    $(`#${code}yearspendapatantotal`).html("Rp. " + todesimal(totalPendapatan));
                    $(`#${code}yearspengeluarantotal`).html("Rp. " + todesimal(totalPengeluaran));
                    $(`#${code}yearsselisihtotal`).html("Rp. " + todesimal(selisih));

                    $(`#total_pendapatan${code}years`).html("Rp. " + todesimal(totalPendapatan));
                    $(`#total_pengeluaran${code}years`).html("Rp. " + todesimal(totalPengeluaran));
                    $(`#saldo_akhir${code}years`).html("Rp. " + todesimal(selisih));

                    $(`#${code}yearspendapatanlabel`).html(startDate);
                    $(`#${code}yearspengeluaranlabel`).html(startDate);
                    $(`#${code}yearsselisihlabel`).html(startDate);
                });

                // ===== TOTAL RMB (RUMAH BERSAMA) =====
                let totalPendapatanRmb = 0;
                let totalPengeluaranRmb = 0;

                categories.forEach((cat) => {
                    const value = rmbTotals[cat];

                    if (pengeluaranCategories.includes(cat)) {
                        $(`#rmb${cat}yearspengeluaran`).html("Rp. " + todesimal(value));
                        totalPengeluaranRmb += value;
                    } else {
                        $(`#rmb${cat}yearspendapatan`).html("Rp. " + todesimal(value));
                        totalPendapatanRmb += value;
                    }
                });

                const selisihRmb = totalPendapatanRmb - totalPengeluaranRmb;

                $(`#rmbyearspendapatantotal`).html("Rp. " + todesimal(totalPendapatanRmb));
                $(`#rmbyearspengeluarantotal`).html("Rp. " + todesimal(totalPengeluaranRmb));
                $(`#rmbyearsselisihtotal`).html("Rp. " + todesimal(selisihRmb));

                $(`#total_pendapatanrmbyears`).html("Rp. " + todesimal(totalPendapatanRmb));
                $(`#total_pengeluaranrmbyears`).html("Rp. " + todesimal(totalPengeluaranRmb));
                $(`#saldo_akhirrmbyears`).html("Rp. " + todesimal(selisihRmb));

                $(`#rmbyearspendapatanlabel`).html(startDate);
                $(`#rmbyearspengeluaranlabel`).html(startDate);
                $(`#rmbyearsselisihlabel`).html(startDate);
            }
        },
        complete: function () {
            Swal.close();
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>" + error + "</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : { confirmButton: "btn btn-danger" },
                showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });

    return false;
};