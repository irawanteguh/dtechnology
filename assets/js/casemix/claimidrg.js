$('#grouping_icd10').on('change', function() {
    let data = $(this).select2('data')[0]; // Ambil data yang dipilih
    let validCode = data.element ? $(data.element).data('validcode') : null;

    console.log("ValidCode:", validCode);

    if(validCode == 0){
        Swal.fire({
            icon: 'warning',
            title: 'Validasi Diagnosis',
            text: 'Diagnosis ini tidak valid!',
            confirmButtonText: 'OK'
        });
        // Reset select jika perlu
        $(this).val(null).trigger('change');
    }
});