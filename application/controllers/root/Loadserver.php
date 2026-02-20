<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';

    class Loadserver extends REST_Controller{
        
        public function __construct(){
            parent::__construct();
        }

        public function load_GET(){
            // Menampilkan informasi PHP
            ob_start();
            phpinfo();
            $phpinfo = ob_get_clean();

            // Cek beban server (load average)
            function getServerLoad() {
                if (stristr(PHP_OS, 'win')) {
                    return 'Load average tidak tersedia pada Windows';
                } else {
                    $load = sys_getloadavg();
                    return "Load Average (1m, 5m, 15m): " . implode(', ', $load);
                }
            }

            // Cek proses Apache
            $apacheProcess = shell_exec('ps aux | grep apache2');

            // Memory usage
            $memoryUsage = [
                'Memori Terpakai' => (memory_get_usage(true) / 1024 / 1024) . ' MB',
                'Memori Maksimal' => (memory_get_peak_usage(true) / 1024 / 1024) . ' MB'
            ];

            $response = [
                // 'phpinfo'        => $phpinfo,
                'server_load'    => getServerLoad(),
                'apache_process' => $apacheProcess,
                'memory_info'    => $memoryUsage
            ];

            $this->response($response, REST_Controller::HTTP_OK);
        }
        
    }
?>
