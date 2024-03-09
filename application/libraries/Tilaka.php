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

        

        public static function oauth(){
            $body   = array("client_id"=>self::$clientid,"client_secret"=>self::$clientsecret,"grant_type"=>"client_credentials");
            $header = array("Content-Type: application/x-www-form-urlencoded");

            $responsecurl = curl([
                'url'     => self::$baseurl."auth",
                'method'  => "POST",
                'header'  => $header,
                'body'    => http_build_query($body),
                'savelog' => false,
                'source'  => "TILAKA-TOKEN"
            ]);

            $responsecurl = json_decode($responsecurl,TRUE)["access_token"];
            return $responsecurl;
        }

        public static function uuid(){
            $header = array("Content-Type: application/json","Authorization: Bearer ".Tilaka::oauth());

            $responsecurl = curl([
                'url'     => self::$baseurl."generateUUID",
                'method'  => "POST",
                'header'  => $header,
                'body'    => "",
                'savelog' => false,
                'source'  => "TILAKA-UUID"
            ]);

            echo $responsecurl;
        }

        
    }

?>