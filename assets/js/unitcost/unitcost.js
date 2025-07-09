masterlayanan();
detailcomponent();

function masterlayanan(){
    $.ajax({
        url       : url+"index.php/unitcost/unitcost/masterlayanan",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatamasterlayanan").html("");
        },
        success:function(data){
            let tableresult;

            if(data.responCode==="00"){
                let result        = data.responResult;
                for(var i in result){
                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'><div class='badge badge-light-info'>"+(result[i].kategori ? result[i].kategori : "")+"</div></td>";
                    tableresult +="<td>"+(result[i].nama_layan ? result[i].nama_layan : "")+"</td>";
                    
                    // tableresult +="<td>"+(result[i].dibuatoleh ? result[i].dibuatoleh : "")+"</td>";
                    tableresult +="</tr>";
                }
            }


            $("#resultdatamasterlayanan").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
			//
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
};

function detailcomponent() {
    $.ajax({
        url: url + "index.php/unitcost/unitcost/detailcomponent",
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatadetailcomponent").html("");
        },
        success: function (data) {
            let tableresult = "";

            if (data.responCode === "00") {
                const result = data.responResult;
                const grouped = {};
                let grandtotal = 0;

                // 1. Kelompokkan data berdasarkan kategori
                for (const i in result) {
                    const kategori = result[i].kategori || "Tanpa Kategori";
                    if (!grouped[kategori]) grouped[kategori] = [];
                    grouped[kategori].push(result[i]);
                }

                // 2. Loop per kategori
                for (const kategori in grouped) {
                    const items = grouped[kategori];
                    let subtotal = 0;

                    // Header kategori
                    tableresult += `<tr class="table-primary fw-bold">
                                        <td colspan="5" class="ps-3">${kategori}</td>
                                        <td></td>
                                    </tr>`;

                    // 3. Baris komponen
                    for (let i = 0; i < items.length; i++) {
                        const row       = items[i];
                        const biaya     = Number(row.total_biaya_per_pasien) || 0;
                        subtotal       += biaya;
                        grandtotal     += biaya;

                        tableresult += `<tr>
                                            <td class='ps-4'>${row.namecomponent || ""}</td>
                                            <td class='text-end'>${row.depresiasi_pasien ? todesimal(row.depresiasi_pasien) : "0"}</td>
                                            <td class='text-end'>${row.pemeliharaan_pasien ? todesimal(row.pemeliharaan_pasien) : "0"}</td>
                                            <td class='text-end'>${row.bunga_pasien ? todesimal(row.bunga_pasien) : "0"}</td>
                                            <td class='text-end'>${biaya ? todesimal(biaya) : "0"}</td>
                                            <td class='text-end'>
                                                <a class='btn btn-sm btn-light-primary'>Detail</a>
                                            </td>
                                        </tr>`;
                    }

                    // 4. Subtotal kategori
                    tableresult += `<tr class="table-warning fw-semibold">
                                        <td class="text-end pe-2" colspan='4'>Subtotal</td>
                                        <td class="text-end fw-bold pe-3">${todesimal(subtotal)}</td>
                                        <td></td>
                                    </tr>`;
                }

                // 5. Grand total di akhir semua kategori
                tableresult += `<tr class="table-success fw-bold">
                                    <td class="text-end pe-2" colspan='4'>Grand Total</td>
                                    <td class="text-end pe-3">${todesimal(grandtotal)}</td>
                                    <td></td>
                                </tr>`;

                // 6. Tambahan: Total Unit Cost x 30%
                const totalUnitCost30 = (grandtotal * 0.3)+grandtotal;
                tableresult += `<tr class="table-info fw-bold">
                                    <td class="text-end pe-2" colspan='4'>Total Unit Cost x 30%</td>
                                    <td class="text-end pe-3">${todesimal(totalUnitCost30)}</td>
                                    <td></td>
                                </tr>`;
            } else {
                tableresult = `<tr><td colspan='6' class='text-center text-danger'>${data.responDesc}</td></tr>`;
            }

            $("#resultdatadetailcomponent").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html: "<b>" + error + "</b>",
                icon: "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling: false,
                timerProgressBar: true,
                timer: 5000,
                customClass: { confirmButton: "btn btn-danger" },
                showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });
    return false;
}


