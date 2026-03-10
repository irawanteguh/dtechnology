var myDropzone = new Dropzone("#file_doc", {
    url: url + "index.php/uploaddocument/uploaddocument/uploadfilette",
    acceptedFiles: '.pdf',
    paramName: "file",
    dictDefaultMessage: "Drop files here or click to upload",
    maxFiles: 10,
    maxFilesize: 10, // Maksimal ukuran file dalam MB
    addRemoveLinks: true,
    autoProcessQueue: true,
    success: function(file, response) {
        if (response.responCode === "00") {
            toastr.success(response.responDesc, "INFORMATION");
        } else {
            toastr.error(response.responDesc, "ERROR");
        }
    },
    error: function(file, errorMessage, xhr) {
        var response = xhr ? JSON.parse(xhr.responseText) : { responDesc: errorMessage };
        toastr.error(response.responDesc || "File upload failed", "ERROR");
    }
});

