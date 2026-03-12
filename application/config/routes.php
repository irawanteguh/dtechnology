<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $route['default_controller'] = 'welcome';

    
    $route['ReceiveData/(:any)']          = 'restapi/aktivo/Leka/ReceiveData/$1';
    $route['ListExamination/(:any)']      = 'restapi/aktivo/Leka/ListExamination/$1';
    $route['GetResultLeka/(:any)/(:any)'] = 'restapi/aktivo/Leka/GetResultLeka/$1/$2';
    $route['UpdateLeka/(:any)']           = 'restapi/aktivo/Leka/UpdateLeka/$1';

    $route['addsigndocument']       = 'restapi/dtech/Signdocument/addsigndocument';
    $route['statusdocument/(:any)'] = 'restapi/dtech/Signdocument/statusdocument/$1';
    $route['datatransaksi']         = 'restapi/dtech/SyncTTE/datatransaksi';

    $route['pegawai']                     = 'restapi/khanza/Khanza/pegawai';

    $route['auth']                        = 'restapi/tilaka/TilakaquicksignV2/auth';
    $route['uploadfile']                  = 'restapi/tilaka/TilakaquicksignV2/uploadfile';
    $route['requestsign']                 = 'restapi/tilaka/TilakaquicksignV2/requestsign';
    $route['statussign']                  = 'restapi/tilaka/TilakaquicksignV2/statussign';

    $route['hmac']                        = 'restapi/mekari/auth/hmac';
    $route['kycliststatus']               = 'restapi/mekari/Kyc/kycliststatus';
    $route['kyc']                         = 'webhook/mekari/Kyc/kyc';

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