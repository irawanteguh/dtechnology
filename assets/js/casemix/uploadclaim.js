$(document).ready(function() {
    $('#uploadForm').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: 'uploadclaim/upload_file',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(resp) {
                let result = JSON.parse(resp);
                if (result.status === 'success') {
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
                } else {
                    $('#preview').html(`<p style="color:red;">${result.message}</p>`);
                }
            },
            error: function(err) {
                $('#preview').html('<p style="color:red;">Terjadi kesalahan saat upload.</p>');
            }
        });
    });
});
