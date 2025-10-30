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

    class Tilaka extends REST_Controller{
        
        public function __construct(){
            parent::__construct();
            $this->load->model("Modeltilaka","md");
        }

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
                                    $statusMsg = color('green').$responseuploadfile['message']." | ".$responseuploadfile['filename'];
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

                    echo str_pad($a->no_file.".pdf", 40).str_pad($a->useridentifier, 20).$statusMsg.PHP_EOL;
                }
            }else{
                echo color('red')."Data Tidak Ditemukan";
            }
        }

    }

?>