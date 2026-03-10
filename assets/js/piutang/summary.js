datapiutang();

// const filterjenis   = new Tagify(document.querySelector("#filterjenis"), { enforceWhitelist: true });
// const filterrekanan = new Tagify(document.querySelector("#filterrekanan"), { enforceWhitelist: true });
// const filterperiode = new Tagify(document.querySelector("#filterperiode"), { enforceWhitelist: true });

// function filterTable() {
//     const jenisfilter   = filterjenis.value.map(tag => tag.value);
//     const periodefilter = filterrekanan.value.map(tag => tag.value); // ini sebenarnya 'periode'
//     const rekananfilter = filterperiode.value.map(tag => tag.value); // ini sebenarnya 'provider'

//     const tbody = document.getElementById("resultrekappiutang");
//     const rows = tbody.getElementsByTagName("tr");

//     for (const row of rows) {
//         const jenis   = row.getElementsByTagName("td")[0].textContent.trim();
//         const periode = row.getElementsByTagName("td")[1].textContent.trim(); // periode_indonesia
//         const rekanan = row.getElementsByTagName("td")[2].textContent.trim(); // provider(s)

//         const showRow = 
//             (jenisfilter.length === 0 || jenisfilter.includes(jenis)) &&
//             (periodefilter.length === 0 || periodefilter.includes(periode)) &&
//             (rekananfilter.length === 0 || rekananfilter.includes(rekanan))

//         row.style.display = showRow ? "" : "none";
//     }
// }


// filterjenis.on('change', filterTable);
// filterrekanan.on('change', filterTable);
// filterperiode.on('change', filterTable);

$(document).on("change", "select[name='toolbar_kunjunganyears_periode']", function (e) {
    e.preventDefault();
    datapiutang();
});

// function datapiutang() {
//     var tahun = $("select[name='toolbar_kunjunganyears_periode']").val();
//     $.ajax({
//         url: url + "index.php/piutang/summary/datapiutang",
//         data: { periode: tahun },
//         method: "POST",
//         dataType: "JSON",
//         cache: false,
//         beforeSend: function () {
//             toastr.clear();
//             toastr["info"]("Mengambil data piutang...", "Harap tunggu");

//             // Kosongkan semua tabel per bulan
//             for (var i = 1; i <= 12; i++) {
//                 $("#resultdatapiutang_" + i).html("");
//                 $("#resulttotaldatapiutang_" + i).html(""); // Kosongkan tfoot
//             }
//         },
//         success: function (data) {
//             if (data.responCode === "00") {
//                 let result  = data.responResult;
//                 var jenis   = new Set();
//                 var rekanan = new Set();
//                 var periode = new Set();

//                 // Struktur penampung total per bulan
//                 let totals = {};
//                 for (let i = 1; i <= 12; i++) {
//                     totals[i] = { nilai: 0, terbayar: 0, sisa: 0 };
//                 }

//                 result.forEach(function (item) {
//                     let bulan    = parseInt(item.periode.split('.')[0]);
//                     let nilai    = parseFloat(item.jml) || 0;
//                     let terbayar = parseFloat(item.jmlterbayar) || 0;
//                     let sisa     = nilai - terbayar;

//                     // Provider dipecah jadi <div> per baris jika mengandung ;
//                     let providers = item.provider ? item.provider.split(";") : [];
//                     let providerHtml = providers.map(p => "<div>" + p.trim() + "</div>").join("");

//                     // Bangun baris tabel
//                     let baris = "<tr>";
//                     baris += "<td class='ps-4'>" + item.jenistagihan + "</td>";
//                     baris += "<td><div class='badge badge-light-info'>" + item.periode_indonesia + "</div></td>";
//                     baris += "<td>" + providerHtml + "</td>";
//                     baris += "<td class='text-end'>" + todesimal(nilai) + "</td>";
//                     baris += "<td class='text-end'>" + todesimal(terbayar) + "</td>";
//                     baris += "<td class='text-end pe-4'>" + todesimal(sisa) + "</td>";
//                     baris += "</tr>";

//                     // Masukkan ke tabel berdasarkan bulan
//                     $("#resultdatapiutang_" + bulan).append(baris);

//                     // Akumulasi total per bulan
//                     totals[bulan].nilai    += nilai;
//                     totals[bulan].terbayar += terbayar;
//                     totals[bulan].sisa     += sisa;

//                     jenis.add(item.jenistagihan);
//                     rekanan.add(item.periode_indonesia);
//                     periode.add(item.providerHtml);
//                 });

//                 // Tampilkan total per bulan di tfoot
//                 for (let i = 1; i <= 12; i++) {
//                     let totalBaris = "<tr class='fw-bold bg-light'>";
//                     totalBaris += "<td colspan='3' class='text-end rounded-start'>Total</td>";
//                     totalBaris += "<td class='text-end'>" + todesimal(totals[i].nilai) + "</td>";
//                     totalBaris += "<td class='text-end'>" + todesimal(totals[i].terbayar) + "</td>";
//                     totalBaris += "<td class='text-end pe-4 rounded-end'>" + todesimal(totals[i].sisa) + "</td>";
//                     totalBaris += "</tr>";

//                     $("#resulttotaldatapiutang_" + i).html(totalBaris);
//                 }

//                 filterjenis.settings.whitelist   = Array.from(jenis);
//                 filterrekanan.settings.whitelist = Array.from(rekanan);
//                 filterperiode.settings.whitelist = Array.from(periode);

//                 toastr["success"]("Data berhasil dimuat", "INFORMASI");
//             } else {
//                 toastr["warning"](data.responDesc || "Data tidak ditemukan", "PERINGATAN");
//             }
//         },
//         complete: function () {
//             toastr.clear();
//         },
//         error: function (xhr, status, error) {
//             showAlert("Maaf", error, "error", "Silakan coba lagi", "btn btn-danger");
//         }
//     });

//     return false;
// }

// =====================
// Inisialisasi Tagify
// =====================
const tagifyInstances = {};

for (let i = 1; i <= 12; i++) {
    tagifyInstances[i] = {
        jenis:    new Tagify(document.querySelector(`#filterjenis_${i}`), { enforceWhitelist: true }),
        periode:  new Tagify(document.querySelector(`#filterperiode_${i}`), { enforceWhitelist: true }),
        rekanan:  new Tagify(document.querySelector(`#filterrekanan_${i}`), { enforceWhitelist: true }),
    };

    // Pasang event filter per bulan
    tagifyInstances[i].jenis.on('change', () => filterTable(i));
    tagifyInstances[i].periode.on('change', () => filterTable(i));
    tagifyInstances[i].rekanan.on('change', () => filterTable(i));
}


// =====================
// Fungsi Filter Tabel
// =====================
function filterTable(bulanKe) {
    const tagify = tagifyInstances[bulanKe];
    if (!tagify) return;

    const jenisfilter   = tagify.jenis.value.map(tag => tag.value);
    const periodefilter = tagify.periode.value.map(tag => tag.value);
    const rekananfilter = tagify.rekanan.value.map(tag => tag.value);

    const tbody = document.getElementById(`resultdatapiutang_${bulanKe}`);
    if (!tbody) return;

    const rows = tbody.getElementsByTagName("tr");

    for (const row of rows) {
        const jenis   = row.getElementsByTagName("td")[0]?.textContent.trim();
        const periode = row.getElementsByTagName("td")[1]?.textContent.trim();
        const rekananRaw = row.getElementsByTagName("td")[2]?.textContent.trim();
        const rekananList = rekananRaw.split("\n").map(p => p.trim()).filter(p => p !== "");

        const showRow =
            (jenisfilter.length === 0 || jenisfilter.includes(jenis)) &&
            (periodefilter.length === 0 || periodefilter.includes(periode)) &&
            (rekananfilter.length === 0 || rekananfilter.some(r => rekananList.includes(r)));

        row.style.display = showRow ? "" : "none";
    }
}



// ======================
// Ambil dan Tampilkan Data Piutang
// ======================
function datapiutang() {
    var tahun = $("select[name='toolbar_kunjunganyears_periode']").val();

    $.ajax({
        url: url + "index.php/piutang/summary/datapiutang",
        data: { periode: tahun },
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Mengambil data piutang...", "Harap tunggu");

            for (let i = 1; i <= 12; i++) {
                $(`#resultdatapiutang_${i}`).html("");
                $(`#resulttotaldatapiutang_${i}`).html("");
            }
        },
        success: function (data) {
            if (data.responCode === "00") {
                const result = data.responResult;

                // Siapkan Set per bulan untuk whitelist
                const jenisMap   = {};
                const periodeMap = {};
                const rekananMap = {};
                const totals     = {};

                for (let i = 1; i <= 12; i++) {
                    jenisMap[i] = new Set();
                    periodeMap[i] = new Set();
                    rekananMap[i] = new Set();
                    totals[i] = { nilai: 0, terbayar: 0, sisa: 0 };
                }

                result.forEach(function (item) {
                    const bulan      = parseInt(item.periode.split('.')[0]);
                    const nilai      = parseFloat(item.jml) || 0;
                    const terbayar   = parseFloat(item.jmlterbayar) || 0;
                    const sisa       = nilai - terbayar;

                    const providers  = item.provider ? item.provider.split(";") : [];
                    const providerHtml = providers.map(p => "<div>" + p.trim() + "</div>").join("");

                    let baris = "<tr>";
                    baris += "<td class='ps-4'>" + item.jenistagihan + "</td>";
                    baris += "<td><div class='badge badge-light-info'>" + item.periode_indonesia + "</div></td>";
                    baris += "<td>" + providerHtml + "</td>";
                    baris += "<td class='text-end'>" + todesimal(nilai) + "</td>";
                    baris += "<td class='text-end'>" + todesimal(terbayar) + "</td>";
                    baris += "<td class='text-end pe-4'>" + todesimal(sisa) + "</td>";
                    baris += "</tr>";

                    $(`#resultdatapiutang_${bulan}`).append(baris);

                    totals[bulan].nilai    += nilai;
                    totals[bulan].terbayar += terbayar;
                    totals[bulan].sisa     += sisa;

                    jenisMap[bulan].add(item.jenistagihan);
                    periodeMap[bulan].add(item.periode_indonesia);
                    providers.forEach(p => rekananMap[bulan].add(p.trim()));
                });

                for (let i = 1; i <= 12; i++) {
                    const totalBaris = `
                        <tr class='fw-bold bg-light'>
                            <td colspan='3' class='text-end rounded-start'>Total</td>
                            <td class='text-end'>${todesimal(totals[i].nilai)}</td>
                            <td class='text-end'>${todesimal(totals[i].terbayar)}</td>
                            <td class='text-end pe-4 rounded-end'>${todesimal(totals[i].sisa)}</td>
                        </tr>`;
                    $(`#resulttotaldatapiutang_${i}`).html(totalBaris);

                    // Set whitelist untuk filter bulan i
                    if (tagifyInstances[i]) {
                        tagifyInstances[i].jenis.settings.whitelist   = Array.from(jenisMap[i]);
                        tagifyInstances[i].periode.settings.whitelist = Array.from(periodeMap[i]);
                        tagifyInstances[i].rekanan.settings.whitelist = Array.from(rekananMap[i]);
                    }
                }

                toastr["success"]("Data berhasil dimuat", "INFORMASI");
            } else {
                toastr["warning"](data.responDesc || "Data tidak ditemukan", "PERINGATAN");
            }
        },
        complete: function () {
            toastr.clear();
        },
        error: function (xhr, status, error) {
            showAlert("Maaf", error, "error", "Silakan coba lagi", "btn btn-danger");
        }
    });

    return false;
}

