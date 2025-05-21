<?php
    class Modelpaymentmanager extends CI_Model{
        
        function datarequest($orgid,$status,$parameter){
            $query =
                    "
                        select a.no_pemesanan, no_spu, no_pemesanan_unit, pettycash_id, judul_pemesanan, note, attachment, attachment_note, supplier_id, invoice, invoice_no, from_department_id, department_id, type, method, subtotal, harga_ppn, total, cito, status, date_format(a.created_date, '%d.%m.%Y %H:%i:%s')tglbuat,
                            (select supplier from dt01_lgu_supplier_ms where org_id=a.org_id and active=a.active and supplier_id=a.supplier_id)namasupplier,
                            (select department from dt01_gen_department_ms where org_id=a.org_id and active=a.active and department_id=a.from_department_id)unit,
                            (select department from dt01_gen_department_ms where org_id=a.org_id and active=a.active and department_id=a.department_id)unitdituju,
                            (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.created_by)dibuatoleh,
                            (select count(item_id) from dt01_lgu_pemesanan_dt where org_id=a.org_id and active=a.active and no_pemesanan=a.no_pemesanan)jmlitem,
                            (select color from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_1' and code=a.status)colorstatus,
                            (select master_name from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_1' and code=a.status)namestatus,
                            (select transaksi_id from dt01_keu_petty_cash_it where org_id=a.org_id and active=a.active and no_pemesanan=a.no_pemesanan order by created_date desc limit 1)transaksiid,
                            (select no_kwitansi from dt01_keu_petty_cash_it where org_id=a.org_id and active=a.active and transaksi_id=a.pettycash_id)nokwitansi,
                            (select no_kwitansi from dt01_keu_petty_cash_it where org_id=a.org_id and active=a.active and no_pemesanan=a.no_pemesanan order by created_date desc limit 1)lastnokwitansi,
                            (select cash_out from dt01_keu_petty_cash_it where org_id=a.org_id and active=a.active and transaksi_id=a.pettycash_id)cashout

                        from dt01_lgu_pemesanan_hd a
                        where a.org_id='".$orgid."'
                        ".$status."
                        and   a.active='1'
                        ".$parameter."
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function nokwitansi($orgid){
            $query =
                    "
                        select concat(
                                        
                                        lpad(
                                            coalesce(
                                                (
                                                    select COUNT(transaksi_id)+1
                                                    from dt01_keu_petty_cash_it
                                                    where org_id='".$orgid."'
                                                    and   date_format(created_date, '%Y') = date_format(current_date, '%Y')
                                                ),
                                                1
                                            ),
                                            3,
                                            '0'
                                        ),
                                        '/CASH/KEU/',
                                        date_format(now(), '%m'),
                                        '/',
                                        date_format(now(), '%Y')
                                ) nokwitansi

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }
        
        function checkbalancelast($orgid){
            $query =
                    "
                        select a.balance
                        from dt01_keu_petty_cash_it a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by created_date desc
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function detailbarangspu($orgid,$nopemesanan){
            $query =
                    "
                        select a.item_id, barang_id, note, stock, qty_req, qty_minta, qty_manager, qty_keu, qty_wadir, qty_dir, harga, harga_ppn, ppn, total,
                            (select satuan from dt01_lgu_satuan_ms where active='1' and org_id=a.org_id and satuan_id=(select satuan_beli_id from dt01_lgu_barang_ms where org_id=a.org_id and barang_id=a.barang_id))satuanbeli,
                            (select satuan from dt01_lgu_satuan_ms where active='1' and org_id=a.org_id and satuan_id=(select satuan_pakai_id from dt01_lgu_barang_ms where org_id=a.org_id and barang_id=a.barang_id))satuanpakai,
                            (select jenis from dt01_lgu_jenis_barang_ms where active='1' and org_id=a.org_id and jenis_id=(select jenis_id from dt01_lgu_barang_ms where org_id=a.org_id and barang_id=a.barang_id))jenis,
                            (select nama_barang from dt01_lgu_barang_ms where org_id=a.org_id and barang_id=a.barang_id)namabarang,
                            (select coalesce(sum(masuk),0) from dt01_lgu_mutasi_barang where org_id=a.org_id and no_pemesanan=a.no_pemesanan and barang_id=a.barang_id)jmlmasuk,
                            (select name from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=(select created_by from dt01_lgu_pemesanan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan))createdby,
                            (select name from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=(select manager_id from dt01_lgu_pemesanan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan))manager

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

        function insertheader($data){           
            $sql =   $this->db->insert("dt01_lgu_pemesanan_hd",$data);
            return $sql;
        }

        function insertpettycash($data){           
            $sql =   $this->db->insert("dt01_keu_petty_cash_it",$data);
            return $sql;
        }

    }
?>