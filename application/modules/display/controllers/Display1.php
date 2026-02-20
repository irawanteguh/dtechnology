<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Display1 extends CI_Controller {

    private $nas_ip = "192.168.102.50"; // Ganti dengan IP NAS Anda
    private $nas_port = "5001"; // Default port DSM
    private $nas_user = "simrs"; // Ganti dengan username NAS
    private $nas_pass = "@Mutiasari02"; // Ganti dengan password NAS

    public function __construct() {
        parent::__construct();
    }

    private function synologyLogin() {
        $login_url = "https://{$this->nas_ip}:{$this->nas_port}/webapi/auth.cgi?api=SYNO.API.Auth&version=3&method=login&account={$this->nas_user}&passwd={$this->nas_pass}&session=DiskStation&format=sid";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $login_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = json_decode(curl_exec($ch), true);
        curl_close($ch);

        if (isset($response['data']['sid'])) {
            return $response['data']['sid']; // Mengembalikan Session ID (SID)
        } else {
            return null;
        }
    }

    private function getWeeklyReport($sid) {
        $api_url = "https://{$this->nas_ip}:{$this->nas_port}/webapi/entry.cgi?api=SYNO.FileStation.List&version=2&method=list_share&_sid={$sid}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = json_decode(curl_exec($ch), true);
        curl_close($ch);

        if (isset($response['data']['shares'])) {
            return $response['data']['shares'];
        } else {
            return null;
        }
    }

    public function fetchWeeklyReport() {
        $sid = $this->synologyLogin();
        
        if ($sid) {
            $data = $this->getWeeklyReport($sid);
            
            if ($data) {
                header('Content-Type: application/json');
                echo json_encode([
                    "responCode" => "00",
                    "responHead" => "success",
                    "responDesc" => "Data Successfully Found",
                    "responResult" => $data
                ], JSON_PRETTY_PRINT);
            } else {
                echo json_encode(["error" => "Gagal mengambil data Weekly Report"]);
            }
        } else {
            echo json_encode(["error" => "Gagal login ke Synology"]);
        }
    }
}
?>
