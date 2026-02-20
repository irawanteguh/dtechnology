function backupsystem(){
    $.ajax({
        url     : url+"index.php/operation/backupdb/backupdatabase",
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){

            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                html             : "<b>"+data.responDesc+"</b>",
                icon             : data.responHead,
                confirmButtonText: "Yeah, got it!",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : {
                    confirmButton: "btn btn-success"
                },
                showClass: {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass: {popup: "animate__animated animate__fadeOutDown animate__faster"}
            }).then(function (result) {
                if(result.isConfirmed){
                    window.open(data.url, "_self");
                }else{
                    if(Swal.DismissReason.backdrop || Swal.DismissReason.cancel || Swal.DismissReason.close || Swal.DismissReason.esc || Swal.DismissReason.timer){
                        window.open(data.url, "_self");
                    }
                }
            });

        },
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
			
		}
    });
    return false;
};

function backuptable(){
    $.ajax({
        url     : url+"index.php/operation/backupdb/backuptable",
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){

            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                html             : "<b>"+data.responDesc+"</b>",
                icon             : data.responHead,
                confirmButtonText: "Yeah, got it!",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : {
                    confirmButton: "btn btn-success"
                },
                showClass: {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass: {popup: "animate__animated animate__fadeOutDown animate__faster"}
            }).then(function (result) {
                if(result.isConfirmed){
                    window.open(data.url, "_self");
                }else{
                    if(Swal.DismissReason.backdrop || Swal.DismissReason.cancel || Swal.DismissReason.close || Swal.DismissReason.esc || Swal.DismissReason.timer){
                        window.open(data.url, "_self");
                    }
                }
            });

        },
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
			
		}
    });
    return false;
};

function confirmDeletion(filename) {
    if (confirm('Are you sure you want to delete ' + filename + '?')) {
        window.location.href = 'delete?file=' + encodeURIComponent(filename);
    }
};

function confirmDeletion(filename) {
    Swal.fire({
        title             : "<h1 class='font-weight-bold' style='color:#234974;'>Are you sure?</h1>",
        html              : "<b>Are you sure you want to delete <br> Filename : " + filename + "?</b>",
        icon              : 'warning',
        showCancelButton  : true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor : '#d33',
        confirmButtonText : 'Yes, delete it!',
        showClass: {popup: "animate__animated animate__fadeInUp animate__faster"},
        hideClass: {popup: "animate__animated animate__fadeOutDown animate__faster"}
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'delete?file=' + encodeURIComponent(filename);
        }
    });
};