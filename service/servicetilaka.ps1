# Daftar URL tujuan
$uris = @(
    "http://localhost/dtechnology/index.php/uploadallfile",
    "http://localhost/dtechnology/index.php/requestsign",
    "http://localhost/dtechnology/index.php/excutesign",
    "http://localhost/dtechnology/index.php/statussign"
)

# Loop untuk mengirim permintaan POST ke setiap URL
foreach ($uri in $uris) {
    try {
        # Permintaan POST tanpa body
        $response = Invoke-RestMethod -Uri $uri -Method POST

        # Output respons (opsional untuk debug/logging)
        Write-Output "Success for ${uri}: ${response}"
    } catch {
        # Tangani kesalahan (log atau tampilkan pesan)
        Write-Output "Error for ${uri}: $_"
    }
}
