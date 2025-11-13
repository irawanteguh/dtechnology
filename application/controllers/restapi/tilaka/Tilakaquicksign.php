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

                    if(file_exists($location)){
                        $filesize = filesize($location);
                        if($filesize!=0){
                            $bodycheckcertificate['user_identifier']=$a->useridentifier;
                            $responsecheckcertificate = Tilaka::checkcertificateuser(json_encode($bodycheckcertificate));

                            if(isset($responsecheckcertificate['success'])){
                                if($responsecheckcertificate['success']){
                                    if($responsecheckcertificate['status']===3){
                                        $responseuploadfile = Tilaka::uploadfile($location);
                                        if(isset($responseuploadfile['success'])){
                                            if($responseuploadfile['success']){
                                                $resultcheckfilename = $this->md->checkfilename($responseuploadfile['filename']);
                                                if(empty($resultcheckfilename)){
                                                    $datasimpanhd['filename']        = $responseuploadfile['filename'];
                                                    $datasimpanhd['user_identifier'] = $a->useridentifier;
                                                    $datasimpanhd['status_sign']     = "1";
                                                    $datasimpanhd['status_file']     = "1";
                                                    $datasimpanhd['note']            = "";
                                                }

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

                    if(file_exists($locationspeciment)){
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

                                if(file_exists($filename)){
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

                                                        if(file_exists($filename)){
                                                            $datasimpanhd['request_id']  = $requestid;

                                                            if($responserequestsign['auth_response'][0]['url']!=null){
                                                                $datasimpanhd['status_sign'] = "2";
                                                                $datasimpanhd['url']         = $responserequestsign['auth_response'][0]['url'];
                                                            }else{
                                                                $datasimpanhd['status_sign'] = "4";
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

        public function statussignquicksign_POST(){
            $this->headerlog();
            $result = $this->md->listdownload();

            if(!empty($result)){
                foreach($result as $a){
                    $statusColor = "";
                    $statusMsg   = "";
                    $responseall = [];
                    $response    = [];
                    $body        = [];
                    $response    = [];

                    $body['request_id'] = $a->request_id;
                    $response = Tilaka::excutesignstatus(json_encode($body));

                    if(isset($response['success'])){
                        if($response['success']){
                            if($response['message']==="DONE"){
                                foreach($response['list_pdf'] as $listpdfs){
                                    $data        = [];
                                    $nofile      = preg_match('/_(.*?)\.pdf$/', $listpdfs['filename'], $matches) ? $matches[1] : '';
                                    $fileContent = file_get_contents(htmlspecialchars_decode($listpdfs['presigned_url']));

                                    if($fileContent!==false){
                                        if($a->source_file==="DTECHNOLOGY"){
                                            $destinationPath = FCPATH."/assets/document/".$nofile.".pdf";
                                        }else{
                                            $destinationPath = FCPATH.PATHFILE_POST_TILAKA.$nofile.".pdf";
                                        }

                                        if(file_put_contents($destinationPath,$fileContent)){
                                            $data['STATUS_SIGN'] = "5";
                                            $data['NOTE']        = "";
                                            $data['LINK']        = $listpdfs['presigned_url'];
                                            
                                            $this->md->updatefile($data,$nofile);

                                            $statusColor = "green";
                                            $statusMsg   = $response['message'];
                                        }else{
                                            $statusColor = "red";
                                            $statusMsg   = "Content Tidak Berhasil Di Simpan";
                                        }
                                    }else{
                                        $statusColor = "red";
                                        $statusMsg   = "Content Tidak Di Temukan";
                                    }
                                }
                            }

                            if($response['message']==="FAILED"){
                                foreach($response['list_pdf'] as $listpdfs){
                                    $data        = [];
                                    $nofile      = preg_match('/_(.*?)\.pdf$/', $listpdfs['filename'], $matches) ? $matches[1] : '';
                                    
                                    $data['STATUS_SIGN']     = "99";
                                    $data['STATUS_FILE']     = "1";
                                    $data['REQUEST_ID']      = "";
                                    $data['LINK']            = "";
                                    $data['NOTE']            = $response['message'];
                                    $data['USER_IDENTIFIER'] = "";
                                    $data['URL']             = "";

                                    $this->md->updatefile($data,$nofile);

                                    $statusColor = "red";
                                    $statusMsg   = $response['message'];
                                }
                            }

                            if($response['message']==="PROCESS"){
                                foreach($response['list_pdf'] as $listpdfs){
                                    $statusColor = "cyan";
                                    $statusMsg   = $response['message'];
                                }
                                
                            }

                            if($response['message']==="PARAMERR"){
                                foreach($response['list_pdf'] as $listpdfs){
                                    $statusColor = "cyan";
                                    $statusMsg   = $response['message'];
                                }
                            }
                        }
                    }

                    echo $this->formatlog($a->request_id,$a->user_identifier,$statusMsg,'white','light_yellow',$statusColor);
                }
            }else{
                echo color('red')."Data Tidak Ditemukan";
            }
        }

    }

?>