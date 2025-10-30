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

    

    class Tilakaservice extends REST_Controller{
        
        public function __construct(){
            parent::__construct();
            $this->load->model("Modeltilaka","md");
        }

        public function headerlog(){
            echo PHP_EOL;
            echo color('cyan').str_pad("IDENTITY", 40).str_pad("USER IDENTIFIER", 20)."MESSAGE".PHP_EOL;
        }

        public function auth_GET(){
            $response = Tilaka::oauth();
            $this->response($response['access_token'],REST_Controller::HTTP_OK);
        }

        //RMB Hospital Group Direct To Tilaka RSMS
        public function transferfile_POST(){
            $this->headerlog();
            $result = $this->md->datalisttransferfile(ORG_ID);

            if(!empty($result)){
                foreach($result as $a){
                    $location  = "";
                    $filesize  = 0;

                    if($a->source_file==="DTECHNOLOGY"){
                        $location = FCPATH."assets/document/".$a->no_file.".pdf";
                    }else{
                        $location = PATHFILE_GET_TILAKA."/".$a->no_file.".pdf";
                    }

                    if(file_exists($location)){
                        $filesize = filesize($location);
                        if($filesize!=0){
                            $responseuploadfile = Tilaka::uploadfile($location);
                            if(isset($responseuploadfile['success'])){
                                if($responseuploadfile['success']){
                                    $resultcheckfilename = $this->md->checkfilename(ORG_ID,$responseuploadfile['filename']);
                                    if(empty($resultcheckfilename)){
                                        $datasimpanhd['filename']        = $responseuploadfile['filename'];
                                        $datasimpanhd['status_sign']     = "1";
                                        $datasimpanhd['status_file']     = "1";
                                        $datasimpanhd['note']            = "";

                                        $statusMsg = color('green').$responseuploadfile['message']." | ".$responseuploadfile['filename'];
                                    }
                                }else{
                                    $datasimpanhd['note'] = $responseuploadfile['message'];
                                    $statusMsg = color('red').$responseuploadfile['message'];
                                }
                            }
                        }else{
                            $datasimpanhd['status_sign'] = "98";
                            $datasimpanhd['note']        = "File Corrupted, Size ".$filesize;
                            $statusMsg = color('red')."File Corrupted, Size: ".$filesize;
                        }
                    }else{
                        $datasimpanhd['status_sign']     = "99";
                        $datasimpanhd['note']            = "File not found";
                        $datasimpanhd['status_file']     = "0";
                        $datasimpanhd['user_identifier'] = "";
                        $datasimpanhd['url']             = "";

                        $statusMsg = color('red')."File not found | ".$location;
                    }

                    if(!empty($datasimpanhd)){
                        $this->md->updatefile($datasimpanhd, $a->no_file);
                    }

                    echo str_pad($a->no_file.".pdf", 40)."SYSTEM".$statusMsg.PHP_EOL;
                }
            }else{
                echo color('red')."Data Tidak Ditemukan";
            }
        }

        public function uploadallfile_POST(){
            $this->headerlog();
            $result = $this->md->datalistuploadfile(ORG_ID);

            if(!empty($result)){
                foreach($result as $a){
                    $location  = "";
                    $filesize  = 0;

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
                                                $resultcheckfilename = $this->md->checkfilename(ORG_ID,$responseuploadfile['filename']);
                                                if(empty($resultcheckfilename)){
                                                    $datasimpanhd['filename']        = $responseuploadfile['filename'];
                                                    $datasimpanhd['user_identifier'] = $a->useridentifier;
                                                    $datasimpanhd['status_sign']     = "1";
                                                    $datasimpanhd['status_file']     = "1";
                                                    $datasimpanhd['note']            = "";

                                                    $statusMsg = color('green').$responseuploadfile['message']." | ".$responseuploadfile['filename'];
                                                }
                                            }else{
                                                $datasimpanhd['note'] = $responseuploadfile['message'];
                                                $statusMsg = color('red').$responseuploadfile['message'];
                                            }
                                        }
                                    }else{
                                        $datasimpanhd['note'] = $responsecheckcertificate['message']['info'];
                                        $statusMsg = color('red').$responsecheckcertificate['message']['info']." | ".$responsecheckcertificate['data'][0]['status']." | ".$responsecheckcertificate['data'][0]['expiry_date'];
                                    }
                                }else{
                                    $datasimpanhd['note'] = $responsecheckcertificate['message']['info'];
                                    $statusMsg = color('red').$responsecheckcertificate['message']['info'];
                                }
                            }
                        }else{
                            $datasimpanhd['status_sign'] = "98";
                            $datasimpanhd['note']        = "File Corrupted, Size ".$filesize;
                            $statusMsg = color('red')."File Corrupted, Size: ".$filesize;
                        }
                    }else{
                        $datasimpanhd['status_sign']     = "99";
                        $datasimpanhd['note']            = "File not found";
                        $datasimpanhd['status_file']     = "0";
                        $datasimpanhd['user_identifier'] = "";
                        $datasimpanhd['url']             = "";

                        $statusMsg = color('red')."File not found | ".$location;
                    }

                    if(!empty($datasimpanhd)){
                        $this->md->updatefile($datasimpanhd, $a->no_file);
                    }

                    echo str_pad($a->no_file.".pdf", 40).str_pad($a->useridentifier, 20).$statusMsg.PHP_EOL;
                }
            }else{
                echo color('red')."Data Tidak Ditemukan";
            }
        }

        public function requestsign_POST(){
            $status = "AND a.status_sign = '1' LIMIT 10;";
            $result = $this->md->listrequestsign(ORG_ID,$status);

            echo PHP_EOL;
            echo color('cyan').str_pad("REQUEST ID", 40).str_pad("USER IDENTIFIER", 20)."MESSAGE".PHP_EOL;

            if(!empty($result)){
                foreach($result as $a){
                    $requestid  = "";
                    $filename   = "";
                    $listfile   = [];
                    $body       = [];
                    $signatures = [];

                    $requestid = generateuuid();

                    if(file_exists(FCPATH."assets/speciment/".ORG_ID.".png")){
                        $signatures['user_identifier'] = $a->user_identifier;
                        $signatures['signature_image'] = "data:image/png;base64,".base64_encode(file_get_contents(FCPATH."assets/speciment/".ORG_ID.".png"));
    
                        $body['request_id']   = $requestid;
                        $body['signatures'][] = $signatures;

                        $resultfilerequestsign = $this->md->filerequestsign(ORG_ID,$status,$a->assign);
                        
                        if(!empty($resultfilerequestsign)){
                            foreach($resultfilerequestsign as $files){

                                if($files->source_file==="DTECHNOLOGY"){
                                    $filename = FCPATH."assets/document/".$files->no_file.".pdf";
                                }else{
                                    $filename = PATHFILE_GET_TILAKA."/".$files->no_file.".pdf";
                                }

                                if(file_exists($filename)){
                                    if(preg_match('/SIGNER(.*)/', $filename, $matches)){
                                        $position = "$" . preg_replace('/\.pdf$/', '', $matches[1]);
                                        
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
                                        
                                                    $listpdf['filename']     = $files->filename;
                                                    $listpdf['signatures'][] = $listpdfsignatures;
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
                    
                                            $listpdf['filename']     = $files->filename;
                                            $listpdf['signatures'][] = $listpdfsignatures;
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
                
                                        $listpdf['filename']     = $files->filename;
                                        $listpdf['signatures'][] = $listpdfsignatures;
                                    }

                                    $body['list_pdf'][]=$listpdf;
                                }else{
                                    $statusMsg = color('red')."File not found";
                                }
                            }

                            $bodycheckcertificate['user_identifier']=$a->user_identifier;
                            $responsecheckcertificate = Tilaka::checkcertificateuser(json_encode($bodycheckcertificate));

                            // return var_dump($responsecheckcertificate);

                            if(isset($responsecheckcertificate['success'])){
                                if($responsecheckcertificate['success']){
                                    if($responsecheckcertificate['status']===3){
                                        $responserequestsign = Tilaka::requestsign(json_encode($body));
                                        if(isset($responserequestsign['success'])){
                                            if($responserequestsign['success']){
                                                foreach($resultfilerequestsign as $files){
                                                    $datasimpanhd = [];

                                                    if($files->source_file==="DTECHNOLOGY"){
                                                        $filename = FCPATH."assets/document/".$files->no_file.".pdf";
                                                    }else{
                                                        $filename = PATHFILE_GET_TILAKA."/".$files->no_file.".pdf";
                                                    }

                                                    if(file_exists($filename)){
                                                        $datasimpanhd['request_id']  = $requestid;
                                                        $datasimpanhd['status_sign'] = "2";
                                                        $datasimpanhd['url']         = $responserequestsign['auth_urls'][0]['url']; 
                                                    }else{
                                                        $datasimpanhd['status_sign'] = "0";
                                                    }

                                                    $this->md->updatefile($datasimpanhd,$files->no_file);

                                                    $statusMsg = color('green')."Success";
                                                }
                                            }
                                        }
                                    }else{
                                        $statusMsg = color('red').$responsecheckcertificate['message']['info']." | ".$responsecheckcertificate['data'][0]['status']." | ".$responsecheckcertificate['data'][0]['expiry_date'];
                                    }
                                }else{
                                    $statusMsg = color('red').$responsecheckcertificate['message']['info'];
                                }
                            }
                            
                            echo str_pad($requestid, 40).str_pad($a->user_identifier, 20).$statusMsg.PHP_EOL;
                        }else{
                            echo color('red')."Rincian File Tidak Ditemukan";
                        }
                    }else{
                        echo color('red')."Speciment Tidak Ditemukan";
                    }
                }
            }else{
                echo color('red')."Data Tidak Ditemukan";
            }
        }

        public function excutesign_POST(){
            $this->headerlog();
            $result = $this->md->listexecute(ORG_ID);

            if(!empty($result)){
                foreach($result as $a){
                    $response     = [];
                    $datasimpanhd = [];
                    $body         = [];
                    

                    $body['request_id']      = $a->request_id;
                    $body['user_identifier'] = $a->user_identifier;

                    $response = Tilaka::excutesign(json_encode($body));
                    // return var_dump($response);

                    if(isset($response['success'])){
                        if($response['status']==="DONE"){
                            $datasimpanhd['STATUS_SIGN'] = "4";
                            $datasimpanhd['NOTE']        = "";
                            $statusMsg                   = color('green').$response['status']." | ".$response['message'];
                        }

                        if($response['status']==="FAILED"){
                            $datasimpanhd['STATUS_SIGN']     = "0";
                            $datasimpanhd['STATUS_FILE']     = "1";
                            $datasimpanhd['REQUEST_ID']      = "";
                            $datasimpanhd['LINK']            = "";
                            $datasimpanhd['NOTE']            = "";
                            $datasimpanhd['USER_IDENTIFIER'] = "";
                            $datasimpanhd['URL']             = "";
                            $statusMsg                       = color('danger').$response['status']." | ".$response['message'];
                        }

                        if($response['status']==="PROCESS"){
                            $datasimpanhd['NOTE'] = $response['status'];
                            $statusMsg            = color('cyan').$response['status']." | ".$response['message'];
                        }

                        if($response['status']==="PARAMERR"){
                            $datasimpanhd['NOTE'] = $response['status'];
                            $statusMsg            = color('cyan').$response['status']." | ".$response['message'];
                        }

                        if(!empty($datasimpanhd)){
                            $this->md->updatefile($datasimpanhd, $a->no_file);
                        }

                        echo str_pad($a->request_id, 40).str_pad($a->user_identifier, 20).$statusMsg.PHP_EOL;
                    }
                }
            }else{
                echo color('red')."Data Tidak Ditemukan";
            }
        }

        public function statussign_POST(){
            $this->headerlog();
            $result = $this->md->listdownload(ORG_ID);
            if(!empty($result)){
                foreach($result as $a){
                    $response    = [];
                    $body        = [];

                    $body['request_id'] = $a->request_id;
                    $response = Tilaka::excutesignstatus(json_encode($body));

                    // return var_dump($response);

                    if(isset($response['success'])){
                        if($response['success']){
                            foreach($response['list_pdf'] as $listpdfs){
                                $data        = [];
                                $nofile      = preg_match('/_(.*?)\.pdf$/', $listpdfs['filename'], $matches) ? $matches[1] : '';
                                $fileContent = file_get_contents(htmlspecialchars_decode($listpdfs['presigned_url']));

                                if($fileContent !== false){
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
                                        $statusMsg = color('green').$response['message'];
                                    }
                                }
                            }
                        }
                    }

                    echo str_pad($a->request_id, 40).str_pad($response['status'][0]['user_identifier'], 20).$statusMsg.PHP_EOL;
                }
            }else{
                echo color('red')."Data Tidak Ditemukan";
            }
        }
    }

?>