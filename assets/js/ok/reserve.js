dataok();

flatpickr('[name="modal_add_plan_date"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    minDate   : "today",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

function dataok(){
    $.ajax({
        url       : url+"index.php/ok/reserve/dataok",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdataok").html("");
        },
        success:function(data){
            let tableresult;

            if(data.responCode==="00"){
                let result        = data.responResult;
                for(var i in result){
                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'><div class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</div></td>";
                    tableresult +="<td><div>"+(result[i].mrpasien ? result[i].mrpasien : "")+"</div><div>"+(result[i].namepasien ? result[i].namepasien : "")+"</div></td>";
                    tableresult +="<td>"+(result[i].tgltindakan ? result[i].tgltindakan : "")+"</td>";
                    tableresult +="<td>"+(result[i].tindakan ? result[i].tindakan : "")+"</td>";
                    tableresult +="<td>"+(result[i].operator ? result[i].operator : "")+"</td>";
                    tableresult +="<td>"+(result[i].anastesi ? result[i].anastesi : "")+"</td>";
                    tableresult +="<td>"+(result[i].anak ? result[i].anak : "")+"</td>";
                    tableresult +="<td></td>";
                    tableresult +="<td></td>";
                    tableresult +="<td class='text-end pe-4'><div>"+(result[i].dibuatoleh ? result[i].dibuatoleh : "")+"</div><div>"+(result[i].tglbuat ? result[i].tglbuat : "")+"</div></td>";
                    tableresult +="</tr>";
                }
            }


            $("#resultdataok").html(tableresult);
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