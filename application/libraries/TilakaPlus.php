<?php
    class TilakaPlus{

        public static function oauth(){
            $body   = array("client_id"=>CLIENT_ID_TILAKA,"client_secret"=>CLIENT_SECRET_TILAKA,"grant_type"=>"client_credentials");
            $header = array("Content-Type: application/x-www-form-urlencoded");

            $responsecurl = curl([
                'url'     => TILAKA_BASE_URL."auth",
                'method'  => "POST",
                'header'  => $header,
                'body'    => http_build_query($body),
                'savelog' => false,
                'source'  => "TILAKA-TOKEN"
            ]);

            return json_decode($responsecurl,TRUE); 
        }

        public static function uuid($certificate,$name,$email){
            $oauthResponse = Tilaka::oauth();

            if (!isset($oauthResponse['access_token'])) {
                return is_array($oauthResponse) ? $oauthResponse : json_decode($oauthResponse, true);
            }

            $header = array("Content-Type: application/json","Authorization: Bearer ".Tilaka::oauth()['access_token']);

            if($certificate==="PERSONAL"){
                $responsecurl = curl([
                    'url'     => TILAKA_BASE_URL."generateUUID",
                    'method'  => "POST",
                    'header'  => $header,
                    'body'    => "",
                    'savelog' => true,
                    'source'  => "TILAKA-UUID"
                ]);
            }else{
                $responsecurl = curl([
                    'url'     => TILAKA_BASE_URL."generateUUID?name=".$name."&email=".$email."",
                    'method'  => "POST",
                    'header'  => $header,
                    'body'    => "",
                    'savelog' => true,
                    'source'  => "TILAKA-UUID"
                ]);
            }
            return json_decode($responsecurl,TRUE);
        }

        public static function registerkyc($body){
            $oauthResponse = Tilaka::oauth();

            if (!isset($oauthResponse['access_token'])) {
                return is_array($oauthResponse) ? $oauthResponse : json_decode($oauthResponse, true);
            }
            
            $header = array("Content-Type: application/json","Authorization: Bearer ".Tilaka::oauth()['access_token']);

            $responsecurl = curl([
                'url'     => TILAKA_BASE_URL."registerForKycCheck",
                'method'  => "POST",
                'header'  => $header,
                'body'    => $body,
                'savelog' => true,
                'source'  => "TILAKA-REGISTERKYC"
            ]);

            return json_decode($responsecurl,TRUE); 
        }

        public static function checkregistrasiuser($body){
            $oauthResponse = Tilaka::oauth();

            if (!isset($oauthResponse['access_token'])) {
                return is_array($oauthResponse) ? $oauthResponse : json_decode($oauthResponse, true);
            }
                    
            $header = array("Content-Type: application/json","Authorization: Bearer ".Tilaka::oauth()['access_token']);

            $responsecurl = curl([
                'url'     => TILAKA_BASE_URL."userregstatus",
                'method'  => "POST",
                'header'  => $header,
                'body'    => $body,
                'savelog' => false,
                'source'  => "TILAKA-CHECKREGISTRASIUSER"
            ]);

            return json_decode($responsecurl,TRUE); 
        }

        public static function checkcertificateuser($body){
            $oauthResponse = Tilaka::oauth();

            if (!isset($oauthResponse['access_token'])) {
                return is_array($oauthResponse) ? $oauthResponse : json_decode($oauthResponse, true);
            }

            $header = array("Content-Type: application/json","Authorization: Bearer ".$oauthResponse['access_token']);

            $responsecurl = curl([
                'url'     => TILAKA_BASE_URL."checkcertstatus",
                'method'  => "POST",
                'header'  => $header,
                'body'    => $body,
                'savelog' => false,
                'source'  => "TILAKA-CHECKCERTIFICATEUSER"
            ]);

            return json_decode($responsecurl,TRUE); 
        }

        public static function revoke($body){
            $oauthResponse = TilakaPlus::oauth();

            if (!isset($oauthResponse['access_token'])) {
                return is_array($oauthResponse) ? $oauthResponse : json_decode($oauthResponse, true);
            }

            $header = array("Content-Type: application/json","Authorization: Bearer ".$oauthResponse['access_token']);

            $responsecurl = curl([
                'url'     => TILAKA_BASE_URL."requestRevokeCertificate",
                'method'  => "POST",
                'header'  => $header,
                'body'    => $body,
                'savelog' => false,
                'source'  => "TILAKA-REVOKE"
            ]);

            return json_decode($responsecurl,TRUE); 
        }

        public static function uploadfile($location){
            $oauthResponse = TilakaPlus::oauth();

            if (!isset($oauthResponse['access_token'])) {
                return is_array($oauthResponse) ? $oauthResponse : json_decode($oauthResponse, true);
            }

            $accessToken = $oauthResponse['access_token'];
            $tempFile    = null;

            /*
            |--------------------------------------------------------------------------
            | Jika input berupa URL → download dulu ke folder temp aplikasi
            |--------------------------------------------------------------------------
            */
            if (filter_var($location, FILTER_VALIDATE_URL)) {

                $tempDir = FCPATH . 'assets/temp/';

                if (!is_dir($tempDir)) {
                    mkdir($tempDir, 0777, true);
                }

                if (!is_writable($tempDir)) {
                    return [
                        'status'  => false,
                        'message' => 'Temporary directory is not writable.'
                    ];
                }

                $filename = basename(parse_url($location, PHP_URL_PATH));
                $tempFile = $tempDir . $filename;

                $ch = curl_init($location);
                curl_setopt_array($ch, [
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_CONNECTTIMEOUT => 30,
                    CURLOPT_TIMEOUT => 60
                ]);

                $fileData = curl_exec($ch);

                if (curl_errno($ch)) {
                    $error = curl_error($ch);
                    curl_close($ch);
                    return [
                        'status'  => false,
                        'message' => 'Failed download file from URL: ' . $error
                    ];
                }

                curl_close($ch);

                if (!$fileData) {
                    return [
                        'status'  => false,
                        'message' => 'Downloaded file is empty.'
                    ];
                }

                file_put_contents($tempFile, $fileData);

                $location = $tempFile;
            }

            /*
            |--------------------------------------------------------------------------
            | Validasi file
            |--------------------------------------------------------------------------
            */
            if (!file_exists($location)) {
                return [
                    'status'  => false,
                    'message' => 'File not found.'
                ];
            }

            if (filesize($location) == 0) {
                return [
                    'status'  => false,
                    'message' => 'File is empty.'
                ];
            }

            $fileInfo  = pathinfo($location);
            $extension = strtolower($fileInfo['extension'] ?? '');

            $mimeTypes = [
                'pdf'  => 'application/pdf',
                'jpg'  => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'png'  => 'image/png',
                'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ];

            $mimeType = $mimeTypes[$extension] ?? 'application/octet-stream';
            $fileName = $fileInfo['basename'];

            /*
            |--------------------------------------------------------------------------
            | Upload ke Tilaka
            |--------------------------------------------------------------------------
            */
            $headers = [
                "Authorization: Bearer {$accessToken}"
            ];

            $postData = [
                'file' => new CURLFile($location, $mimeType, $fileName)
            ];

            $response = curl([
                'url'     => TILAKALITE_URL . "api/v1/upload",
                'method'  => "POST",
                'header'  => $headers,
                'body'    => $postData,
                'savelog' => false,
                'source'  => "TILAKA-UPLOADFILE"
            ]);

            /*
            |--------------------------------------------------------------------------
            | Cleanup file temp
            |--------------------------------------------------------------------------
            */
            if ($tempFile && file_exists($tempFile)) {
                @unlink($tempFile);
            }

            return json_decode($response, true);
        }

        public static function requestsignquicksign($body){
            $oauthResponse = TilakaPlus::oauth();

            if (!isset($oauthResponse['access_token'])) {
                return is_array($oauthResponse) ? $oauthResponse : json_decode($oauthResponse, true);
            }

            $accessToken = $oauthResponse['access_token'];

            $headers = [
                "Content-Type: application/json",
                "Authorization: Bearer {$accessToken}"
            ];

            $response = curl([
                'url'     => TILAKALITE_URL . "api/v1/requestquicksign",
                'method'  => "POST",
                'header'  => $headers,
                'body'    => $body,
                'savelog' => true,
                'source'  => "TILAKA-UPLOADFILE"
            ]);

            return json_decode($response, true);
        }

        public static function requestsignreguler($body){
            $oauthResponse = TilakaPlus::oauth();

            if (!isset($oauthResponse['access_token'])) {
                return is_array($oauthResponse) ? $oauthResponse : json_decode($oauthResponse, true);
            }

            $accessToken = $oauthResponse['access_token'];

            $headers = [
                "Content-Type: application/json",
                "Authorization: Bearer {$accessToken}"
            ];

            $response = curl([
                'url'     => TILAKALITE_URL . "api/v1/requestsign",
                'method'  => "POST",
                'header'  => $headers,
                'body'    => $body,
                'savelog' => true,
                'source'  => "TILAKA-REQUESTSIGN"
            ]);

            return json_decode($response, true);
        }

        public static function excutesign($body){
            $oauthResponse = TilakaPlus::oauth();

            if (!isset($oauthResponse['access_token'])) {
                return is_array($oauthResponse) ? $oauthResponse : json_decode($oauthResponse, true);
            }

            $accessToken = $oauthResponse['access_token'];

            $headers = [
                "Content-Type: application/json",
                "Authorization: Bearer {$accessToken}"
            ];

            $response = curl([
                'url'     => TILAKALITE_URL . "api/v1/executesign",
                'method'  => "POST",
                'header'  => $headers,
                'body'    => $body,
                'savelog' => false,
                'source'  => "TILAKA-EXECUTE"
            ]);

            return json_decode($response, true);
        }

        public static function statussign($body){
            $oauthResponse = TilakaPlus::oauth();

            if (!isset($oauthResponse['access_token'])) {
                return is_array($oauthResponse) ? $oauthResponse : json_decode($oauthResponse, true);
            }

            $accessToken = $oauthResponse['access_token'];

            $headers = [
                "Content-Type: application/json",
                "Authorization: Bearer {$accessToken}"
            ];

            $response = curl([
                'url'     => TILAKALITE_URL . "api/v1/checksignstatus",
                'method'  => "POST",
                'header'  => $headers,
                'body'    => $body,
                'savelog' => false,
                'source'  => "TILAKA-SIGNSTATUS"
            ]);

            return json_decode($response, true);
        }

        public static function regquicksign($body){
            $oauthResponse = TilakaPlus::oauth();

            if (!isset($oauthResponse['access_token'])) {
                return is_array($oauthResponse) ? $oauthResponse : json_decode($oauthResponse, true);
            }

            $accessToken = $oauthResponse['access_token'];

            $headers = [
                "Content-Type: application/json",
                "Authorization: Bearer {$accessToken}"
            ];

            $response = curl([
                'url'     => TILAKA_BASE_URL."addquicksignusers",
                'method'  => "POST",
                'header'  => $headers,
                'body'    => $body,
                'savelog' => false,
                'source'  => "TILAKA-REGQUICKSIGN"
            ]);

            return json_decode($response, true);
        }

        public static function submittemplatequicksign($body){
            $oauthResponse = TilakaPlus::oauth();

            if (!isset($oauthResponse['access_token'])) {
                return is_array($oauthResponse) ? $oauthResponse : json_decode($oauthResponse, true);
            }

            $accessToken = $oauthResponse['access_token'];

            $headers = [
                "Content-Type: application/json",
                "Authorization: Bearer {$accessToken}"
            ];

            $response = curl([
                'url'     => TILAKA_BASE_URL."quicksign-addtemplates",
                'method'  => "POST",
                'header'  => $headers,
                'body'    => $body,
                'savelog' => false,
                'source'  => "TILAKA-SUBMITTEMPLATEQUICKSIGN"
            ]);

            return json_decode($response, true);
        }

    }

?>