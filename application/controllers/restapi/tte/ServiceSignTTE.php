<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    require FCPATH . 'vendor/autoload.php';

    use Restserver\Libraries\REST_Controller;

    require APPPATH . '/libraries/REST_Controller.php';

    include FCPATH . "assets/vendors/phpqrcode/qrlib.php";
    include FCPATH . "assets/vendors/pdfparse/Pdfparse.php";
    

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

    class ServiceSignTTE extends REST_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->model("ModelServiceSignTTE","md");
            headerlog();
        }

        public function uploadfile_POST(){
            $resultuploaddocument = $this->md->uploaddocument();

            if(empty($resultuploaddocument)){
                echo color('red')."Data Tidak Ditemukan";
                return;
            }

            foreach($resultuploaddocument as $a){
                $responseuploadfile = [];
                $datasimpanhd       = [];
                $statusColor        = "";
                $statusMsg          = "";
                $storage            = "";
                $filedirectory      = "";

                if($a->from_in!="Dtechnology"){
                    $resultcheckduplicate = $this->md->checkduplicate($a->no_file);
                    if($resultcheckduplicate->jml > 1){
                        $statusColor = "red";
                        $statusMsg   = "Duplicate No File";

                        $datasimpanhd['status_sign']      = "95";
                        $datasimpanhd['quick_sign']       = "0";
                        $datasimpanhd['response']         = $statusMsg;
                        $datasimpanhd['storage_in']       = null;
                        $datasimpanhd['storage_out']      = null;
                        $datasimpanhd['filename']         = null;
                        $datasimpanhd['signature_type']   = null;
                        $datasimpanhd['signature_field']  = null;
                        $datasimpanhd['request_id']       = null;
                        $datasimpanhd['user_identifier']  = null;
                        $datasimpanhd['link']             = null;
                        $datasimpanhd['upload_date']      = null;
                        $datasimpanhd['requestsign_date'] = null;
                        $datasimpanhd['download_date']    = null;
                        $this->md->updatedocument($datasimpanhd,$a->transaksi_id);

                        echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                        continue;
                    }
                };

                if($a->storage_in===null){
                    if(TYPESTORAGE===null){
                        $statusColor = "red";
                        $statusMsg   = "File Directory Not Found";

                        echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                        continue;
                    }
                    $storage = TYPESTORAGE;
                }else{
                    $storage = $a->storage_in;
                }

                if($a->from_in==="Dtechnology"){
                    $filedirectory = $storage.$a->transaksi_id.".pdf";
                }else{
                    $filedirectory = $storage.$a->no_file.".pdf";
                }

                if($a->useridentifier===null || $a->useridentifier===""){
                    $statusColor = "red";
                    $statusMsg   = "User Identifier Tidak Ada";

                    $datasimpanhd['status_sign'] = "96";
                    $datasimpanhd['response']    = "User Identifier Tidak Ada";
                    $datasimpanhd['storage_in']  = $storage;
                    $this->md->updatedocument($datasimpanhd,$a->transaksi_id);

                    echo formatlog($a->transaksi_id,'',$statusMsg,'white','green',$statusColor);
                    continue;
                }

                if(!fileExists($filedirectory)['status']){
                    $statusColor = "red";
                    $statusMsg   = fileExists($filedirectory)['message'];

                    $datasimpanhd['status_sign'] = "99";
                    $datasimpanhd['response']    = $statusMsg;
                    $datasimpanhd['storage_in']  = $storage;
                    $this->md->updatedocument($datasimpanhd,$a->transaksi_id);

                    echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                    continue;
                }

                if(getFileSize($filedirectory)===0){
                    $statusColor = "red";
                    $statusMsg   = "File Corrupted";

                    $datasimpanhd['status_sign'] = "98";
                    $datasimpanhd['note']        = "File Corrupted";
                    $datasimpanhd['storage_in']  = $storage;
                    $this->md->updatedocument($datasimpanhd,$a->transaksi_id);
                    
                    echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                    continue;
                }

                $responseuploadfile = TilakaPlus::uploadfile($filedirectory);

                if(!isset($responseuploadfile['success'])){
                    if($responseuploadfile['status']===false){
                        $statusColor = "red";
                        $statusMsg   = $responseuploadfile['message'];

                        echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                        continue;
                    }else{
                        $statusColor = "red";
                        $statusMsg   = $responseuploadfile['error']." [ ".$responseuploadfile['path']." ]";

                        echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                        continue;
                    }
                }

                

                if($responseuploadfile['success']===false){
                    $statusColor = "red";
                    $statusMsg   = $responseuploadfile['message'];

                    echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                    continue;
                }

                $statusColor = "green";
                $statusMsg   = $responseuploadfile['message'];

                $datasimpanhd['status_sign']     = "1";
                $datasimpanhd['quick_sign']      = "0";
                $datasimpanhd['user_identifier'] = $a->useridentifier;
                $datasimpanhd['filename']        = $responseuploadfile['filename'];
                $datasimpanhd['response']        = $responseuploadfile['message'];
                $datasimpanhd['storage_in']      = $storage;
                $datasimpanhd['upload_date']     = date('Y-m-d H:i:s');
                if($a->type_of===null){
                    $datasimpanhd['type_of'] = TYPEOF;
                }
                if($a->signature_type===null){
                    $datasimpanhd['signature_type'] = TYPESIGNATURE;
                }
                if($a->type_certificate===null){
                    $datasimpanhd['type_certificate'] = TYPECERTIFICATE;
                }
                $signatureType = $a->signature_type ?? TYPESIGNATURE;
                if ($a->signature_field === null) {
                    if ($signatureType === "Default") {
                        $datasimpanhd['signature_field'] = SIGNATUREFIELD;
                    } elseif ($signatureType === "Custom") {
                        $datasimpanhd['signature_field'] = "Dokumen telah ditandatangani elektronik oleh " . $a->name . " (ID: " . $a->useridentifier . ") " . "Created Date: " . $a->createddate." Ref : ".$a->transaksi_id;
                    }
                }

                $datasimpanhd['request_id']       = null;
                $datasimpanhd['link']             = null;
                $datasimpanhd['storage_out']      = null;
                $datasimpanhd['requestsign_date'] = null;
                $datasimpanhd['download_date']    = null;
                
                $this->md->updatedocument($datasimpanhd,$a->transaksi_id);
                echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                continue;
            }
        }

        public function requestquicksign_POST(){
            $resultrequestsign = $this->md->requestquicksign();

            if(empty($resultrequestsign)){
                echo color('red')."Data Tidak Ditemukan";
                return;
            }

            foreach($resultrequestsign as $a){
                $responserequestsignquicksign = [];
                $rawImages                    = [];
                $assignArr                    = [];
                $uidArr                       = [];
                $nameArr                      = [];
                $emailArr                     = [];
                $body                         = [];
                $statusColor                  = "";
                $statusMsg                    = "";
                $filedirectory                = "";
                $mainName                     = "";

                $requestid     = generateuuid();
                $assignArr     = array_values(array_filter(explode(';',$a->signer_id)));
                $uidArr        = array_values(array_filter(explode(';',$a->useridentifier)));
                $nameArr       = array_values(array_filter(explode(';',$a->name)));
                $emailArr      = array_values(array_filter(explode(';',$a->email)));

                if($a->from_in==="Dtechnology"){
                    $filedirectory = $a->storage_in.$a->transaksi_id.".pdf";
                    $mainName      = $a->transaksi_id.".pdf";
                }else{
                    $filedirectory = $a->storage_in.$a->no_file.".pdf";
                    $mainName      = $a->no_file.".pdf";
                }
                
                if($a->signature_type === "Default" || $a->signature_type === "Custom"){
                    $logo = FCPATH."assets/images/clients/".$a->org_id.".png";

                    if(!fileExists($logo)['status']){
                        $statusColor = "red";
                        $statusMsg   = "Logo Client Tidak Di Temukan";

                        echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                        return;
                    }

                    foreach ($assignArr as $i => $nik){
                        $userIdentifier = $uidArr[$i];
                        $name           = $nameArr[$i];
                        $rawImages[]    = getQRCode($a->signature_field, $logo);
                    }
                    
                }

                if(!fileExists($filedirectory)['status']){
                    $statusColor = "red";
                    $statusMsg   = fileExists($filedirectory)['message'];

                    $datasimpanhd['status_sign'] = "99";
                    $datasimpanhd['response']    = $statusMsg;
                    $this->md->updatedocument($datasimpanhd,$a->transaksi_id);

                    echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                    continue;
                }

                if(getFileSize($filedirectory)===0){
                    $statusColor = "red";
                    $statusMsg   = "File Corrupted";

                    $datasimpanhd['status_sign'] = "98";
                    $datasimpanhd['note']        = "File Corrupted";
                    $this->md->updatedocument($datasimpanhd,$a->transaksi_id);
                    
                    echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                    continue;
                }

                $lastcoordinate_x = floatval(COORDINATE_X);

                foreach ($assignArr as $i => $nik){
                    $listsignatures = [];
                    $signatures     = [];
                    $signatureslist = [];

                    $userIdentifier = $uidArr[$i];
                    $name           = $nameArr[$i];
                    $email          = $emailArr[$i];
                    if(TYPETAG==="Array"){
                        $position = '$'.$i;
                    }else{
                        $position = '<<'.$assignArr[$i].'>>';
                    }
                    

                    $signatures['email']           = $email;
                    $signatures['user_identifier'] = $userIdentifier;
                    $signatures['sequence']        = $i+1;
                    $signatures['signature_image'] = "data:image/png;base64,".$rawImages[$i];

                    if(SIGNATUREPOSITION==="Fixed"){
                        $signatureslist['user_identifier'] = $userIdentifier;
                        $signatureslist['location']        = $a->orgname;
                        $signatureslist['width']           = floatval(WIDTH);
                        $signatureslist['height']          = floatval(HEIGHT);
                        $signatureslist['coordinate_x']    = $lastcoordinate_x;
                        $signatureslist['coordinate_y']    = floatval(COORDINATE_Y);
                        $signatureslist['page_number']     = floatval(PAGE);
                        $signatureslist['reason']          = "Signed on behalf of " . $a->orgname;

                        $listsignatures[] = $signatureslist;
                        $lastcoordinate_x = $lastcoordinate_x+floatval(WIDTH)+10;
                    }else{
                        $specimentposition = parsePdfAndFindText($filedirectory,$position,$mainName);

                        if(!empty($specimentposition['data']['content'][$position])){
                            foreach($specimentposition['data']['content'][$position] as $specimen){
                                $signatureslist = [];
                                if(isset($specimen['x'],$specimen['y'],$specimen['page'])){
                                    $signatureslist['user_identifier'] = $userIdentifier;
                                    $signatureslist['location']        = $a->orgname;
                                    $signatureslist['width']           = floatval(WIDTH);
                                    $signatureslist['height']          = floatval(HEIGHT);
                                    $signatureslist['coordinate_x']    = floatval($specimen['x']) - (floatval(WIDTH)/2);
                                    $signatureslist['coordinate_y']    = floatval($specimen['y']) - (floatval(HEIGHT)/2);
                                    $signatureslist['page_number']     = floatval($specimen['page']);
                                    $signatureslist['reason']          = "Signed on behalf of " . $a->orgname;
                                }

                                $listsignatures[] = $signatureslist;
                            }
                        }else{
                            $signatureslist = [];

                            $signatureslist['user_identifier'] = $userIdentifier;
                            $signatureslist['location']        = $a->orgname;
                            $signatureslist['width']           = floatval(WIDTH);
                            $signatureslist['height']          = floatval(HEIGHT);
                            $signatureslist['coordinate_x']    = $lastcoordinate_x;
                            $signatureslist['coordinate_y']    = floatval(COORDINATE_Y);
                            $signatureslist['page_number']     = floatval(PAGE);
                            $signatureslist['reason']          = "Signed on behalf of " . $a->orgname;

                            $listsignatures[] = $signatureslist;
                            $lastcoordinate_x = $lastcoordinate_x+floatval(WIDTH)+10;
                        }
                    }
                    
                    $listpdf['filename']    = $a->filename;
                    $listpdf['template_no'] = $nik;
                    $listpdf['signatures']  = $listsignatures;

                    $body['signatures'][] = $signatures;
                    $body['list_pdf'][]   = $listpdf;
                }

                $body['request_id']  = $requestid;
                $responserequestsignquicksign = TilakaPlus::requestsignquicksign(json_encode($body));

                if(!isset($responserequestsignquicksign['success'])){
                    $statusColor = "red";
                    $statusMsg   = "No Response From Tilaka Lite";

                    echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                    continue;
                }

                if($responserequestsignquicksign['success']===false){

                    $statusColor = "red";
                    $statusMsg   = $responserequestsignquicksign['message'];

                    if ($statusMsg === "There is file/s that's not available in bucket") {
                        $datasimpanhd['status_sign'] = "0";
                        $datasimpanhd['response']    = $responserequestsignquicksign['message'];
                        $this->md->updatedocument($datasimpanhd,$a->transaksi_id);
                    }
                    
                    if (strpos(strtolower($statusMsg), 'tidak bisa melakukan quicksign') !== false) {
                        $datasimpanhd['quick_sign'] = "1";
                        $datasimpanhd['response']    = $responserequestsignquicksign['message'];
                        $this->md->updatedocument($datasimpanhd,$a->transaksi_id);
                    }

                    echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                    continue;
                }

                if($responserequestsignquicksign['auth_response'][0]['url']!=null){
                    $statusColor = "red";
                    $statusMsg   = $responserequestsignquicksign['message'];
                }else{
                    $statusColor = "green";
                    $statusMsg   = $responserequestsignquicksign['message'];

                    $datasimpanhd                     = [];
                    $datasimpanhd['status_sign']      = "3";
                    $datasimpanhd['quick_sign']       = "2";
                    $datasimpanhd['request_id']       = $requestid;
                    $datasimpanhd['response']         = $responserequestsignquicksign['message'];
                    $datasimpanhd['requestsign_date'] = date('Y-m-d H:i:s');

                    $this->md->updatedocument($datasimpanhd,$a->transaksi_id);
                }

                echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                continue;
            }
        }

        public function statussignquicksign_GET(){
            $resultstatussignquicksign = $this->md->statussignquicksign();

            if(empty($resultstatussignquicksign)){
                echo color('red')."Data Tidak Ditemukan";
                return;
            }

            foreach($resultstatussignquicksign as $a){
                $responsestatussign = [];
                $body               = [];
                $statusColor        = "";
                $statusMsg          = "";

                $body['request_id'] = $a->request_id;
                $responsestatussign = TilakaPlus::statussign(json_encode($body));

                if(!isset($responsestatussign['success'])){
                    $statusColor = "red";
                    $statusMsg   = "No Response From Tilaka Lite";

                    echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                    continue;
                }

                if($responsestatussign['success']===false){
                    $statusColor = "red";
                    $statusMsg   = $responsestatussign['message'];

                    echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                    continue;
                }

                if($responsestatussign['message']==="PARAMERR"){
                    foreach($responsestatussign['list_pdf'] as $listpdfs){
                        $statusColor = "yellow";
                        $statusMsg   = $responsestatussign['message'];

                        echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                        continue;
                    }
                }

                if($responsestatussign['message']==="PROCESS"){
                    foreach($responsestatussign['list_pdf'] as $listpdfs){
                        $statusColor = "yellow";
                        $statusMsg   = $responsestatussign['message']." | ".$responsestatussign['status'][0]['status']." | ".$responsestatussign['status'][0]['num_signatures_done']."/".$responsestatussign['status'][0]['num_signatures']." Signatures";

                        echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                        continue;
                    }
                }

                if($responsestatussign['message']==="FAILED"){
                    foreach($responsestatussign['list_pdf'] as $listpdfs){
                        $statusColor = "red";
                        $statusMsg   = $responsestatussign['message'];

                        $datasimpanhd                = [];
                        $datasimpanhd['status_sign'] = "0";

                        $this->md->updatedocument($datasimpanhd,$a->transaksi_id);
                        echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                        continue;
                    }
                }

                if($responsestatussign['message']==="DONE"){
                    foreach($responsestatussign['list_pdf'] as $listpdfs){
                        $filedirectory = "";
                        if($listpdfs['error']===false){
                            $filename    = $listpdfs['filename'];
                            $pos         = strpos($filename, '_');
                            $mainName    = ($pos !== false) ? substr($filename, $pos + 1) : $filename;
                            if($a->storage_out===null){
                                $fileContent = downloadAndSave($listpdfs['presigned_url'],STORAGESIGN,$mainName);
                            }else{
                                $fileContent = downloadAndSave($listpdfs['presigned_url'],$a->storage_out,$mainName);
                            }
                            

                            if ($fileContent === false) {
                                $statusColor = "red";
                                $statusMsg   = "Download failed or file invalid";
                                echo formatlog($a->transaksi_id, $a->useridentifier, $statusMsg, 'white', 'green', $statusColor);
                                continue;
                            }

                            if (isset($fileContent['success']) && $fileContent['success'] === false) {
                                $statusColor = "red";
                                $statusMsg   = $fileContent['message'] ?? 'Unknown error';
                                echo formatlog($a->transaksi_id, $a->useridentifier, $statusMsg, 'white', 'green', $statusColor);
                                continue;
                            }

                            if($a->storage_out===null){
                                $filedirectory = STORAGESIGN.$mainName;
                            }else{
                                $filedirectory = $a->storage_out.$mainName;
                            }
                            

                            if(!fileExists($filedirectory)['status']){
                                $statusColor = "red";
                                $statusMsg   = fileExists($filedirectory)['message'];
                                $statusMsg   = $filedirectory;

                                echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                                continue;
                            }
                            
                            $statusColor = "green";
                            $statusMsg   = $responsestatussign['message'];

                            $datasimpanhd                  = [];
                            $datasimpanhd['status_sign']   = "5";
                            $datasimpanhd['response']      = $responsestatussign['message'];
                            $datasimpanhd['link']          = $listpdfs['presigned_url'];
                            if($a->storage_out===null){
                                $datasimpanhd['storage_out']   = STORAGESIGN;
                            }
                            $datasimpanhd['download_date'] = date('Y-m-d H:i:s');

                            $this->md->updatedocument($datasimpanhd,$a->transaksi_id);
                        }
                    }

                    echo formatlog($a->transaksi_id,$a->useridentifier,$statusMsg,'white','green',$statusColor);
                    continue;
                }
                
            }
        }
    }
?>