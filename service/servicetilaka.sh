#!/bin/bash

# Jalankan semua permintaan HTTP
curl -X POST http://localhost/dtechnology/index.php/uploadallfile
curl -X POST http://localhost/dtechnology/index.php/requestsign
curl -X POST http://localhost/dtechnology/index.php/excutesign
curl -X POST http://localhost/dtechnology/index.php/statussign
curl -X GET http://localhost/dtechnology/index.php/pegawai
