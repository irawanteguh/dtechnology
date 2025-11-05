<?php
    class Dtech{

        public static function oauth(){
            $body['orgid']    = "10c84edd-500b-49e3-93a5-a2c8cd2c8524";
            $body['username'] = "Admin_Leka";
            $body['password'] = "12345678";

            $header = array("Content-Type: application/x-www-form-urlencoded");

            $responsecurl = curl([
                'url'     => "https://rsumutiasari.com/dtechnology/index.php/auth",
                'method'  => "GET",
                'header'  => $header,
                'body'    => json_encode($body),
                'savelog' => false,
                'source'  => "DTECH-TOKEN"
            ]);

            return json_decode($responsecurl,TRUE); 
        }

        public static function quickreportkunjungan($body){
            $oauthResponse = Dtech::oauth();

            if(isset($oauthResponse['data']['token'])){
                $token = $oauthResponse['data']['token'];

                $header = [
                    "x-token: $token",
                    "Content-Type: application/json"
                ];

                $responsecurl = curl([
                    'url'     => "https://rsumutiasari.com/dtechnology/index.php/addquickreportkunjungan",
                    // 'url'     => "localhost/dtech/dtechnology/index.php/addquickreportkunjungan",
                    'method'  => "POST",
                    'header'  => $header,
                    'body'    => $body,
                    'savelog' => false,
                    'source'  => "DTECH-QUICKREPORT"
                ]);
    
                return json_decode($responsecurl,TRUE); 
            }else{
                return json_decode($oauthResponse, TRUE); 
            }
        }

        public static function quickreportpendapatan($body){
            $oauthResponse = Dtech::oauth();

            if(isset($oauthResponse['data']['token'])){
                $token = $oauthResponse['data']['token'];

                $header = [
                    "x-token: $token",
                    "Content-Type: application/json"
                ];

                $responsecurl = curl([
                    // 'url'     => "https://rsumutiasari.com/dtechnology/index.php/addquickreportpendapatan",
                    'url'     => "localhost/dtech/dtechnology/index.php/addquickreportpendapatan",
                    'method'  => "POST",
                    'header'  => $header,
                    'body'    => $body,
                    'savelog' => false,
                    'source'  => "DTECH-QUICKREPORT"
                ]);
    
                return json_decode($responsecurl,TRUE); 
            }else{
                return json_decode($oauthResponse, TRUE); 
            }
        }

        public static function addsigndocument($body){
            $oauthResponse = Dtech::oauth();

            if(isset($oauthResponse['data']['token'])){
                $token = $oauthResponse['data']['token'];

                $header = [
                    "x-token: $token",
                    "Content-Type: application/json"
                ];

                $responsecurl = curl([
                    'url'     => "https://rsumutiasari.com/dtechnology/index.php/addsigndocument/",
                    'method'  => "POST",
                    'header'  => $header,
                    'body'    => $body,
                    'savelog' => false,
                    'source'  => "DTECH-INSERTDOCUMENT"
                ]);

                return json_decode($responsecurl,TRUE); 
            }else{
                return json_decode($oauthResponse, TRUE); 
            }
        }

        public static function checkdatauser($nik){
            $oauthResponse = Dtech::oauth();

            if(isset($oauthResponse['data']['token'])){
                $token = $oauthResponse['data']['token'];

                $header = [
                    "x-token: $token",
                    "Content-Type: application/json"
                ];

                $responsecurl = curl([
                    'url'     => "https://rsumutiasari.com/dtechnology/index.php/datauser/".$nik,
                    'method'  => "GET",
                    'header'  => $header,
                    'body'    => "",
                    'savelog' => false,
                    'source'  => "DTECH-CHECKDATAUSER"
                ]);
                return json_decode($responsecurl,TRUE); 
            }else{
                return json_decode($oauthResponse, TRUE); 
            }
        }

        public static function statusdocument($nofile){
            $oauthResponse = Dtech::oauth();

            if(isset($oauthResponse['data']['token'])){
                $token = $oauthResponse['data']['token'];

                $header = [
                    "x-token: $token",
                    "Content-Type: application/json"
                ];

                $responsecurl = curl([
                    'url'     => "https://rsumutiasari.com/dtechnology/index.php/statusdocument/".$nofile,
                    'method'  => "GET",
                    'header'  => $header,
                    'body'    => "",
                    'savelog' => false,
                    'source'  => "DTECH-CHECKSTATUSDOCUMENT"
                ]);
                return json_decode($responsecurl,TRUE); 
            }else{
                return json_decode($oauthResponse, TRUE); 
            }
        }
    }

?>