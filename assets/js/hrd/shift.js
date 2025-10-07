jadwalshift();

function jadwalshift(){
    $.ajax({
        url        : url+"index.php/hrd/shift/jadwalshift",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatajadwalshift").html("");
        },
        success:function(data){
            toastr.clear();
            var result              = "";
            var tableresult         = "";

            if(data.responCode === "00") {
                result = data.responResult;
                for(var i in result){
                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].name + "</td>";

                    for(var j = 1; j <= 31; j++){
                        let h = result[i]['h'+j]; // misal: "08.00.00;12.00.00;P;red"
                        if(h){
                            let parts = h.split(';');
                            let jammasuk = parts[0] || '';
                            let jampulang = parts[1] || '';
                            let code = parts[2] || '';
                            let colorClass = parts[3] ? 'table-' + parts[3].replace('#','') : ''; // bg-ff0000

                            tableresult += `<td class='text-center ${colorClass}' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-trigger='hover' data-bs-placement='right' title='<div class="text-start"><b>Informasi</b><hr style="margin:5px 0;">Jam Masuk : ${jammasuk}<br>Jam Pulang : ${jampulang}</div>'>${code}</td>`;
                        } else {
                            tableresult += "<td class='text-center table-success'></td>";
                        }
                    }

                    tableresult += "</tr>";
                }
            }



            $("#resultdatajadwalshift").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            KTApp.initBootstrapTooltips();
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