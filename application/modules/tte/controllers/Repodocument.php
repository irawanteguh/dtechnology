<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    include FCPATH."assets/vendors/phpqrcode/qrlib.php";

	class Repodocument extends CI_Controller {

        public $upload;

		public function __construct(){
            parent:: __construct();
            rootsystem::system();
			$this->load->model("Modelrepodocument","md");
        }

		public function index(){
            $data = $this->loadcombobox();

            $full_url   = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
            $full_url  .= "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $has_query  = parse_url($full_url, PHP_URL_QUERY);

            if (!empty($has_query)) {
                $datacallback['org_id']      = $_SESSION['orgid'];
                $datacallback['callback_id'] = generateuuid();
                $datacallback['url']         = $full_url;
                $datacallback['created_by']  = $_SESSION['userid'];

                $this->md->insertcallback($datacallback);
            }

            if(isset($_GET['user_identifier']) && isset($_GET['request_id']) && isset($_GET['status'])){
                if($_GET['status'] === "Sukses"){
                    $data        = [];
                    $responseotp = "";

                    $body['request_id']      = $_GET['request_id'];
                    $body['user_identifier'] = $_GET['user_identifier'];

                    $checkdata = $this->md->checkdata($_GET['request_id']);

                    // gabungkan response lama + user baru
                    if(empty($checkdata->response)){
                        $responseotp = $_GET['user_identifier'];
                    }else{
                        $responseotp = $checkdata->response.";".$_GET['user_identifier'];
                    }

                    // hilangkan duplikat
                    $responseArray = array_unique(array_filter(array_map('trim', explode(';', $responseotp))));
                    $responseotp   = implode(';', $responseArray);

                    // execute sign
                    $responseexcutesign = TilakaPlus::excutesign(json_encode($body));

                    // jika PROCESS atau DONE
                    if(
                        ($responseexcutesign['success'] === true  && $responseexcutesign['status'] === "PROCESS")
                        ||
                        ($responseexcutesign['success'] === false && $responseexcutesign['status'] === "DONE")
                    ){

                        $data['response'] = $responseotp;

                        // semua user_identifier wajib
                        $allUsers = array_unique(array_filter(array_map('trim', explode(';', $checkdata->user_identifier))));

                        // pecah response
                        $responseParts = array_unique(array_filter(array_map('trim', explode(';', $responseotp))));

                        // ambil hanya user_identifier valid
                        $otpUsers = [];

                        foreach($responseParts as $part){
                            if(in_array($part, $allUsers)){
                                $otpUsers[] = $part;
                            }
                        }

                        // cek apakah semua user sudah OTP
                        $diff = array_diff($allUsers, $otpUsers);

                        // jika semua user sudah OTP
                        if(empty($diff)){
                            $data['status_sign'] = '6';
                        }

                        // update database
                        $this->md->updatedocument($data, $_GET['request_id']);

                        redirect("tte/repodocument");
                    }
                }
            }else{
                $this->template->load("template/template-sidebar","v_repodocument",$data);
            }
		}

        public function loadcombobox(){
            $resultuserassign = $this->md->userassign($_SESSION['orgid']);

            $assign="";
            foreach($resultuserassign as $a ){
                $assign.="<option value='".$a->nik."'>".$a->name."</option>";
            }

            $data['assign'] = $assign;
            return $data;
		}

        public function alldocument(){
            $result = $this->md->alldocument();
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Di Temukan";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Tidak Di Temukan";
            }

            echo json_encode($json);
        }

        public function adddocument()
        {
            $this->output->set_content_type('application/json', 'utf-8');

            $respond = function ($code, $head, $desc, $extra = []) {
                $payload = array_merge([
                    'responCode' => $code,
                    'responHead' => $head,
                    'responDesc' => $desc
                ], $extra);

                $this->output->set_output(json_encode($payload));
            };

            /*
            =================================
            VALIDASI REQUEST
            =================================
            */
            if (strtoupper($this->input->method()) !== 'POST') {
                $respond('01', 'error', 'Invalid request method');
                return;
            }

            $postMaxSize = trim(ini_get('post_max_size'));
            $postMaxBytes = (float) $postMaxSize;
            switch (strtolower(substr($postMaxSize, -1))) {
                case 'g': $postMaxBytes *= 1024;
                case 'm': $postMaxBytes *= 1024;
                case 'k': $postMaxBytes *= 1024;
            }

            if ($postMaxBytes > 0 && (float) ($_SERVER['CONTENT_LENGTH'] ?? 0) > $postMaxBytes) {
                $respond('01', 'error', 'Ukuran request melebihi post_max_size PHP (' . $postMaxSize . '). Silakan perkecil file dokumen.');
                return;
            }

            $assign = trim((string) $this->input->post('modal_sign_add_tilaka_assign'));
            $type   = trim((string) $this->input->post('modal_sign_add_tilaka_type'));
            $info1  = trim((string) $this->input->post('modal_sign_add_tilaka_informasi1'));
            $info2  = trim((string) $this->input->post('modal_sign_add_tilaka_informasi2'));

            if ($assign === '') {
                $respond('01', 'error', 'Signer wajib dipilih');
                return;
            }

            if ($type === '') {
                $respond('01', 'error', 'Jenis dokumen wajib diisi');
                return;
            }

            /*
            =================================
            VALIDASI FILE
            =================================
            */
            $fileKey = 'modal_sign_add_tilaka_document';

            if (!isset($_FILES[$fileKey])) {
                log_message(
                    'error',
                    'Tilaka upload: file key tidak ditemukan. ' .
                    'CONTENT_TYPE=' . ($_SERVER['CONTENT_TYPE'] ?? '') .
                    ', CONTENT_LENGTH=' . ($_SERVER['CONTENT_LENGTH'] ?? '') .
                    ', POST_KEYS=' . implode(',', array_keys($_POST)) .
                    ', FILE_KEYS=' . implode(',', array_keys($_FILES))
                );

                $respond('01', 'error', 'File dokumen tidak ditemukan dalam request. Periksa multipart/form-data dan konfigurasi PHP.');
                return;
            }

            $file = $_FILES[$fileKey];

            if (!isset($file['error']) || is_array($file['error'])) {
                $respond('01', 'error', 'Format upload file tidak valid');
                return;
            }

            if ($file['error'] !== UPLOAD_ERR_OK) {
                $uploadErrors = [
                    UPLOAD_ERR_INI_SIZE   => 'File melebihi upload_max_filesize PHP',
                    UPLOAD_ERR_FORM_SIZE  => 'File melebihi batas ukuran form',
                    UPLOAD_ERR_PARTIAL    => 'File hanya terupload sebagian',
                    UPLOAD_ERR_NO_FILE    => 'Tidak ada file yang dipilih',
                    UPLOAD_ERR_NO_TMP_DIR => 'Folder temporary PHP tidak tersedia',
                    UPLOAD_ERR_CANT_WRITE => 'PHP gagal menulis file ke disk',
                    UPLOAD_ERR_EXTENSION  => 'Upload dihentikan oleh ekstensi PHP'
                ];

                $message = $uploadErrors[$file['error']] ?? 'Upload gagal dengan kode ' . $file['error'];

                $respond('01', 'error', $message);
                return;
            }

            if (
                empty($file['tmp_name']) ||
                !is_uploaded_file($file['tmp_name'])
            ) {
                $respond('01', 'error', 'Temporary upload file tidak valid');
                return;
            }

            $maxFileSize = 60 * 1024 * 1024;

            if ($file['size'] <= 0 || $file['size'] > $maxFileSize) {
                $respond('01', 'error', 'Ukuran dokumen harus lebih dari 0 dan maksimal 60 MiB');
                return;
            }

            $originalname = pathinfo($file['name'], PATHINFO_FILENAME);
            $extension    = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            if ($extension !== 'pdf') {
                $respond('01', 'error', 'Hanya dokumen PDF yang diperbolehkan');
                return;
            }

            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime  = $finfo->file($file['tmp_name']);

            if (!in_array($mime, ['application/pdf', 'application/x-pdf'], true)) {
                $respond('01', 'error', 'Tipe file bukan PDF yang valid');
                return;
            }

            /*
            =================================
            GENERATE TRANSACTION ID
            =================================
            */
            $transid     = generateuuid();
            $mainName    = $transid . '.pdf';
            $finalUrl    = null;
            $storageType = null;

            /*
            =================================
            UPLOAD KE TEMP
            =================================
            */
            $tempPath = FCPATH . 'assets/temp/';

            if (!is_dir($tempPath) && !mkdir($tempPath, 0755, true)) {
                $respond('01', 'error', 'Gagal membuat folder temporary');
                return;
            }

            if (!is_writable($tempPath)) {
                $respond('01', 'error', 'Folder temporary tidak memiliki izin tulis');
                return;
            }

            $config = [
                'upload_path'      => $tempPath,
                'allowed_types'    => 'pdf',
                'max_size'         => $maxFileSize / 1024,
                'file_name'        => $mainName,
                'overwrite'        => false,
                'remove_spaces'    => true,
                'file_ext_tolower' => true
            ];

            $this->load->library('upload');
            $this->upload->initialize($config);

            if (!$this->upload->do_upload($fileKey)) {
                $respond(
                    '01',
                    'error',
                    strip_tags($this->upload->display_errors())
                );
                return;
            }

            $uploadData = $this->upload->data();
            $tempFile   = $uploadData['full_path'];

            /*
            =================================
            CEK STORAGE TYPE
            =================================
            */
            if (filter_var(STORAGESIGNIN, FILTER_VALIDATE_URL)) {

                /*
                =================================
                REMOTE STORAGE
                =================================
                */
                $storageType = 'remote';
                $storageBase = rtrim(STORAGESIGNIN, '/');
                $url         = $storageBase . '/receivedfile.php';

                if (strtolower((string) parse_url($url, PHP_URL_SCHEME)) !== 'https') {
                    @unlink($tempFile);
                    $respond('01', 'error', 'Remote storage wajib menggunakan HTTPS');
                    return;
                }

                $ch = curl_init($url);

                if ($ch === false) {
                    @unlink($tempFile);
                    $respond('01', 'error', 'Gagal menginisialisasi CURL');
                    return;
                }

                curl_setopt_array($ch, [
                    CURLOPT_POST           => true,
                    CURLOPT_POSTFIELDS     => [
                        'file' => new CURLFile(
                            $tempFile,
                            'application/pdf',
                            $mainName
                        )
                    ],
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CONNECTTIMEOUT => 15,
                    CURLOPT_TIMEOUT        => 60,
                    CURLOPT_SSL_VERIFYPEER => true,
                    CURLOPT_SSL_VERIFYHOST => 2,
                    CURLOPT_FOLLOWLOCATION => false
                ]);

                $response = curl_exec($ch);
                $curlErr  = curl_error($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                curl_close($ch);

                if ($response === false || $curlErr !== '') {
                    @unlink($tempFile);

                    log_message('error', 'Tilaka remote CURL: ' . $curlErr);

                    $respond('01', 'error', 'Upload remote gagal (CURL): ' . $curlErr);
                    return;
                }

                if ($httpCode !== 200) {
                    @unlink($tempFile);

                    log_message('error', 'Tilaka remote HTTP: ' . $httpCode);

                    $respond('01', 'error', 'Upload remote gagal (HTTP ' . $httpCode . ')');
                    return;
                }

                /*
                =================================
                PARSE RESPONSE JSON
                =================================
                */
                $result = json_decode($response, true);

                if (
                    json_last_error() !== JSON_ERROR_NONE ||
                    !is_array($result)
                ) {
                    @unlink($tempFile);

                    log_message('error', 'Tilaka remote: response bukan JSON valid');

                    $respond('01', 'error', 'Response server remote tidak valid JSON');
                    return;
                }

                /*
                =================================
                VALIDASI REMOTE SUCCESS
                =================================
                */
                if (
                    !isset($result['success']) ||
                    $result['success'] !== true
                ) {
                    @unlink($tempFile);

                    $respond(
                        '01',
                        'error',
                        (string) ($result['message'] ?? 'Upload remote gagal')
                    );
                    return;
                }

                /*
                =================================
                AMBIL FINAL URL
                =================================
                */
                $remotePath = $result['url'] ?? ($result['path'] ?? null);

                if (is_string($remotePath) && trim($remotePath) !== '') {

                    $remotePath = trim($remotePath);

                    if (filter_var($remotePath, FILTER_VALIDATE_URL)) {
                        $finalUrl = $remotePath;
                    } else {
                        $finalUrl = $storageBase . '/' . ltrim($remotePath, '/');
                    }
                }

                if (
                    empty($finalUrl) ||
                    !filter_var($finalUrl, FILTER_VALIDATE_URL) ||
                    strtolower((string) parse_url($finalUrl, PHP_URL_SCHEME)) !== 'https' ||
                    parse_url($finalUrl, PHP_URL_HOST) !== parse_url($storageBase, PHP_URL_HOST)
                ) {
                    @unlink($tempFile);

                    $respond('01', 'error', 'URL dokumen dari remote storage tidak valid');
                    return;
                }

            } else {

                /*
                =================================
                LOCAL STORAGE
                =================================
                */
                $storageType = 'local';
                $destFolder  = rtrim(STORAGESIGNIN, '/') . '/';

                if (!is_dir($destFolder) && !mkdir($destFolder, 0755, true)) {
                    @unlink($tempFile);

                    $respond('01', 'error', 'Gagal membuat direktori local storage');
                    return;
                }

                if (!is_writable($destFolder)) {
                    @unlink($tempFile);

                    $respond('01', 'error', 'Direktori local storage tidak memiliki izin tulis');
                    return;
                }

                $destFile = $destFolder . $mainName;

                if (file_exists($destFile) || !rename($tempFile, $destFile)) {
                    @unlink($tempFile);

                    $respond('01', 'error', 'Gagal memindahkan file ke local storage');
                    return;
                }

                $finalUrl = rtrim(STORAGESIGNOUT, '/') . '/' . $mainName;
            }

            /*
            =================================
            DELETE TEMP FILE
            =================================
            */
            if (is_file($tempFile)) {
                @unlink($tempFile);
            }

            /*
            =================================
            VALIDASI FINAL URL
            =================================
            */
            if (empty($finalUrl)) {
                $respond('01', 'error', 'File URL tidak ditemukan (upload gagal)', [
                    'file_url' => null,
                    'storage'  => $storageType,
                    'trans_id' => $transid
                ]);
                return;
            }

            /*
            =================================
            VALIDASI SESSION
            =================================
            */
            $orgId  = $_SESSION['orgid'] ?? null;
            $userId = $_SESSION['userid'] ?? null;

            if (empty($orgId) || empty($userId)) {
                $respond('01', 'error', 'Session pengguna tidak ditemukan. Silakan login kembali');
                return;
            }

            /*
            =================================
            SIMPAN DATABASE
            =================================
            */
            $data = [
                'org_id'           => $orgId,
                'transaksi_id'     => $transid,
                'no_file'          => $originalname,
                'jenis_doc'        => $type,
                'signer_id'        => $assign,
                'note_1'           => $info1,
                'note_2'           => $info2,
                'storage_in'       => STORAGESIGNIN,
                'storage_out'      => STORAGESIGNOUT,
                'type_of'          => TYPEOF,
                'from_in'          => 'Dtechnology',
                'provider_sign'    => PROVIDERSIGN,
                'type_certificate' => TYPECERTIFICATE,
                'created_by'       => $userId
            ];

            if ($this->md->insertdocument($data)) {

                $respond('00', 'success', 'Data Added Successfully', [
                    'file_url' => $finalUrl,
                    'storage'  => $storageType,
                    'trans_id' => $transid
                ]);

            } else {

                log_message(
                    'error',
                    'Tilaka: database insert gagal. Transaksi ID=' . $transid
                );

                $respond('01', 'error', 'Database insert failed', [
                    'file_url' => $finalUrl,
                    'storage'  => $storageType,
                    'trans_id' => $transid
                ]);
            }
        }

        public function voiddocument(){
            $transid = $this->input->post("datatransaksiid");

            $data['status_sign'] = "80";

            if($this->md->updatedocument($data,$transid)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Updated Successfully";
            }else{
                $json['responCode']="01";
                $json['responHead']="error";
                $json['responDesc']="Data failed to update";
            }

            echo json_encode($json);
        }

        public function resend(){
            $transid = $this->input->post("datatransaksiid");

            $data['status_sign'] = "0";
            $data['storage_in']  = STORAGESIGNIN;
            $data['storage_out'] = STORAGESIGNOUT;
            $data['response']    = null;

            if($this->md->updatedocument($data,$transid)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Updated Successfully";
            }else{
                $json['responCode']="01";
                $json['responHead']="error";
                $json['responDesc']="Data failed to update";
            }

            echo json_encode($json);
        }


	}

?>
