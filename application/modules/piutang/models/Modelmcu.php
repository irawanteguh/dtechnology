<?php
    class Modelmcu extends CI_Model{
        
        function datapiutang($orgid){
            $query =
                    "
                        select a.piutang_id, no_tagihan, rekanan_id, date_format(a.created_date, '%d.%m.%Y %H:%i:%s')createddate, note, nilai,
                            (select provider from dt01_keu_provider_ms where org_id=a.org_id and provider_id=a.rekanan_id)rekanan
                        from dt01_keu_piutang_hd a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.jenis_id='2'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>