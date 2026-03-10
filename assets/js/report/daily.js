
const checkbox      = document.getElementById('typeperiode');
const dateContainer = document.getElementById('date-container');

checkbox.addEventListener('change', toggleDateInput);
checkbox.addEventListener('change', updateCheckboxValue);

flatpickr('[name="dateperiode"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    maxDate   : "today",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

$(document).on("click",".btn-apply", function(e){            
    e.preventDefault();
    var provider    = $("select[name='toolbar_report_provider']").val();
    var typeperiode = $("input[name='typeperiode']").val();
    var dateperiode = $("input[name='dateperiode']").val();

    billing(provider,typeperiode,dateperiode);

    dateContainer.classList.add('d-none'); // Menyembunyikan dateContainer
    checkbox.checked = true; // Mengatur checkbox menjadi checked
    checkbox.value = "Y"; // Mengatur nilai checkbox menjadi "Y"
});

function toggleDateInput() {
    if (checkbox.checked) {
        dateContainer.classList.add('d-none');
    } else {
        dateContainer.classList.remove('d-none');
    }
}

function updateCheckboxValue() {
    if (checkbox.checked) {
        checkbox.value = "Y";
    } else {
        checkbox.value = "N";
    }
}

function billing(provider,typeperiode,dateperiode){
    $.ajax({
        url        : url+"index.php/report/daily/billing",
        data       : {provider:provider,typeperiode:typeperiode,dateperiode:dateperiode},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultbillingrawatjalan").html("");
            $("#footresultbillingrawatjalan").html("");
            $("#resultbillingrawatinap").html("");
        },
        success:function(data){
            toastr.clear();
            var tableresultRJ      = "";
            var tableresultRI      = "";
            var foottableresultRJ  = "";
            var total_grandtotalRJ = 0;

            if(data.responCode==="00"){
                var result        = data.responResult;
                for(var i in result){

                    if(result[i].status_lanjut==='Ralan'){
                        tableresultRJ +="<tr>";
                        tableresultRJ +="<td class='ps-4'>"+result[i].tgl_registrasi+" "+result[i].jam_reg+"</td>";
                        tableresultRJ +="<td><div>"+result[i].no_rkm_medis+"</div><div>"+result[i].namapasien+"</div></td>";
                        tableresultRJ +="<td>"+(result[i].nobilling ? result[i].nobilling : "")+"</td>";
                        tableresultRJ +="<td>"+result[i].politujuan+"</td>";
                        tableresultRJ +="<td>"+result[i].provider+"</td>";
                        tableresultRJ +="<td class='text-end'>"+(result[i].biayareg ? todesimal(result[i].biayareg) : "0")+"</td>";
                        tableresultRJ +="<td class='text-end'>"+(result[i].biayaobat ? todesimal(result[i].biayaobat) : "0")+"</td>";
                        tableresultRJ +="<td class='text-end'>"+(result[i].biayalab ? todesimal(result[i].biayalab) : "0")+"</td>";
                        tableresultRJ +="<td class='text-end'>"+(result[i].biayarad ? todesimal(result[i].biayarad) : "0")+"</td>";
    
                        tableresultRJ +="<td class='text-end'>"+(result[i].RJtindakanparamedic ? todesimal(result[i].RJtindakanparamedic) : "0")+"</td>";
                        tableresultRJ +="<td class='text-end'>"+(result[i].RJtindakandokter ? todesimal(result[i].RJtindakandokter) : "0")+"</td>";
                        tableresultRJ +="<td class='text-end pe-4'>"+(result[i].grandtotal ? todesimal(result[i].grandtotal) : "0")+"</td>";
                        tableresultRJ +="</tr>";
    
                        total_grandtotalRJ = total_grandtotalRJ+parseFloat(result[i].grandtotal);
                    }else{
                        tableresultRI +="<tr>";
                        tableresultRI +="<td class='ps-4'>"+result[i].tgl_registrasi+" "+result[i].jam_reg+"</td>";
                        tableresultRI +="<td><div>"+result[i].no_rkm_medis+"</div><div>"+result[i].namapasien+"</div></td>";
                        tableresultRI +="<td>"+(result[i].nobilling ? result[i].nobilling : "")+"</td>";
                        tableresultRI +="<td>"+result[i].politujuan+"</td>";
                        tableresultRI +="<td>"+result[i].provider+"</td>";
                        tableresultRI +="<td class='text-end'>"+(result[i].biayareg ? todesimal(result[i].biayareg) : "0")+"</td>";
                        tableresultRI +="<td class='text-end'>"+(result[i].biayaobat ? todesimal(result[i].biayaobat) : "0")+"</td>";
                        tableresultRI +="<td class='text-end'>"+(result[i].biayalab ? todesimal(result[i].biayalab) : "0")+"</td>";
                        tableresultRI +="<td class='text-end'>"+(result[i].biayarad ? todesimal(result[i].biayarad) : "0")+"</td>";
    
                        tableresultRI +="<td class='text-end'>"+(result[i].RJtindakanparamedic ? todesimal(result[i].RJtindakanparamedic) : "0")+"</td>";
                        tableresultRI +="<td class='text-end'>"+(result[i].RJtindakandokter ? todesimal(result[i].RJtindakandokter) : "0")+"</td>";
                        tableresultRI +="<td class='text-end pe-4'>"+(result[i].grandtotal ? todesimal(result[i].grandtotal) : "0")+"</td>";
                        tableresultRI +="</tr>";
                    }
                    
                }

                foottableresultRJ +="<tr>";
                foottableresultRJ +="<td class='ps-4' colspan='10'>Grand Total</td>";
                foottableresultRJ +="<td class='pe-4'>"+todesimal(total_grandtotalRJ)+"</td>";
                foottableresultRJ +="</tr>";

            }

            $("#resultbillingrawatjalan").html(tableresultRJ);
            $("#footresultbillingrawatjalan").html(foottableresultRJ);
            $("#resultbillingrawatinap").html(tableresultRI);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
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
};