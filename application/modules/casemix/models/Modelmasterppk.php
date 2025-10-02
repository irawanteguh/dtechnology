<?php
    class Modelmasterppk extends CI_Model{

        function masterdatappk(){
            $query =
                    "
                        select a.transaksi_id, name, status,
                            (select color       from dt01_gen_master_ms where jenis_id='PPK_1' and code=a.status)colorstatus,
                            (select master_name from dt01_gen_master_ms where jenis_id='PPK_1' and code=a.status)namestatus
                        from dt01_casemix_ppk_ms a
                        where a.active='1'
                        order by created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function getgroupingidrg($transaksiid){
            $query =
                    "
                        select a.transaksi_id, mdc_number, mdc_description, drg_code, drg_description
                        from dt01_casemix_ppk_ms a
                        where a.active='1'
                        and   a.transaksi_id='".$transaksiid."'
                        order by created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function detaildiagnosappk($ppkid){
            $query =
                    "
                        select a.transaksi_id, icd_code, jenis_id, primary_code, status,
                            (select description from dt01_casemix_icd_ms where code=a.icd_code)description
                        from dt01_casemix_ppk_diag_dt a
                        where a.active='1'
                        and   a.type='IDRG'
                        and   a.ppk_id='".$ppkid."'
                        order by jenis_id asc, primary_code desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function detaildiagnosappkinacbg($ppkid){
            $query =
                    "
                        select a.transaksi_id, icd_code, jenis_id, primary_code, status,
                            (select description from dt01_casemix_icd_ms where code=a.icd_code)description
                        from dt01_casemix_ppk_diag_dt a
                        where a.active='1'
                        and   a.type='INACBG'
                        and   a.ppk_id='".$ppkid."'
                        order by jenis_id asc, primary_code desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function diagnosaset($ppkid){
            $query =
                    "
                        select GROUP_CONCAT(a.icd_code ORDER BY primary_code DESC, icd_code ASC SEPARATOR '#') AS resultdiagnosa
                        from dt01_casemix_ppk_diag_dt a
                        where a.active='1'
                        and   a.jenis_id='1'
                        and   a.ppk_id='".$ppkid."'
                        order by primary_code desc, icd_code asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function procedureset($ppkid){
            $query =
                    "
                        select GROUP_CONCAT(a.icd_code ORDER BY primary_code DESC, icd_code ASC SEPARATOR '#') AS resultprocedure
                        from dt01_casemix_ppk_diag_dt a
                        where a.active='1'
                        and   a.jenis_id='2'
                        and   a.ppk_id='".$ppkid."'
                        order by primary_code desc, icd_code asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function insertdatappk($data){           
            $sql =   $this->db->insert("dt01_casemix_ppk_ms",$data);
            return $sql;
        }

        function updateppk($data,$transaksiid){           
            $sql =   $this->db->update("dt01_casemix_ppk_ms",$data,array("transaksi_id"=>$transaksiid));
            return $sql;
        }

        function updateicd($data,$transaksiid,$icdid){           
            $sql =   $this->db->update("dt01_casemix_ppk_diag_dt",$data,array("ppk_id"=>$transaksiid,"icd_code"=>$icdid));
            return $sql;
        }

        function updateicdinacbg($data,$transaksiid,$icdid){           
            $sql =   $this->db->update("dt01_casemix_ppk_diag_dt",$data,array("TYPE"=>"INACBG","ppk_id"=>$transaksiid,"icd_code"=>$icdid));
            return $sql;
        }

        function updateicdinacbgedit($data,$transaksiid){           
            $sql =   $this->db->update("dt01_casemix_ppk_diag_dt",$data,array("TYPE"=>"INACBG","ppk_id"=>$transaksiid));
            return $sql;
        }

        function insertimport($data){           
            $sql =   $this->db->insert("dt01_casemix_ppk_diag_dt",$data);
            return $sql;
        }

    }
?>