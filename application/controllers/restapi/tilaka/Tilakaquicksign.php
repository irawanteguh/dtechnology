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

    if(!function_exists('color')){
        function color($name = null){
            $colors = [
                'reset'          => "\033[0m",
                'black'          => "\033[30m",
                'red'            => "\033[31m",
                'green'          => "\033[32m",
                'yellow'         => "\033[33m",
                'blue'           => "\033[34m",
                'magenta'        => "\033[35m",
                'cyan'           => "\033[36m",
                'white'          => "\033[37m",
                'gray'           => "\033[90m",
                'light_red'      => "\033[91m",
                'light_green'    => "\033[92m",
                'light_yellow'   => "\033[93m",
                'light_blue'     => "\033[94m",
                'light_magenta'  => "\033[95m",
                'light_cyan'     => "\033[96m",
                'light_white'    => "\033[97m",
            ];

            return $colors[$name] ?? $colors['reset'];
        }
    }

    class Tilakaquicksign extends REST_Controller{
        
        public function __construct(){
            parent::__construct();
            $this->load->model("Modeltilaka","md");
        }

        public function headerlog(){
            echo PHP_EOL;
            echo color('cyan').str_pad("IDENTITY", 50).str_pad("USER IDENTIFIER", 42)."MESSAGE".PHP_EOL;
        }

        public function formatlog($identity, $useridentifier, $message, $colorIdentity = 'cyan', $colorUser = 'yellow', $colorMessage = 'white') {
            $identityWidth       = 50;
            $userIdentifierWidth = 42;

            // Ambil warna sesuai parameter
            $colorStartIdentity  = color($colorIdentity);
            $colorStartUser      = color($colorUser);
            $colorStartMessage   = color($colorMessage);
            $reset               = color('reset');

            // Susun log dengan padding dan warna
            $formatted  = $colorStartIdentity . str_pad($identity, $identityWidth) . $reset;
            $formatted .= $colorStartUser . str_pad($useridentifier, $userIdentifierWidth) . $reset;
            $formatted .= $colorStartMessage . $message . $reset;

            return $formatted . PHP_EOL;
        }

        private function fileExistsFlexible($path) {
            // Jika bentuknya URL
            if (filter_var($path, FILTER_VALIDATE_URL)) {
                // Cek header HTTP
                $headers = @get_headers($path);
                if (!$headers) return false;

                return (strpos($headers[0], '200') !== false);
            }

            // Jika bentuknya path lokal
            return file_exists($path);
        }

        function getFileSizeFlexible($path) {

            // Jika path adalah URL
            if (filter_var($path, FILTER_VALIDATE_URL)) {
                $ch = curl_init($path);
                curl_setopt($ch, CURLOPT_NOBODY, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_exec($ch);

                $filesize = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
                curl_close($ch);

                if ($filesize > 0) {
                    return $filesize; // bytes
                } else {
                    return 0; // tidak bisa baca size
                }
            }

            // Jika path lokal
            if (file_exists($path)) {
                return filesize($path);
            }

            return 0;
        }


        private function convertUrlToLocalPath($url){
            // Jika bukan URL, langsung kembalikan
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                return rtrim($url, '/') . '/';
            }

            // Hilangkan http:// atau https://
            $clean = preg_replace('/^https?:\/\//', '', $url);

            // Pisahkan domain dan path
            $parts = explode('/', $clean, 2);

            if (count($parts) < 2) {
                return false;
            }

            // Anda bisa sesuaikan base folder jika perlu
            return '/' . $parts[1];   // hasil: /webappsagus/berkasrawat/pages/upload/
        }

        private function uploadToAapanel($filename, $binary){
            $tmp = tempnam(sys_get_temp_dir(), 'pdf_');
            file_put_contents($tmp, $binary);

            $ch = curl_init("http://10.10.11.250/webappsagus/UploadAAPanel.php");

            curl_setopt($ch, CURLOPT_POST, true);

            curl_setopt($ch, CURLOPT_POSTFIELDS, [
                'file' => new CURLFile($tmp, 'application/pdf', $filename)
            ]);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            curl_close($ch);

            unlink($tmp);

            return json_decode($response, true);
        }


        function curlDownload($url){
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }

        public function uploadallfile_POST(){
            $this->headerlog();
            $result = $this->md->datalistuploadfile();

            if(!empty($result)){
                foreach($result as $a){
                    $statusColor              = "";
                    $statusMsg                = "";
                    $location                 = "";
                    $filesize                 = 0;
                    $bodycheckcertificate     = [];
                    $responsecheckcertificate = [];
                    $responseuploadfile       = [];

                    if($a->source_file==="DTECHNOLOGY"){
                        $location = FCPATH."assets/document/".$a->no_file.".pdf";
                    }else{
                        $location = PATHFILE_GET_TILAKA."/".$a->no_file.".pdf";
                    }

                    if($this->fileExistsFlexible($location)){
                        $filesize = $this->getFileSizeFlexible($location);
                        if($filesize!=0){
                            $bodycheckcertificate['user_identifier']=$a->useridentifier;
                            $responsecheckcertificate = Tilaka::checkcertificateuser(json_encode($bodycheckcertificate));

                            if(isset($responsecheckcertificate['success'])){
                                if($responsecheckcertificate['success']){
                                    if($responsecheckcertificate['status']===3){
                                        $responseuploadfile = Tilaka::uploadfile($location);
                                        if(isset($responseuploadfile['success'])){
                                            if($responseuploadfile['success']){
                                                $datasimpanhd['filename']        = $responseuploadfile['filename'];
                                                $datasimpanhd['user_identifier'] = $a->useridentifier;
                                                $datasimpanhd['status_sign']     = "1";
                                                $datasimpanhd['status_file']     = "1";
                                                $datasimpanhd['note']            = "";

                                                $statusColor = "green";
                                                $statusMsg   = $responseuploadfile['message']." | ".$responseuploadfile['filename'];
                                            }else{
                                                $datasimpanhd['note'] = $responseuploadfile['message'];

                                                $statusColor = "red";
                                                $statusMsg   = $responseuploadfile['message'];
                                            }
                                        }else{
                                            $statusColor = "red";
                                            $statusMsg   = "No Response From Tilaka Lite";
                                        }
                                    }else{
                                        $datasimpanhd['note'] = $responsecheckcertificate['message']['info']." | ".$responsecheckcertificate['data'][0]['status']." | ".$responsecheckcertificate['data'][0]['expiry_date'];

                                        $statusColor = "red";
                                        $statusMsg   = $responsecheckcertificate['message']['info']." | ".$responsecheckcertificate['data'][0]['status']." | ".$responsecheckcertificate['data'][0]['expiry_date'];
                                    }
                                }else{
                                    $datasimpanhd['note'] = $responsecheckcertificate['message']['info'];

                                    $statusColor = "red";
                                    $statusMsg   = $responsecheckcertificate['message']['info'];
                                }
                            }
                        }else{
                            $datasimpanhd['status_sign'] = "98";
                            $datasimpanhd['note']        = "File Corrupted, Size ".$filesize;

                            $statusColor = "red";
                            $statusMsg   = "File Corrupted, Size: ".$filesize;
                        }
                    }else{
                        $datasimpanhd['status_sign']     = "99";
                        $datasimpanhd['note']            = "File not found";
                        $datasimpanhd['status_file']     = "0";
                        $datasimpanhd['user_identifier'] = "";
                        $datasimpanhd['url']             = "";

                        $statusColor = "red";
                        $statusMsg   = "File not found | ".$location;
                    }


                    if(!empty($datasimpanhd)){
                        $this->md->updatefile($datasimpanhd, $a->no_file);
                    }

                    echo $this->formatlog($a->no_file.".pdf",$a->useridentifier,$statusMsg,'white','light_yellow',$statusColor);
                }
            }else{
                echo color('red')."Data Tidak Ditemukan";
            }
        }

        public function requestsignquicksign_POST(){
            $this->headerlog();
            $result = $this->md->listrequestsign();

            if(!empty($result)){
                foreach($result as $a){
                    $statusColor              = "";
                    $statusMsg                = "";
                    $requestid                = "";
                    $listfile                 = [];
                    $body                     = [];
                    $signatures               = [];
                    $bodycheckcertificate     = [];
                    $responsecheckcertificate = [];
                    $responserequestsign      = [];
                    $datasimpanhd             = [];

                    $requestid = generateuuid();
                    $locationspeciment = FCPATH."assets/speciment/".$a->org_id.".png";

                    if($this->fileExistsFlexible($locationspeciment)){
                        $signatures['email']           = $a->email;
                        $signatures['user_identifier'] = $a->user_identifier;
                        $signatures['signature_image'] = "data:image/png;base64,".base64_encode(file_get_contents($locationspeciment));

                        $body['request_id']   = $requestid;
                        $body['signatures'][] = $signatures;

                        $resultfilerequestsign = $this->md->filerequestsign($a->assign);
                        if(!empty($resultfilerequestsign)){
                            foreach($resultfilerequestsign as $files){
                                if($files->source_file==="DTECHNOLOGY"){
                                    $filename = FCPATH."assets/document/".$files->no_file.".pdf";
                                }else{
                                    $filename = PATHFILE_GET_TILAKA."/".$files->no_file.".pdf";
                                }

                                if($this->fileExistsFlexible($filename)){
                                    if(preg_match('/SIGNER(.*)/', $filename, $matches)){
                                        $position = "$".preg_replace('/\.pdf$/', '', $matches[1]);
                                        
                                        $pdfParse          = new Pdfparse($filename);
                                        $specimentposition = $pdfParse->findText($position);
        
                                        if(!empty($specimentposition['content'][$position])){ 
                                            $listpdf = [];
                                            foreach ($specimentposition['content'][$position] as $specimen) { 
                                                if (isset($specimen['x']) && isset($specimen['y']) && isset($specimen['page'])) {
                                                    $coordinatex = floatval($specimen['x']) - (floatval(WIDTH) / 2); 
                                                    $coordinatey = floatval($specimen['y']) - (floatval(HEIGHT) / 2); 
                                                    $page        = floatval($specimen['page']);
                                        
                                                    $listpdfsignatures['user_identifier'] = $a->user_identifier;
                                                    $listpdfsignatures['location']        = $files->orgname;
                                                    $listpdfsignatures['width']           = floatval(WIDTH);
                                                    $listpdfsignatures['height']          = floatval(HEIGHT);
                                                    $listpdfsignatures['coordinate_x']    = $coordinatex;
                                                    $listpdfsignatures['coordinate_y']    = $coordinatey;
                                                    $listpdfsignatures['page_number']     = $page;
                                                    $listpdfsignatures['qrcombine']       = "QRONLY";
                                        
                                                    if (CERTIFICATE === "PERSONAL") {
                                                        $listpdfsignatures['reason'] = "Signed on behalf of " . $files->orgname;
                                                    }
                                        
                                                    $listpdf['template_no']  = $files->assign;
                                                    $listpdf['filename']     = $files->filename;
                                                    $listpdf['signatures'][] = $listpdfsignatures;
                                                }
                                            }
                                        }
                                    }else{
                                        $listpdf     = [];
                                        $coordinatex = floatval(COORDINATE_X);
                                        $coordinatey = floatval(COORDINATE_Y);
                                        $page        = floatval(PAGE);
        
        
                                        $listpdfsignatures['user_identifier'] = $a->user_identifier;
                                        $listpdfsignatures['location']        = $files->orgname;
                                        $listpdfsignatures['width']           = floatval(WIDTH);
                                        $listpdfsignatures['height']          = floatval(HEIGHT);
                                        $listpdfsignatures['coordinate_x']    = $coordinatex;
                                        $listpdfsignatures['coordinate_y']    = $coordinatey;
                                        $listpdfsignatures['page_number']     = $page;
                                        $listpdfsignatures['qrcombine']       = "QRONLY";
                                        if(CERTIFICATE==="PERSONAL"){
                                            $listpdfsignatures['reason']       = "Signed on behalf of ".$files->orgname;
                                        }
                
                                        $listpdf['template_no']  = $files->assign;
                                        $listpdf['filename']     = $files->filename;
                                        $listpdf['signatures'][] = $listpdfsignatures;
                                    }

                                    $body['list_pdf'][]=$listpdf;

                                    $bodycheckcertificate['user_identifier']=$a->user_identifier;
                                    $responsecheckcertificate = Tilaka::checkcertificateuser(json_encode($bodycheckcertificate));

                                    if(isset($responsecheckcertificate['success'])){
                                        if($responsecheckcertificate['status']===3){
                                            $responserequestsign = Tilaka::requestsignquicksign(json_encode($body));
                                            if(isset($responserequestsign['success'])){
                                                if($responserequestsign['success']){
                                                    foreach($resultfilerequestsign as $files){
                                                        if($files->source_file==="DTECHNOLOGY"){
                                                            $filename = FCPATH."assets/document/".$files->no_file.".pdf";
                                                        }else{
                                                            $filename = PATHFILE_GET_TILAKA."/".$files->no_file.".pdf";
                                                        }

                                                        if($this->fileExistsFlexible($filename)){
                                                            $datasimpanhd['request_id']  = $requestid;

                                                            if($responserequestsign['auth_response'][0]['url']!=null){
                                                                $datasimpanhd['status_sign'] = "2";
                                                                $datasimpanhd['url']         = $responserequestsign['auth_response'][0]['url'];
                                                            }else{
                                                                $datasimpanhd['status_sign'] = "3";
                                                            }

                                                            $statusColor = "green";
                                                            $statusMsg   = $responserequestsign['message'];
                                                        }else{
                                                            $datasimpanhd['status_sign'] = "0";

                                                            $statusColor = "red";
                                                            $statusMsg   = "File : ".$files->no_file.".pdf Tidak Di Temukan Folder Penyimpanan";
                                                        }
                                                    }
                                                }else{
                                                    $datasimpanhd['note'] = $responserequestsign['message'];

                                                    $statusColor = "red";
                                                    $statusMsg   = $responserequestsign['message'];
                                                }
                                            }
                                        }else{
                                            $datasimpanhd['note'] = $responsecheckcertificate['message']['info']." | ".$responsecheckcertificate['data'][0]['status']." | ".$responsecheckcertificate['data'][0]['expiry_date'];

                                            $statusColor = "red";
                                            $statusMsg   = $responsecheckcertificate['message']['info']." | ".$responsecheckcertificate['data'][0]['status']." | ".$responsecheckcertificate['data'][0]['expiry_date'];
                                        }
                                    }
                                }else{
                                    $statusColor = "red";
                                    $statusMsg   = "File : ".$files->no_file.".pdf Tidak Di Temukan Folder Penyimpanan";
                                }

                                if(!empty($datasimpanhd)){
                                    $this->md->updatefile($datasimpanhd, $files->no_file);
                                }
                            }
                        }else{
                            $statusColor = "red";
                            $statusMsg   = "Rincian File Tidak Di Temukan Dalam Data";
                        }
                    }else{
                        $statusColor = "red";
                        $statusMsg   = "Speciment Tidak Ditemukan";
                    }

                    

                    echo $this->formatlog($requestid,$a->user_identifier,$statusMsg,'white','light_yellow',$statusColor);
                }
            }else{
                echo color('red')."Data Tidak Ditemukan";
            }
        }

        // public function statussignquicksign_POST(){
        //     $this->headerlog();
        //     $result = $this->md->listdownload();

        //     if(!empty($result)){
        //         foreach($result as $a){
        //             $statusColor = "";
        //             $statusMsg   = "";
        //             $responseall = [];
        //             $response    = [];
        //             $body        = [];
        //             $response    = [];

        //             $body['request_id'] = $a->request_id;
        //             $response = Tilaka::excutesignstatus(json_encode($body));

        //             if(isset($response['success'])){
        //                 if($response['success']){
        //                     if($response['message']==="DONE"){
        //                         foreach($response['list_pdf'] as $listpdfs){
        //                             $data        = [];

                                    
        //                             $nofile      = preg_match('/_(.*?)\.pdf$/', $listpdfs['filename'], $matches) ? $matches[1] : '';
        //                             $fileContent = file_get_contents(htmlspecialchars_decode($listpdfs['presigned_url']));

        //                             if($fileContent!==false){
        //                                 if($a->source_file==="DTECHNOLOGY"){
        //                                     $destinationPath = FCPATH."/assets/document/".$nofile.".pdf";
        //                                 }else{
        //                                     $destinationPath = FCPATH.PATHFILE_POST_TILAKA.$nofile.".pdf";
        //                                 }

        //                                 if(file_put_contents($destinationPath,$fileContent)){
        //                                     $data['STATUS_SIGN'] = "5";
        //                                     $data['NOTE']        = "";
        //                                     $data['LINK']        = $listpdfs['presigned_url'];
                                            
        //                                     $this->md->updatefile($data,$nofile);

        //                                     $statusColor = "green";
        //                                     $statusMsg   = $response['message'];
        //                                 }else{
        //                                     $statusColor = "red";
        //                                     $statusMsg   = "Content Tidak Berhasil Di Simpan";
        //                                 }
        //                             }else{
        //                                 $statusColor = "red";
        //                                 $statusMsg   = "Content Tidak Di Temukan";
        //                             }
        //                         }
        //                     }

        //                     if($response['message']==="FAILED"){
        //                         foreach($response['list_pdf'] as $listpdfs){
        //                             $data        = [];
        //                             $nofile      = preg_match('/_(.*?)\.pdf$/', $listpdfs['filename'], $matches) ? $matches[1] : '';
                                    
        //                             $data['STATUS_SIGN']     = "99";
        //                             $data['STATUS_FILE']     = "1";
        //                             $data['REQUEST_ID']      = "";
        //                             $data['LINK']            = "";
        //                             $data['NOTE']            = $response['message'];
        //                             $data['USER_IDENTIFIER'] = "";
        //                             $data['URL']             = "";

        //                             $this->md->updatefile($data,$nofile);

        //                             $statusColor = "red";
        //                             $statusMsg   = $response['message'];
        //                         }
        //                     }

        //                     if($response['message']==="PROCESS"){
        //                         foreach($response['list_pdf'] as $listpdfs){
        //                             $statusColor = "yellow";
        //                             $statusMsg   = $response['message'];
        //                         }
                                
        //                     }

        //                     if($response['message']==="PARAMERR"){
        //                         foreach($response['list_pdf'] as $listpdfs){
        //                             $statusColor = "yellow";
        //                             $statusMsg   = $response['message'];
        //                         }
        //                     }
        //                 }
        //             }

        //             echo $this->formatlog($a->request_id,$a->user_identifier,$statusMsg,'white','light_yellow',$statusColor);
        //         }
        //     }else{
        //         echo color('red')."Data Tidak Ditemukan";
        //     }
        // }

        public function statussignquicksign_POST()
{
    $this->headerlog();
    $result = $this->md->listdownload();

    if (empty($result)) {
        echo color('red') . "Data Tidak Ditemukan";
        return;
    }

    foreach ($result as $a) {

        $body['request_id'] = $a->request_id;
        $response = Tilaka::excutesignstatus(json_encode($body));

        if (!isset($response['success']) || !$response['success']) {
            echo $this->formatlog($a->request_id, $a->user_identifier, "Invalid Response",
                'white','light_yellow','red');
            continue;
        }

        $message = $response['message'];

        /* ======================
         *      STATUS DONE
         * ====================== */
        if ($message === "DONE") {

            foreach ($response['list_pdf'] as $listpdfs) {

                $url = htmlspecialchars_decode($listpdfs['presigned_url']);

                $mainName = pathinfo($listpdfs['filename'], PATHINFO_FILENAME);

                if (preg_match('/_(\d+)$/', $mainName, $m)) {
                    $nofile = $m[1];
                } else {
                    $nofile = $mainName;
                }

                // Download PDF
                $fileContent = $this->curlDownload($url);

                if (!$fileContent) {
                    echo $this->formatlog($a->request_id, $a->user_identifier,
                        "Gagal download file",'white','light_yellow','red');
                    continue;
                }

                /* ======================================
                 *   PENYIMPANAN
                 * ====================================== */

                if ($a->source_file === "DTECHNOLOGY") {

                    // Simpan di root aplikasi 10.10.11.66
                    $destinationPath = FCPATH . "assets/document/" . $nofile . ".pdf";
                    file_put_contents($destinationPath, $fileContent);

                } else {

                    // Upload ke server aapanel 10.10.11.250
                    $upload = $this->uploadToAapanel($nofile . ".pdf", $fileContent);

                    if (!$upload || !$upload['success']) {
                        echo $this->formatlog($a->request_id, $a->user_identifier,
                            "Upload ke aapanel gagal",'white','light_yellow','red');
                        continue;
                    }

                    $destinationPath = PATHFILE_POST_TILAKA . $nofile . ".pdf";
                }

                // Update DB
                $data['STATUS_SIGN'] = "5";
                $data['NOTE']        = "";
                $data['LINK']        = $destinationPath;

                $this->md->updatefile($data, $nofile);

                echo $this->formatlog($a->request_id, $a->user_identifier,
                    "DONE | " . $destinationPath,'white','light_yellow','green');
            }
        }

        /* ======================
         *      STATUS FAILED
         * ====================== */
        if ($message === "FAILED") {

            foreach ($response['list_pdf'] as $listpdfs) {

                $mainName = pathinfo($listpdfs['filename'], PATHINFO_FILENAME);

                if (preg_match('/_(\d+)$/', $mainName, $m)) {
                    $nofile = $m[1];
                } else {
                    $nofile = $mainName;
                }

                $data = [
                    'STATUS_SIGN'     => "99",
                    'STATUS_FILE'     => "1",
                    'REQUEST_ID'      => "",
                    'LINK'            => "",
                    'NOTE'            => $message,
                    'USER_IDENTIFIER' => "",
                    'URL'             => ""
                ];

                $this->md->updatefile($data, $nofile);

                echo $this->formatlog($a->request_id, $a->user_identifier,
                    "FAILED",'white','light_yellow','red');
            }
        }

        /* ====================== */
        if ($message === "PROCESS") {
            echo $this->formatlog($a->request_id,$a->user_identifier,"PROCESS",
                'white','light_yellow','yellow');
        }

        if ($message === "PARAMERR") {
            echo $this->formatlog($a->request_id,$a->user_identifier,"PARAMERR",
                'white','light_yellow','yellow');
        }
    }
}




    }

?>