# Daftar URL tujuan
$uris = @(
    @{ Uri = "http://192.168.102.13/dtechnology/index.php/uploadallfile"; Method = "POST" },
    @{ Uri = "http://192.168.102.13/dtechnology/index.php/requestsign"; Method = "POST" },
    @{ Uri = "http://192.168.102.13/dtechnology/index.php/excutesign"; Method = "POST" },
    @{ Uri = "http://192.168.102.13/dtechnology/index.php/statussign"; Method = "POST" },
    @{ Uri = "http://192.168.102.13/dtechnology/index.php/pegawai"; Method = "GET" }
)

# Loop untuk mengirim permintaan ke setiap URL
foreach ($endpoint in $uris) {
    $uri = $endpoint.Uri
    $method = $endpoint.Method
    try {
        # Kirim permintaan GET atau POST sesuai kebutuhan
        $response = Invoke-RestMethod -Uri $uri -Method $method

        # Output respons (opsional untuk debug/logging)
        Write-Output "Success for ${uri} (${method}): ${response}"
    } catch {
        # Tangani kesalahan (log atau tampilkan pesan)
        Write-Output "Error for ${uri} (${method}): $_"
    }
}
