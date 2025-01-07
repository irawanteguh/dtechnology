<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';
    include FCPATH."assets/vendors/phpqrcode/qrlib.php";
    include FCPATH."assets/vendors/pdfparse/Pdfparse.php";

    class Tilakaservicebulk extends REST_Controller{
        
        public function __construct(){
            parent::__construct();
            $this->load->model("Modeltilakaservicebulk","md");
        }

        public function auth_GET(){
            $response = Tilaka::oauth();
            $this->response($response,REST_Controller::HTTP_OK);
        }

        public function uploadfilesingle_POST(){
            $response  = [];
            $parameter = "and a.org_id='".ORG_ID."' and a.status='1' and a.type='S'";
            $result    = $this->md->dataupload($parameter);

            if(!empty($result)){
                foreach($result as $a){
                    $filesize     = 0;
                    $pathfile     = "";
                    $datasimpanhd = [];
                    $datasimpanit = [];
                    $files        = [];

                    if($a->location==="DTECHNOLOGY"){
                        $pathfile = FCPATH."assets/document/".$a->no_file.".pdf";
                    }else{
                        $pathfile = PATHFILE_GET_TILAKA."/".$a->no_file.".pdf";
                    }

                    $files['nofile']   = $a->no_file;
                    $files['location'] = $a->location;
                    $files['path']     = $pathfile;

                    if(file_exists($pathfile)){
                        $filesize = filesize($pathfile);

                        if($filesize!=0){
                            if($a->type==="D"){
                                $responsetilaka    = Tilaka::uploadfile($pathfile);
                                if($responsetilaka['success']){
                                    $datasimpanhd['filename']           = $responsetilaka['filename'];
                                    $datasimpanhd['status']             = "2";
                                    $datasimpanhd['date_upload_tilaka'] = date('Y-m-d H:i:s');

                                    $datasimpanit['coordinate_x']    = floatval(COORDINATE_X);
                                    $datasimpanit['coordinate_y']    = floatval(COORDINATE_Y);
                                    $datasimpanit['page']            = floatval(PAGE);
                                    $datasimpanit['user_identifier'] = $a->useridentifier;

                                    $this->md->updatesigner($datasimpanit,$a->no_file);
                                }

                                $files['filesize'] = $filesize;
                                $files['response'] = $responsetilaka;
                            }
                        }else{
                            $files['issue']         = "File size 0 Mb";
                            $datasimpanhd['response'] = "File size 0 Mb";
                        }
                        $datasimpanhd['filesize'] = $filesize;
                    }else{
                        $files['issue']         = "File not found";
                        $datasimpanhd['response'] = "File not found";
                    }

                    $this->md->updatefile($datasimpanhd,$a->no_file);

                    $response['file'][]=$files;
                }
            }else{
                $response['response']['dtechnology']="There is no data to upload";
            }

            $this->response($response,REST_Controller::HTTP_OK);
        }

        public function requestsignsingle_POST(){
            $response  = [];
            $result    = $this->md->datasignerdocument(ORG_ID);

            if(!empty($result)){
                foreach($result as $a){
                    $requestid      = "";
                    $body           = [];
                    $signatures     = [];
                    $signatureimage = [];

                    $requestid = generateuuid();

                    $signatures['user_identifier'] = $a->useridentifier;
                    $signatures['signature_image'] = "data:image/png;base64,".base64_encode(file_get_contents(FCPATH."assets/speciment/".ORG_ID.".png"));

                    $body['request_id']   = $requestid;
                    $body['signatures'][] = $signatures; 

                    $resultdatalisfile = $this->md->datalisfile(ORG_ID,$a->nik);
                    foreach($resultdatalisfile as $listfiles){
                        $resultpositionsign = $this->md->positionsign(ORG_ID,$a->nik,$listfiles->no_file);

                        if($resultpositionsign[0]->type==="D"){
                            $listpdf           = [];
                            $listpdfsignatures = [];
    
                            $listpdfsignatures['user_identifier'] = $a->useridentifier;
                            $listpdfsignatures['location']        = $listfiles->orgname;
                            $listpdfsignatures['width']           = floatval(WIDTH);
                            $listpdfsignatures['height']          = floatval(HEIGHT);
                            $listpdfsignatures['coordinate_x']    = floatval($resultpositionsign[0]->coordinate_x);
                            $listpdfsignatures['coordinate_y']    = floatval($resultpositionsign[0]->coordinate_y);
                            $listpdfsignatures['page_number']     = floatval($resultpositionsign[0]->page);
                            $listpdfsignatures['qrcombine']       = "QRONLY";
                            if(CERTIFICATE==="PERSONAL"){
                                $listpdfsignatures['reason']       = "Signed on behalf of ".$files->orgname;
                            }
    
                            $listpdf['filename']     = $listfiles->filename;
                            $listpdf['signatures'][] = $listpdfsignatures;
    
                            $body['list_pdf'][] = $listpdf;
                        }
                       
                    }
                    $responserequestsign = Tilaka::requestsign(json_encode($body));

                    if(isset($responserequestsign['success'])){
                        if($responserequestsign['success']){
                            foreach($resultdatalisfile as $listfiles){
                                $datasimpanhd = [];
                                $datasimpanit = [];
                                
                                $datasimpanhd['request_id'] = $requestid;
                                $datasimpanhd['status']     = "3";
                                $this->md->updatefile($datasimpanhd,$listfiles->no_file);

                                $datasimpanit['link_sign']  = $responserequestsign['auth_urls'][0]['url'];
                                $datasimpanit['status']     = "1";
                                $this->md->updatesigner($datasimpanit,$listfiles->no_file);
                            }
                        }
                    }

                    $response['payload'] = $body;
                    $response['response']['tilaka'] = $responserequestsign;
                }
            }else{
                $response['response']['dtechnology']="There is no data to upload";
            }

            $this->response($response,REST_Controller::HTTP_OK);

        }
    }

?>