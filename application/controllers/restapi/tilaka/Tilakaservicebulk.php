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

        public function uploadfile_POST(){
            $response  = [];
            $parameter = "and a.org_id='".ORG_ID."' and status='1'";
            $result    = $this->md->dataupload($parameter);

            if(!empty($result)){
                foreach($result as $a){
                    $filesize   = 0;
                    $pathfile   = "";
                    $datasimpan = [];
                    $files      = [];

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
                            $responsetilaka    = Tilaka::uploadfile($pathfile);

                            if($responsetilaka['success']){
                                $datasimpan['filename']           = $responsetilaka['filename'];
                                $datasimpan['status']             = "2";
                                $datasimpan['date_upload_tilaka'] = date('Y-m-d H:i:s');
                            }

                            $files['filesize'] = $filesize;
                            $files['response'] = $responsetilaka;
                        }else{
                            $files['issue']         = "File size 0 Mb";
                            $datasimpan['response'] = "File size 0 Mb";
                        }
                        $datasimpan['filesize'] = $filesize;
                    }else{
                        $files['issue']         = "File not found";
                        $datasimpan['response'] = "File not found";
                    }

                    $this->md->updatefile($datasimpan,$a->no_file);
                    $response['file'][]=$files;
                }
            }else{
                $response['response']['dtechnology']="There is no data to upload";
                $response['response']['tilaka']="";
            }

            $this->response($response,REST_Controller::HTTP_OK);
        }

        // public function uploadallfile_POST(){
        //     $summaryresponse = [];
        //     $responseservice = [];

        //     $result = $this->md->dataupload(ORG_ID);
        //     if(!empty($result)){
        //         foreach($result as $a){
        //             $fileSize       = 0;
        //             $location       = "";
        //             $data           = [];
        //             $responsedetail = [];
        //             $response       = [];

        //             if($a->location==="DTECHNOLOGY"){
        //                 $location = FCPATH."assets/document/".$a->no_file.".pdf";
        //             }else{
        //                 $location = PATHFILE_GET_TILAKA."/".$a->no_file.".pdf";
        //             }

        //             $responsedetail['NoFile']    = $a->no_file;
        //             $responsedetail['Directory'] = $location;
        //             $responsedetail['Source']    = $a->location;

        //             if(file_exists($location)){
        //                 $fileSize = filesize($location);
        //                 if($fileSize!=0){
        //                     $response = Tilaka::uploadfile($location);
        //                     if($response['success']){
        //                         $data['RESPONSE']    = "";
        //                         $data['FILENAME']    = $response['filename'];
        //                         $data['STATUS']      = "2";
        //                         $data['DATE_UPLOAD'] = date('Y-m-d H:i:s');
        //                     }
        //                     $responsedetail['ResponseTilaka'] = $response;
        //                 }else{
        //                     $data['STATUS']                        = "0";
        //                     $data['RESPONSE']                      = "File Corrupted, File Size : ".$fileSize;
        //                     $responsedetail['ResponseDTechnology'] = "File Corrupted, File Size : ".$fileSize;
        //                 }
        //             }else{
        //                 $data['STATUS']                        = "0";
        //                 $data['RESPONSE']                      = "File Not Found";
        //                 $responsedetail['ResponseDTechnology'] = "File Not Found";
        //             }
        //             $this->md->updatefile($data,$a->trans_id);
        //             $responseservice[]=$responsedetail;
        //         }
        //     }else{
        //         $responseservice['ResponseDTechnology'] = "Tidak Ada List File Untuk Di Upload Ke Tilaka Lite";
        //     }

        //     $summaryresponse[]=$responseservice;
        //     $this->response($summaryresponse,REST_Controller::HTTP_OK);
        // }

        // public function setsignerdocument_POST(){
        //     $summaryresponse = [];
        //     $responseservice = [];

        //     $result = $this->md->datasignerdocument(ORG_ID);
        //     if(!empty($result)){
        //         foreach($result as $a){
        //             $responsedetail = [];
        //             $location       = "";
        //             $coordinatex    = 0;
        //             $coordinatey    = 0;
        //             $page           = 0;

        //             if($a->type==="D"){
        //                 $coordinatex = floatval(COORDINATE_X);
        //                 $coordinatey = floatval(COORDINATE_Y);
        //                 $page        = floatval(PAGE);

        //                 $data['STATUS'] = "1";
        //             }else{
        //                 if($a->location==="DTECHNOLOGY"){
        //                     $location = FCPATH."assets/document/".$a->no_file.".pdf";
        //                 }else{
        //                     $location = PATHFILE_GET_TILAKA."/".$a->no_file.".pdf";
        //                 }

        //                 $pdfParse          = new Pdfparse($filename);
        //                 $specimentposition = $pdfParse->findText($a->tag);

        //                 if(isset($specimentposition['content'][$a->tag][0]['x']) && isset($specimentposition['content'][$a->tag][0]['y']) && isset($specimentposition['content'][$a->tag][0]['page'])){
        //                     $coordinatex = floatval($specimentposition['content'][$a->tag][0]['x'])-(floatval(WIDTH)/2);
        //                     $coordinatey = floatval($specimentposition['content'][$a->tag][0]['y'])-(floatval(HEIGHT)/2);
        //                     $page        = floatval($specimentposition['content'][$a->tag][0]['page']);

        //                     $data['STATUS'] = "1";
        //                 }
        //             }

        //             $data['USER_IDENTIFIER'] = $a->useridentifier;
        //             $data['COORDINATE_X']    = $coordinatex;
        //             $data['COORDINATE_Y']    = $coordinatey;
        //             $data['PAGE']            = $page;                    
        //             $this->md->updatesigner($data,$a->trans_id);

        //             $responsedetail['NoFile']                         = $a->no_file;
        //             $responsedetail['Directory']                      = $location;
        //             $responsedetail['Source']                         = $a->location;
        //             $responsedetail['DetailSigner']['UserIdentifier'] = $a->useridentifier;
        //             $responsedetail['DetailSigner']['CoordinateX']    = $coordinatex;
        //             $responsedetail['DetailSigner']['CoordinateY']    = $coordinatey;
        //             $responsedetail['DetailSigner']['Page']           = $page;
        //             $responseservice[]=$responsedetail;
        //         }
        //     }else{
        //         $responseservice['ResponseDTechnology'] = "Tidak Ada List Signer Document";
        //     }

        //     $summaryresponse[]=$responseservice;
        //     $this->response($summaryresponse,REST_Controller::HTTP_OK);
        // }
    }

?>