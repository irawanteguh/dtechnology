<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $route['default_controller'] = 'landingpage/landingpage';

    $route['authtilaka']         = 'restapi/tilaka/TilakaserviceV5/auth';
    $route['uploadallfile']      = 'restapi/tilaka/TilakaserviceV5/uploadallfile';
    $route['requestsign']        = 'restapi/tilaka/TilakaserviceV5/requestsign';
    $route['excutesign']         = 'restapi/tilaka/TilakaserviceV5/excutesign';
    $route['statussign']         = 'restapi/tilaka/TilakaserviceV5/statussign';
    $route['appkyc']             = 'restapi/tilaka/TilakaserviceV5/checkdataapprovalkyc';

    $route['pegawai']            = 'restapi/Khanza/pegawai';
    
    $route['masterDomisili']     = 'restapi/satusehat/MasterDomisili/domisili';

    $route['ReceiveData/(:any)']          = 'restapi/aktivo/Leka/ReceiveData/$1';
    $route['ListExamination/(:any)']      = 'restapi/aktivo/Leka/ListExamination/$1';
    $route['GetResultLeka/(:any)/(:any)'] = 'restapi/aktivo/Leka/GetResultLeka/$1/$2';
    $route['UpdateLeka/(:any)']           = 'restapi/aktivo/Leka/UpdateLeka/$1';
    $route['Sendsatusehat/(:any)']        = 'restapi/aktivo/Leka/Sendsatusehat/$1';

    $route['403_override']         = 'errors/error_403';
    $route['404_override']         = 'errors/error_404';
    $route['translate_uri_dashes'] = FALSE;
?>