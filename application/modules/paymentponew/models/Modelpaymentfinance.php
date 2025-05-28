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
                        select a.no_pemesanan, no_spu, no_pemesanan_unit, pettycash_id, judul_pemesanan, note, attachment, attachment_note, supplier_id, invoice, invoice_no, from_department_id, department_id, type, method, status_vice, status_dir, status_com, subtotal, harga_ppn, total, cito, status, inv_keu_note,
                               date_format(a.created_date, '%d.%m.%Y %H:%i:%s')tglorder,
                               date_format(a.inv_manager_date, '%d.%m.%Y %H:%i:%s')tglbuat,
                               date_format(a.inv_keu_date, '%d.%m.%Y %H:%i:%s')tglkeuangan,
                               date_format(a.payment_date, '%d.%m.%Y %H:%i:%s')tgldibayar,
                               date_format(a.inv_dir_date, '%d.%m.%Y %H:%i:%s')tgldir,
                               (select supplier from dt01_lgu_supplier_ms where org_id=a.org_id and active=a.active and supplier_id=a.supplier_id)namasupplier,
                               (select department from dt01_gen_department_ms where org_id=a.org_id and active=a.active and department_id=a.department_id)unitdituju,
                               (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.inv_manager_id)dibuatoleh,
                               (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.inv_keu_id)disetujuikeuoleh,
                               (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.payment_id)dibayarkanoleh,
                               (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.inv_dir_id)namadir,
                               (select color from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_1' and code=a.status)colorstatus,
                               (select master_name from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_1' and code=a.status)namestatus,
                               (select count(item_id) from dt01_lgu_pemesanan_dt where org_id=a.org_id and active=a.active and no_pemesanan=a.no_pemesanan)jmlitem,
                               (select sum(total) from dt01_lgu_pemesanan_dt where org_id=a.org_id and active=a.active and no_pemesanan=a.no_pemesanan)itemhargakosong,
                               (select concat(account,' ',account_id) from dt01_keu_rekening_ms where org_id=a.org_id and rekening_id=a.rekening_id)rekening

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

        function detailbarangpemesanan($orgid,$nopemesanan){
            $query =
                    "
                        select a.item_id, barang_id, note, stock, qty_req, qty_req_manager, qty_minta, qty_manager, qty_keu, qty_wadir, qty_dir, harga, harga_ppn, ppn, total,
                            (select satuan from dt01_lgu_satuan_ms where active='1' and org_id=a.org_id and satuan_id=(select satuan_beli_id from dt01_lgu_barang_ms where org_id=a.org_id and barang_id=a.barang_id))satuanbeli,
                            (select satuan from dt01_lgu_satuan_ms where active='1' and org_id=a.org_id and satuan_id=(select satuan_pakai_id from dt01_lgu_barang_ms where org_id=a.org_id and barang_id=a.barang_id))satuanpakai,
                            (select jenis from dt01_lgu_jenis_barang_ms where active='1' and org_id=a.org_id and jenis_id=(select jenis_id from dt01_lgu_barang_ms where org_id=a.org_id and barang_id=a.barang_id))jenis,
                            (select nama_barang from dt01_lgu_barang_ms where org_id=a.org_id and barang_id=a.barang_id)namabarang,
                            (select coalesce(sum(masuk),0) from dt01_lgu_mutasi_barang where org_id=a.org_id and no_pemesanan=a.no_pemesanan and barang_id=a.barang_id)jmlmasuk,
                            (select name from dt01_gen_user_data where org_id=a.org_id and user_id=(select created_by from dt01_lgu_pemesanan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan))createdby,
                            (select name from dt01_gen_user_data where org_id=a.org_id and user_id=(select manager_id from dt01_lgu_pemesanan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan))manager

                        from dt01_lgu_pemesanan_dt a
                        where a.org_id='".$orgid."'
                        and   a.no_pemesanan='".$nopemesanan."'
                        and   a.active='1'
                        order by namabarang asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
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

        function updateheader($nopemesanan,$data){           
            $sql =   $this->db->update("dt01_lgu_pemesanan_hd",$data,array("no_pemesanan"=>$nopemesanan));
            return $sql;
        }

        function insertrekening($data){           
            $sql =   $this->db->insert("dt01_keu_rekening_it",$data);
            return $sql;
        }

    }
?>