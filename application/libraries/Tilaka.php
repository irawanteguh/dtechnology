<?php
    class Tilaka{

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

        public static function uploadfile($location){
            $oauthResponse = Tilaka::oauth();
            if(isset($oauthResponse['access_token'])){
                $header    = array("Authorization: Bearer ".$oauthResponse['access_token']);
                $infodoc   = pathinfo($location);
                $extension = strtolower($infodoc['extension']);
                
                switch ($extension) {
                    case 'pdf':
                        $mimedoc = 'application/pdf';
                    break;

                    case 'jpg':
                    case 'jpeg':
                        $mimedoc = 'image/jpeg';
                    break;

                    case 'png':
                        $mimedoc = 'image/png';
                    break;

                    default:
                        $mimedoc = 'application/octet-stream';
                    break;
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
            
                return json_decode($responsecurl, TRUE); 
            }else{
                return json_decode($oauthResponse, TRUE); 
            }
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
                    'savelog' => true,
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
                    'savelog' => true,
                    'source'  => "TILAKA-SIGNSTATUS"
                ]);
                return json_decode($responsecurl,TRUE); 
            }else{
                return json_decode($oauthResponse,TRUE); 
            }
        }
    }

?>