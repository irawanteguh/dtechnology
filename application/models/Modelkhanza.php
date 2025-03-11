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

        function datapasien(){
            $query =
                    "
                        select a.no_rkm_medis, nm_pasien, no_ktp, jk, tmp_lahir, tgl_lahir, nm_ibu, email, no_tlp
                        from pasien a
                        where a.no_rkm_medis not in (select int_pasien_id_old from dt01_gen_pasien_ms)
                        limit 100;
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

        function cekdatapasien($orgid,$mrpasien){
            $query =
                    "
                        select a.int_pasien_id
                        from dt01_gen_pasien_ms a
                        where a.org_id='".$orgid."'
                        and   a.int_pasien_id='".$mrpasien."'
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

        function insertdatapasien($data){           
            $sql =   $this->db->insert("dt01_gen_pasien_ms",$data);
            return $sql;
        }

        function updatedatapasien($data,$mrpasien){           
            $sql =   $this->db->update("dt01_gen_pasien_ms",$data,array("int_pasien_id"=>$mrpasien));
            return $sql;
        }
        
    }
?>