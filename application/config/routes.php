<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    // $route['default_controller'] = 'landingpage/Rmb';
    // $route['default_controller'] = 'landingpage/Mutiasari';
    $route['default_controller'] = 'landingpage/landingpage';

    
    // $route['authtilaka']               = 'restapi/tilaka/Tilakaservice/auth';
    // $route['requestsign']              = 'restapi/tilaka/Tilakaservice/requestsign';
    // $route['excutesign']               = 'restapi/tilaka/Tilakaservice/excutesign';
    // $route['statussign']               = 'restapi/tilaka/Tilakaservice/statussign';
    // $route['transferfile']             = 'restapi/tilaka/Tilakaservice/transferfile';
    // $route['getstatusdocument']        = 'restapi/tilaka/Tilakaservice/getstatusdocument';
    // $route['statusregister']           = 'restapi/tilaka/Tilakaregister/statusregister';
    // $route['transferfiletoholding']    = 'restapi/tilaka/Tilakaquicksign/transferfiletoholding';
    // $route['uploadallfile']            = 'restapi/tilaka/Tilakaquicksign/uploadallfile';
    // $route['requestsignquicksign']     = 'restapi/tilaka/Tilakaquicksign/requestsignquicksign';
    // $route['statussignquicksign']      = 'restapi/tilaka/Tilakaquicksign/statussignquicksign';
    
    // $route['quickreportkunjungan']     = 'restapi/khanza/Sb/quickreportkunjungan';
    // $route['quickreportpendapatan']    = 'restapi/khanza/Sb/quickreportpendapatan';
    // $route['masterDomisili']           = 'restapi/satusehat/MasterDomisili/domisili';
    // $route['auth']                     = 'restapi/dtech/Auth/createdtoken';
    // $route['datauser/(:any)']          = 'restapi/dtech/User/datauser/$1';
    
    
    // $route['addquickreportkunjungan']  = 'restapi/dtech/Sb/addquickreportkunjungan';
    // $route['addquickreportpendapatan'] = 'restapi/dtech/Sb/addquickreportpendapatan';
    // $route['documenttte']              = 'restapi/dtech/Notification/documenttte';
    // $route['approvalpodirector']       = 'restapi/dtech/Notification/approvalpodirector';
    // $route['updatedevice']             = 'restapi/dtech/Whatsapp/updatedevice';
    // $route['broadcastwhatsapp']        = 'restapi/dtech/Whatsapp/broadcastwhatsapp';

    
    $route['ReceiveData/(:any)']          = 'restapi/aktivo/Leka/ReceiveData/$1';
    $route['ListExamination/(:any)']      = 'restapi/aktivo/Leka/ListExamination/$1';
    $route['GetResultLeka/(:any)/(:any)'] = 'restapi/aktivo/Leka/GetResultLeka/$1/$2';
    $route['UpdateLeka/(:any)']           = 'restapi/aktivo/Leka/UpdateLeka/$1';
    $route['addsigndocument']             = 'restapi/dtech/Signdocument/addsigndocument';
    $route['statusdocument/(:any)']       = 'restapi/dtech/Signdocument/statusdocument/$1';
    $route['pegawai']                     = 'restapi/khanza/Khanza/pegawai';
    $route['pasien']                      = 'restapi/khanza/Khanza/pasien';
    $route['hmac']                        = 'restapi/mekari/auth/hmac';
    $route['auth']                        = 'restapi/tilaka/TilakaquicksignV2/auth';
    $route['uploadfile']                  = 'restapi/tilaka/TilakaquicksignV2/uploadfile';
    $route['requestsign']                 = 'restapi/tilaka/TilakaquicksignV2/requestsign';
    $route['statussign']                  = 'restapi/tilaka/TilakaquicksignV2/statussign';
    $route['kycliststatus']               = 'restapi/mekari/Kyc/kycliststatus';

    $route['kyc'] = 'webhook/mekari/Kyc/kyc';

   
   
    $route['403_override']         = 'errors/error_403';
    $route['404_override']         = 'errors/error_404';
    $route['translate_uri_dashes'] = FALSE;
?>