<?php
defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';
    include FCPATH."assets/vendors/phpqrcode/qrlib.php";
    include FCPATH."assets/vendors/pdfparse/Pdfparse.php";
    require 'vendor/autoload.php';
    use Smalot\PdfParser\Parser;
    use setasign\Fpdi\Fpdi;
    use setasign\Fpdi\PdfReader;

    class Auth extends REST_Controller {


        // public function hmac_get() {

        //     $clientId     = 'BfilE6rYEnsxyjO7';
        //     $clientSecret = 'h72pE8DcHki8gom5mNdgO20wRfmryH7j';

        //     $method = 'GET';
        //     $path   = '/v2/esign-hmac/v1/profile';
        //     $url    = 'https://sandbox-api.mekari.com' . $path;

        //     // RFC7231 UTC
        //     $date = gmdate('D, d M Y H:i:s') . ' GMT';

        //     $request_line = "{$method} {$path} HTTP/1.1";

        //     $payload = "date: {$date}\n{$request_line}";

        //     $signature = base64_encode(
        //         hash_hmac('sha256', $payload, $clientSecret, true)
        //     );

        //     $authorization = sprintf(
        //         'hmac username="%s", algorithm="hmac-sha256", headers="date request-line", signature="%s"',
        //         $clientId,
        //         $signature
        //     );

        //     $headers = [
        //         "Authorization: {$authorization}",
        //         "Date: {$date}",
        //         "Content-Type: application/json",
        //         "Accept: application/json"
        //     ];

        //     $ch = curl_init($url);
        //     curl_setopt_array($ch, [
        //         CURLOPT_HTTPGET        => true, // ⬅️ PENTING
        //         CURLOPT_RETURNTRANSFER => true,
        //         CURLOPT_HTTPHEADER     => $headers,
        //         CURLOPT_SSL_VERIFYPEER => true
        //     ]);

        //     $response = curl_exec($ch);
        //     curl_close($ch);

        //     $this->response(json_decode($response, true));
        // }

        public function hmac_get(){
            $response = Mekari::hmac();
            $this->response($response,REST_Controller::HTTP_OK);
        }
    }

?>
