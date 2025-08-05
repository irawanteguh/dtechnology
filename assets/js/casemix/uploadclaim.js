let mode = 'upload'; // default mode

$('#uploadForm').on('submit', function(e) {
    e.preventDefault();

    if (mode === 'upload') {
        let formData = new FormData(this);

        Swal.fire({
            title: 'Mengunggah file...',
            text: 'Silakan tunggu.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => Swal.showLoading()
        });

        $.ajax({
            url: 'uploadclaim/upload_file',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(resp) {
                let result = JSON.parse(resp);
                if (result.status === 'success' && result.data.length > 0) {
                    let html = '<table class="table align-middle table-row-dashed fs-6 gy-2"><thead class="text-center"><tr class="fw-bolder text-muted bg-light align-middle">';
                    result.headers.forEach(h => {
                        html += `<th>${h}</th>`;
                    });
                    html += '</tr></thead><tbody class="text-gray-600 fw-bold">';
                    result.data.forEach(row => {
                        html += '<tr>';
                        row.forEach(col => {
                            html += `<td>${col}</td>`;
                        });
                        html += '</tr>';
                    });
                    html += '</tbody></table>';
                    $('#preview').html(html);

                    window.uploadedClaimData = result.data;
                    Swal.close();

                    // Ubah tombol jadi "Import"
                    mode = 'import';
                    $('#actionBtn').html('<i class="bi bi-download"></i> Import Data')
                        .removeClass('btn-primary').addClass('btn-info');
                } else {
                    Swal.fire('Gagal', 'Data kosong atau tidak valid.', 'warning');
                }
            },
            error: function() {
                Swal.fire('Gagal', 'Terjadi kesalahan saat upload.', 'error');
            }
        });
    } else if (mode === 'import') {
        if (!window.uploadedClaimData || window.uploadedClaimData.length === 0) {
            Swal.fire('Peringatan', 'Tidak ada data untuk diimport.', 'warning');
            return;
        }

        Swal.fire({
            title: 'Mengimport ke database...',
            text: 'Mohon tunggu.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => Swal.showLoading()
        });

        $.ajax({
            url: 'uploadclaim/import_to_db',
            type: 'POST',
            data: { rows: JSON.stringify(window.uploadedClaimData) },
            success: function(resp) {
                Swal.fire('Selesai', resp, 'success');
            },
            error: function() {
                Swal.fire('Gagal', 'Gagal mengimport data ke database.', 'error');
            }
        });
    }
});
