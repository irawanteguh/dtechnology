<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    // $route['default_controller'] = 'landingpage/Rmb';
    $route['default_controller'] = 'landingpage/Mutiasari';
    // $route['default_controller'] = 'landingpage/landingpage';

    $route['authtilaka']           = 'restapi/tilaka/TilakaserviceV5/auth';
    $route['uploadallfile']        = 'restapi/tilaka/TilakaserviceV5/uploadallfile';
    $route['requestsign']          = 'restapi/tilaka/TilakaserviceV5/requestsign';
    $route['requestsignquicksign'] = 'restapi/tilaka/TilakaserviceV5/requestsignquicksign';
    $route['excutesign']           = 'restapi/tilaka/TilakaserviceV5/excutesign';
    $route['statussign']           = 'restapi/tilaka/TilakaserviceV5/statussign';
    $route['statussignquicksign']           = 'restapi/tilaka/TilakaserviceV5/statussignquicksign';
    $route['appkyc']               = 'restapi/tilaka/TilakaserviceV5/checkdataapprovalkyc';
    $route['getfile']              = 'restapi/tilaka/TilakaserviceV5/getfile';
    $route['mergepdfs']            = 'restapi/tilaka/TilakaserviceV5/mergepdfs';

    $route['authtilaka/bulk']         = 'restapi/tilaka/Tilakaservicebulk/auth';
    $route['uploadfilesingle/bulk']   = 'restapi/tilaka/Tilakaservicebulk/uploadfilesingle';
    $route['requestsignsingle/bulk']  = 'restapi/tilaka/Tilakaservicebulk/requestsignsingle';
    $route['executesignsingle/bulk']  = 'restapi/tilaka/Tilakaservicebulk/executesignsingle';
    $route['downloadfilesingle/bulk'] = 'restapi/tilaka/Tilakaservicebulk/downloadfilesingle';

    $route['pegawai'] = 'restapi/Khanza/pegawai';
    $route['pasien']  = 'restapi/Khanza/pasien';
    
    $route['masterDomisili'] = 'restapi/satusehat/MasterDomisili/domisili';

    $route['ReceiveData/(:any)']          = 'restapi/aktivo/Leka/ReceiveData/$1';
    $route['ListExamination/(:any)']      = 'restapi/aktivo/Leka/ListExamination/$1';
    $route['GetResultLeka/(:any)/(:any)'] = 'restapi/aktivo/Leka/GetResultLeka/$1/$2';
    $route['UpdateLeka/(:any)']           = 'restapi/aktivo/Leka/UpdateLeka/$1';

    $route['loadserver']        = 'root/Loadserver/load';


    

    $route['403_override']         = 'errors/error_403';
    $route['404_override']         = 'errors/error_404';
    $route['translate_uri_dashes'] = FALSE;
?>