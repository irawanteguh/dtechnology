<?php
    class Gatewaywhatsapp {
    
        public static function sendWhatsAppText($body) {
            $header = ["Content-Type: application/json"];

            $responsecurl = curl([
                'url'     => WA_GATEWAY."/message/send-text",
                'method'  => "POST",
                'header'  => $header,
                'body'    => json_encode($body),
                'savelog' => true,
                'source'  => "DTECH-WHATSAPP"
            ]);

            return json_decode($responsecurl, true);
        }

        public static function sendWhatsAppDocument($body) {
            $header = ["Content-Type: application/json"];

            $responsecurl = curl([
                'url'     => WA_GATEWAY."/message/send-document",
                'method'  => "POST",
                'header'  => $header,
                'body'    => json_encode($body),
                'savelog' => true,
                'source'  => "DTECH-WHATSAPP"
            ]);

            return json_decode($responsecurl, true);
        }
    }


?>