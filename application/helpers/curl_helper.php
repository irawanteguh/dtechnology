<?php

    function curl($config){
        $ci = &get_instance();
        $ci->load->model('Modelserviceapi', 'mlog');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL            => $config['url'],
            CURLOPT_CUSTOMREQUEST  => $config['method'],
            CURLOPT_POSTFIELDS     => $config['body'],
            CURLOPT_HTTPHEADER     => $config['header'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0
        ));
        
        $response        = curl_exec($curl);

        $response_header       = json_encode(curl_getinfo($curl));
        $request_headers       = json_encode(function_exists('apache_request_headers') ? apache_request_headers() : array());
        $request_url           = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
        $response_status       = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $appconnect_time_us    = json_encode(curl_getinfo($curl)['appconnect_time_us']);
        $connect_time_us       = json_encode(curl_getinfo($curl)['connect_time_us']);
        $namelookup_time_us    = json_encode(curl_getinfo($curl)['namelookup_time_us']);
        $pretransfer_time_us   = json_encode(curl_getinfo($curl)['pretransfer_time_us']);
        $redirect_time_us      = json_encode(curl_getinfo($curl)['redirect_time_us']);
        $starttransfer_time_us = json_encode(curl_getinfo($curl)['starttransfer_time_us']);
        $total_time_us         = json_encode(curl_getinfo($curl)['total_time_us']);

        // echo "Hasil print_r:\n";
        // echo '<pre>';
        // print_r(curl_getinfo($curl));
        // echo '</pre>';
        // die();

        curl_close($curl);

        if($config['savelog']){
            $requestlog = [
                'REQUEST_ID'            => round(microtime(true) * 1000),
                'REQUEST_METHOD'        => $config['method'],
                'REQUEST_URL'           => $request_url,
                'REQUEST_HEADERS'       => $request_headers,
                'REQUEST_BODY'          => $config['body'],
                'USER_AGENT'            => $_SERVER['HTTP_USER_AGENT'],
                'REMOTE_ADDRESS'        => $_SERVER['REMOTE_ADDR'],
                'RESPONSE_STATUS'       => $response_status,
                'RESPONSE_HEADERS'      => $response_header,
                'RESPONSE_BODY'         => $response,
                'APPCONNECT_TIME_US'    => $appconnect_time_us,
                'CONNECT_TIME_US'       => $connect_time_us,
                'NAMELOOKUP_TIME_US'    => $namelookup_time_us,
                'PRETRANSFER_TIME_US'   => $pretransfer_time_us,
                'REDIRECT_TIME_US'      => $redirect_time_us,
                'STARTTRANSFER_TIME_US' => $starttransfer_time_us,
                'TOTAL_TIME_US'         => $total_time_us,
                'SOURCE'                => $config['source']
            ];
        }else{
            $requestlog = [
                'REQUEST_ID'            => round(microtime(true) * 1000),
                'REQUEST_METHOD'        => $config['method'],
                'REQUEST_URL'           => $request_url,
                'REQUEST_HEADERS'       => $request_headers,
                'REQUEST_BODY'          => "",
                'USER_AGENT'            => $_SERVER['HTTP_USER_AGENT'],
                'REMOTE_ADDRESS'        => $_SERVER['REMOTE_ADDR'],
                'RESPONSE_STATUS'       => $response_status,
                'RESPONSE_HEADERS'      => $response_header,
                'RESPONSE_BODY'         => "",
                'APPCONNECT_TIME_US'    => $appconnect_time_us,
                'CONNECT_TIME_US'       => $connect_time_us,
                'NAMELOOKUP_TIME_US'    => $namelookup_time_us,
                'PRETRANSFER_TIME_US'   => $pretransfer_time_us,
                'REDIRECT_TIME_US'      => $redirect_time_us,
                'STARTTRANSFER_TIME_US' => $starttransfer_time_us,
                'TOTAL_TIME_US'         => $total_time_us,
                'SOURCE'                => $config['source']
            ];
        }

        $ci->mlog->savelog($requestlog);
        
        return $response;
    }


?>