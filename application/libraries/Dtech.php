<?php
    class Dtech{

        public static function oauth(){
            $body['orgid']    = ORG_ID;
            $body['username'] = "Admin_Leka";
            $body['password'] = "12345678";

            $header = array("Content-Type: application/x-www-form-urlencoded");

            $responsecurl = curl([
                'url'     => "https://rsumutiasari.com/dtechnology/index.php/auth",
                'method'  => "GET",
                'header'  => $header,
                'body'    => json_encode($body),
                'savelog' => true,
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
                    'savelog' => true,
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
                    'url'     => "https://rsumutiasari.com/dtechnology/index.php/addquickreportpendapatan",
                    // 'url'     => "localhost/dtech/dtechnology/index.php/addquickreportpendapatan",
                    'method'  => "POST",
                    'header'  => $header,
                    'body'    => $body,
                    'savelog' => true,
                    'source'  => "DTECH-QUICKREPORT"
                ]);
    
                return json_decode($responsecurl,TRUE); 
            }else{
                return json_decode($oauthResponse, TRUE); 
            }
        }
    }

?>