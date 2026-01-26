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

    class TilakaquicksignV2 extends REST_Controller{
        
        public function __construct(){
            parent::__construct();
            $this->load->model("ModeltilakaV2","md");
            headerlog();
        }

        public function auth_GET(){
            $response = Tilaka::oauth();
            $this->response($response,REST_Controller::HTTP_OK);
        }

        public function uploadfile_POST(){
            $resultlistuploadfile = $this->md->listuploadfile();

            if(empty($resultlistuploadfile)){
                echo color('red')."Data Tidak Ditemukan";
                return;
            }

            foreach($resultlistuploadfile as $a){
                $statusColor    = "";
                $statusMsg      = "";
                $filelocation   = "";
                $useridentifier = $a->useridentifiers;
                $datasimpanhd   = [];
                    
                $filelocation = ($a->source_file==="DTECHNOLOGY") ? FCPATH."assets/document/".$a->no_file.".pdf" : PATHFILE_GET_TILAKA."/".$a->no_file.".pdf";

                if(fileExists($filelocation)===false){
                    $statusColor = "red";
                    $statusMsg   = "File not found";

                    $datasimpanhd['status_sign']     = "99";
                    $datasimpanhd['note']            = "File not found";
                    $datasimpanhd['status_file']     = "0";
                    $datasimpanhd['user_identifier'] = null;
                    $datasimpanhd['link']            = null;
                    $datasimpanhd['url']             = null;
                    $datasimpanhd['request_id']      = null;

                    if($this->md->updatetransaksi($datasimpanhd,"0",$a->no_file)){
                        echo formatlog($a->no_file.".pdf",$useridentifier,$statusMsg,'white','light_yellow',$statusColor);
                    }else{
                        echo formatlog($a->no_file.".pdf",$useridentifier,$statusMsg." [ Gagal Update Data ]",'white','light_yellow',$statusColor);
                    }
                    continue;
                }

                if(getFileSize($filelocation)===0){
                    $statusColor = "red";
                    $statusMsg   = "File Corrupted, Size: ".$filesize;

                    $datasimpanhd['status_sign']     = "98";
                    $datasimpanhd['note']            = "File Corrupted, Size ".$filesize;
                    $datasimpanhd['status_file']     = "0";
                    $datasimpanhd['user_identifier'] = null;
                    $datasimpanhd['link']            = null;
                    $datasimpanhd['url']             = null;
                    $datasimpanhd['request_id']      = null;
                    
                    if($this->md->updatetransaksi($datasimpanhd,"0",$a->no_file)){
                        echo formatlog($a->no_file.".pdf",$useridentifier,$statusMsg,'white','light_yellow',$statusColor);
                    }else{
                        echo formatlog($a->no_file.".pdf",$useridentifier,$statusMsg." [ Gagal Update Data ]",'white','light_yellow',$statusColor);
                    }
                    continue;
                }

                $responseuploadfile = Tilaka::uploadfile($filelocation);

                if(!isset($responseuploadfile['success'])){
                    $statusColor = "red";
                    $statusMsg   = "No Response From Tilaka Lite";
                    continue;
                }

                if($responseuploadfile['success']===false){
                    $statusColor = "red";
                    $statusMsg   = $responseuploadfile['message'];

                    $datasimpanhd['status_sign']     = "0";
                    $datasimpanhd['note']            = $responseuploadfile['message'];
                    $datasimpanhd['status_file']     = "1";
                    $datasimpanhd['user_identifier'] = null;
                    $datasimpanhd['link']            = null;
                    $datasimpanhd['url']             = null;
                    $datasimpanhd['request_id']      = null;
                    
                    if($this->md->updatetransaksi($datasimpanhd,"0",$a->no_file)){
                        echo formatlog($a->no_file.".pdf",$useridentifier,$statusMsg,'white','light_yellow',$statusColor);
                    }else{
                        echo formatlog($a->no_file.".pdf",$useridentifier,$statusMsg." [ Gagal Update Data ]",'white','light_yellow',$statusColor);
                    }
                    continue;
                }

                $datasimpanhd['filename']        = $responseuploadfile['filename'];
                $datasimpanhd['user_identifier'] = $useridentifier;
                $datasimpanhd['status_sign']     = "1";
                $datasimpanhd['status_file']     = "1";
                $datasimpanhd['link']            = null;
                $datasimpanhd['url']             = null;
                $datasimpanhd['request_id']      = null;
                $datasimpanhd['note']            = null;

                $statusColor = "green";
                $statusMsg   = $responseuploadfile['message'];

                if($this->md->updatetransaksi($datasimpanhd,"0",$a->no_file)){
                    echo formatlog($a->no_file.".pdf",$useridentifier,$statusMsg,'white','light_yellow',$statusColor);
                }else{
                    echo formatlog($a->no_file.".pdf",$useridentifier,$statusMsg." [ Gagal Update Data ]",'white','light_yellow',$statusColor);
                }
            }

        }
        
        public function requestsign_POST(){
            $resultlistrequestsign = $this->md->listrequestsign();

            if(empty($resultlistrequestsign)){
                echo color('red')."Data Tidak Ditemukan";
                return;
            }

            foreach($resultlistrequestsign as $a){
                $statusColor    = "";
                $statusMsg      = "";
                $filelocation   = "";
                $requestid      = generateuuid();
                $rawImages      = [];
                $body           = [];
                $signatureslist = [];
                $listpdf        = [];

                $assignArr = array_values(array_filter(explode(';', $a->assign)));
                $uidArr    = array_values(array_filter(explode(';', $a->user_identifier)));
                $nameArr   = array_values(array_filter(explode(';', $a->names)));
                $emailArr  = array_values(array_filter(explode(';', $a->email)));

                if(SIGNATUREIMAGES === "DEFAULT"){
                    $locationspeciment = FCPATH."assets/speciment/".$a->org_id.".png";

                    if(fileExists($locationspeciment)===false){
                        echo color('red')."Speciment Tidak Ditemukan";
                        return;
                    }

                    $rawImages[] = base64_encode(file_get_contents($locationspeciment));
                }else{
                    $logo = FCPATH."assets/images/clients/".$a->org_id.".png";
                    if(fileExists($logo)===false){
                        echo color('red')."Logo Client Tidak Di Temukan";
                        return;
                    }

                    foreach ($assignArr as $i => $nik){
                        $userIdentifier = $uidArr[$i];
                        $name           = $nameArr[$i];

                        $text        = "Dokumen telah ditandatangani elektronik oleh ".$name." (ID: ".$userIdentifier.") "."Created Date: ".$a->tgljam;
                        $rawImages[] = getQRCode($text, $logo);
                    }
                }

                $filelocation = ($a->source_file==="DTECHNOLOGY") ? FCPATH."assets/document/".$a->no_file.".pdf" : PATHFILE_GET_TILAKA."/".$a->no_file.".pdf";

                if(fileExists($filelocation)===false){
                    $statusColor = "red";
                    $statusMsg   = "File not found";

                    $datasimpanhd['status_sign']     = "99";
                    $datasimpanhd['note']            = "File not found";
                    $datasimpanhd['status_file']     = "0";
                    $datasimpanhd['user_identifier'] = null;
                    $datasimpanhd['link']            = null;
                    $datasimpanhd['url']             = null;
                    $datasimpanhd['request_id']      = null;

                    if($this->md->updatetransaksi($datasimpanhd,"0",$a->no_file)){
                        echo formatlog($a->no_file.".pdf",$useridentifier,$statusMsg,'white','light_yellow',$statusColor);
                    }else{
                        echo formatlog($a->no_file.".pdf",$useridentifier,$statusMsg." [ Gagal Update Data ]",'white','light_yellow',$statusColor);
                    }
                    continue;
                }

                if(getFileSize($filelocation)===0){
                    $statusColor = "red";
                    $statusMsg   = "File Corrupted, Size: ".$filesize;

                    $datasimpanhd['status_sign']     = "98";
                    $datasimpanhd['note']            = "File Corrupted, Size ".$filesize;
                    $datasimpanhd['status_file']     = "0";
                    $datasimpanhd['user_identifier'] = null;
                    $datasimpanhd['link']            = null;
                    $datasimpanhd['url']             = null;
                    $datasimpanhd['request_id']      = null;
                    
                    if($this->md->updatetransaksi($datasimpanhd,"0",$a->no_file)){
                        echo formatlog($a->no_file.".pdf",$useridentifier,$statusMsg,'white','light_yellow',$statusColor);
                    }else{
                        echo formatlog($a->no_file.".pdf",$useridentifier,$statusMsg." [ Gagal Update Data ]",'white','light_yellow',$statusColor);
                    }
                    continue;
                }

                $body['request_id'] = $requestid;

                foreach ($assignArr as $i => $nik){
                    $userIdentifier = $uidArr[$i];
                    $name           = $nameArr[$i];
                    $email          = $emailArr[$i];

                    $signatureslist['email']           = $email;
                    $signatureslist['user_identifier'] = $userIdentifier;
                    $signatureslist['sequence']        = $i+1;
                    if(SIGNATUREIMAGES === "DEFAULT"){
                        $signatureslist['signature_image'] = "data:image/png;base64,".$rawImages[0];
                    }else{
                        $signatureslist['signature_image'] = "data:image/png;base64,".$rawImages[$i];
                    }
                    
                    
                    $body['signatures'][]=$signatureslist;
                }

                $pdfParse         = new Pdfparse($filelocation);
                $lastcoordinate_x = floatval(COORDINATE_X);
                
                foreach ($assignArr as $i => $nik){
                    $listsignatures    = [];
                    $userIdentifier    = $uidArr[$i];
                    $position          = '$'.$i;
                    $specimentposition = $pdfParse->findText($position);


                    if(POSITIONSIGN==="FIXED"){
                        $signatureslist = [];

                        $signatureslist['user_identifier'] = $userIdentifier;
                        $signatureslist['location']        = $a->orgname;
                        $signatureslist['width']           = floatval(WIDTH);
                        $signatureslist['height']          = floatval(HEIGHT);
                        $signatureslist['coordinate_x']    = $lastcoordinate_x;
                        $signatureslist['coordinate_y']    = floatval(COORDINATE_Y);
                        $signatureslist['page_number']     = floatval(PAGE);
                        if (CERTIFICATE === "PERSONAL") {
                            $signatureslist['reason'] = "Signed on behalf of " . $a->orgname;
                        }

                        $listsignatures[] = $signatureslist;

                        $lastcoordinate_x = $lastcoordinate_x+floatval(WIDTH)+10;
                    }else{
                        if(!empty($specimentposition['content'][$position])){
                            foreach($specimentposition['content'][$position] as $specimen){
                                $signatureslist = [];
                                if(isset($specimen['x'],$specimen['y'],$specimen['page'])){
                                    $signatureslist['user_identifier'] = $userIdentifier;
                                    $signatureslist['location']        = $a->orgname;
                                    $signatureslist['width']           = floatval(WIDTH);
                                    $signatureslist['height']          = floatval(HEIGHT);
                                    $signatureslist['coordinate_x']    = floatval($specimen['x']) - (floatval(WIDTH)/2);
                                    $signatureslist['coordinate_y']    = floatval($specimen['y']) - (floatval(HEIGHT)/2);
                                    $signatureslist['page_number']     = floatval($specimen['page']);
                                    if (CERTIFICATE === "PERSONAL") {
                                        $signatureslist['reason'] = "Signed on behalf of " . $a->orgname;
                                    }
                                }

                                $listsignatures[] = $signatureslist;
                            }
                        }else{
                            $signatureslist = [];

                            $signatureslist['user_identifier'] = $userIdentifier;
                            $signatureslist['location']        = $a->orgname;
                            $signatureslist['width']           = floatval(WIDTH);
                            $signatureslist['height']          = floatval(HEIGHT);
                            $signatureslist['coordinate_x']    = floatval(COORDINATE_X);
                            $signatureslist['coordinate_y']    = floatval(COORDINATE_Y);
                            $signatureslist['page_number']     = floatval(PAGE);
                            if (CERTIFICATE === "PERSONAL") {
                                $signatureslist['reason'] = "Signed on behalf of " . $a->orgname;
                            }

                            $listsignatures[] = $signatureslist;
                        }
                    }
                    
                    

                    $listpdf['filename']    = $a->filename;
                    $listpdf['template_no'] = $nik;
                    $listpdf['signatures']  = $listsignatures;
                    $body['list_pdf'][]     = $listpdf;
                }

                // $this->response($body);
                $pdfParse->cleanup();
                $responserequestsign = Tilaka::requestsignquicksign(json_encode($body));
                
                if(!isset($responserequestsign['success'])){
                    $statusColor = "red";
                    $statusMsg   = "No Response From Tilaka Lite";
                    continue;
                }

                if($responserequestsign['success']===false){
                    $statusColor = "red";
                    $statusMsg   = $responserequestsign['message'];

                    $datasimpanhd['status_sign']     = "97";
                    $datasimpanhd['note']            = $responserequestsign['message'];
                    $datasimpanhd['status_file']     = "1";
                    $datasimpanhd['user_identifier'] = null;
                    $datasimpanhd['link']            = null;
                    $datasimpanhd['url']             = null;
                    $datasimpanhd['request_id']      = null;
                    
                    if($this->md->updatetransaksi($datasimpanhd,"1",$a->no_file)){
                        echo formatlog($a->no_file.".pdf",$a->user_identifier,$statusMsg,'white','light_yellow',$statusColor);
                    }else{
                        echo formatlog($a->no_file.".pdf",$a->user_identifier,$statusMsg." [ Gagal Update Data ]",'white','light_yellow',$statusColor);
                    }
                    continue;
                }

                $datasimpanhd['request_id']  = $requestid;
                if($responserequestsign['auth_response'][0]['url']!=null){
                    $datasimpanhd['status_sign'] = "2";
                    $datasimpanhd['url']         = $responserequestsign['auth_response'][0]['url'];
                }else{
                    $datasimpanhd['status_sign'] = "3";
                }

                $statusColor = "green";
                $statusMsg   = $responserequestsign['message'];

                if($this->md->updatetransaksi($datasimpanhd,"1",$a->no_file)){
                    echo formatlog($a->no_file.".pdf",$userIdentifier,$statusMsg,'white','light_yellow',$statusColor);
                }else{
                    echo formatlog($a->no_file.".pdf",$userIdentifier,$statusMsg." [ Gagal Update Data ]",'white','light_yellow',$statusColor);
                }
            }
        }

        public function statussign_POST(){
            $resultlistdownload = $this->md->listdownload();

            if(empty($resultlistdownload)){
                echo color('red')."Data Tidak Ditemukan";
                return;
            }

            foreach($resultlistdownload as $a){
                $statusColor = "";
                $statusMsg   = "";
                $body        = [];
                $response    = [];

                $body['request_id'] = $a->request_id;
                $response = Tilaka::excutesignstatus(json_encode($body));
                // $this->response($response);

                if(!isset($response['success'])){
                    $statusColor = "red";
                    $statusMsg   = "No Response From Tilaka Lite";
                    continue;
                }

                if($response['success']===false){
                    $statusColor = "red";
                    $statusMsg   = $response['message'];

                    echo formatlog($a->request_id,$a->user_identifier,$statusMsg,'white','light_yellow',$statusColor);
                    continue;
                }

                if($response['success']===true && $response['message']==="FAILED"){

                    $statusColor = "red";
                    $statusMsg   = $response['message'];

                    $datasimpanhd['status_sign']     = "99";
                    $datasimpanhd['note']            = $response['message'];
                    $datasimpanhd['status_file']     = "1";
                    $datasimpanhd['user_identifier'] = null;
                    $datasimpanhd['link']            = null;
                    $datasimpanhd['url']             = null;
                    $datasimpanhd['request_id']      = null;

                    if($this->md->updatetransaksirequestid($datasimpanhd,$a->request_id)){
                        echo formatlog($a->request_id,$a->user_identifier,$statusMsg,'white','light_yellow',$statusColor);
                    }else{
                        echo formatlog($a->request_id,$a->user_identifier,$statusMsg." [ Gagal Update Data ]",'white','light_yellow',$statusColor);
                    }
                    continue;
                }

                if($response['success']===true && ($response['message']==="PROCESS"||$response['message']==="PARAMERR")){

                    $statusColor = "yellow";
                    $statusMsg   = $response['message'];

                    $datasimpanhd['note'] = $response['message'];

                    if($this->md->updatetransaksirequestid($datasimpanhd,$a->request_id)){
                        echo formatlog($a->request_id,$a->user_identifier,$statusMsg,'white','light_yellow',$statusColor);
                    }else{
                        echo formatlog($a->request_id,$a->user_identifier,$statusMsg." [ Gagal Update Data ]",'white','light_yellow',$statusColor);
                    }

                    continue;
                }

                if($response['success']===true && $response['message']==="DONE"){
                    if($response['list_pdf'][0]['error']===false){
                        $url         = htmlspecialchars_decode($response['list_pdf'][0]['presigned_url']);
                        $fileContent = curlDownload($url);
                        $mainName    = pathinfo($response['list_pdf'][0]['presigned_url'], PATHINFO_FILENAME);

                        if(strpos($mainName, "_") !== false){
                            $nofile = substr($mainName, strpos($mainName, "_") + 1);
                        }else{
                            $nofile = $mainName;
                        }

                        if($fileContent===false){
                            $statusColor = "red";
                            $statusMsg   = "Gagal Download Content Tidak Di Temukan";

                            echo formatlog($a->request_id,$a->user_identifier,$statusMsg,'white','light_yellow',$statusColor);
                            continue;
                        }

                        if($a->source_file === "DTECHNOLOGY"){
                            $destinationPath = FCPATH."assets/document/".$nofile . ".pdf";
                            $save            = file_put_contents($destinationPath, $fileContent);

                            if ($save === false) {
                                echo formatlog($a->request_id, $a->user_identifier, "Gagal menyimpan file di lokal", 'white','light_yellow','red');
                                continue;
                            }
                        }else{
                            if(TYPE_STORAGE==="LOCAL"){
                                $destinationPath = FCPATH.PATHFILE_POST_TILAKA.$nofile.".pdf";
                                $save            = file_put_contents($destinationPath, $fileContent);
                                echo 'x';
                                if ($save === false) {
                                    echo formatlog($a->request_id, $a->user_identifier, "Gagal menyimpan file di lokal", 'white','light_yellow','red');
                                    continue;
                                }
                            }

                            if(TYPE_STORAGE==="AAPANEL"){
                                $upload = uploadToAapanel($nofile.".pdf",$fileContent);

                                if (!$upload || !$upload['success']) {
                                    echo formatlog($a->request_id, $a->user_identifier, "Upload ke AAPanel gagal", 'white','light_yellow','red');
                                    continue;
                                }

                                $destinationPath = PATHFILE_POST_TILAKA . $nofile . ".pdf";
                            }
                        }

                        $statusColor = "green";
                        $statusMsg   = $response['message']." | " . $destinationPath;

                        $datasimpanhd['status_sign']     = "5";
                        $datasimpanhd['note']            = null;
                        $datasimpanhd['status_file']     = "1";
                        $datasimpanhd['link']            = null;
                        $datasimpanhd['url']             = $url;

                        return var_dump($datasimpanhd);

                        if($this->md->updatetransaksirequestid($datasimpanhd,$a->request_id)){
                            echo formatlog($a->request_id,$a->user_identifier,$statusMsg,'white','light_yellow',$statusColor);
                        }else{
                            echo formatlog($a->request_id,$a->user_identifier,$statusMsg." [ Gagal Update Data ]",'white','light_yellow',$statusColor);
                        }
                        continue;
                    }
                }


            }
        }

    }
?>