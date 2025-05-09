<?php
    class BSRe{
        public static function checkcertificateuser($body){

            $auth   = base64_encode(USERNAME_BSRE.':'.PASSWORD_BSRE);
            $header = array('Authorization: Basic '.$auth);

            $responsecurl = curl([
                'url'     => BASE_URL_BSRE."api/user/status/".$body,
                'method'  => "GET",
                'header'  => $header,
                'body'    => $body,
                'savelog' => true,
                'source'  => "BSRE-CHECKCERTIFICATEUSER"
            ]);

            return json_decode($responsecurl,TRUE); 
        }

        public static function signingdocumentvisible($nik, $phass, $location, $spesimen, $tag) {
            $body = [];
            
            $auth   = base64_encode(USERNAME_BSRE . ':' . PASSWORD_BSRE);
            $header = ['Authorization: Basic ' . $auth];
        
            $mimedoc = mime_content_type($location);
            $namedoc = pathinfo($location, PATHINFO_BASENAME);
            $filedoc = new CURLFile($location, $mimedoc, $namedoc);
        
            $mimespe = mime_content_type($spesimen);
            $namespe = pathinfo($spesimen, PATHINFO_BASENAME);
            $filespe = new CURLFile($spesimen, $mimespe, $namespe);

            $body = [
                'file'          => $filedoc,
                'nik'           => $nik,
                'passphrase'    => $phass,
                'tampilan'      => 'visible',
                'image'         => 'true',
                'imageTTD'      => $filespe,
                'tag_koordinat' => $tag,
                'width'         => WIDTH,
                'height'        => HEIGHT
            ];
        
            $responsecurl = curl([
                'url'     => BASE_URL_BSRE."api/sign/pdf",
                'method'  => "POST",
                'header'  => $header,
                'body'    => $body,
                'savelog' => false,
                'source'  => "BSRE-SIGNING"
            ]);
        
            unlink($spesimen);
            return $responsecurl;
        }
        

        
    }

?>