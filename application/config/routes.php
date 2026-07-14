<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $route['default_controller'] = 'welcome';


    $route['pegawai']             = 'restapi/khanza/Khanza/pegawai';
    $route['datatransaksi']       = 'restapi/dtech/SyncTTE/datatransaksi';
    $route['generatedQRCode']     = 'restapi/tte/ServiceSignTTE/generatedQRCode';
    $route['uploadfile']          = 'restapi/tte/ServiceSignTTE/uploadfile';
    $route['requestquicksign']    = 'restapi/tte/ServiceSignTTE/requestquicksign';
    $route['requestregulersign']  = 'restapi/tte/ServiceSignTTE/requestregulersign';
    $route['executesign']         = 'restapi/tte/ServiceSignTTE/executesign';
    $route['statussignquicksign'] = 'restapi/tte/ServiceSignTTE/statussignquicksign';
    $route['listcompressfile']    = 'restapi/tte/ServiceSignTTE/listcompressfile';
   
   
    $route['403_override']         = 'errors/error_403';
    $route['404_override']         = 'errors/error_404';
    $route['translate_uri_dashes'] = FALSE;
?>