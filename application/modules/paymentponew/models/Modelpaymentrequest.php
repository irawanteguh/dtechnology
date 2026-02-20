<?php
    class Modelpaymentrequest extends CI_Model{

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

        function datapemesanan($orgid,$status,$orderby){
            $query =
                    "
                        select a.no_pemesanan, no_spu, no_pemesanan_unit, pettycash_id, judul_pemesanan, note, attachment, attachment_note, supplier_id, invoice, invoice_no, from_department_id, department_id, type, method methodid, status_vice, status_dir, status_com, subtotal, harga_ppn, total, cito, status, invoice_no, inv_keu_note,
                            date_format(a.created_date, '%d.%m.%Y %H:%i:%s')tglbuat,
                            (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.created_by)dibuatoleh,
                            (select color       from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_2' and code=a.method)colorjenis,
                            (select master_name from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_2' and code=a.method)namejenis,
                            (select color       from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_3' and code=a.status)colorstatus,
                            (select master_name from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_3' and code=a.status)namestatus,
                            (select department from dt01_gen_department_ms where org_id=a.org_id and active=a.active and department_id=a.department_id)unitpelaksana,
                            (select supplier from dt01_lgu_supplier_ms where org_id=a.org_id and active=a.active and supplier_id=a.supplier_id)namasupplier,
                            (select count(item_id) from dt01_lgu_pemesanan_dt where org_id=a.org_id and active=a.active and no_pemesanan=a.no_pemesanan)jmlitem,
                            (select count(item_id) from dt01_lgu_pemesanan_dt where org_id=a.org_id and active=a.active and no_pemesanan=a.no_pemesanan and total=0)itemhargakosong,
                            (select concat(account,' ',account_id) from dt01_keu_rekening_ms where org_id=a.org_id and rekening_id=a.rekening_id)rekening,

                            (select sum(subtotal) from dt01_lgu_penerimaan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan)subtotalterima,
                            (select sum(harga_ppn) from dt01_lgu_penerimaan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan)hargappnterima,
                            (select sum(total) from dt01_lgu_penerimaan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan)totalterima
                            

                        from dt01_lgu_pemesanan_hd a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        ".$status."
                        ".$orderby."
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        // function datarequest($orgid,$status,$orderby){
        //     $query =
        //             "
        //                 select a.no_pemesanan, no_spu, no_pemesanan_unit, pettycash_id, judul_pemesanan, note, attachment, attachment_note, supplier_id, invoice, invoice_no, from_department_id, department_id, type, method, status_vice, status_dir, status_com, subtotal, harga_ppn, total, cito, status, inv_keu_note,
        //                        date_format(a.inv_kains_date, '%d.%m.%Y %H:%i:%s')tglbuat,
        //                        date_format(a.inv_keu_date, '%d.%m.%Y %H:%i:%s')tglkeuangan,
        //                        date_format(a.inv_vice_date, '%d.%m.%Y %H:%i:%s')tglvice,
        //                        date_format(a.inv_dir_date, '%d.%m.%Y %H:%i:%s')tgldir,
        //                        date_format(a.payment_date, '%d.%m.%Y %H:%i:%s')tgldibayar,
        //                        (select supplier from dt01_lgu_supplier_ms where org_id=a.org_id and active=a.active and supplier_id=a.supplier_id)namasupplier,
        //                        (select department from dt01_gen_department_ms where org_id=a.org_id and active=a.active and department_id=a.department_id)unitdituju,
        //                        (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.inv_kains_id)dibuatoleh,
        //                        (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.inv_keu_id)disetujuikeuoleh,
        //                        (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.inv_vice_id)vicename,
        //                        (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.inv_dir_id)dirname,
        //                        (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.payment_id)dibayarkanoleh,
        //                        (select color from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_1' and code=a.status)colorstatus,
        //                        (select master_name from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_1' and code=a.status)namestatus,
        //                        (select count(item_id) from dt01_lgu_pemesanan_dt where org_id=a.org_id and active=a.active and no_pemesanan=a.no_pemesanan)jmlitem,
        //                        (select sum(total) from dt01_lgu_pemesanan_dt where org_id=a.org_id and active=a.active and no_pemesanan=a.no_pemesanan)itemhargakosong

        //                 from dt01_lgu_pemesanan_hd a
        //                 where a.org_id='".$orgid."'
        //                 and   a.active='1'
        //                 ".$status."
        //                 ".$orderby."
        //             ";

        //     $recordset = $this->db->query($query);
        //     $recordset = $recordset->result();
        //     return $recordset;
        // }

        // function updateheader($nopemesanan,$data){           
        //     $sql =   $this->db->update("dt01_lgu_pemesanan_hd",$data,array("no_pemesanan"=>$nopemesanan));
        //     return $sql;
        // }

        // function detailbarangpemesanan($orgid,$nopemesanan){
        //     $query =
        //             "
        //                 select a.item_id, barang_id, note, stock, qty_req, qty_req_manager, qty_minta, qty_manager, qty_keu, qty_wadir, qty_dir, harga, harga_ppn, ppn, total,
        //                     (select satuan from dt01_lgu_satuan_ms where active='1' and org_id=a.org_id and satuan_id=(select satuan_beli_id from dt01_lgu_barang_ms where org_id=a.org_id and barang_id=a.barang_id))satuanbeli,
        //                     (select satuan from dt01_lgu_satuan_ms where active='1' and org_id=a.org_id and satuan_id=(select satuan_pakai_id from dt01_lgu_barang_ms where org_id=a.org_id and barang_id=a.barang_id))satuanpakai,
        //                     (select jenis from dt01_lgu_jenis_barang_ms where active='1' and org_id=a.org_id and jenis_id=(select jenis_id from dt01_lgu_barang_ms where org_id=a.org_id and barang_id=a.barang_id))jenis,
        //                     (select nama_barang from dt01_lgu_barang_ms where org_id=a.org_id and barang_id=a.barang_id)namabarang,
        //                     (select coalesce(sum(masuk),0) from dt01_lgu_mutasi_barang where org_id=a.org_id and no_pemesanan=a.no_pemesanan and barang_id=a.barang_id)jmlmasuk,
        //                     (select name from dt01_gen_user_data where org_id=a.org_id and user_id=(select created_by from dt01_lgu_pemesanan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan))createdby,
        //                     (select name from dt01_gen_user_data where org_id=a.org_id and user_id=(select manager_id from dt01_lgu_pemesanan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan))manager

        //                 from dt01_lgu_pemesanan_dt a
        //                 where a.org_id='".$orgid."'
        //                 and   a.no_pemesanan='".$nopemesanan."'
        //                 and   a.active='1'
        //                 order by namabarang asc
        //             ";

        //     $recordset = $this->db->query($query);
        //     $recordset = $recordset->result();
        //     return $recordset;
        // }

    }
?>