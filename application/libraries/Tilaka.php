<?php
    class Tilaka{

        public static $clientid;
        public static $clientsecret;
        public static $baseurl;
        
        public static function init(){
            self::$clientid       = CLIENT_ID;
            self::$clientsecret   = CLIENT_SECRET;
            self::$baseurl   = BASE_URL;
        }

        
        public static function generateuuid($data = null){
            $data = $data ?? random_bytes(16);
            assert(strlen($data) == 16);
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
            return vsprintf("%s%s-%s-%s-%s-%s%s%s", str_split(bin2hex($data), 4));
        }

        public static function oauth(){
            $body   = array("client_id"=>self::$clientid,"client_secret"=>self::$clientsecret,"grant_type"=>"client_credentials");
            $header = array("Content-Type: application/x-www-form-urlencoded");

            $responsecurl = curl([
                'url'     => self::$baseurl."auth",
                'method'  => "POST",
                'header'  => $header,
                'body'    => http_build_query($body),
                'savelog' => true,
                'source'  => "TILAKA-TOKEN"
            ]);

            $responsecurl = json_decode($responsecurl,TRUE);
            return $responsecurl;
        }

        public static function uuid(){
            $header = array("Content-Type: application/json","Authorization: Bearer ".Tilaka::oauth()['access_token']);

            $responsecurl = curl([
                'url'     => self::$baseurl."generateUUID",
                'method'  => "POST",
                'header'  => $header,
                'body'    => "",
                'savelog' => true,
                'source'  => "TILAKA-UUID"
            ]);

            return json_decode($responsecurl,TRUE);
        }

        public static function registerkyc($body){
            $header = array("Content-Type: application/json","Authorization: Bearer ".Tilaka::oauth()['access_token']);

            $responsecurl = curl([
                'url'     => self::$baseurl."registerForKycCheck",
                'method'  => "POST",
                'header'  => $header,
                'body'    => $body,
                'savelog' => false,
                'source'  => "TILAKA-REGISTERKYC"
            ]);

            return json_decode($responsecurl,TRUE); 
        }

        public static function checkregistrasiuser($body){
            $header = array("Content-Type: application/json","Authorization: Bearer ".Tilaka::oauth()['access_token']);

            $responsecurl = curl([
                'url'     => self::$baseurl."userregstatus",
                'method'  => "POST",
                'header'  => $header,
                'body'    => $body,
                'savelog' => false,
                'source'  => "TILAKA-CHECKREGISTRASIUSER"
            ]);

            return json_decode($responsecurl,TRUE); 
        }

        public static function webviewregistrasi($parameter){
            $header = array("Content-Type: application/json","Authorization: Bearer ".Tilaka::oauth()['access_token']);

            $responsecurl = curl([
                'url'     => self::$baseurl."personal-webview/guide?".$parameter,
                'method'  => "POST",
                'header'  => $header,
                'body'    => "",
                'savelog' => false,
                'source'  => "TILAKA-WEBVIEWREGISTRAS"
            ]);

            return json_decode($responsecurl,TRUE); 
        }

        public static function checkcertificateuser($body){
            $header = array("Content-Type: application/json","Authorization: Bearer ".Tilaka::oauth()['access_token']);

            $responsecurl = curl([
                'url'     => self::$baseurl."checkcertstatus",
                'method'  => "POST",
                'header'  => $header,
                'body'    => $body,
                'savelog' => false,
                'source'  => "TILAKA-CHECKCERTIFICATEUSER"
            ]);

            return json_decode($responsecurl,TRUE); 
        }

        public static function checkakunpenautan($body){
            $header = array("Content-Type: application/json","Authorization: Bearer ".Tilaka::oauth()['access_token']);

            $responsecurl = curl([
                'url'     => self::$baseurl."checkAkunDSExist",
                'method'  => "POST",
                'header'  => $header,
                'body'    => $body,
                'savelog' => false,
                'source'  => "TILAKA-CHECKAKUNPENAUTAN"
            ]);

            return json_decode($responsecurl,TRUE); 
        }

        public static function webviewpenautan($parameter){
            $header = array("Content-Type: application/json","Authorization: Bearer ".Tilaka::oauth()['access_token']);

            $responsecurl = curl([
                'url'     => self::$baseurl."personal-webview/link-account?".$parameter,
                'method'  => "POST",
                'header'  => $header,
                'body'    => "",
                'savelog' => false,
                'source'  => "TILAKA-WEBVIEWPENAUTAN"
            ]);

            return json_decode($responsecurl,TRUE); 
        }

        public static function checkakunexist($body){
            $header = array("Content-Type: application/json","Authorization: Bearer ".Tilaka::oauth()['access_token']);

            $responsecurl = curl([
                'url'     => self::$baseurl."checkAkunDSExist",
                'method'  => "POST",
                'header'  => $header,
                'body'    => $body,
                'savelog' => false,
                'source'  => "TILAKA-CHECKAKUNEXIST"
            ]);

            return json_decode($responsecurl,TRUE); 
        }

        
    }

?>