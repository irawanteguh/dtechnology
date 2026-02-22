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

        public static function uploadfile($location){
            $oauthResponse = Tilaka::oauth();

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

                $tempDir = FCPATH . 'assets/document/temp/';

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
                $tempFile = $tempDir . uniqid('tilaka_') . '_' . $filename;

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

    }

?>