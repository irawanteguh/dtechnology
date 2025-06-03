<?php
    class Modelmcu extends CI_Model{
        
        function rekening($orgid){
            $query =
                    "
                        select a.rekening_id, concat(account,' ',account_id)keterangan
                        from dt01_keu_rekening_ms a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        order by account asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

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

        function masterunit($orgid,$parameter){
            $query =
                    "
                        select a.department_id, department
                        from dt01_gen_department_ms a
                        where a.org_id='".$orgid."'
                        ".$parameter."
                        and   a.active='1'
                        order by department asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }
        
        function nokwitansi($orgid,$rekeningid){
            $query =
                    "
                        select concat(                              
                            lpad(
                                coalesce(
                                    (
                                        select COUNT(transaksi_id)+1
                                        from dt01_keu_rekening_it
                                        where org_id='".$orgid."'
                                        and   rekening_id='".$rekeningid."'
                                        and   date_format(created_date, '%Y') = date_format(current_date, '%Y')
                                    ),
                                    1
                                ),
                                3,
                                '0'
                            ),
                            '/',(select code from dt01_keu_rekening_ms where rekening_id='".$rekeningid."'),'/KEU/',
                            date_format(now(), '%m'),
                            '/',
                            date_format(now(), '%Y')
                    ) nokwitansi

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function checkbalancelast($orgid,$rekeningid){
            $query =
                    "
                        select a.balance
                        from dt01_keu_rekening_it a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.rekening_id='".$rekeningid."'
                        order by created_date desc
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function datapiutang($orgid){
            $query =
                    "
                        select x.*,
                            nilai-jmlterbayar sisa
                        from(
                            select a.piutang_id, no_tagihan, rekanan_id, date_format(a.date, '%d.%m.%Y')tgldate, note, nilai,
                                (select provider from dt01_keu_provider_ms where org_id=a.org_id and provider_id=a.rekanan_id)rekanan,
                                (select coalesce(sum(nominal),0) from dt01_keu_piutang_it where org_id=a.org_id and piutang_id=a.piutang_id)jmlterbayar
                            from dt01_keu_piutang_hd a
                            where a.active='1'
                            and   a.org_id='".$orgid."'
                            and   a.jenis_id='2'
                            order by rekanan asc, date asc
                        )x
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertpiutang($data){           
            $sql =   $this->db->insert("dt01_keu_piutang_hd",$data);
            return $sql;
        }

        function insertrekening($data){           
            $sql =   $this->db->insert("dt01_keu_rekening_it",$data);
            return $sql;
        }

    }
?>