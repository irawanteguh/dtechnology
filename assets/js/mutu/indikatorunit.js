masterindikator();

$(document).on("change", "select[name='toolbar_kunjunganyears_periode']", function (e) {
    e.preventDefault();
    masterindikator();
});

function masterindikator(){
    var periode = $("select[name='toolbar_kunjunganyears_periode']").val();
    $.ajax({
        url       : url+"index.php/mutu/indikatorunit/masterindikator",
        data      : {periode:periode},
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
                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'><div class='fw-bolder'>"+result[i].mutu+"</div><div class='fst-italic fs-9'>"+result[i].definisi_operasional+"</div><div><span class='badge badge-light-success'>"+result[i].jenis_indikator+"</span><span class='badge badge-light-info'>"+result[i].dimensi_mutu+"</span></div></td>";
                    tableresult +="<td><div class='fw-bolder'>Numerator :</div><div>"+result[i].numerator+"</div><div class='fw-bolder'>Denumerator :</div><div>"+result[i].denumerator+"</div></td>";
                    tableresult +="<td><div>"+result[i].target+"</div><div class='fw-bolder'>Formulasi :</div><div>"+result[i].formula+"</div></td>";
                    tableresult +="<td><div class='fw-bolder'>Tujuan :</div><div>"+result[i].tujuan+"</div><div class='fw-bolder'>Dasar Pemikiran :</div><div>"+result[i].dasar_pemikiran+"</div></td>";
                    tableresult +="<td><div class='fw-bolder'>Inklusi :</div><div>"+result[i].kriteria_inklusi+"</div><div class='fw-bolder'>Eksklusi :</div><div>"+result[i].kriteria_eksklusi+"</div></td>";
                    tableresult +="</tr>";
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