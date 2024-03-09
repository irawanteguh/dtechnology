kkk();

function kkk(){
    $.ajax({
        url:url+"dashboard/dashboarddev/kkk",
        method:"GET",
        dataType:"JSON",
        cache :false,
        beforeSend: function () {
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){
            var result = "";
            var kkk    = "";

            if(data.responCode == "00"){
                result        = data.responResult;

                for(var i in result){
                    kkk +="<div class='col-md-3'>";
                    kkk +="<div class='info-box mb-3 bg-warning'>";
                    kkk +="<span class='info-box-icon'><i class='fa-solid fa-location-dot'></i></span>";
                    kkk +="<div class='info-box-content'>";
                    if(result[i].JENIS==="1"){
                        kkk +="<span class='info-box-text'>Provinsi</span>";
                    }else{
                        if(result[i].JENIS==="2"){
                            kkk +="<span class='info-box-text'>Kabupaten</span>";
                        }else{
                            if(result[i].JENIS==="3"){
                                kkk +="<span class='info-box-text'>Kecamatan</span>";
                            }else{
                                kkk +="<span class='info-box-text'>Kelurahan</span>";
                            }
                        }
                    }
                    
                    kkk +="<span class='info-box-number'>"+todesimal(result[i].JML)+"</span>";
                    kkk +="</div>";
                    kkk +="</div>";
                    kkk +="</div>";
                }
            }

            $("#kkk").html(kkk);
			toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
			toastr.clear();
		}
    });
    return false;
};