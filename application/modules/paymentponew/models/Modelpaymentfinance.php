<?php
    class Modelpaymentfinance extends CI_Model{
        
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

        function datarequest($orgid,$status,$orderby){
            $query =
                    "
                        select a.no_pemesanan, no_spu, no_pemesanan_unit, pettycash_id, judul_pemesanan, note, attachment, attachment_note, supplier_id, invoice, invoice_no, from_department_id, department_id, type, method, status_vice, status_dir, status_com, subtotal, harga_ppn, total, cito, status,
                               date_format(a.inv_manager_date, '%d.%m.%Y %H:%i:%s')tglbuat,
                               date_format(a.inv_keu_date, '%d.%m.%Y %H:%i:%s')tglkeuangan,
                               date_format(a.payment_date, '%d.%m.%Y %H:%i:%s')tgldibayar,
                               (select supplier from dt01_lgu_supplier_ms where org_id=a.org_id and active=a.active and supplier_id=a.supplier_id)namasupplier,
                               (select department from dt01_gen_department_ms where org_id=a.org_id and active=a.active and department_id=a.department_id)unitdituju,
                               (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.inv_manager_id)dibuatoleh,
                               (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.inv_keu_id)disetujuikeuoleh,
                               (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.payment_id)dibayarkanoleh,
                               (select color from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_1' and code=a.status)colorstatus,
                               (select master_name from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_1' and code=a.status)namestatus,
                               (select count(item_id) from dt01_lgu_pemesanan_dt where org_id=a.org_id and active=a.active and no_pemesanan=a.no_pemesanan)jmlitem,
                               (select sum(total) from dt01_lgu_pemesanan_dt where org_id=a.org_id and active=a.active and no_pemesanan=a.no_pemesanan)itemhargakosong

                        from dt01_lgu_pemesanan_hd a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        ".$status."
                        ".$orderby."
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updateheader($nopemesanan,$data){           
            $sql =   $this->db->update("dt01_lgu_pemesanan_hd",$data,array("no_pemesanan"=>$nopemesanan));
            return $sql;
        }

    }
?>