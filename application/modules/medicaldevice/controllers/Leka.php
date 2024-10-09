<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Leka extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelleka","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_leka");
		}

		public function listexamination(){
            $result = $this->md->listexamination($_SESSION['orgid']);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Di Temukan";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Tidak Di Temukan";
            }

            echo json_encode($json);
        }

        public function result(){
            $transid =$this->input->post("transid");
            $result = $this->md->result($_SESSION['orgid'],$transid);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Di Temukan";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Tidak Di Temukan";
            }

            echo json_encode($json);
        }

        public function updateencounter(){
            $transid     = $this->input->post("data_leka_transid_edit");
            $encounterid = $this->input->post("data_leka_encounter_edit");

            $data['encounter_id']=$encounterid;

            
            if($this->md->updateencounter($data,$transid)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Berhasil Di Perbaharui";
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Berhasil Di Gagal";
            }

            echo json_encode($json);
        }

        public function Sendsatusehat(){
            $transsaksiid=$this->input->post("transaksiid");            
            $resultexamination = $this->md->resultexaminationsatusehat($_SESSION['orgid'],$transsaksiid);

            if(!empty($resultexamination)){
                $responsegetencounter = Satusehat::getencounter($resultexamination[0]->ENCOUNTER_ID);
             
                $bodyFHIR                   = [];
                $categorycoding             = [];
                $encounter                  = [];
                $identifier1                = [];
                $identifier2                = [];
                $performer                  = [];
                $subject                    = [];
                
                $imtscale                   = [];
                $imtscaleresource           = [];
                $imtscaleresourcecodecoding = [];

                $height                   = [];
                $heightresource           = [];
                $heightresourcecodecoding = [];

                $weight                   = [];
                $weightresource           = [];
                $weightresourcecodecoding = [];

                $systol                   = [];
                $systolresource           = [];
                $systolresourcecodecoding = [];

                $diastol                   = [];
                $diastolresource           = [];
                $diastolresourcecodecoding = [];

                $temp                   = [];
                $tempresource           = [];
                $tempresourcecodecoding = [];

                $categorycoding['code']    = "vital-signs";
                $categorycoding['display'] = "Vital Signs";
                $categorycoding['system']  = "http://terminology.hl7.org/CodeSystem/observation-category";
                $encounter['display']      = "Kunjungan Rawat Jalan";
                $encounter['reference']    = "Encounter/".$resultexamination[0]->ENCOUNTER_ID;
                $identifier1['system']     = "http://sys-ids.kemkes.go.id/observation/".ORGID_SATUSEHAT;
                $identifier1['use']        = "official";
                $identifier1['value']      = $resultexamination[0]->EXAM_ID;
                $identifier2['system']     = "http://sys-ids.kemkes.go.id/observation/".ORGID_SATUSEHAT;
                $identifier2['use']        = "official";
                $identifier2['value']      = generateuuid();
                $performer['display']      = $responsegetencounter['participant'][0]['individual']['display'];
                $performer['reference']    = $responsegetencounter['participant'][0]['individual']['reference'];
                $subject['display']        = $responsegetencounter['subject']['display'];
                $subject['reference']      = $responsegetencounter['subject']['reference'];

                $imtscaleresourcecodecoding['code']    = "39156-5";
                $imtscaleresourcecodecoding['display'] = "Body mass index (BMI) [Ratio]";
                $imtscaleresourcecodecoding['system']  = "http://loinc.org";

                $heightresourcecodecoding['code']    = "8302-2";
                $heightresourcecodecoding['display'] = "Body height";
                $heightresourcecodecoding['system']  = "http://loinc.org";

                $weightresourcecodecoding['code']    = "29463-7";
                $weightresourcecodecoding['display'] = "Body weight";
                $weightresourcecodecoding['system']  = "http://loinc.org";

                $systolresourcecodecoding['code']    = "8480-6";
                $systolresourcecodecoding['display'] = "Systolic blood pressure";
                $systolresourcecodecoding['system']  = "http://loinc.org";

                $diastolresourcecodecoding['code']    = "8462-4";
                $diastolresourcecodecoding['display'] = "Diastolic blood pressure";
                $diastolresourcecodecoding['system']  = "http://loinc.org";

                $tempresourcecodecoding['code']    = "8310-5";
                $tempresourcecodecoding['display'] = "Body temperature";
                $tempresourcecodecoding['system']  = "http://loinc.org";

                $imtscaleresource['category'][]['coding'][]  = $categorycoding;
                $imtscaleresource['code']['coding'][]        = $imtscaleresourcecodecoding;
                $imtscaleresource['effectiveDateTime']       = $resultexamination[0]->assessmentdate."+00:00";
                $imtscaleresource['encounter']               = $encounter;
                $imtscaleresource['identifier'][]            = $identifier1;
                $imtscaleresource['identifier'][]            = $identifier2;
                $imtscaleresource['issued']                  = $resultexamination[0]->assessmentdate."+00:00";
                $imtscaleresource['performer'][]             = $performer;
                $imtscaleresource['resourceType']            = "Observation";
                $imtscaleresource['status']                  = "final";
                $imtscaleresource['subject']                 = $subject;
                $imtscaleresource['valueQuantity']['code']   = "kg/m2";
                $imtscaleresource['valueQuantity']['system'] = "http://unitsofmeasure.org";
                $imtscaleresource['valueQuantity']['unit']   = "kg/m2";
                $imtscaleresource['valueQuantity']['value']  = floatval($resultexamination[0]->BMI_VALUE);

                $heightresource['category'][]['coding'][]  = $categorycoding;
                $heightresource['code']['coding'][]        = $heightresourcecodecoding;
                $heightresource['effectiveDateTime']       = $resultexamination[0]->assessmentdate."+00:00";
                $heightresource['encounter']               = $encounter;
                $heightresource['identifier'][]            = $identifier1;
                $heightresource['identifier'][]            = $identifier2;
                $heightresource['issued']                  = $resultexamination[0]->assessmentdate."+00:00";
                $heightresource['performer'][]             = $performer;
                $heightresource['resourceType']            = "Observation";
                $heightresource['status']                  = "final";
                $heightresource['subject']                 = $subject;
                $heightresource['valueQuantity']['code']   = "cm";
                $heightresource['valueQuantity']['system'] = "http://unitsofmeasure.org";
                $heightresource['valueQuantity']['unit']   = "cm";
                $heightresource['valueQuantity']['value']  = floatval($resultexamination[0]->HEIGHT_VALUE);

                $weightresource['category'][]['coding'][]  = $categorycoding;
                $weightresource['code']['coding'][]        = $weightresourcecodecoding;
                $weightresource['effectiveDateTime']       = $resultexamination[0]->assessmentdate."+00:00";
                $weightresource['encounter']               = $encounter;
                $weightresource['identifier'][]            = $identifier1;
                $weightresource['identifier'][]            = $identifier2;
                $weightresource['issued']                  = $resultexamination[0]->assessmentdate."+00:00";
                $weightresource['performer'][]             = $performer;
                $weightresource['resourceType']            = "Observation";
                $weightresource['status']                  = "final";
                $weightresource['subject']                 = $subject;
                $weightresource['valueQuantity']['code']   = "kg";
                $weightresource['valueQuantity']['system'] = "http://unitsofmeasure.org";
                $weightresource['valueQuantity']['unit']   = "kg";
                $weightresource['valueQuantity']['value']  = floatval($resultexamination[0]->WEIGHT_VALUE);

                $systolresource['category'][]['coding'][]  = $categorycoding;
                $systolresource['code']['coding'][]        = $systolresourcecodecoding;
                $systolresource['effectiveDateTime']       = $resultexamination[0]->assessmentdate."+00:00";
                $systolresource['encounter']               = $encounter;
                $systolresource['identifier'][]            = $identifier1;
                $systolresource['identifier'][]            = $identifier2;
                $systolresource['issued']                  = $resultexamination[0]->assessmentdate."+00:00";
                $systolresource['performer'][]             = $performer;
                $systolresource['resourceType']            = "Observation";
                $systolresource['status']                  = "final";
                $systolresource['subject']                 = $subject;
                $systolresource['valueQuantity']['code']   = "mm[Hg]";
                $systolresource['valueQuantity']['system'] = "http://unitsofmeasure.org";
                $systolresource['valueQuantity']['unit']   = "mm[Hg]";
                $systolresource['valueQuantity']['value']  = floatval($resultexamination[0]->BLOOD_HIGH_VALUE);

                $diastolresource['category'][]['coding'][]  = $categorycoding;
                $diastolresource['code']['coding'][]        = $diastolresourcecodecoding;
                $diastolresource['effectiveDateTime']       = $resultexamination[0]->assessmentdate."+00:00";
                $diastolresource['encounter']               = $encounter;
                $diastolresource['identifier'][]            = $identifier1;
                $diastolresource['identifier'][]            = $identifier2;
                $diastolresource['issued']                  = $resultexamination[0]->assessmentdate."+00:00";
                $diastolresource['performer'][]             = $performer;
                $diastolresource['resourceType']            = "Observation";
                $diastolresource['status']                  = "final";
                $diastolresource['subject']                 = $subject;
                $diastolresource['valueQuantity']['code']   = "mm[Hg]";
                $diastolresource['valueQuantity']['system'] = "http://unitsofmeasure.org";
                $diastolresource['valueQuantity']['unit']   = "mm[Hg]";
                $diastolresource['valueQuantity']['value']  = floatval($resultexamination[0]->BLOOD_LOW_NOTE);

                $tempresource['category'][]['coding'][]  = $categorycoding;
                $tempresource['code']['coding'][]        = $tempresourcecodecoding;
                $tempresource['effectiveDateTime']       = $resultexamination[0]->assessmentdate."+00:00";
                $tempresource['encounter']               = $encounter;
                $tempresource['identifier'][]            = $identifier1;
                $tempresource['identifier'][]            = $identifier2;
                $tempresource['issued']                  = $resultexamination[0]->assessmentdate."+00:00";
                $tempresource['performer'][]             = $performer;
                $tempresource['resourceType']            = "Observation";
                $tempresource['status']                  = "final";
                $tempresource['subject']                 = $subject;
                $tempresource['valueQuantity']['code']   = "Cel";
                $tempresource['valueQuantity']['system'] = "http://unitsofmeasure.org";
                $tempresource['valueQuantity']['unit']   = "C";
                $tempresource['valueQuantity']['value']  = floatval($resultexamination[0]->TIWEN_VALUE);

                $imtscale['fullUrl']           = "urn:uuid:".generateuuid();
                $imtscale['request']['method'] = "POST";
                $imtscale['request']['url']    = "Observation";
                $imtscale['resource']          = $imtscaleresource;
                $height['fullUrl']             = "urn:uuid:".generateuuid();
                $height['request']['method']   = "POST";
                $height['request']['url']      = "Observation";
                $height['resource']            = $heightresource;
                $weight['fullUrl']             = "urn:uuid:".generateuuid();
                $weight['request']['method']   = "POST";
                $weight['request']['url']      = "Observation";
                $weight['resource']            = $weightresource;
                $systol['fullUrl']             = "urn:uuid:".generateuuid();
                $systol['request']['method']   = "POST";
                $systol['request']['url']      = "Observation";
                $systol['resource']            = $systolresource;
                $diastol['fullUrl']            = "urn:uuid:".generateuuid();
                $diastol['request']['method']  = "POST";
                $diastol['request']['url']     = "Observation";
                $diastol['resource']           = $diastolresource;
                $temp['fullUrl']               = "urn:uuid:".generateuuid();
                $temp['request']['method']     = "POST";
                $temp['request']['url']        = "Observation";
                $temp['resource']              = $tempresource;
                
                $bodyFHIR['resourceType'] = "Bundle";
                $bodyFHIR['type']         = "transaction";
                $bodyFHIR['entry'][]      = $imtscale;
                $bodyFHIR['entry'][]      = $height;
                $bodyFHIR['entry'][]      = $weight;
                $bodyFHIR['entry'][]      = $systol;
                $bodyFHIR['entry'][]      = $diastol;
                $bodyFHIR['entry'][]      = $temp;

                $response = Satusehat::postbundle(json_encode($bodyFHIR));
                if(isset($response['entry'])){
                    foreach($response['entry'] as $a){
                        $simpanlog['ORG_ID']        = $_SESSION['orgid'];
                        $simpanlog['TRANSAKSI_ID']  = generateuuid();
                        $simpanlog['TRANS_ID']      = $resultexamination[0]->TRANSAKSI_ID;
                        $simpanlog['LOCATION']      = $a['response']['location'];
                        $simpanlog['RESOURCE_TYPE'] = $a['response']['resourceType'];
                        $simpanlog['RESOURCE_ID']   = $a['response']['resourceID'];
                        $simpanlog['ETAG']          = $a['response']['etag'];
                        $simpanlog['STATUS']        = $a['response']['status'];
                        $simpanlog['LAST_MODIFIED'] = $a['response']['lastModified'];
                        $simpanlog['JENIS']         = "1";
                        $simpanlog['NOTE']          = "";
                        $simpanlog['ENVIRONMENT']   = "";
                        $simpanlog['CREATED_BY']    = $_SESSION['userid'];

                        $this->md->insertlogsatusehat($simpanlog);
                        $finalresponse [] = $a;
                    } 
                }

                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Berhasil Di Perbaharui";
                $json['responResult']=$response;
                echo json_encode($json);
            }
        }
	}
?>