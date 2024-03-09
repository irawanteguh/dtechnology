<?php
    class Tilaka{

        public static $clientid;
        public static $clientsecret;
        public static $baseurloauth;
        
        public static function init(){
            self::$clientid       = CLIENT_ID;
            self::$clientsecret   = CLIENT_SECRET;
            self::$baseurloauth   = OAUTH_URL;
        }

        public static function uuid($data = null){
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
                'url'     => self::$baseurloauth,
                'method'  => "POST",
                'header'  => $header,
                'body'    => http_build_query($body),
                'savelog' => false,
                'source'  => "TILAKA-TOKEN"
            ]);

            $responsecurl = json_decode($responsecurl,TRUE)["access_token"];
            return $responsecurl;
        }

        
    }

?>