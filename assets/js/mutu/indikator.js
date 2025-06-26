masterindikator();

function masterindikator(){
    $.ajax({
        url       : url+"index.php/mutu/indikator/masterindikator",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatamasterindikator").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){
                    var jenisindikator = "<span class='badge badge-light-"+result[i].colorjenisindikator+"'>"+result[i].namejenisindikator+"</span>";

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'><div class='fw-bolder'>"+result[i].mutu+"</div><div class='fst-italic fs-9'>"+result[i].definisi_operasional+"</div><div>"+jenisindikator+"<span class='badge badge-light-info'>"+result[i].dimensi_mutu+"</span></div></td>";
                    tableresult += "<td><div class='fw-bolder'>Numerator :</div><div>"+result[i].numerator+"</div><br><div class='fw-bolder'>Denumerator :</div><div>"+result[i].denumerator+"</div></td>";
                    tableresult += "<td>"+result[i].formula+"</td>";
                    tableresult += "<td><div class='fw-bolder'>Tujuan :</div><div>"+result[i].tujuan+"</div><br><div class='fw-bolder'>Dasar Pemikiran :</div><div>"+result[i].dasar_pemikiran+"</div></td>";
                    tableresult += "<td><div class='fw-bolder'>Inklusi :</div><div>"+result[i].kriteria_inklusi+"</div><br><div class='fw-bolder'>Eksklusi :</div><div>"+result[i].kriteria_eksklusi+"</div></td>";
                    tableresult += "<td>"+result[i].metode_pengumpulan_data+"</td>";
                    tableresult += "<td>"+result[i].sumber_data+"</td>";
                    tableresult += "<td>"+result[i].instrumen_pengambilan_data+"</td>";
                    tableresult += "<td>"+result[i].sampel+"</td>";
                    tableresult += "<td><div class='fw-bolder'>Pengumpulan Data :</div><div>"+result[i].periode_pengumpulan_data+"</div><br><div class='fw-bolder'>Analisis Pelaporan :</div><div>"+result[i].periode_analisis_pelaporan+"</div></td>";
                    tableresult += "<td>"+result[i].penyajian_data+"</td>";
                    tableresult += "</tr>";
                }
            }

            $("#resultdatamasterindikator").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
			toastr.clear();
		},
        error(xhr, status, error) {
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
};