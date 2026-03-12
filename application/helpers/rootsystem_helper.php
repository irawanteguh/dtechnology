<?php

    //Start Function Random Generator
    function randomgeneatorname() {
        $names = [
            "Andi Saputra", "Budi Santoso", "Citra Dewi", "Dewi Anggraini", 
            "Eko Prasetyo", "Fitri Handayani", "Gilang Ramadhan", "Hesti Nuraini",
            "Irfan Maulana", "Joko Widodo", "Kartika Putri", "Lukman Hakim"
        ];
        return $names[array_rand($names)];
    };

    function generateNoKartuBPJS() {
        $digits = '';
        for ($i = 0; $i < 13; $i++) {
            $digits .= random_int(0, 9);
        }
        return $digits;
    };

    function generateNoSEP($prefix = '0064R004') {
        $part1 = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);   // 4 digits
        $part2 = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT); // 6 digits
        return $prefix . $part1 . 'V' . $part2;
    };

    function generateNilaiTindakan() {
        $nilai = random_int(150000, 3000000);
        return $nilai;
    };

    function generateRandomTanggal($startYear = 1992, $endYear = 2025) {
        $start     = strtotime("$startYear-01-01 00:00:00");
        $end       = strtotime("$endYear-12-31 23:59:59");
        $timestamp = mt_rand($start, $end);

        return date("Y-m-d", $timestamp) . " 00:00:00";
    };

    //End Function Random Generator

    function generateuuid($data = null){
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf("%s%s-%s-%s-%s-%s%s%s", str_split(bin2hex($data), 4));
    };

    function generateUniqueCode() {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $uniqueCode = '';
        
        for ($i = 0; $i < 6; $i++) {
            $uniqueCode .= $characters[rand(0, $charactersLength - 1)];
        }
    
        return $uniqueCode;
    };

    function generateUniqueNumber() {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $uniqueCode = '';
        
        for ($i = 0; $i < 6; $i++) {
            $uniqueCode .= $characters[rand(0, $charactersLength - 1)];
        }
    
        return $uniqueCode;
    };

    function encodedata($data){
        $i2 = 0;
        $s = "";
        $length = strlen($data);
        $pass = $data[$length - 1] . substr($data, 1, $length - 2) . $data[0];
        for ($i = 0; $i < $length; $i++) {
            $i2++;
            if ($i2 = 1) {
                $s = $s . "";
                $i2 = 0;
            }
            $num = dechex(ord($pass[$i]));
            $s = $s . "" . $num;
        }
        $result = $s;
        return $result;
    };

    function decodedata($data){
        $length = strlen($data);
        $res = '';

        if (strlen($data) % 2 !== 0) {
            return '';
        }

        for ($i = 0; $i < $length; $i += 2) {
            $char = $data[$i] . $data[$i + 1];
            $res .= chr(hexdec($char));
        }

        $decodedLength = strlen($res);
        $decodedPassword = $res[$decodedLength - 1] . substr($res, 1, $decodedLength - 2) . $res[0];

        return $decodedPassword;
    };

    //Start Tilaka
    function headerlog(){
        echo PHP_EOL;
        echo color('cyan').str_pad("IDENTITY", 50).str_pad("USER IDENTIFIER", 42)."MESSAGE".PHP_EOL;
    }

    function formatlog($identity, $useridentifier, $message, $colorIdentity = 'cyan', $colorUser = 'yellow', $colorMessage = 'white') {
        $identityWidth       = 50;
        $userIdentifierWidth = 42;

        $colorStartIdentity  = color($colorIdentity);
        $colorStartUser      = color($colorUser);
        $colorStartMessage   = color($colorMessage);
        $reset               = color('reset');

        $formatted  = $colorStartIdentity . str_pad($identity, $identityWidth) . $reset;
        $formatted .= $colorStartUser . str_pad($useridentifier, $userIdentifierWidth) . $reset;
        $formatted .= $colorStartMessage . $message . $reset;

        return $formatted . PHP_EOL;
    }
    
    function fileExists(&$location) {
        // Cek apakah $location adalah URL valid
        if (filter_var($location, FILTER_VALIDATE_URL)) {

            // Gunakan HEAD request untuk cek keberadaan file tanpa mengunduh
            $ch = curl_init($location);
            curl_setopt_array($ch, [
                CURLOPT_NOBODY => true, // jangan ambil konten
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_TIMEOUT => 30
            ]);

            curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if (curl_errno($ch)) {
                $error = curl_error($ch);
                curl_close($ch);
                return [
                    'status'  => false,
                    'message' => 'Failed to access URL: ' . $error
                ];
            }

            curl_close($ch);

            if ($httpCode >= 200 && $httpCode < 400) {
                return ['status' => true, 'message' => 'File exists at URL'];
            } else {
                return ['status' => false, 'message' => "URL returned HTTP code $httpCode"];
            }

        } else {
            // Bukan URL → cek file lokal
            if (file_exists($location)) {
                return ['status' => true, 'message' => 'Local file exists.'];
            } else {
                return ['status' => false, 'message' => 'Local file does not exist.'];
            }
        }
    }

    function getFileSize($path) {
        if (filter_var($path, FILTER_VALIDATE_URL)) {

            $ch = curl_init($path);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);

            curl_exec($ch);

            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $fileSize = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

            curl_close($ch);

            if ($httpCode >= 200 && $httpCode < 300 && $fileSize > 0) {
                return (int)$fileSize;
            }

            return 0;
        }

        // Jika file lokal
        if (file_exists($path)) {
            return (int)filesize($path);
        }

        return 0;
    }

    function parsePdfAndFindText($locationFile, $position, $mainName){

        $localFile  = $locationFile;
        $isTempFile = false;

        try {

            /*
            ========================================
            JIKA SOURCE ADALAH URL
            ========================================
            */
            if (filter_var($locationFile, FILTER_VALIDATE_URL)) {

                // Folder temp project
                $tempDir = FCPATH . 'assets/temp/';
                if (!is_dir($tempDir)) {
                    mkdir($tempDir, 0777, true);
                }

                // pastikan ada ekstensi pdf
                if (pathinfo($mainName, PATHINFO_EXTENSION) == "") {
                    $mainName .= ".pdf";
                }

                $localFile = $tempDir . $mainName;

                $ch = curl_init($locationFile);
                curl_setopt_array($ch, [
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_CONNECTTIMEOUT => 30,
                    CURLOPT_TIMEOUT => 60
                ]);

                $pdfContent = curl_exec($ch);

                if (curl_errno($ch)) {
                    throw new Exception("Failed download PDF: " . curl_error($ch));
                }

                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                if ($httpCode < 200 || $httpCode >= 300) {
                    throw new Exception("URL returned HTTP code $httpCode");
                }

                if (!$pdfContent) {
                    throw new Exception("Downloaded PDF is empty.");
                }

                if (!file_put_contents($localFile, $pdfContent)) {
                    throw new Exception("Failed write temporary PDF file.");
                }

                $isTempFile = true;
            }

            /*
            ========================================
            CEK FILE ADA
            ========================================
            */
            if (!file_exists($localFile)) {
                throw new Exception("File not found: " . $localFile);
            }

            /*
            ========================================
            PARSE PDF
            ========================================
            */
            $pdfParse = new Pdfparse($localFile);
            $specimentposition = $pdfParse->findText($position);

            return [
                'status' => true,
                'data'   => $specimentposition
            ];

        } catch (Exception $e) {

            return [
                'status'  => false,
                'message' => $e->getMessage()
            ];

        } finally {

            /*
            ========================================
            HAPUS TEMP FILE
            ========================================
            */
            if ($isTempFile && file_exists($localFile)) {
                unlink($localFile);
            }
        }
    }

    function downloadAndSave($sourceUrl, $destinationFolder, $mainName) {

        // Tambahkan ekstensi PDF jika belum ada
        if (pathinfo($mainName, PATHINFO_EXTENSION) == "") {
            $mainName .= ".pdf";
        }

        /*
        ========================================
        DOWNLOAD FILE
        ========================================
        */
        $ch = curl_init($sourceUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 60
        ]);

        $fileData = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch) || $httpCode != 200) {
            curl_close($ch);
            return [
                'success' => false,
                'message' => 'Download failed or HTTP code: ' . $httpCode
            ];
        }

        curl_close($ch);

        if (!$fileData || strlen($fileData) < 500) {
            return [
                'success' => false,
                'message' => 'Downloaded file is empty or too small'
            ];
        }

        // Validasi PDF
        if (substr($fileData, 0, 4) !== "%PDF") {
            return [
                'success' => false,
                'message' => 'File is not a valid PDF'
            ];
        }

        /*
        ========================================
        CEK JIKA DESTINATION ADALAH URL
        ========================================
        */
        if (filter_var($destinationFolder, FILTER_VALIDATE_URL)) {
            // Folder temp di project
            $tempDir = FCPATH . 'assets/temp/';
            if (!is_dir($tempDir)) mkdir($tempDir, 0777, true);

            // Temp file di project
            $tmpFile = $tempDir . $mainName;
            file_put_contents($tmpFile, $fileData);

            $url = rtrim($destinationFolder, '/') . '/receivedfile.php';

            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => [
                    'file' => new CURLFile($tmpFile, 'application/pdf', $mainName)
                ],
                CURLOPT_RETURNTRANSFER => true
            ]);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                $err = curl_error($ch);
                curl_close($ch);
                @unlink($tmpFile); // hapus temp
                return [
                    'success' => false,
                    'message' => 'Upload failed: ' . $err
                ];
            }

            curl_close($ch);
            @unlink($tmpFile); // hapus temp setelah upload

            return json_decode($response, true);
        }

        /*
        ========================================
        LOCAL STORAGE
        ========================================
        */
        $destinationFolder = rtrim($destinationFolder, '/') . '/';
        if (!is_dir($destinationFolder)) mkdir($destinationFolder, 0777, true);
        if (!is_writable($destinationFolder)) {
            return [
                'success' => false,
                'message' => 'Destination folder is not writable'
            ];
        }

        $fullPath = $destinationFolder . $mainName;
        file_put_contents($fullPath, $fileData);

        return [
            'success' => true,
            'message' => 'File saved locally',
            'filename' => $mainName,
            'path' => $fullPath
        ];
    }

    function compressPdf($filedirectory, $mainName) {

        $localFile  = $filedirectory;
        $isTempFile = false;
        $tempCompress = "";

        try {

            /*
            ========================================
            JIKA FILE ADALAH URL
            ========================================
            */
            if (filter_var($filedirectory, FILTER_VALIDATE_URL)) {

                $tempDir = FCPATH . 'assets/temp/';
                if (!is_dir($tempDir)) mkdir($tempDir, 0777, true);

                if (pathinfo($mainName, PATHINFO_EXTENSION) == "") {
                    $mainName .= ".pdf";
                }

                $localFile = $tempDir . $mainName;

                // Download file via stream (untuk file besar)
                $fp = fopen($localFile, 'w');
                $ch = curl_init($filedirectory);
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
                curl_setopt($ch, CURLOPT_TIMEOUT, 600); // 10 menit untuk file besar
                curl_exec($ch);
                if (curl_errno($ch)) {
                    fclose($fp);
                    throw new Exception("Failed download PDF: " . curl_error($ch));
                }
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                fclose($fp);

                if ($httpCode < 200 || $httpCode >= 300) {
                    throw new Exception("URL returned HTTP code $httpCode");
                }

                $isTempFile = true; // tandai file temp dari URL
            }

            /*
            ========================================
            CEK FILE ADA
            ========================================
            */
            if (!file_exists($localFile)) {
                throw new Exception("File not found: " . $localFile);
            }

            /*
            ========================================
            SKIP FILE KECIL
            ========================================
            */
            if (filesize($localFile) < 500000) {
                return [
                    'status' => true,
                    'message'=> 'Skip compress (file kecil)',
                    'file'   => $localFile,
                    'before' => formatSize(filesize($localFile)),
                    'after'  => formatSize(filesize($localFile)),
                    'reduce' => '0%'
                ];
            }

            /*
            ========================================
            SIZE SEBELUM COMPRESS
            ========================================
            */
            $sizeBefore = filesize($localFile);
            $tempCompress = $localFile . ".compress.pdf";

            /*
            ========================================
            COMMAND GHOSTSCRIPT
            ========================================
            */
            $gsPath = "/opt/homebrew/bin/gs"; // Path Ghostscript di Mac

            if (!file_exists($gsPath)) {
                throw new Exception("Ghostscript tidak ditemukan di path: $gsPath");
            }

            $tempDirGs = FCPATH . 'assets/temp/';
            if (!is_dir($tempDirGs)) mkdir($tempDirGs, 0777, true);

            $cmd = $gsPath .
                " -sDEVICE=pdfwrite" .
                " -dCompatibilityLevel=1.4" .
                " -dPDFSETTINGS=/screen" .
                " -dColorImageResolution=72" .
                " -dGrayImageResolution=72" .
                " -dMonoImageResolution=72" .
                " -dNOPAUSE -dQUIET -dBATCH" .
                " -sTEMP=" . escapeshellarg($tempDirGs) . // paksa Ghostscript pakai folder temp aplikasi
                " -sOutputFile=" . escapeshellarg($tempCompress) .
                " " . escapeshellarg($localFile);

            // Jalankan Ghostscript
            exec($cmd . " 2>&1", $output, $status);

            if ($status !== 0 || !file_exists($tempCompress)) {
                throw new Exception("Ghostscript error: " . implode(" ", $output));
            }

            /*
            ========================================
            SIZE SETELAH COMPRESS
            ========================================
            */
            $sizeAfter = filesize($tempCompress);
            $reduction = $sizeBefore > 0 ? round((($sizeBefore - $sizeAfter)/$sizeBefore)*100,2) : 0;

            /*
            ========================================
            REPLACE FILE
            ========================================
            */
            unlink($localFile); // hapus file asli
            rename($tempCompress, $localFile); // rename hasil compress

            return [
                'status' => true,
                'message'=> 'Compress success',
                'file'   => $localFile,
                'before' => formatSize($sizeBefore),
                'after'  => formatSize($sizeAfter),
                'reduce' => $reduction . "%"
            ];

        } catch (Exception $e) {

            return [
                'status'  => false,
                'message' => $e->getMessage()
            ];

        } finally {

            /*
            ========================================
            HAPUS TEMP FILE JIKA FILE URL
            ========================================
            */
            // Hanya hapus file URL jika masih ada dan belum di replace
            if ($isTempFile && file_exists($localFile) && (!isset($tempCompress) || !file_exists($tempCompress))) {
                unlink($localFile);
            }
        }
    }

    /*
    ========================================
    HELPER FORMAT SIZE
    ========================================
    */
    function formatSize($bytes) {
        if ($bytes >= 1073741824) return number_format($bytes / 1073741824,2) . " GB";
        if ($bytes >= 1048576) return number_format($bytes / 1048576,2) . " MB";
        if ($bytes >= 1024) return number_format($bytes / 1024,2) . " KB";
        return $bytes . " B";
    }

    // function uploadToAapanel($filename, $binary){
    //     $tmp = tempnam(sys_get_temp_dir(), 'pdf_');
    //     file_put_contents($tmp, $binary);

    //     $url = rtrim(PATHFILE_POST_TILAKA, '/') . '/receivedfile.php';
    //     $ch  = curl_init($url);

    
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS,['file' => new CURLFile($tmp, 'application/pdf', $filename)]);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //     $response = curl_exec($ch);
    //     curl_close($ch);
    //     unlink($tmp);
    //     return json_decode($response, true);
    // }


    // function curlDownload($url){
    //     $ch = curl_init($url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     $data = curl_exec($ch);
    //     curl_close($ch);
    //     return $data;
    // }

    function getQRCode($text, $logoPath){

        ob_start();
        QRcode::png($text, null, QR_ECLEVEL_H, 8, 2);
        $qrImageData = ob_get_contents();
        ob_end_clean();

        $qrImage = imagecreatefromstring($qrImageData);
        if (!$qrImage) return false;

        $qrWidth  = imagesx($qrImage);
        $qrHeight = imagesy($qrImage);

        /*
        =========================
        BACKGROUND QR PUTIH
        =========================
        */
        $canvas = imagecreatetruecolor($qrWidth, $qrHeight);
        $white  = imagecolorallocate($canvas, 255,255,255);

        imagefill($canvas, 0, 0, $white);
        imagecopy($canvas, $qrImage, 0, 0, 0, 0, $qrWidth, $qrHeight);

        /*
        =========================
        LOGO DI TENGAH
        =========================
        */
        if (file_exists($logoPath)) {

            $logo = imagecreatefrompng($logoPath);

            $logoWidth  = imagesx($logo);
            $logoHeight = imagesy($logo);

            $logoQRWidth  = $qrWidth / 4;
            $scale        = $logoWidth / $logoQRWidth;
            $logoQRHeight = $logoHeight / $scale;

            $x = ($qrWidth - $logoQRWidth) / 2;
            $y = ($qrHeight - $logoQRHeight) / 2;

            /*
            =========================
            BACKGROUND PUTIH DI LOGO
            =========================
            */

            $padding = 10;

            imagefilledrectangle(
                $canvas,
                $x - $padding,
                $y - $padding,
                $x + $logoQRWidth + $padding,
                $y + $logoQRHeight + $padding,
                $white
            );

            /*
            =========================
            TEMPEL LOGO
            =========================
            */

            imagecopyresampled(
                $canvas,
                $logo,
                $x,
                $y,
                0,
                0,
                $logoQRWidth,
                $logoQRHeight,
                $logoWidth,
                $logoHeight
            );
        }

        /*
        =========================
        OUTPUT BASE64
        =========================
        */

        ob_start();
        imagepng($canvas);
        $finalImageData = ob_get_contents();
        ob_end_clean();

        return base64_encode($finalImageData);
    }
    //End Tilaka
?>