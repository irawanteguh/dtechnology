<?php
    class authorization {

        public static function validateTimestamp($token){
            $date   =new DateTime();
            $CI     =& get_instance();
            $token  =self::validateToken($token);
            if ($token != false && ($date->getTimestamp() - $token->timestamp < ($CI->config->item('token_timeout') * 60))) {
                return $token;
            }
            return false;
        }

        public static function validateToken($token){
            $CI =& get_instance();
            return JWT::decode($token, $CI->config->item('jwt_key'));
        }

        public static function generateToken($data){
            $CI =& get_instance();
            return JWT::encode($data, $CI->config->item('jwt_key'));
        }
        
    }

?>