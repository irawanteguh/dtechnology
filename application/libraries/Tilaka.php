<?php
    class Tilaka{

        public static function downloadToTemp($url, $extension = 'pdf'){
            // Tentukan direktori temp (ubah sesuai OS)
            $tempDir = sys_get_temp_dir(); // cross-platform: Windows/Linux

            // Buat nama file random
            $tempFile = $tempDir . DIRECTORY_SEPARATOR . 'temp_'.uniqid().'.'.$extension;

            // Download file dari URL
            $fileData = $this->curlDownload($url);

            // Simpan ke temp file
            file_put_contents($tempFile, $fileData);

            return $tempFile; // file siap digunakan oleh CURLFILE
        }

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

            if(isset($oauthResponse['access_token'])){
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
            }else{
                return json_decode($oauthResponse, TRUE); 
            }
        }

        public static function uuidreenroll($useridentifier){
            $oauthResponse = Tilaka::oauth();
            if(isset($oauthResponse['access_token'])){
                $header = array("Content-Type: application/json","Authorization: Bearer ".$oauthResponse['access_token']);

                $responsecurl = curl([
                    'url'     => TILAKA_BASE_URL."generateUUID?request_type=re_enroll&user_identifier=".$useridentifier,
                    'method'  => "POST",
                    'header'  => $header,
                    'body'    => "",
                    'savelog' => true,
                    'source'  => "TILAKA-UUIDENROLL"
                ]);
    
                return json_decode($responsecurl,TRUE);
            }else{
                return json_decode($oauthResponse, TRUE); 
            }
        }

        public static function registerkyc($body){
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
            $header = array("Content-Type: application/json","Authorization: Bearer ".Tilaka::oauth()['access_token']);

            $responsecurl = curl([
                'url'     => TILAKA_BASE_URL."userregstatus",
                'method'  => "POST",
                'header'  => $header,
                'body'    => $body,
                'savelog' => true,
                'source'  => "TILAKA-CHECKREGISTRASIUSER"
            ]);

            return json_decode($responsecurl,TRUE); 
        }

        public static function checkcertificateuser($body){
            $oauthResponse = Tilaka::oauth();
            if(isset($oauthResponse['access_token'])){
                $header = array("Content-Type: application/json","Authorization: Bearer ".$oauthResponse['access_token']);

                $responsecurl = curl([
                    'url'     => TILAKA_BASE_URL."checkcertstatus",
                    'method'  => "POST",
                    'header'  => $header,
                    'body'    => $body,
                    'savelog' => true,
                    'source'  => "TILAKA-CHECKCERTIFICATEUSER"
                ]);
    
                return json_decode($responsecurl,TRUE); 

            }else{
                return json_decode($oauthResponse, TRUE); 
            }
        }

        public static function revoke($body){
            $header = array("Content-Type: application/json","Authorization: Bearer ".Tilaka::oauth()['access_token']);

            $responsecurl = curl([
                'url'     => TILAKA_BASE_URL."requestRevokeCertificate",
                'method'  => "POST",
                'header'  => $header,
                'body'    => $body,
                'savelog' => true,
                'source'  => "TILAKA-REVOKE"
            ]);

            return json_decode($responsecurl,TRUE); 
        }

        // public static function uploadfile($location){
        //     $oauthResponse = Tilaka::oauth();
        //     if(isset($oauthResponse['access_token'])){
        //         $header    = array("Authorization: Bearer ".$oauthResponse['access_token']);
        //         $infodoc   = pathinfo($location);
        //         $extension = strtolower($infodoc['extension']);
                
        //         switch ($extension) {
        //             case 'pdf':
        //                 $mimedoc = 'application/pdf';
        //             break;

        //             case 'jpg':
        //             case 'jpeg':
        //                 $mimedoc = 'image/jpeg';
        //             break;

        //             case 'png':
        //                 $mimedoc = 'image/png';
        //             break;

        //             default:
        //                 $mimedoc = 'application/octet-stream';
        //             break;
        //         }
                
        //         $namedoc = $infodoc['basename'];
            
        //         $requestbody = array(
        //             'file' => new CURLFILE($location, $mimedoc, $namedoc)
        //         );
            
        //         $responsecurl = curl([
        //             'url'     => TILAKALITE_URL."api/v1/upload",
        //             'method'  => "POST",
        //             'header'  => $header,
        //             'body'    => $requestbody,
        //             'savelog' => false,
        //             'source'  => "TILAKA-UPLOADFILE"
        //         ]);
            
        //         return json_decode($responsecurl, TRUE); 
        //     }else{
        //         return json_decode($oauthResponse, TRUE); 
        //     }
        // }

        public static function uploadfile($location){
            $oauthResponse = Tilaka::oauth();
            if(!isset($oauthResponse['access_token'])){
                return json_decode($oauthResponse, TRUE); 
            }

            $header = array(
                "Authorization: Bearer ".$oauthResponse['access_token'],
                "Content-Type: multipart/form-data"
            );

            // Cek apakah location adalah URL
            if (filter_var($location, FILTER_VALIDATE_URL)) {
                // Download dulu ke file temp
                $tempDir  = sys_get_temp_dir();
                $tempExt  = strtolower(pathinfo(parse_url($location, PHP_URL_PATH), PATHINFO_EXTENSION));
                $tempFile = $tempDir . DIRECTORY_SEPARATOR . uniqid('tilaka_') . '.' . $tempExt;
                
                $fileData = self::downloadToTemp($location);
                file_put_contents($tempFile, $fileData);

                $location = $tempFile; // ubah location ke temp file tersebut
            }

            $infodoc   = pathinfo($location);
            $extension = strtolower($infodoc['extension']);

            switch ($extension) {
                case 'pdf':  $mimedoc = 'application/pdf'; break;
                case 'jpg':
                case 'jpeg': $mimedoc = 'image/jpeg'; break;
                case 'png':  $mimedoc = 'image/png'; break;
                default:     $mimedoc = 'application/octet-stream'; break;
            }

            $namedoc = $infodoc['basename'];

            $requestbody = array(
                'file' => new CURLFILE($location, $mimedoc, $namedoc)
            );

            $responsecurl = curl([
                'url'     => TILAKALITE_URL."api/v1/upload",
                'method'  => "POST",
                'header'  => $header,
                'body'    => $requestbody,
                'savelog' => false,
                'source'  => "TILAKA-UPLOADFILE"
            ]);

            // Hapus file temp jika tadi download dari URL
            if (isset($tempFile) && file_exists($tempFile)) {
                unlink($tempFile);
            }

            return json_decode($responsecurl, TRUE);
        }

        
        public static function requestsign($body){
            $oauthResponse = Tilaka::oauth();
            if(isset($oauthResponse['access_token'])){
                $header = array("Content-Type: application/json","Authorization: Bearer ".$oauthResponse['access_token']);
                
                $responsecurl = curl([
                    'url'     => TILAKALITE_URL."api/v1/requestsign",
                    'method'  => "POST",
                    'header'  => $header,
                    'body'    => $body,
                    'savelog' => true,
                    'source'  => "TILAKA-REQSIGN"
                ]);
                return json_decode($responsecurl,TRUE); 
            }else{
                return json_decode($oauthResponse, TRUE); 
            }
        }

        public static function requestsignquicksign($body){
            $oauthResponse = Tilaka::oauth();
            if(isset($oauthResponse['access_token'])){
                $header = array("Content-Type: application/json","Authorization: Bearer ".$oauthResponse['access_token']);

                $responsecurl = curl([
                    'url'     => TILAKALITE_URL."api/v1/requestquicksign",
                    'method'  => "POST",
                    'header'  => $header,
                    'body'    => $body,
                    'savelog' => true,
                    'source'  => "TILAKA-REQSIGN"
                ]);
                return json_decode($responsecurl,TRUE); 
            }else{
                return json_decode($oauthResponse, TRUE); 
            }
        }

        public static function excutesign($body){
            $oauthResponse = Tilaka::oauth();
            if(isset($oauthResponse['access_token'])){
                $header = array("Content-Type: application/json","Authorization: Bearer ".$oauthResponse['access_token']);

                $responsecurl = curl([
                    'url'     => TILAKALITE_URL."api/v1/executesign",
                    'method'  => "POST",
                    'header'  => $header,
                    'body'    => $body,
                    'savelog' => false,
                    'source'  => "TILAKA-EXECUTESIGN"
                ]);
                return json_decode($responsecurl,TRUE); 
            }else{
                return json_decode($oauthResponse, TRUE); 
            }
        }

        public static function excutesignstatus($body){
            $oauthResponse = Tilaka::oauth();
            if(isset($oauthResponse['access_token'])){
                $header = array("Content-Type: application/json","Authorization: Bearer ".$oauthResponse['access_token']);

                $responsecurl = curl([
                    'url'     => TILAKALITE_URL."api/v1/checksignstatus",
                    'method'  => "POST",
                    'header'  => $header,
                    'body'    => $body,
                    'savelog' => false,
                    'source'  => "TILAKA-SIGNSTATUS"
                ]);
                return json_decode($responsecurl,TRUE); 
            }else{
                return json_decode($oauthResponse,TRUE); 
            }
        }
    }

?>