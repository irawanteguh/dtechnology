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
?>