datamonitoring();

$(document).on("change", "select[name='selectorganization']", function (e) {
    e.preventDefault();
    datamonitoring();
});

$(document).on("change", "select[name='filterperiode']", function (e) {
    e.datamonitoring();
    datagrafik();
});

function datamonitoring() {
    const filterperiode      = $("select[name='filterperiode']").val();
    const selectorganization = $("select[name='selectorganization']").val();

    $.ajax({
        url     : url + "index.php/po/status/datamonitoring",
        method  : "POST",
        data    : {filterperiode:filterperiode,selectorganization:selectorganization},
        dataType: "JSON",
        cache   : false,
        beforeSend() {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatamonitoring").html("");
        },
        success(data) {
            var result              = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){
                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'><div>"+result[i].no_pemesanan_unit+"</div>"+(result[i].cito==="Y"?"<div class='badge badge-light-danger fw-bolder fa-fade me-2'>CITO</div>":"")+"<div class='badge badge-light-"+result[i].colorjenis+"'>"+result[i].namejenis+"</div></td>";
                    tableresult +="<td><div class='fw-bolder'>"+result[i].judul_pemesanan+"</div><div class='small fst-italic'>"+result[i].note+"</div></td>";
                    tableresult +="<td>"+result[i].unitpelaksana+"</td>";
                    tableresult +="<td>"+todesimal(result[i].total)+"</td>";
                    tableresult +="<td class='text-end'><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
                    
                    if(result[i].method==="4"){
                        if(result[i].status==="0"){
                            tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-warning' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Menunggu Persetujuan</b></div>'></i></td>";
                        }else{
                            tableresult +="<td></td>";
                        }
                        
                        if(result[i].flagkoordinator==="0"){
                            tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        }else{
                            tableresult +="<td></td>";
                        }
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                    }

                    if(result[i].method==="5"){
                        tableresult +="<td></td>";
                        if(result[i].flagkoordinator==="0"){
                            tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        }else{
                            tableresult +="<td></td>";
                        }
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                    }

                    if(result[i].method==="6"){
                        tableresult +="<td></td>";
                        if(result[i].flagkoordinator==="0"){
                            tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        }else{
                            tableresult +="<td></td>";
                        }
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                    }

                    if(result[i].method==="7"){
                        tableresult +="<td></td>";
                        if(result[i].flagkoordinator==="0"){
                            tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        }else{
                            tableresult +="<td></td>";
                        }
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        if(parseFloat(result[i].total)<=2000000){
                            tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                            tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        }else{
                            if(parseFloat(result[i].total)<=5000000){
                                tableresult +="<td></td>";
                                tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                            }else{
                                tableresult +="<td></td>";
                                tableresult +="<td></td>";
                            }
                        }
                    }

                    if(result[i].method==="8"){
                        tableresult +="<td></td>";
                        if(result[i].flagkoordinator==="0"){
                            tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        }else{
                            tableresult +="<td></td>";
                        }
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                    }

                    if(result[i].method==="9"){
                        tableresult +="<td></td>";
                        if(result[i].flagkoordinator==="0"){
                            tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        }else{
                            tableresult +="<td></td>";
                        }
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                    }

                    if(result[i].method==="10"){
                        tableresult +="<td></td>";
                        if(result[i].flagkoordinator==="0"){
                            tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        }else{
                            tableresult +="<td></td>";
                        }
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        if(parseFloat(result[i].total)<=500000){
                            tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                            tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        }else{
                            tableresult +="<td></td>";
                            tableresult +="<td></td>";
                        }
                    }

                    if(result[i].method==="11"){
                        tableresult +="<td></td>";
                        if(result[i].flagkoordinator==="0"){
                            tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        }else{
                            tableresult +="<td></td>";
                        }
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                    }

                    if(result[i].method==="12"){
                        tableresult +="<td></td>";
                        if(result[i].flagkoordinator==="0"){
                            tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        }else{
                            tableresult +="<td></td>";
                        }
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                    }

                    if(result[i].method==="13"){
                        tableresult +="<td></td>";
                        if(result[i].flagkoordinator==="0"){
                            tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        }else{
                            tableresult +="<td></td>";
                        }
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                    }

                    if(result[i].method==="14"){
                        tableresult +="<td></td>";
                        if(result[i].flagkoordinator==="0"){
                            tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        }else{
                            tableresult +="<td></td>";
                        }
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                        tableresult +="<td></td>";
                        tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan</b></div>'></i></td>";
                    }
                    

                    tableresult +="<td class='text-end'><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";
                    tableresult +="<td></td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultdatamonitoring").html(tableresult);

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete() {
            toastr.clear();
            KTApp.initBootstrapTooltips();
        },
        error(xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>" + error + "</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : { confirmButton: "btn btn-danger" },
                showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });

    return false;
};


                    // if(result[i].status==="0"){
                    //     tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-warning' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Belum Di Setujui Kepala Instalasi</b></div>'></i></td>";
                    // }else{
                    //     if(result[i].status==="1"){
                    //         tableresult +="<td class='text-center'><i class='bi bi-x-circle-fill text-danger' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Di Batalkan Kepala Instalasi</b><hr style=\"margin:5px 0;\">"+result[i].kainsname+"<br>"+result[i].kainsdate+"</div>'></i></td>";
                    //     }else{
                    //         tableresult +="<td class='text-center'><i class='bi bi-check-circle-fill text-success' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Di Setujui Kepala Instalasi</b><hr style=\"margin:5px 0;\">"+result[i].kainsname+"<br>"+result[i].kainsdate+"</div>'></i></td>";
                    //     }
                    // }
                    
                    // if(result[i].flagkoordinator==="0"){
                    //     tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Memerlukan Persetujuan Koordinator</b></div>'></i></td>";
                    // }else{
                    //     if(result[i].status==="18"){
                    //         tableresult +="<td class='text-center'><i class='bi bi-x-circle-fill text-danger' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Tidak Di Setujui Koordinator</b><hr style=\"margin:5px 0;\">"+result[i].koordinatorname+"<br>"+result[i].koordinatordate+"</div>'></i></td>";
                    //     }else{
                    //         if(result[i].status!="0"){
                    //             tableresult +="<td class='text-center'><i class='bi bi-check-circle-fill text-success' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Di Setujui Koordinator</b><hr style=\"margin:5px 0;\">"+result[i].koordinatorname+"<br>"+result[i].koordinatordate+"</div>'></i></td>";
                    //         }else{
                    //             tableresult +="<td class='text-center'><i class='bi bi-info-circle-fill text-info' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' title='<div class=\"text-start\"><b>Menunggu Persetujuan Sebelumnya</b></div>'></i></td>";
                    //         }
                            
                    //     }
                    // }