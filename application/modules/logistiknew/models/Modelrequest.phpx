<?php
    class Modelrequest extends CI_Model{
        
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

        function masterbarang($orgid,$nopemesanan,$parameter){
            $query =
                    "
                        SELECT 
                            a.barang_id,
                            a.nama_barang,
                            b.item_id,
                            b.stock,
                            b.qty_minta AS qty,
                            b.qty_req,
                            b.harga,
                            b.ppn,
                            ROUND(b.harga_ppn, 0) AS hargappn,
                            ROUND(b.total, 0) AS total,
                            b.note,
                            satuan_beli.satuan AS satuanbeli,
                            satuan_pakai.satuan AS satuanpakai,
                            jenis.jenis,
                            CASE 
                                WHEN b.item_id IS NULL THEN '0'
                                ELSE '1'
                            END AS status
                        FROM dt01_lgu_barang_ms a
                        LEFT JOIN dt01_lgu_pemesanan_dt b 
                            ON b.org_id = a.org_id 
                            AND b.barang_id = a.barang_id 
                            AND b.no_pemesanan = '".$nopemesanan."'
                        LEFT JOIN dt01_lgu_satuan_ms satuan_beli 
                            ON satuan_beli.satuan_id = a.satuan_beli_id 
                            AND satuan_beli.org_id = a.org_id 
                            AND satuan_beli.active = '1'
                        LEFT JOIN dt01_lgu_satuan_ms satuan_pakai 
                            ON satuan_pakai.satuan_id = a.satuan_pakai_id 
                            AND satuan_pakai.org_id = a.org_id 
                            AND satuan_pakai.active = '1'
                        LEFT JOIN dt01_lgu_jenis_barang_ms jenis 
                            ON jenis.jenis_id = a.jenis_id 
                            AND jenis.org_id = a.org_id 
                            AND jenis.active = '1'
                        WHERE 
                            a.active = '1'
                            AND a.org_id = '".$orgid."'
                            ".$parameter."
                        ORDER BY status DESC, a.nama_barang ASC;

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
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
        
        function datarequest($orgid,$status,$orderby){
            $query =
                    "
                        select a.no_pemesanan, no_spu, no_pemesanan_unit, pettycash_id, judul_pemesanan, note, attachment, attachment_note, supplier_id, invoice, invoice_no, from_department_id, department_id, type, method, status_vice, status_dir, status_com, subtotal, harga_ppn, total, cito, status,
                               date_format(a.created_date, '%d.%m.%Y %H:%i:%s')tglbuat,
                               date_format(a.keu_date, '%d.%m.%Y %H:%i:%s')keudate,
                               date_format(a.wadir_date, '%d.%m.%Y %H:%i:%s')wadirdate,
                               date_format(a.dir_date, '%d.%m.%Y %H:%i:%s')dirdate,
                               (select supplier from dt01_lgu_supplier_ms where org_id=a.org_id and active=a.active and supplier_id=a.supplier_id)namasupplier,
                               (select department from dt01_gen_department_ms where org_id=a.org_id and active=a.active and department_id=a.department_id)unitdituju,
                               (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.created_by)dibuatoleh,
                               (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.keu_id)keuname,
                               (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.wadir_id)wadirname,
                               (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.dir_id)dirname,
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

        function insertheader($data){           
            $sql =   $this->db->insert("dt01_lgu_pemesanan_hd",$data);
            return $sql;
        }

        function updateheader($nopemesanan,$data){           
            $sql =   $this->db->update("dt01_lgu_pemesanan_hd",$data,array("no_pemesanan"=>$nopemesanan));
            return $sql;
        }

        function insertitem($data){           
            $sql =   $this->db->insert("dt01_lgu_pemesanan_dt",$data);
            return $sql;
        }

        function insertstock($data){           
            $sql =   $this->db->insert("dt01_lgu_mutasi_barang",$data);
            return $sql;
        }

        function updateitem($barangid,$nopemesanan,$data){           
            $sql =   $this->db->update("dt01_lgu_pemesanan_dt",$data,array("barang_id"=>$barangid,"no_pemesanan"=>$nopemesanan));
            return $sql;
        }

        function updatestock($transaksiid,$data){           
            $sql =   $this->db->update("dt01_lgu_mutasi_barang",$data,array("transaksi_id"=>$transaksiid));
            return $sql;
        }

        function cekitemid($orgid,$nopemesanan,$barangid){
            $query =
                    "
                        select a.item_id
                        from dt01_lgu_pemesanan_dt a
                        where a.org_id='".$orgid."'
                        and   a.no_pemesanan='".$nopemesanan."'
                        and   a.barang_id='".$barangid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function hitungdetail($orgid,$nopemesanan){
            $query =
                    "
                        select sum((total-harga_ppn))harga, round(sum(harga_ppn),0)harga_ppn, round(sum(total),0)total
                        from dt01_lgu_pemesanan_dt a
                        where a.org_id='".$orgid."'
                        and   a.no_pemesanan='".$nopemesanan."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        

    }
?>