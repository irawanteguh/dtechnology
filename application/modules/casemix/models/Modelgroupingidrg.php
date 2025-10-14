<?php
    class Modelgroupingidrg extends CI_Model{

        function dataklaim(){
            $query =
                    "
                        select date_format(a.tgl_masuk, '%d.%m.%Y %H:%i:%s')tglmasuk,
                            date_format(a.tgl_pulang, '%d.%m.%Y %H:%i:%s')tglpulang,
                            no_sep, nama_pasien, no_rm,
                            CASE 
                                WHEN a.jenis_rawat = 1 THEN 'Rawat Inap'
                                WHEN a.jenis_rawat = 2 THEN 'Rawat Jalan'
                                WHEN a.jenis_rawat = 3 THEN 'IGD'
                                ELSE 'Tidak Diketahui'
                            END AS jenisrawat,
                            (select color       from dt01_gen_master_ms where jenis_id='PPK_1' and code=a.status)colorstatus,
                            (select master_name from dt01_gen_master_ms where jenis_id='PPK_1' and code=a.status)namestatus,
                            PROSEDUR_NON_BEDAH+PROSEDUR_BEDAH+KONSULTASI+TENAGA_AHLI+KEPERAWATAN+PENUNJANG+RADIOLOGI+LABORATORIUM+PELAYANAN_DARAH+REHABILITASI+KAMAR+RAWAT_INTENSIF+OBAT+OBAT_KRONIS+OBAT_KEMOTERAPI+ALKES+BMHP+SEWA_ALAT totalbillingrs
                        from dt01_casemix_claim_idrg a
                        order by tgl_masuk asc, jenis_rawat asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function pencariandataklaim($transaksiid){
            $query =
                    "
                        select a.*
                        from dt01_casemix_claim_idrg a
                        where a.transaksi_id='".$transaksiid."'
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function insertclaim($data){           
            $sql =   $this->db->insert("dt01_casemix_claim_idrg",$data);
            return $sql;
        }

        function updateclaim($data,$transaksiid){           
            $sql =   $this->db->update("dt01_casemix_claim_idrg",$data,array("transaksi_id"=>$transaksiid));
            return $sql;
        }


    }
?>