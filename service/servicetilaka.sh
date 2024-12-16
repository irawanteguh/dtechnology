#!/bin/bash

# Lokasi file log
LOG_FILE="/www/wwwroot/192.168.102.13/dtechnology/service/servicetilaka.log"

# Fungsi untuk mencatat log (append tanpa menghapus log sebelumnya)
initialize_log() {
    if [ ! -f "$LOG_FILE" ]; then
        echo "$(date '+%Y-%m-%d %H:%M:%S') - Log initialized" > "$LOG_FILE"
    fi
}

# Fungsi untuk mencatat log tambahan
log_message() {
    local MESSAGE="$1"
    echo "$(date '+%Y-%m-%d %H:%M:%S') - $MESSAGE" >> "$LOG_FILE"
}

# Fungsi untuk menjalankan permintaan HTTP
run_request() {
    local METHOD="$1"
    local URL="$2"

    # Catat log sebelum melakukan permintaan
    log_message "Starting $METHOD request to $URL"
    
    # Jalankan permintaan HTTP dan tangkap respon
    RESPONSE=$(curl -s -w "HTTP_CODE:%{http_code}" -X "$METHOD" "$URL" 2>&1)
    HTTP_BODY=$(echo "$RESPONSE" | sed -e 's/HTTP_CODE:.*//')
    HTTP_CODE=$(echo "$RESPONSE" | grep -o 'HTTP_CODE:[0-9]*' | cut -d':' -f2)
    
    # Cek status kode HTTP
    if [ "$HTTP_CODE" -ge 200 ] && [ "$HTTP_CODE" -lt 300 ]; then
        log_message "Request to $URL succeeded with HTTP $HTTP_CODE. Response: $HTTP_BODY"
    else
        log_message "Request to $URL failed with HTTP $HTTP_CODE. Response: $HTTP_BODY"
    fi
}

# Inisialisasi log
initialize_log

# Jalankan semua permintaan HTTP
run_request "POST" "http://192.168.102.13/dtechnology/index.php/uploadallfile"
run_request "POST" "http://192.168.102.13/dtechnology/index.php/requestsign"
run_request "POST" "http://192.168.102.13/dtechnology/index.php/excutesign"
run_request "POST" "http://192.168.102.13/dtechnology/index.php/statussign"
run_request "GET" "http://192.168.102.13/dtechnology/index.php/pegawai"

# Penutup log
log_message "Script servicetilaka.sh finished."

# Clear log setelah selesai
> "$LOG_FILE"
