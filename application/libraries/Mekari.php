<?php
    class Mekari{

        public static function hmac(){
            // DATE (UTC, sama dengan Postman)
            $date = gmdate('D, d M Y H:i:s') . ' GMT';

            // METHOD & PATH (WAJIB path + query kalau ada)
            $method = 'GET';
            $path   = MEKARI_PATH_KYC; // contoh: /api/kyc?type=register

            // REQUEST LINE
            $requestLine = "{$method} {$path} HTTP/1.1";

            // STRING TO SIGN
            $stringToSign = "date: {$date}\n{$requestLine}";

            // SIGNATURE
            $signature = base64_encode(hash_hmac('sha256', $stringToSign, MEKARI_SECRET_ID, true));

            // AUTHORIZATION HEADER
            $authorization = sprintf(
                'hmac username="%s", algorithm="hmac-sha256", headers="date request-line", signature="%s"',
                MEKARI_CLIENT_ID,
                $signature
            );

            return var_dump($date);

            // HEADERS
            $headers = [
                "Authorization: {$authorization}",
                "Date: {$date}",
                "Content-Type: application/json",
                "Accept: application/json"
            ];

            // CURL
            $ch = curl_init(MEKARI_BASE_URL . $path);
            curl_setopt_array($ch, [
                CURLOPT_HTTPGET        => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER     => $headers,
                CURLOPT_SSL_VERIFYPEER => true
            ]);

            $response = curl_exec($ch);
            curl_close($ch);

            return json_decode($response, true);
        }


    }

    
?>