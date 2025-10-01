<?php
    class Modelmasterppk extends CI_Model{

        function masterppk(){
            $query =
                    "
                        select a.transaksi_id, name
                        from dt01_casemix_ppk_ms a
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function detaildiagnosappk($ppkid){
            $query =
                    "
                        select a.transaksi_id, icd_code, jenis_id, primary_code,
                            (select description from dt01_casemix_icd_ms where code=a.icd_code)description
                        from dt01_casemix_ppk_diag_dt a
                        where a.active='1'
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

    }
?>