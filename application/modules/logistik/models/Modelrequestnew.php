<?php
    class Modelrequestnew extends CI_Model{
        
        function mastersupplier($orgid){
            $query =
                    "
                        select a.supplier_id, supplier
                        from dt01_lgu_supplier_ms a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        order by supplier asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function paymentmethod(){
            $query =
                    "
                        select '1'id, 'Invoice' metod union
                        select '2'id, 'Cash / Bon' metod union
                        select '3'id, 'Invoice dan Cash / Bon' metod union
                        select '4'id, 'On The Spot (BBM / Snack / Etc)' metod
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

        function transaksipettycash($orgid,$departmentid){
            $query =
                    "
                        select x.*
                        from(
                        select a.transaksi_id, no_kwitansi, note, cash_out,
                            (select department from dt01_gen_department_ms where org_id=a.org_id and active=a.active and department_id=a.department_id)unit,
                            (select no_pemesanan from dt01_keu_petty_cash_it where org_id=a.org_id and active=a.active and ref_pettycash_id=a.transaksi_id order by created_date desc limit 1)refnopemesanan
                        from dt01_keu_petty_cash_it a
                        where a.org_id='".$orgid."'
                        and   a.department_id='".$departmentid."'
                        and   a.active='1'
                        and   a.cash_out<>0
                        and   a.status='6'
                        and   a.ref_pettycash_id is null
                        )x
                        where x.refnopemesanan is null
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function buatnopemesanan($orgid,$departmentid,$parameter){
            $query =
                    "
                        select concat(
                                        lpad(
                                            coalesce(
                                                (
                                                    select COUNT(no_pemesanan)+1
                                                    from dt01_lgu_pemesanan_hd
                                                    where org_id='".$orgid."'
                                                    and   department_id='".$departmentid."'
                                                    ".$parameter."
                                                    and   DATE_FORMAT(created_date, '%Y') = DATE_FORMAT(CURRENT_DATE, '%Y')
                                                ),
                                                1
                                            ),
                                            3,
                                            '0'
                                        ),
                                        '/',
                                        COALESCE(
                                                    (
                                                        select code
                                                        from dt01_gen_department_ms
                                                        where org_id='".$orgid."'
                                                        and   department_id='".$departmentid."'
                                                    ),
                                                    'XXX'
                                        ),
                                        '/',
                                        DATE_FORMAT(NOW(), '%m'),
                                        '/',
                                        DATE_FORMAT(NOW(), '%Y')
                                ) nomor_pemesanan

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function checkmanagerid($orgid,$departmentid){
            $query =
                    "
                        select a.user_id 
                        from dt01_gen_department_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.department_id=(
                                                select a.header_id
                                                from dt01_gen_department_ms a
                                                where a.active='1'
                                                and   a.org_id='".$orgid."'
                                                and   a.department_id='".$departmentid."'
                                            )

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function datarequest($orgid,$status){
            $query =
                    "
                        select a.no_pemesanan, no_spu, no_pemesanan_unit, pettycash_id, judul_pemesanan, note, attachment, attachment_note, supplier_id, invoice, invoice_no, from_department_id, department_id, type, method, status_vice, status_dir, status_com, subtotal, harga_ppn, total, cito, status, date_format(a.created_date, '%d.%m.%Y %H:%i:%s')tglbuat,
                            (select supplier from dt01_lgu_supplier_ms where org_id=a.org_id and active=a.active and supplier_id=a.supplier_id)namasupplier,
                            (select department from dt01_gen_department_ms where org_id=a.org_id and active=a.active and department_id=a.from_department_id)unit,
                            (select department from dt01_gen_department_ms where org_id=a.org_id and active=a.active and department_id=a.department_id)unitdituju,
                            (select name from dt01_gen_user_data where org_id=a.org_id and active=a.active and user_id=a.created_by)dibuatoleh,
                            (select count(item_id) from dt01_lgu_pemesanan_dt where org_id=a.org_id and active=a.active and no_pemesanan=a.no_pemesanan)jmlitem,
                            (select color from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_1' and code=a.status)colorstatus,
                            (select master_name from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_1' and code=a.status)namestatus,
                            (select transaksi_id from dt01_keu_petty_cash_it where org_id=a.org_id and active=a.active and transaksi_id=a.pettycash_id)transaksiid,
                            (select no_kwitansi from dt01_keu_petty_cash_it where org_id=a.org_id and active=a.active and transaksi_id=a.pettycash_id)nokwitansi

                        from dt01_lgu_pemesanan_hd a
                        where a.org_id='".$orgid."'
                        ".$status."
                        and   a.active='1'
                        order by created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function detailbarangspu($orgid,$nopemesanan){
            $query =
                    "
                        select a.item_id, barang_id, note, stock, qty_req, qty_req_manager, qty_minta, qty_manager, qty_keu, qty_wadir, qty_dir, harga, harga_ppn, ppn, total,
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

        function updateheader($nopemesanan,$data){           
            $sql =   $this->db->update("dt01_lgu_pemesanan_hd",$data,array("no_pemesanan"=>$nopemesanan));
            return $sql;
        }

    }
?>