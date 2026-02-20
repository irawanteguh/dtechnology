<?php
    class Mekari{

        // public static function hmacx(){
        //     // DATE (UTC, sama dengan Postman)
        //     $date = gmdate('D, d M Y H:i:s') . ' GMT';

        //     // METHOD & PATH (WAJIB path + query kalau ada)
        //     $method = 'GET';
        //     $path   = MEKARI_PATH_KYC; // contoh: /api/kyc?type=register

        //     // REQUEST LINE
        //     $requestLine = "{$method} {$path} HTTP/1.1";

        //     // STRING TO SIGN
        //     $stringToSign = "date: {$date}\n{$requestLine}";

        //     // SIGNATURE
        //     $signature = base64_encode(hash_hmac('sha256', $stringToSign, MEKARI_SECRET_ID, true));

        //     // AUTHORIZATION HEADER
        //     $authorization = sprintf(
        //         'hmac username="%s", algorithm="hmac-sha256", headers="date request-line", signature="%s"',
        //         MEKARI_CLIENT_ID,
        //         $signature
        //     );

        //     // return var_dump($date);

        //     // HEADERS
        //     $headers = [
        //         "Authorization: {$authorization}",
        //         "Date: {$date}",
        //         "Content-Type: application/json",
        //         "Accept: application/json"
        //     ];

        //     // CURL
        //     $ch = curl_init(MEKARI_BASE_URL . $path);
        //     curl_setopt_array($ch, [
        //         CURLOPT_HTTPGET        => true,
        //         CURLOPT_RETURNTRANSFER => true,
        //         CURLOPT_HTTPHEADER     => $headers,
        //         CURLOPT_SSL_VERIFYPEER => true
        //     ]);

        //     $response = curl_exec($ch);
        //     curl_close($ch);

        //     return json_decode($response, true);
        // }

        public static function hmac($method,$path){
            $date          = gmdate('D, d M Y H:i:s') . ' GMT';
            $requestLine   = "{$method} {$path} HTTP/1.1";
            $stringToSign  = "date: {$date}\n{$requestLine}";
            $signature     = base64_encode(hash_hmac('sha256',$stringToSign,MEKARI_SECRET_ID,true));
            $authorization = sprintf('hmac username="%s", algorithm="hmac-sha256", headers="date request-line", signature="%s"',MEKARI_CLIENT_ID,$signature);

            $response['date']          = $date;
            $response['authorization'] = $authorization;
            
            return $response;
        }

        public static function registerkyc($body){
            $method = "POST";
            $path   = "/v2/esign/v1/ekyc_request";
            $hmac   = Mekari::hmac($method,$path);

            $header = array(
                                "Authorization: ".$hmac['authorization'],
                                "Date: ".$hmac['date'],
                                "Content-Type: application/json",
                                "Accept: application/json"
                            );

            $responsecurl = curl([
                'url'     => MEKARI_BASE_URL.$path,
                'method'  => $method,
                'header'  => $header,
                'body'    => $body,
                'savelog' => false,
                'source'  => "MEKARI-EKYC"
            ]);

            return json_decode($responsecurl,TRUE); 
        }

        public static function listregisterkyc($email){
            $method = "GET";
            $path   = "/v2/esign/v1/ekyc_request?page=1&limit=1&email=".$email;
            $hmac   = Mekari::hmac($method,$path);

            $header = array(
                                "Authorization: ".$hmac['authorization'],
                                "Date: ".$hmac['date'],
                                "Content-Type: application/json",
                                "Accept: application/json"
                            );

            $responsecurl = curl([
                'url'     => MEKARI_BASE_URL.$path,
                'method'  => $method,
                'header'  => $header,
                'body'    => "",
                'savelog' => false,
                'source'  => "MEKARI-EKYC"
            ]);

            return json_decode($responsecurl,TRUE); 
        }


    }

    
?>