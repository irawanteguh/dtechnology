<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    // $route['default_controller'] = 'landingpage/Rmb';
    $route['default_controller'] = 'landingpage/Mutiasari';
    // $route['default_controller'] = 'landingpage/landingpage';

    // $route['authtilaka']           = 'restapi/tilaka/TilakaserviceV5/auth';
    // $route['uploadallfile']        = 'restapi/tilaka/TilakaserviceV5/uploadallfile';
    // $route['requestsign']          = 'restapi/tilaka/TilakaserviceV5/requestsign';
    // $route['requestsignquicksign'] = 'restapi/tilaka/TilakaserviceV5/requestsignquicksign';
    // $route['excutesign']           = 'restapi/tilaka/TilakaserviceV5/excutesign';
    // $route['statussign']           = 'restapi/tilaka/TilakaserviceV5/statussign';

    $route['statussignquicksign']  = 'restapi/tilaka/TilakaserviceV5/statussignquicksign';
    $route['appkyc']               = 'restapi/tilaka/TilakaserviceV5/checkdataapprovalkyc';
    $route['getfile']              = 'restapi/tilaka/TilakaserviceV5/getfile';
    $route['mergepdfs']            = 'restapi/tilaka/TilakaserviceV5/mergepdfs';

    $route['authtilaka']           = 'restapi/tilaka/Tilakaservice/auth';
    $route['uploadallfile']        = 'restapi/tilaka/Tilakaservice/uploadallfile';
    $route['requestsign']          = 'restapi/tilaka/Tilakaservice/requestsign';
    $route['requestsignquicksign'] = 'restapi/tilaka/Tilakaservice/requestsignquicksign';
    $route['excutesign']           = 'restapi/tilaka/Tilakaservice/excutesign';
    $route['statussign']           = 'restapi/tilaka/Tilakaservice/statussign';
    $route['transferfile']         = 'restapi/tilaka/Tilakaservice/transferfile';
    $route['getstatusdocument']    = 'restapi/tilaka/Tilakaservice/getstatusdocument';


    $route['pegawai']               = 'restapi/khanza/Khanza/pegawai';
    $route['pasien']                = 'restapi/khanza/Khanza/pasien';
    $route['quickreportkunjungan']  = 'restapi/khanza/Sb/quickreportkunjungan';
    $route['quickreportpendapatan'] = 'restapi/khanza/Sb/quickreportpendapatan';
    
    $route['masterDomisili'] = 'restapi/satusehat/MasterDomisili/domisili';

    $route['ReceiveData/(:any)']          = 'restapi/aktivo/Leka/ReceiveData/$1';
    $route['ListExamination/(:any)']      = 'restapi/aktivo/Leka/ListExamination/$1';
    $route['GetResultLeka/(:any)/(:any)'] = 'restapi/aktivo/Leka/GetResultLeka/$1/$2';
    $route['UpdateLeka/(:any)']           = 'restapi/aktivo/Leka/UpdateLeka/$1';

   


    $route['auth']                  = 'restapi/dtech/Auth/createdtoken';
    $route['datauser/(:any)']       = 'restapi/dtech/User/datauser/$1';
    $route['addsigndocument']       = 'restapi/dtech/Signdocument/addsigndocument';
    $route['statusdocument/(:any)'] = 'restapi/dtech/Signdocument/statusdocument/$1';

    // $route['addquickreportkunjungan']  = 'restapi/dtech/Sb/addquickreportkunjungan';
    // $route['addquickreportpendapatan'] = 'restapi/dtech/Sb/addquickreportpendapatan';
    
    
   

    $route['documenttte']        = 'restapi/dtech/Notification/documenttte';
    $route['approvalpodirector'] = 'restapi/dtech/Notification/approvalpodirector';

    
    $route['updatedevice']      = 'restapi/dtech/Whatsapp/updatedevice';
    $route['broadcastwhatsapp'] = 'restapi/dtech/Whatsapp/broadcastwhatsapp';
    

    $route['loadserver']        = 'root/Loadserver/load';

    $route['403_override']         = 'errors/error_403';
    $route['404_override']         = 'errors/error_404';
    $route['translate_uri_dashes'] = FALSE;
?>