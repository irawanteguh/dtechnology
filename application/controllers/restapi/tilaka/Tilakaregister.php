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

    class Tilakaregister extends REST_Controller{
        
        public function __construct(){
            parent::__construct();
            $this->load->model("Modeltilaka","md");
        }

        public function headerlog(){
            echo PHP_EOL;
            echo color('cyan').str_pad("REGISTER ID", 40).str_pad("NAME", 52)."MESSAGE".PHP_EOL;
        }

        public function formatlog($identity, $useridentifier, $message, $colorIdentity = 'cyan', $colorUser = 'yellow', $colorMessage = 'white') {
            $identityWidth       = 40;
            $userIdentifierWidth = 52;

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

        public function statusregister_GET(){
            $this->headerlog();
            $result = $this->md->checkstatusregister();
            if(!empty($result)){
                foreach($result as $a){
                    $statusColor              = "";
                    $statusMsg                = "";
                    $bodycheckcertificate     = [];
                    $responsecheckcertificate = [];

                    $bodycheckcertificate['user_identifier']=$a->user_identifier;
                    $responsecheckcertificate = Tilaka::checkcertificateuser(json_encode($bodycheckcertificate));

                    $data['CERTIFICATE'] = $responsecheckcertificate['status'];

                    if($responsecheckcertificate['status']===3){
                        $statusColor = "green";
                        $statusMsg   = $responsecheckcertificate['message']['info'];

                        $data['CERTIFICATE_INFO'] = $responsecheckcertificate['message']['info'];
                    }else{
                        $statusColor = "red";
                        $statusMsg   = isset($responsecheckcertificate['data'][0]['status']) ? $responsecheckcertificate['message']['info']." | ".$responsecheckcertificate['data'][0]['status'] : $responsecheckcertificate['message']['info'];

                        $data['CERTIFICATE_INFO'] = isset($responsecheckcertificate['data'][0]['status']) ? $responsecheckcertificate['data'][0]['status'] : $responsecheckcertificate['message']['info'];
                    }

                    if($responsecheckcertificate['status']===0){ 
                        if($responsecheckcertificate['data'][0]['status']==="Expired"){
                            $data['START_ACTIVE'] = DateTime::createFromFormat('Y-m-d H:i:s', $responsecheckcertificate['data'][0]['start_active_date'])->format('Y-m-d H:i:s');
                            $data['EXPIRED_DATE'] = DateTime::createFromFormat('Y-m-d H:i:s', $responsecheckcertificate['data'][0]['expiry_date'])->format('Y-m-d H:i:s');
                        }
                    }

                    if($responsecheckcertificate['status']===3){
                        if($responsecheckcertificate['message']['info']==="Aktif"){
                            $data['REVOKE_ID']   = "";
                            $data['ISSUE_ID']    = "";
                            $data['START_ACTIVE'] = DateTime::createFromFormat('Y-m-d H:i:s', $responsecheckcertificate['data'][0]['start_active_date'])->format('Y-m-d H:i:s');
                            $data['EXPIRED_DATE'] = DateTime::createFromFormat('Y-m-d H:i:s', $responsecheckcertificate['data'][0]['expiry_date'])->format('Y-m-d H:i:s');
                        }
                    }

                    if($responsecheckcertificate['status']===4){
                        $data['USER_IDENTIFIER']  = "";
                        $data['REGISTER_ID']      = "";
                        $data['REVOKE_ID']        = "";
                        $data['ISSUE_ID']         = "";
                    }

                    $this->md->updatedatauserid($data,$a->user_id);

                    echo $this->formatlog($a->register_id,$a->name,$statusMsg,'white','light_yellow',$statusColor);
                }
            }else{
                echo color('red')."Data Tidak Ditemukan";
            }
        }

    }

?>