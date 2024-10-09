<?php
    class Satusehat{

        public static function oauth(){
            $body   = array("client_id"=>CLIENTID_SATUSEHAT,"client_secret"=>CLIENTSECRET_SATUSEHAT);
            $header = array("Content-Type: application/x-www-form-urlencoded");
           
            $responsecurl = curl([
                'url'     => AUTHURL_SATUSEHAT."/accesstoken?grant_type=client_credentials",
                'method'  => "POST",
                'header'  => $header,
                'body'    => http_build_query($body),
                'savelog' => true,
                'source'  => "SATUSEHAT-TOKEN"
            ]);

            $responsecurl = json_decode($responsecurl,TRUE);
            return $responsecurl;
        }

        public static function getencounter($encounterid){
            $header = array("Content-Type: application/json","Authorization: Bearer ".Satusehat::oauth()['access_token']);

            $responsecurl = curl([
                'url'     => BASEURL_SATUSEHAT."/fhir-r4/v1/Encounter/".$encounterid,
                'method'  => "GET",
                'header'  => $header,
                'body'    => "",
                'savelog' => false,
                'source'  => "SATUSEHAT-GET-ENCOUNTER"
            ]);

            return json_decode($responsecurl,TRUE); 
        }

        // public static function masterdomisili($parameter){
        //     $testing = Satusehat::oauth();
        //     $header = array("Content-Type: application/json","Authorization: Bearer ".Satusehat::oauth()['access_token']);

        //     $responsecurl = curl([
        //         'url'     => SATUSEHAT_BASE_URL."/masterdata/v1/".$parameter,
        //         'method'  => "GET",
        //         'header'  => $header,
        //         'body'    => "",
        //         'savelog' => true,
        //         'source'  => "SATUSEHAT-MASTERDOMISILI"
        //     ]);

        //     return json_decode($responsecurl,TRUE); 
        // }
        
        public static function postbundle($body){
            $header = array("Content-Type: application/json","Authorization: Bearer ".Satusehat::oauth()['access_token']);

            $responsecurl = curl([
                'url'     => BASEURL_SATUSEHAT."/fhir-r4/v1",
                'method'  => "POST",
                'header'  => $header,
                'body'    => $body,
                'savelog' => false,
                'source'  => "SATUSEHAT-BUNDLE"
            ]);

            return json_decode($responsecurl,TRUE); 
        }
    }

?>