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

        public function auth_GET(){
            $response = Tilaka::oauth();
            $this->response($response['access_token'],REST_Controller::HTTP_OK);
        }

        public function uploadallfile_POST(){
            header('Content-Type: text/plain');

            $status = "AND a.status_sign = '0' ORDER BY note ASC, created_date ASC LIMIT 10;";
            $result = $this->md->pencariandata(ORG_ID, $status);

            if(!empty($result)){
                foreach ($result as $a) {
                    $location                 = "";
                    $datasimpanhd             = [];
                    $responseuploadfile       = [];
                    $responsecheckcertificate = [];
                    $filesize                 = 0;

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
                                                    echo PHP_EOL.color('green')."Filename: ".$responseuploadfile['filename']."\tUploaded Success";
                                                }
                                            }else{
                                                $datasimpanhd['note'] = $responseuploadfile['message'];
                                                echo PHP_EOL."Status: False NoFile: {$a->no_file}.pdf"." Message: ".$responseuploadfile['message'];
                                            }
                                        }
                                    }else{
                                        $datasimpanhd['note'] = $responsecheckcertificate['message']['info'];
                                        echo PHP_EOL."Status: False NoFile: {$a->no_file}.pdf"." Message: ".$responsecheckcertificate['message']['info'];
                                    }
                                }
                            }
                        }else{
                            $datasimpanhd['status_sign'] = "98";
                            $datasimpanhd['note']        = "File Corrupted";
                            echo PHP_EOL."Status: False NoFile: {$a->no_file}.pdf"." Message: File Corrupted, File Size : ".$filesize;
                        }
                    }else{
                        $datasimpanhd['status_sign']     = "99";
                        $datasimpanhd['note']            = "File not found";
                        $datasimpanhd['status_file']     = "0";
                        $datasimpanhd['user_identifier'] = "";
                        $datasimpanhd['url']             = "";
                        echo PHP_EOL."Status: False NoFile: {$a->no_file}.pdf"." Location: ".$location." Message: File not found";
                    }

                    if(!empty($datasimpanhd)){
                        $this->md->updatefile($datasimpanhd, $a->no_file);
                    }
                }
            } else {
                echo color('red')."Message: Data Tidak Ditemukan";
            }
        }

        public function excutesign_POST(){
            $status = "AND a.status_sign = '3' ORDER BY note ASC, created_date DESC LIMIT 10;";
            $result = $this->md->listexecute(ORG_ID, $status);

            if(!empty($result)){
                foreach($result as $a){
                    $response    = [];
                    $data        = [];
                    $body        = [];

                    $body['request_id']      = $a->request_id;
                    $body['user_identifier'] = $a->user_identifier;

                    $response = Tilaka::excutesign(json_encode($body));

                    if(isset($response['success'])){
                        if($response['status']==="DONE"){
                            $data['STATUS_SIGN'] = "4";
                            $data['NOTE']        = "";
                            $this->md->updatefile($data,$a->no_file);
                            echo PHP_EOL."Status: True RequestId: {$a->request_id} NoFile: {$a->no_file}.pdf UserIdentifier: {$a->user_identifier} Message: ".$response['status'];
                        }

                        if($response['status']==="FAILED"){
                            $data['STATUS_SIGN']     = "0";
                            $data['STATUS_FILE']     = "1";
                            $data['REQUEST_ID']      = "";
                            $data['LINK']            = "";
                            $data['NOTE']            = "";
                            $data['USER_IDENTIFIER'] = "";
                            $data['URL']             = "";
                            $this->md->updatefile($data,$a->no_file);
                            echo PHP_EOL."Status: False RequestId: {$a->request_id} NoFile: {$a->no_file}.pdf UserIdentifier: {$a->user_identifier} Message: ".$response['status'];
                        }

                        if($response['status']==="PROCESS"){
                            $data['NOTE']=$response['status'];
                            $this->md->updatefile($data,$a->no_file);
                            echo PHP_EOL."Status: Info RequestId: {$a->request_id} NoFile: {$a->no_file}.pdf UserIdentifier: {$a->user_identifier} Message: ".$response['status'];
                        }

                        if($response['status']==="PARAMERR"){
                            $data['NOTE']=$response['status'];
                            $this->md->updatefile($data,$a->no_file);
                            echo PHP_EOL."Status: Info RequestId: {$a->request_id} NoFile: {$a->no_file}.pdf UserIdentifier: {$a->user_identifier} Message: ".$response['status'];
                        }
                    }
                }
            }else{
                echo color('red')."Message: Data Tidak Ditemukan";
            }
        }
    }

?>