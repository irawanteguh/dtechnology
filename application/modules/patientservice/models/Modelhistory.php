<?php
    class Modelhistory extends CI_Model{

        function daftaralergipasien(){
            $query =
                    "
                        select a.alergi
                        from catatan_pasien a
                        where a.alergi<>''
                        and   a.alergi<>'-'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function soapie(){
            $query =
                    "
                        select a.*,
                               (select nama from pegawai where nik=a.nip)nama
                        from pemeriksaan_ranap a
                        where a.no_rawat='2024/11/10/000080'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>