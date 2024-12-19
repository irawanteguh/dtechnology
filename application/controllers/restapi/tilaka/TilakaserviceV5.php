<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';
    include FCPATH."assets/vendors/phpqrcode/qrlib.php";
    include FCPATH."assets/vendors/pdfparse/Pdfparse.php";
    require 'vendor/autoload.php';
    use Smalot\PdfParser\Parser;

    class TilakaserviceV5 extends REST_Controller{
        
        public function __construct(){
            parent::__construct();
            $this->load->model("Modeltilakaservice","md");
        }

        public function auth_GET(){
            $response = Tilaka::oauth();
            $this->response($response,REST_Controller::HTTP_OK);
        }

        public function uploadallfile_POST(){
            $summaryresponse = [];
            $responseservice = [];

            $status ="and a.status_sign ='0'";
            $result = $this->md->dataupload(ORG_ID,$status);
            
            if(!empty($result)){
                foreach($result as $a){
                    $response                 = [];
                    $responseall              = [];
                    $data                     = [];
                    $bodycheckcertificate     = [];
                    $responsecheckcertificate = [];
                    $location                 = "";

                    $responseall['NoFile']                   = $a->NO_FILE;
                    $responseall['Type']                     = $a->jenisdocumen;
                    $responseall['Directory']                = $location;
                    $responseall['Source']                   = $a->SOURCE_FILE;
                    $responseall['Assign']['UserIdentifier'] = $a->useridentifier;
                    $responseall['Assign']['Name']           = $a->assignname;
                    
                    if($a->SOURCE_FILE==="DTECHNOLOGY"){
                        $location = FCPATH."/assets/document/".$a->NO_FILE.".pdf";
                    }else{
                        $location = PATHFILE_GET_TILAKA."/".$a->NO_FILE.".pdf";
                    }

                    if(file_exists($location)){
                        $fileSize = 0;
                        $fileSize = filesize($location);

                        if($fileSize!=0){
                            $bodycheckcertificate['user_identifier']=$a->useridentifier;
                            $responsecheckcertificate = Tilaka::checkcertificateuser(json_encode($bodycheckcertificate));

                            if(isset($responsecheckcertificate['success'])){
                                if($responsecheckcertificate['success']){
                                    if($responsecheckcertificate['status']===3){
                                        $response = Tilaka::uploadfile($location);
                                        if(isset($response['success'])){
                                            if($response['success']){
                                                $data['NOTE']            = "";
                                                $data['FILENAME']        = $response['filename'];
                                                $data['USER_IDENTIFIER'] = $a->useridentifier;
                                                $data['STATUS_SIGN']     = "1";
                                            }
                                        }else{
                                            $data['NOTE'] = "Gagal Upload Document";
                                        }
                                        
                                        $responseall['ResponseTilaka'] = $response;
                                    }else{
                                        $data['NOTE']                  = $responsecheckcertificate['data'][0]['status'];
                                        $responseall['ResponseTilaka'] = $responsecheckcertificate;
                                    }
                                }
                            }else{
                                $data['NOTE']                  = "Gagal Check Certificate User";
                                $responseall['ResponseTilaka'] = $responsecheckcertificate;
                            }
                        }else{
                            $data['ACTIVE']                     = "0";
                            $data['NOTE']                       = "File Corrupted, File Size : ".$fileSize;
                            $responseall['ResponseDTechnology'] = "File Corrupted, File Size : ".$fileSize;
                        }
                    }else{
                        $data['ACTIVE']                                 = "0";
                        $data['NOTE']                                   = "File Tidak Di Temukan";
                        $responseall['ResponseDTechnology']['Note']     = "File Tidak Di Temukan";
                        $responseall['ResponseDTechnology']['Location'] = $location;
                    }

                    $this->md->updatefile($data,$a->NO_FILE);
                    $responseservice[]=$responseall;
                }
            }else{
                $responseservice['ResponseDTechnology'] = "Tidak Ada List File Untuk Di Upload Ke Tilaka Lite";
            }

            $summaryresponse[]=$responseservice;
            $this->response($summaryresponse,REST_Controller::HTTP_OK);
        }

        public function requestsign_POST(){
            $summaryresponse = [];
            $responseservice = [];
            $bodycheckcertificate = [];
            $responsecheckcertificate = [];

            $status ="and a.status_sign ='1' limit 50;";
            $result = $this->md->listrequestsign(ORG_ID,$status);

            if(!empty($result)){
                foreach($result as $a){
                    $requestid      = "";
                    $signatureimage = "";
                    $response       = [];
                    $responseall    = [];
                    $data           = [];
                    $body           = [];
                    $signatures     = [];
                    $nofile         = [];

                    $requestid   = generateuuid();

                    $speciment      = FCPATH."assets/speciment/".ORG_ID.".png";
                    $qrcode         = file_get_contents($speciment);
                    $signatureimage = "data:image/png;base64,".base64_encode($qrcode);

                    $signatures['user_identifier'] = $a->user_identifier;
                    $signatures['signature_image'] = $signatureimage;

                    $body['request_id']   = $requestid;
                    $body['signatures'][] = $signatures;

                    $listfile = $this->md->filerequestsign(ORG_ID,$status,$a->assign);
                    foreach($listfile as $files){
                        $listpdf           = [];
                        $listpdfsignatures = [];

                        $nofile[]          = $files->no_file;

                        if($files->source_file==="DTECHNOLOGY"){
                            $filename = FCPATH."assets/document/".$files->no_file.".pdf";
                        }else{
                            $filename = PATHFILE_GET_TILAKA."/".$files->no_file.".pdf";
                        }
                        
                        if(file_exists($filename)){
                            if($files->source_file==="DTECHNOLOGY"){
                                $pdfParse          = new Pdfparse($filename);
                                $specimentposition = $pdfParse->findText('$');

                                // return var_dump($specimentposition);

                                // $parser = new Parser();
                                // $pdf  = $parser->parseFile($filename);
                                // $text = $pdf->getText();

                                // return var_dump($text,'$');

                                // // Cari simbol $
                                // if (strpos($text, '$') !== false) {
                                //     echo "Simbol '$' ditemukan dalam file PDF.\n";
                                // } else {
                                //     echo "Simbol '$' tidak ditemukan.\n";
                                // }
        
                                if(isset($specimentposition['content']['$'][0]['x']) && isset($specimentposition['content']['$'][0]['y']) && isset($specimentposition['content']['$'][0]['page'])){
                                    $coordinatex = floatval($specimentposition['content']['$'][0]['x'])-(floatval(WIDTH)/2);
                                    $coordinatey = floatval($specimentposition['content']['$'][0]['y'])-(floatval(HEIGHT)/2);
                                    $page        = floatval($specimentposition['content']['$'][0]['page']);
                                }else{
                                    $coordinatex = floatval(COORDINATE_X);
                                    $coordinatey = floatval(COORDINATE_Y);
                                    $page        = floatval(PAGE);
                                }
                            }else{
                                $coordinatex = floatval(COORDINATE_X);
                                $coordinatey = floatval(COORDINATE_Y);
                                $page        = floatval(PAGE);
                            }
                            
    
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
    
                            $body['list_pdf'][]=$listpdf;
                        }
                    }

                    $bodycheckcertificate['user_identifier']=$a->user_identifier;
                    $responsecheckcertificate = Tilaka::checkcertificateuser(json_encode($bodycheckcertificate));

                    if(isset($responsecheckcertificate['success'])){
                        if($responsecheckcertificate['success']){
                            if($responsecheckcertificate['status']===3){
                                $response = Tilaka::requestsign(json_encode($body));
    
                                if(isset($response['success'])){
                                    if($response['success']){
                                        foreach($response['auth_urls'] as $authurls){
                                            $data['REQUEST_ID']  = $requestid;
                                            $data['STATUS_SIGN'] = "2";
                                            $data['URL']         = $authurls['url'];   
                                        }
                                    }else{
                                        foreach($listfile as $a){
                                            $data['REQUEST_ID']  = $requestid;
                                            $data['STATUS_SIGN'] = "0";
                                            $data['NOTE']        = $response['message'];
                                        }
                                    }
        
                                    foreach($nofile as $a){
                                        $this->md->updatefile($data,$a);
                                    }
                                }
                                                 
                                $responseall['ResponseTilaka'] = $response;
                            }else{
                                $responseall['ResponseTilaka'] = $responsecheckcertificate;
                            }
                        }
                    }
                    
                    
                    $responseservice[]=$responseall;
                }
            }else{
                $responseservice['ResponseDTechnology'] = "Tidak Ada List Untuk Di Lakukan Request Sign";
            }

            $summaryresponse[]=$responseservice;
            $this->response($summaryresponse,REST_Controller::HTTP_OK);
        }

        public function excutesign_POST(){
            $summaryresponse = [];
            $responseservice = [];

            $status ="and a.status_sign ='3' limit 50;";
            $result = $this->md->listexecute(ORG_ID,$status);

            if(!empty($result)){
                foreach($result as $a){
                    $response    = [];
                    $responseall = [];
                    $data        = [];
                    $body        = [];
                   
                    $body['request_id']      = $a->request_id;
                    $body['user_identifier'] = $a->user_identifier;

                    $response = Tilaka::excutesign(json_encode($body));

                    if(isset($response['success'])){
                        if($response['status']==="DONE"){
                            $data['STATUS_SIGN']="4";
                        }
    
                        if($response['status']==="FAILED"){
                            $data['STATUS_SIGN']     = "0";
                            $data['STATUS_FILE']     = "1";
                            $data['REQUEST_ID']      = "";
                            $data['LINK']            = "";
                            $data['NOTE']            = "";
                            $data['USER_IDENTIFIER'] = "";
                            $data['URL']             = "";
                        }

                        $this->md->updatefile($data,$a->no_file);
                    }

                    $responseall['Assign']['UserIdentifier'] = $a->user_identifier;
                    $responseall['Assign']['Name']           = $a->assignname;
                    $responseall['File']['Filename']         = $a->no_file;
                    $responseall['File']['RequestId']        = $a->request_id;
                    $responseall['Response']                 = $response;
                    $responseservice[]=$responseall;
                    
                }
            }else{
                $responseservice['ResponseDTechnology'] = "Tidak Ada List Untuk Di Execute";
            }

            $summaryresponse[]=$responseservice;
            $this->response($summaryresponse,REST_Controller::HTTP_OK);
        }

        public function statussign_POST(){
            $summaryresponse = [];
            $responseservice = [];

            $result = $this->md->listdownload(ORG_ID);

            if(!empty($result)){
                foreach($result as $a){
                    $responseall = [];
                    $response    = [];
                    $body        = [];

                    $body['request_id'] = $a->request_id;
                    $response = Tilaka::excutesignstatus(json_encode($body));

                    if(isset($response['success'])){
                        if($response['success']){
                            foreach($response['list_pdf'] as $listpdfs){
                                // if($listpdfs['error']===false){
                                    $data        = [];
                                    $nofile      = preg_match('/_(.*?)\.pdf$/', $listpdfs['filename'], $matches) ? $matches[1] : '';
                                    $fileContent = file_get_contents(htmlspecialchars_decode($listpdfs['presigned_url']));
    
                                    if($fileContent !== false){
    
                                        if($a->source_file==="DTECHNOLOGY"){
                                            $destinationPath = FCPATH."/assets/document/".$nofile.".pdf";
                                        }else{
                                            $destinationPath = PATHFILE_POST_TILAKA.DIRECTORY_SEPARATOR.$nofile.".pdf";
                                        }
    
                                        if(file_put_contents($destinationPath,$fileContent)){
                                            $data['STATUS_SIGN'] = "5";
                                            $data['LINK']        = $listpdfs['presigned_url'];
                                            
                                            $this->md->updatefile($data,$nofile);
                                        }
                                    }
                                // }
                            }
                        }
                    }
                    

                    $responseall['Assign']['UserIdentifier'] = $a->user_identifier;
                    $responseall['Assign']['Name']           = $a->assignname;
                    $responseall['ResponseTilaka']           = $response;
                    $responseservice[]                       = $responseall;
                }
            }else{
                $responseservice['ResponseDTechnology'] = "Tidak File Yang Sudah Selesai";
            }

            $summaryresponse[]=$responseservice;
            $this->response($summaryresponse,REST_Controller::HTTP_OK);
        }

        public function getfile_GET(){
            $orgId    = isset($_SESSION['orgid']) ? $_SESSION['orgid'] : '10c84edd-500b-49e3-93a5-a2c8cd2c8524';
            $location = FCPATH . "/assets/documenttemp/";
            if (is_dir($location)) {
                $pdfFiles = glob($location . "*.pdf");
        
                if (!empty($pdfFiles)) {
                    foreach ($pdfFiles as $file) {
                        // Use basename to get only the filename for splitting
                        $partsfile = explode("-", basename($file));
        
                        if (count($partsfile) === 5) {
                            $nofile      = $partsfile[0];
                            $jenisdoc    = $partsfile[1];
                            $assign      = $partsfile[2];
                            $pasienid    = $partsfile[3];
                            $transaksiid = str_replace(".pdf", "", $partsfile[4]);
        
                            $data['org_id']        = $orgId;
                            $data['no_file']       = $nofile;
                            $data['status_file']   = "1";
                            $data['jenis_doc']     = $jenisdoc;
                            $data['assign']        = $assign;
                            $data['pasien_idx']    = $pasienid;
                            $data['transaksi_idx'] = $transaksiid;
                            $data['source_file']   = "DTECHNOLOGY";
        
                            if ($this->md->insertsigndocument($data)) {
                                // Define the new location with only the filename for the new path
                                $newLocation = FCPATH . "/assets/document/" . $nofile . ".pdf";
        
                                // Move the file to the new location
                                if (rename($file, $newLocation)) {
                                    $this->response("Data Added Successfully and file moved", 200);
                                } else {
                                    $this->response("Data Added Successfully, but file failed to move", 200);
                                }
                            } else {
                                $this->response("Data Failed to Add", 200);
                            }
                        } else {
                            $this->response("The array does not have 5 elements", 200);
                        }
                    }
                } else {
                    $this->response("No PDF files found in the directory.", 200);
                }
            } else {
                $this->response("Directory does not exist.", 200);
            }
        }
        
    }

?>