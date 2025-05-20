let today = new Date();
today.setDate(today.getDate() - 1); // Kurangi 1 hari
let startDate = today.toISOString().split('T')[0]; // Format: YYYY-MM-DD

dataharian(startDate);

flatpickr('[name="dateperiode"]', {
    enableTime: false,
    dateFormat: "Y-m-d",
    maxDate: "today",
    defaultDate: new Date(),
    onChange: function (selectedDates, dateStr, instance) {
        dataharian(dateStr);
        instance.close();
    }
});

function dataharian(startDate){
    $.ajax({
        url       : url + "index.php/sb/insight/datainsight",
        data      : {startDate:startDate},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            Swal.fire({
                title            : 'Sending request...',
                text             : 'Please wait',
                allowOutsideClick: false,
                allowEscapeKey   : false,
                didOpen          : () => Swal.showLoading()
            });
        },
        success: function (data) {
            Swal.fire({
                title            : 'Memproses data...',
                text             : 'Menyiapkan tampilan data rumah sakit.',
                allowOutsideClick: false,
                allowEscapeKey   : false,
                didOpen          : () => Swal.showLoading()
            });
            if (data.responCode === "00") {
                const result = data.responResult;

                // $("#rmbumumdate").html("Rp. "+todesimal(rmblastday.umum));
                // $("#rmbasuransidate").html("Rp. "+todesimal(rmblastday.asuransi));
                // $("#rmbbpjsdate").html("Rp. "+todesimal(rmblastday.bpjs));
                // $("#rmbmcudate").html("Rp. "+todesimal(rmblastday.mcu));
                // $("#rmbobatdate").html("Rp. "+todesimal(rmblastday.obat));
                // $("#rmblaindate").html("Rp. "+todesimal(rmblastday.lain));

                // $("#rsmsumumdate").html("Rp. "+todesimal(rmslastday.umum));
                // $("#rsmsasuransidate").html("Rp. "+todesimal(rmslastday.asuransi));
                // $("#rsmsbpjsdate").html("Rp. "+todesimal(rmslastday.bpjs));
                // $("#rsmsmcudate").html("Rp. "+todesimal(rmslastday.mcu));
                // $("#rsmsobatdate").html("Rp. "+todesimal(rmslastday.obat));
                // $("#rsmslaindate").html("Rp. "+todesimal(rmslastday.lain));

                let totalrbm = (
                    parseFloat(result[0].rmbmumum || 0) +
                    parseFloat(result[0].rmbasuransi || 0) +
                    parseFloat(result[0].rmbbpjs || 0) +
                    parseFloat(result[0].rmbmcu || 0) +
                    parseFloat(result[0].rmbpob || 0) +
                    parseFloat(result[0].rmblain || 0)
                );

                let totalrsms = (
                    parseFloat(result[0].rsmsmumum || 0) +
                    parseFloat(result[0].rsmsasuransi || 0) +
                    parseFloat(result[0].rsmsbpjs || 0) +
                    parseFloat(result[0].rsmsmcu || 0) +
                    parseFloat(result[0].rsmspob || 0) +
                    parseFloat(result[0].rsmslain || 0)
                );

                let totalrsiabm = (
                    parseFloat(result[0].rsiabmumum || 0) +
                    parseFloat(result[0].rsiabmasuransi || 0) +
                    parseFloat(result[0].rsiabmbpjs || 0) +
                    parseFloat(result[0].rsiabmmcu || 0) +
                    parseFloat(result[0].rsiabmpob || 0) +
                    parseFloat(result[0].rsiabmlain || 0)
                );

                let totalrst = (
                    parseFloat(result[0].rstumum || 0) +
                    parseFloat(result[0].rstasuransi || 0) +
                    parseFloat(result[0].rstbpjs || 0) +
                    parseFloat(result[0].rstmcu || 0) +
                    parseFloat(result[0].rstpob || 0) +
                    parseFloat(result[0].rstlain || 0)
                );

                $("#rmbdatependapatanlabel").html(startDate);
                $("#rmbdatependapatantotal").html("Rp. " + todesimal(totalrbm));
                $("#rmbumumdatependapatan").html("Rp. " + todesimal(result[0].rmbumum));
                $("#rmbasuransidatependapatan").html("Rp. " + todesimal(result[0].rmbasuransi));
                $("#rmbbpjsdatependapatan").html("Rp. " + todesimal(result[0].rmbbpjs));
                $("#rmbmcudatependapatan").html("Rp. " + todesimal(result[0].rmbmcu));
                $("#rmbobatdatependapatan").html("Rp. " + todesimal(result[0].rmbpob));
                $("#rmblaindatependapatan").html("Rp. " + todesimal(result[0].rmblain));

                $("#rsmsdatependapatanlabel").html(startDate);
                $("#rsmsdatependapatantotal").html("Rp. " + todesimal(totalrsms));
                $("#rsmsumumdatependapatan").html("Rp. " + todesimal(result[0].rsmsumum));
                $("#rsmsasuransidatependapatan").html("Rp. " + todesimal(result[0].rsmsasuransi));
                $("#rsmsbpjsdatependapatan").html("Rp. " + todesimal(result[0].rsmsbpjs));
                $("#rsmsmcudatependapatan").html("Rp. " + todesimal(result[0].rsmsmcu));
                $("#rsmsobatdatependapatan").html("Rp. " + todesimal(result[0].rsmspob));
                $("#rsmslaindatependapatan").html("Rp. " + todesimal(result[0].rsmslain));

                $("#rsiabmdatependapatanlabel").html(startDate);
                $("#rsiabmdatependapatantotal").html("Rp. " + todesimal(totalrsiabm));
                $("#rsiabmumumdatependapatan").html("Rp. " + todesimal(result[0].rsiabmumum));
                $("#rsiabmasuransidatependapatan").html("Rp. " + todesimal(result[0].rsiabmasuransi));
                $("#rsiabmbpjsdatependapatan").html("Rp. " + todesimal(result[0].rsiabmbpjs));
                $("#rsiabmmcudatependapatan").html("Rp. " + todesimal(result[0].rsiabmmcu));
                $("#rsiabmobatdatependapatan").html("Rp. " + todesimal(result[0].rsiabmpob));
                $("#rsiabmlaindatependapatan").html("Rp. " + todesimal(result[0].rsiabmlain));

                $("#rstdatependapatanlabel").html(startDate);
                $("#rstdatependapatantotal").html("Rp. " + todesimal(totalrst));
                $("#rstumumdatependapatan").html("Rp. " + todesimal(result[0].rstumum));
                $("#rstasuransidatependapatan").html("Rp. " + todesimal(result[0].rstasuransi));
                $("#rstbpjsdatependapatan").html("Rp. " + todesimal(result[0].rstbpjs));
                $("#rstmcudatependapatan").html("Rp. " + todesimal(result[0].rstmcu));
                $("#rstobatdatependapatan").html("Rp. " + todesimal(result[0].rstpob));
                $("#rstlaindatependapatan").html("Rp. " + todesimal(result[0].rstlain));

                $("#total_pendapatanrmbdate").html("Rp. " + todesimal(totalrbm));
                $("#total_pendapatanrsmsdate").html("Rp. " + todesimal(totalrsms));
                $("#total_pendapatanrsiabmdate").html("Rp. " + todesimal(totalrsiabm));
                $("#total_pendapatanrstdate").html("Rp. " + todesimal(totalrst));

                $("#rmbdateselisih").html("Rp. " + todesimal(totalrbm));
                $("#rsmsdateselisih").html("Rp. " + todesimal(totalrsms));
                $("#rsiabmdateselisih").html("Rp. " + todesimal(totalrsiabm));
                $("#rstdateselisih").html("Rp. " + todesimal(totalrst));

                
            }

            

        },
        complete: function () {
            Swal.close();
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html: "<b>" + error + "</b>",
                icon: "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling: false,
                timerProgressBar: true,
                timer: 5000,
                customClass: { confirmButton: "btn btn-danger" },
                showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });

    return false;
};