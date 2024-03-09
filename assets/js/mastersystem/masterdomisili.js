provinsi();

$(document).on("click",".btn-prov", function(e){            
    e.preventDefault();
    e.stopPropagation();
    $("#datakabupaten > tr").remove();
    $("#datakecamatan > tr").remove();
    $("#datakelurahan > tr").remove();
    kabupaten($(this));
});

$(document).on("click",".btn-kab", function(e){            
    e.preventDefault();
    e.stopPropagation();
    kecamatan($(this));
});

$(document).on("click",".btn-kec", function(e){            
    e.preventDefault();
    e.stopPropagation();
    kelurahan($(this));
});

function provinsi(){
    $.ajax({
        url:url+"mastersystem/masterdomisili/provinsi",
        method:"GET",
        dataType:"JSON",
        cache :false,
        beforeSend: function () {
            toastr["info"]("Sending request...", "Please wait");
            $("#dataprovinsi > tr").remove();
        },
        success:function(data){
            var result       = "";
            var dataprovinsi = "";

            if(data.responCode == "00"){
                result        = data.responResult;

                for(var i in result){
                    dataprovinsi +="<tr>";
                    dataprovinsi +="<td class='text-center align-middle'>"+result[i].NOURUT+"</td>";
                    dataprovinsi +="<td class='text-center align-middle'>"+result[i].KKK_ID+"</td>";
                    dataprovinsi +="<td class='align-middle'>"+result[i].KETERANGAN+"</td>";
                    dataprovinsi +="<td class='text-center align-middle'><a class='btn btn-xs btn-prov' data-jenis='2' data-headerid='"+result[i].KKK_ID+"'><i class='fa-solid fa-eye text-primary'></i></a></td>";
                    dataprovinsi +="</tr>";
                }
            }

            $("#dataprovinsi").html(dataprovinsi);
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

function kabupaten(btn){
    var jenis    = btn.attr("data-jenis");
    var headerid = btn.attr("data-headerid");
    $.ajax({
        url:url+"mastersystem/masterdomisili/kabupaten",
        data : {"jenis":jenis,"headerid":headerid},
        method:"POST",
        dataType:"JSON",
        cache :false,
        beforeSend: function () {
            toastr["info"]("Sending request...", "Please wait");
            $("#datakabupaten > tr").remove();
        },
        success:function(data){
            var result       = "";
            var datakabupaten = "";

            if(data.responCode == "00"){
                result        = data.responResult;

                for(var i in result){
                    datakabupaten +="<tr>";
                    datakabupaten +="<td class='text-center align-middle'>"+result[i].NOURUT+"</td>";
                    datakabupaten +="<td class='text-center align-middle'>"+result[i].KKK_ID+"</td>";
                    datakabupaten +="<td class='align-middle'>"+result[i].KETERANGAN+"</td>";
                    datakabupaten +="<td class='text-center align-middle'><a class='btn btn-xs btn-kab' data-jenis='3' data-headerid='"+result[i].KKK_ID+"'><i class='fa-solid fa-eye text-primary'></i></a></td>";
                    datakabupaten +="</tr>";
                }
            }

            $("#datakabupaten").html(datakabupaten);
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

function kecamatan(btn){
    var jenis    = btn.attr("data-jenis");
    var headerid = btn.attr("data-headerid");
    $.ajax({
        url:url+"mastersystem/masterdomisili/kecamatan",
        data : {"jenis":jenis,"headerid":headerid},
        method:"POST",
        dataType:"JSON",
        cache :false,
        beforeSend: function () {
            toastr["info"]("Sending request...", "Please wait");
            $("#datakecamatan > tr").remove();
        },
        success:function(data){
            var result       = "";
            var datakecamatan = "";

            if(data.responCode == "00"){
                result        = data.responResult;

                for(var i in result){
                    datakecamatan +="<tr>";
                    datakecamatan +="<td class='text-center align-middle'>"+result[i].NOURUT+"</td>";
                    datakecamatan +="<td class='text-center align-middle'>"+result[i].KKK_ID+"</td>";
                    datakecamatan +="<td class='align-middle'>"+result[i].KETERANGAN+"</td>";
                    datakecamatan +="<td class='text-center align-middle'><a class='btn btn-xs btn-kec' data-jenis='4' data-headerid='"+result[i].KKK_ID+"'><i class='fa-solid fa-eye text-primary'></i></a></td>";
                    datakecamatan +="</tr>";
                }
            }

            $("#datakecamatan").html(datakecamatan);
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

function kelurahan(btn){
    var jenis    = btn.attr("data-jenis");
    var headerid = btn.attr("data-headerid");
    $.ajax({
        url:url+"mastersystem/masterdomisili/kelurahan",
        data : {"jenis":jenis,"headerid":headerid},
        method:"POST",
        dataType:"JSON",
        cache :false,
        beforeSend: function () {
            toastr["info"]("Sending request...", "Please wait");
            $("#datakelurahan > tr").remove();
        },
        success:function(data){
            var result       = "";
            var datakelurahan = "";

            if(data.responCode == "00"){
                result        = data.responResult;

                for(var i in result){
                    datakelurahan +="<tr>";
                    datakelurahan +="<td class='text-center align-middle'>"+result[i].NOURUT+"</td>";
                    datakelurahan +="<td class='text-center align-middle'>"+result[i].KKK_ID+"</td>";
                    datakelurahan +="<td class='align-middle'>"+result[i].KETERANGAN+"</td>";
                    datakelurahan +="</tr>";
                }
            }

            $("#datakelurahan").html(datakelurahan);
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