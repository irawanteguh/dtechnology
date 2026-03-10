masterrkk();

function masterrkk(){
    $.ajax({
        url        : url+"index.php/komiteperawat/details/masterrkk",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmasterrkk").html("");
        },
        success:function(data){
            let tableresult ="";

            if(data.responCode==="00"){
                let result        = data.responResult;
                for(var i in result){
                    if(result[i].jenis_id==="H"){
                        tableresult +="<tr class='bg-info text-white'>";
                        tableresult +="<td class='ps-4' colspan='5'>"+result[i].activity+"</td>";
                    }else{
                        tableresult +="<tr>";
                        tableresult +="<td class='ps-4'>"+result[i].klinis+"</td>";
                        tableresult +="<td>"+result[i].activity+"</td>";
                        tableresult +="<td>"+result[i].kewenangan+"</td>";
                        tableresult +="<td><div>" + (result[i].dibuatoleh || "") + "<div>" + (result[i].tgldibuat || "") + "</div></td>";
                        tableresult +="<td class='text-end'>";
                            tableresult += "<div class='btn-group' role='group'>";
                                tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                                tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                    tableresult += "<a class='dropdown-item btn btn-sm' data-kt-drawer-show='true' data-kt-drawer-target='#drawer_employee_rkk_add'  onclick='getdata($(this));'><i class='bi bi-pencil'></i> Clinical Authority</a>";
                                tableresult +="</div>";
                            tableresult +="</div>";
                        tableresult +="</td>";
                    }
                    tableresult +="</tr>";
                }
            }

            $("#resultmasterrkk").html(tableresult);

            toastr.clear();
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