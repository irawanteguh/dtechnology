<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $route['default_controller']   = 'landingpage/landingpage';
    $route['404_override']         = 'Error404';
    $route['translate_uri_dashes'] = FALSE;

    $route['OAuth']              = 'restapi/TTE/OAuth';
    $route['Register']              = 'restapi/TTE/Register';

?>