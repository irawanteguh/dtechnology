<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';

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

    class Mergepdf extends REST_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->model("Modelmergepdf","md");
            headerlog();
        }

        public function mergepdf_POST(){
            $files = [];
            $resultlistmergefiles = $this->md->listfiles("RA202512000425");

            if(empty($resultlistmergefiles)){
                echo color('red')."Data List Files Tidak Di Temukan";
                return;
            }

            foreach($resultlistmergefiles as $b){
                $filelocation = ($a->source_file==="DTECHNOLOGY") ? FCPATH."assets/document/".$a->no_file.".pdf" : PATHFILE_POST_TILAKA."/".$a->no_file.".pdf";

                if(file_exists($filelocation)){
                    $files[] = escapeshellarg($filelocation);
                }

                if(empty($files)){
                    echo color('red')."List Files Tidak Di Temukan";
                    continue;
                }

                $gsPath            = '"C:\Program Files\gs\gs10.04.0\bin\gswin64c.exe"';
                $outputFileEscaped = escapeshellarg($outputFile);
                $cmd               = "$gsPath -dBATCH -dNOPAUSE -dSAFER -dQUIET -sDEVICE=pdfwrite -sOutputFile=$outputFileEscaped " . implode(" ", array_map('escapeshellarg', $files));
                
            }
        }

        public function mergepdfsx_POST() {
            $resultlistmerge = $this->md->listmerge(ORG_ID);
        
            if(!empty($resultlistmerge)){
                foreach($resultlistmerge as $a){
                    $resultlistmergefiles = $this->md->listmergefiles(ORG_ID, $a->transaksi_idx);
        
                    if(!empty($resultlistmergefiles)){
                        $outputDir  = FCPATH . "/assets/mergedocument/";
                        $outputFile = $outputDir . $a->norm . "_" . str_replace("/", "-", $a->transaksi_idx) . ".pdf";
        
                        $files = [];
                        foreach($resultlistmergefiles as $b){
                            $filePath = FCPATH . "/assets/document/" . $b->no_file . ".pdf";
                            if (file_exists($filePath)) {
                                $files[] = escapeshellarg($filePath);
                            }
                        }
        
                        if(!empty($files)){
                            if (file_exists($outputFile)) {
                                if (!@unlink($outputFile)) {
                                    error_log("Gagal menghapus file: $outputFile, proses merge dibatalkan.");
                                    echo json_encode([
                                        "status" => "error",
                                        "message" => "Gagal menghapus file lama, proses merge dibatalkan."
                                    ]);
                                    exit;
                                }
                            }
                            
                            $gsPath            = '"C:\Program Files\gs\gs10.04.0\bin\gswin64c.exe"';
                            $outputFileEscaped = escapeshellarg($outputFile);
                            $cmd               = "$gsPath -dBATCH -dNOPAUSE -dSAFER -dQUIET -sDEVICE=pdfwrite -sOutputFile=$outputFileEscaped " . implode(" ", array_map('escapeshellarg', $files));
                            
                            shell_exec($cmd);
                            
                            if (file_exists($outputFile) && filesize($outputFile) > 0) {
                                foreach($resultlistmergefiles as $c){
                                    $data['status_file'] = "2";
                                    $this->md->updatefile($data,$c->no_file);
                                }

                                echo json_encode([
                                    "status" => "success",
                                    "message" => "File berhasil digabung: " . basename($outputFile),
                                    "outputFile" => $outputFile
                                ]);
                            } else {
                                echo json_encode([
                                    "status" => "error",
                                    "message" => "Gagal menyimpan file: " . basename($outputFile)
                                ]);
                            }
                        }else{
                            echo json_encode([
                                "status" => "error",
                                "message" => "Tidak ada file PDF yang ditemukan untuk digabung."
                            ]);
                        }
                    }
                }
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Tidak ada data merge yang ditemukan."
                ]);
            }
        }

    }
?>