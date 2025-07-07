masterassets();

function masterassets(){
    $.ajax({
        url       : url+"index.php/assets/listassets/masterassets",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatamasterassets").html("");
        },
        success:function(data){
            let tableresult;

            if(data.responCode==="00"){
                let result        = data.responResult;
                for(var i in result){
                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'>"+(result[i].no_assets ? result[i].no_assets : "")+"</td>";
                    tableresult +="<td><div>"+result[i].name+"</div><div class='fst-italic fs-9'>"+(result[i].spesifikasi ? result[i].spesifikasi : "")+"</div></td>";
                    tableresult +="<td><div class='badge badge-light-info'>"+(result[i].kategori ? result[i].kategori : "")+"</div></td>";
                    tableresult +="<td>"+(result[i].serial_number ? result[i].serial_number : "")+"</td>";
                    tableresult +="<td>"+(result[i].tahun_pembuatan ? result[i].tahun_pembuatan : "")+"</td>";
                    tableresult +="<td>"+(result[i].tglpembelian ? result[i].tglpembelian : "")+"</td>";
                    tableresult +="<td>"+(result[i].nilai_ekonomis ? result[i].nilai_ekonomis+" Tahun" : "")+"</td>";
                    tableresult +="<td class='text-end'>"+(result[i].nilai_perolehan ? todesimal(result[i].nilai_perolehan) : "")+"</td>";
                    tableresult +="<td class='text-end'>"+(result[i].nilai_pemeliharaan ? todesimal(result[i].nilai_pemeliharaan) : "")+"</td>";
                    tableresult +="<td>"+(result[i].masa_bunga ? result[i].masa_bunga+" Tahun" : "")+"</td>";
                    tableresult +="<td class='text-end'>"+(result[i].nilai_bunga_pinjaman ? todesimal(result[i].nilai_bunga_pinjaman) : "")+"</td>";
                    tableresult +="<td class='text-end'>"+(result[i].nilai_residu ? todesimal(result[i].nilai_residu) : "")+"</td>";
                    tableresult +="<td class='text-center'>"+(result[i].estimasi_penggunaan_day ? result[i].estimasi_penggunaan_day+" Pasien / Hari" : "")+"</td>";

                    tableresult +="<td class='text-end'>"+(result[i].depresiasi_tahun ? todesimal(result[i].depresiasi_tahun) : "")+"</td>";
                    tableresult +="<td class='text-end'>"+(result[i].depresiasi_bulan ? todesimal(result[i].depresiasi_bulan) : "")+"</td>";
                    tableresult +="<td class='text-end'>"+(result[i].depresiasi_hari ? todesimal(result[i].depresiasi_hari) : "")+"</td>";
                    tableresult +="<td class='text-end'>"+(result[i].depresiasi_pasien ? todesimal(result[i].depresiasi_pasien) : "")+"</td>";

                    tableresult +="<td class='text-end'>"+(result[i].pemeliharaan_tahun ? todesimal(result[i].pemeliharaan_tahun) : "")+"</td>";
                    tableresult +="<td class='text-end'>"+(result[i].pemeliharaan_bulan ? todesimal(result[i].pemeliharaan_bulan) : "")+"</td>";
                    tableresult +="<td class='text-end'>"+(result[i].pemeliharaan_hari ? todesimal(result[i].pemeliharaan_hari) : "")+"</td>";
                    tableresult +="<td class='text-end'>"+(result[i].pemeliharaan_pasien ? todesimal(result[i].pemeliharaan_pasien) : "")+"</td>";

                    tableresult +="<td class='text-end'>"+(result[i].bunga_tahun ? todesimal(result[i].bunga_tahun) : "0")+"</td>";
                    tableresult +="<td class='text-end'>"+(result[i].bunga_bulan ? todesimal(result[i].bunga_bulan) : "0")+"</td>";
                    tableresult +="<td class='text-end'>"+(result[i].bunga_hari ? todesimal(result[i].bunga_hari) : "0")+"</td>";
                    tableresult +="<td class='text-end'>"+(result[i].bunga_pasien ? todesimal(result[i].bunga_pasien) : "0")+"</td>";

                    tableresult += "<td class='text-end'>" + todesimal((parseFloat(result[i].depresiasi_pasien) || 0) + (parseFloat(result[i].pemeliharaan_pasien) || 0) + (parseFloat(result[i].bunga_pasien) || 0)) + "</td>";
                    tableresult +="<td class='text-end'>"+(result[i].depresiasi_saat_ini ? todesimal(result[i].depresiasi_saat_ini) : "")+"</td>";
                    tableresult += "<td class='text-end " + ((result[i].nilai_buku_sisa < 0) ? "table-success" : "") + "'>" + (result[i].nilai_buku_sisa != null ? todesimal(Math.abs(result[i].nilai_buku_sisa)) : "") + "</td>";

                    // tableresult +="<td>"+(result[i].dibuatoleh ? result[i].dibuatoleh : "")+"</td>";
                    tableresult +="</tr>";
                }
            }


            $("#resultdatamasterassets").html(tableresult);
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

// $(document).on("submit", "#forminsertassets", function (e) {
// 	e.preventDefault();
// 	var form = $(this);
//     var url  = $(this).attr("action");

// 	$.ajax({
//         url       : url,
//         data      : form.serialize(),
//         method    : "POST",
//         dataType  : "JSON",
//         cache     : false,
//         beforeSend: function () {
//             toastr.clear();
//             toastr["info"]("Sending request...", "Please wait");
// 			$("#btn_assets_add").addClass("disabled");
//         },
// 		success: function (data) {
//             if(data.responCode == "00"){
//                 masterassets();
//                 $('#modal_assets_add').modal('hide');
// 			}

//             toastr.clear();
// 			toastr[data.responHead](data.responDesc, "INFORMATION");
// 		},
//         complete: function () {
//             toastr.clear();
//             $("#btn_assets_add").removeClass("disabled");
// 		},
//         error: function(xhr, status, error) {
//             Swal.fire({
//                 title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
//                 html             : "<b>"+error+"</b>",
//                 icon             : "error",
//                 confirmButtonText: "Please Try Again",
//                 buttonsStyling   : false,
//                 timerProgressBar : true,
//                 timer            : 5000,
//                 customClass      : {confirmButton: "btn btn-danger"},
//                 showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
//                 hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
//             });
// 		}		
// 	});
//     return false;
// });