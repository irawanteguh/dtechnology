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
    
    function fileExists($path) {
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            $headers = @get_headers($path);
            if (!$headers) return false;
            return (strpos($headers[0], '200') !== false);
        }

        return file_exists($path);
    }

    function getFileSize($path) {
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            $ch = curl_init($path);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_exec($ch);

            $filesize = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
            curl_close($ch);

            if ($filesize > 0) {
                return $filesize;
            } else {
                return 0;
            }
        }

        if (file_exists($path)) {
            return filesize($path);
        }

        return 0;
    }

    function uploadToAapanel($filename, $binary){
        $tmp = tempnam(sys_get_temp_dir(), 'pdf_');
        file_put_contents($tmp, $binary);

        $url = rtrim(PATHFILE_POST_TILAKA, '/') . '/receivedfile.php';
        echo $url;
        $ch  = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,['file' => new CURLFile($tmp, 'application/pdf', $filename)]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);
        unlink($tmp);
        return json_decode($response, true);
    }


    function curlDownload($url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    function getQRCode($text, $logoPath){
        ob_start();
        QRcode::png($text, null, QR_ECLEVEL_H, 8, 2);
        $qrImageData = ob_get_contents();
        ob_end_clean();

        $qrImage = imagecreatefromstring($qrImageData);
        if (!$qrImage) return false;

        if (!file_exists($logoPath)) return false;
        $logo = imagecreatefrompng($logoPath);

        $qrWidth    = imagesx($qrImage);
        $qrHeight   = imagesy($qrImage);
        $logoWidth  = imagesx($logo);
        $logoHeight = imagesy($logo);

        $logoQRWidth  = $qrWidth / 4;
        $scale        = $logoWidth / $logoQRWidth;
        $logoQRHeight = $logoHeight / $scale;

        $x = ($qrWidth - $logoQRWidth) / 2;
        $y = ($qrHeight - $logoQRHeight) / 2;

        imagecopyresampled($qrImage, $logo, $x, $y, 0, 0, $logoQRWidth, $logoQRHeight, $logoWidth, $logoHeight);

        ob_start();
        imagepng($qrImage);
        $finalImageData = ob_get_contents();
        ob_end_clean();

        return base64_encode($finalImageData);
    }
    //End Tilaka
?>