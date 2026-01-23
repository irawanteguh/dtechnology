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

    public function oauth_authorize_get()
{
    $clientId = 'BfilE6rYEnsxyjO7';
    $state    = 'testing123';

    $authorizeUrl =
        'https://sandbox-account.mekari.com/auth'
        . '?client_id=' . $clientId
        . '&response_type=code'
        . '&scope=esign'
        . '&state=' . $state;

    redirect($authorizeUrl);
}


public function oauth_callback_get()
{
    $code = $this->get('code');

    if (!$code) {
        $this->response([
            'status'  => false,
            'message' => 'Authorization code not found'
        ], 400);
        return;
    }

    $postData = http_build_query([
        'client_id'     => 'BfilE6rYEnsxyjO7',
        'client_secret' => 'h72pE8DcHki8gom5mNdgO20wRfmryH7j',
        'grant_type'    => 'authorization_code',
        'code'          => $code
    ]);

    $ch = curl_init('https://sandbox-api.mekari.com/oauth2/token');
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/x-www-form-urlencoded'
        ],
        CURLOPT_POSTFIELDS     => $postData
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $result = json_decode($response, true);

    $this->response([
        'http_code' => $httpCode,
        'token'     => $result
    ], $httpCode);
}

    public function hmac_post() {

        $clientId     = 'BfilE6rYEnsxyjO7';
        $clientSecret = 'h72pE8DcHki8gom5mNdgO20wRfmryH7j';

        $method = 'GET';
    $path   = '/v2/esign-hmac/v1/profile';
    $url    = 'https://sandbox-api.mekari.com' . $path;

    // RFC7231 UTC
    $date = gmdate('D, d M Y H:i:s') . ' GMT';

    $request_line = "{$method} {$path} HTTP/1.1";

    $payload = "date: {$date}\n{$request_line}";

    $signature = base64_encode(
        hash_hmac('sha256', $payload, $clientSecret, true)
    );

    $authorization = sprintf(
        'hmac username="%s", algorithm="hmac-sha256", headers="date request-line", signature="%s"',
        $clientId,
        $signature
    );

    $headers = [
        "Authorization: {$authorization}",
        "Date: {$date}",
        "Content-Type: application/json",
        "Accept: application/json"
    ];

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_HTTPGET        => true, // ⬅️ PENTING
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => $headers,
        CURLOPT_SSL_VERIFYPEER => true
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $this->response(json_decode($response, true));
    }
}

?>
