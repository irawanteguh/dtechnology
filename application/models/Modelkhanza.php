<?php
    class Modelkhanza extends CI_Model{

        function datapegawai(){
            $query =
                    "
                        select a.no_ktp, mulai_kontrak, alamat, nik, nama, CASE WHEN jk = 'Pria' THEN 'L' ELSE 'P' END sexid, CASE WHEN stts_aktif = 'AKTIF' THEN 'N' ELSE 'Y' END susspended
                        from pegawai a
                        where a.nik not in (select nik from dt01_gen_user_data)
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function checkdata($orgid,$nik){
            $query =
                    "
                        select a.nik
                        from dt01_gen_user_data a
                        where a.org_id='".$orgid."'
                        and   a.nik='".$nik."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertdatauser($data){           
            $sql =   $this->db->insert("dt01_gen_user_data",$data);
            return $sql;
        }

        function updatedatauser($data,$nik){           
            $sql =   $this->db->update("dt01_gen_user_data",$data,array("nik"=>$nik));
            return $sql;
        }
        
    }
?>