alldocument();

function alldocument(){
    $.ajax({
        url       : url+"index.php/tte/repodocument/alldocument",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");

            $("#resultdatadocument").html("");
        },
        success:function(data){
            let tablerander = "";

            if(data.responCode==="00"){
                let result = data.responResult;

                for(var i in result){

                    tablerander +="<tr>";
                    tablerander +="<td class='ps-4 text-start'>"+(parseInt(i)+1)+"</td>";
                    tablerander +="<td>";
                    tablerander +="<div class='fw-bolder'>"+result[i].no_file+".pdf <i class='bi bi-info-circle-fill' data-bs-toggle='tooltip' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>"+result[i].transaksi_id+"</b></div>'></i></div>";
                    tablerander +="<div class='badge badge-light-primary me-2 mb-1'>"+result[i].jenis_doc+"</div><br>";
                    tablerander +="<div class='badge badge-light-dark me-2'>"+(result[i].provider_sign || "Unknown Provider")+"</div>";
                    tablerander +="<div class='badge badge-light-info me-2'>"+(result[i].type_of || "Unknown Type Of Service")+"</div>";
                    tablerander +="<div class='badge badge-light-warning me-2'>"+(result[i].type_certificate || "Unknown Type Of Certificate")+"</div>";
                    tablerander +="<div class='badge badge-light-success me-4'>"+(result[i].quick_sign == 0 ? "Reguler Sign" : "Auto Sign")+"</div>";
                    tablerander +="<div class='badge badge-light-danger me-2'>"+(result[i].from_in || "Unknown Source")+"</div>";
                    tablerander +"</td>";
                    tablerander +="<td><div>"+(result[i].note_1 || "")+"</div><div>"+(result[i].note_2 || "")+"</div></td>";
                    tablerander +="<td><div>"+(result[i].name || "")+"</div><div>"+(result[i].email || "")+"</div></td>";
                    tablerander +="<td><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
                    tablerander +="<td><div>"+(result[i].dibuatoleh || "")+"</div><div>"+result[i].tglbuat+"</div></td>";
                    tablerander +="</tr>";
                }
            }

            $("#resultdatadocument").html(tablerander);

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
			toastr.clear();
            KTApp.initBootstrapTooltips();
		},
        error: function(xhr, status, error) {
            showAlert(
                "I'm Sorry",
                "<b>"+error+"</b>",
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
		}
    });
    return false;
};