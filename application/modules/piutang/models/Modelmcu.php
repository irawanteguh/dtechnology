<?php
    class Modelmcu extends CI_Model{
        
        function provider($orgid){
            $query =
                    "
                        select a.provider_id, provider
                        from dt01_keu_provider_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by provider asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function datapiutang($orgid){
            $query =
                    "
                        select a.piutang_id, no_tagihan, rekanan_id, date_format(a.date, '%d.%m.%Y')tgldate, note, nilai,
                            (select provider from dt01_keu_provider_ms where org_id=a.org_id and provider_id=a.rekanan_id)rekanan
                        from dt01_keu_piutang_hd a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.jenis_id='2'
                        order by rekanan asc, date asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertpiutang($data){           
            $sql =   $this->db->insert("dt01_keu_piutang_hd",$data);
            return $sql;
        }

    }
?>