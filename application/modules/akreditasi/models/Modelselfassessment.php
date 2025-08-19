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

        function judulelement($standartid){
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

        function bab($orgid){
            $query =
                    "
                        select x.*,
                               IFNULL(
                                    ROUND(
                                        (IFNULL(elementterisi,0) / NULLIF(jmlelemen,0)) * 100
                                    ,2)
                                ,0) AS presentasi

                        from(
                        select a.penilaian_id, penilaian, do, urut,
                            (select count(penilaian_id) from dt01_akre_standart_ms where active='1' and jenis_id='E' and bab_id=a.penilaian_id)jmlelemen,
                            (select count(distinct(element_id)) from dt01_akre_document_hd where active='1' and org_id='".$orgid."' and bab_id=a.penilaian_id)elementterisi,
                            (select count(transaksi_id) from dt01_akre_document_hd where active='1' and org_id='".$orgid."' and bab_id=a.penilaian_id)jmldocument
                        from dt01_akre_standart_ms a
                        where a.active='1'
                        and   a.jenis_id='B'
                        )x
                        order by urut asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function standart($orgid,$babid){
            $query =
                    "
                        select a.penilaian_id, bab_id, penilaian, do, urut,
                                (select count(penilaian_id) from dt01_akre_standart_ms where active='1' and jenis_id='E' and standart_id=a.penilaian_id)jmlelemen,
                                (select count(distinct(element_id)) from dt01_akre_document_hd where active='1' and org_id='".$orgid."' and standart_id=a.penilaian_id)elementterisi,
                                (select count(transaksi_id) from dt01_akre_document_hd where active='1' and org_id='".$orgid."' and standart_id=a.penilaian_id)jmldocument
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

        function element($orgid,$standartid){
            $query =
                    "
                         select a.penilaian_id, bab_id, standart_id, element_id, penilaian, do, urut,
                                (select count(distinct(element_id)) from dt01_akre_document_hd where active='1' and org_id='".$orgid."' and element_id=a.penilaian_id)elementterisi,
                                (select count(transaksi_id) from dt01_akre_document_hd where active='1' and org_id='".$orgid."' and element_id=a.penilaian_id)jmldocument,
                                (
                                    SELECT GROUP_CONCAT(b.penilaian SEPARATOR ';') 
                                    FROM dt01_akre_standart_ms b
                                    WHERE b.jenis_id = 'SE'
                                    AND b.element_id = a.penilaian_id
                                    AND b.active = '1'
                                    order by urut asc
                                ) AS subelement
                            
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

        function listdokument($orgid,$elementid){
            $query =
                    "
                        select a.transaksi_id, judul, catatan,
                               date_format(a.created_date,'%d.%m.%Y %H:%i:%s')tgldibuat,
                               (select name from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.created_by)dibuatoleh
                        from dt01_akre_document_hd a
                        where a.active='1'
                        and a.org_id='".$orgid."'
                        and   a.element_id='".$elementid."'
                        order by created_date desc
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

        function urutsubelement($standartid){
            $query =
                    "
                        select count(a.penilaian_id)+1 as jml
                        from dt01_akre_standart_ms a
                        where a.active='1'
                        and   a.jenis_id='SE'
                        and   a.element_id='".$standartid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function insertpenilian($data){           
            $sql =   $this->db->insert("dt01_akre_standart_ms",$data);
            return $sql;
        }

        function insertdocument($data){           
            $sql =   $this->db->insert("dt01_akre_document_hd",$data);
            return $sql;
        }

        
    }
?>