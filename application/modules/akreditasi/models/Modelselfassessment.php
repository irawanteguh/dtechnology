<?php
    class Modelselfassessment extends CI_Model{
        
        function judulbab($standartid){
            $query =
                    "
                        select a.penilaian_id, penilaian
                        from dt01_akre_standart_ms a
                        where a.active='1'
                        and   a.penilaian_id='".$standartid."'
                        order by penilaian asc
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function judulstandart($standartid){
            $query =
                    "
                        select a.penilaian_id, penilaian, do
                        from dt01_akre_standart_ms a
                        where a.active='1'
                        and   a.penilaian_id='".$standartid."'
                        order by penilaian asc
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function bab(){
            $query =
                    "
                        select a.penilaian_id, penilaian, do, urut,
                            (select count(penilaian_id) from dt01_akre_standart_ms where active='1' and jenis_id='E' and bab_id=a.penilaian_id)jmlelemen
                        from dt01_akre_standart_ms a
                        where a.active='1'
                        and   a.jenis_id='B'
                        order by urut asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function standart($babid){
            $query =
                    "
                        select a.penilaian_id, bab_id, penilaian, do, urut,
                                (select count(penilaian_id) from dt01_akre_standart_ms where active='1' and jenis_id='E' and standart_id=a.penilaian_id)jmlelemen
                        from dt01_akre_standart_ms a
                        where a.active='1'
                        and   a.jenis_id='S'
                        and   a.bab_id='".$babid."'
                        order by urut asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function element($standartid){
            $query =
                    "
                        select a.penilaian_id, bab_id, penilaian, do, urut
                        from dt01_akre_standart_ms a
                        where a.active='1'
                        and   a.jenis_id='E'
                        and   a.standart_id='".$standartid."'
                        order by urut asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function urutstandart($standartid){
            $query =
                    "
                        select count(a.penilaian_id)+1 as jml
                        from dt01_akre_standart_ms a
                        where a.active='1'
                        and   a.jenis_id='S'
                        and   a.bab_id='".$standartid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function urutelement($standartid){
            $query =
                    "
                        select count(a.penilaian_id)+1 as jml
                        from dt01_akre_standart_ms a
                        where a.active='1'
                        and   a.jenis_id='E'
                        and   a.standart_id='".$standartid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function insertpenilian($data){           
            $sql =   $this->db->insert("dt01_akre_standart_ms",$data);
            return $sql;
        }

        
    }
?>