<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $route['default_controller']   = 'landingpage/landingpage';
    // $route['default_controller']   = 'welcome';

    $route['404_override']         = 'Error404';
    $route['translate_uri_dashes'] = FALSE;

    $route['uploadallfile'] = 'restapi/Tilakaservice/uploadallfile';
    $route['requestsign']   = 'restapi/Tilakaservice/requestsign';
    $route['statussign']    = 'restapi/Tilakaservice/statussign';

    // $route['oauth']                = 'restapi/TTE/OAuth';
    // $route['uuid']                 = 'restapi/TTE/Uuid';
    // $route['registerkyc']          = 'restapi/TTE/registerkyc';
    // $route['webviewregistrasi']    = 'restapi/TTE/webviewregistrasi';
    // $route['checkregistrasiuser']  = 'restapi/TTE/checkregistrasiuser';
    // $route['checkcertificateuser'] = 'restapi/TTE/checkcertificateuser';
    // $route['checkakunpenautan']    = 'restapi/TTE/checkakunpenautan';
    // $route['webviewpenautan']      = 'restapi/TTE/webviewpenautan';

    

?>