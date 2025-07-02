<?php
    class Whatsapp {
        public static function sendWhatsAppDocument($body) {
            $header = ["Content-Type: application/json"];

            $responsecurl = curl([
                'url'     => "http://localhost:5001/message/send-document",
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