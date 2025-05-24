<?php
    class Modelspu extends CI_Model{
        
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

        function buatnopemesanan($orgid,$departmentid,$parameter){
            $query =
                    "
                        select concat(
                                        'SPU/',
                                        lpad(
                                            coalesce(
                                                (
                                                    select COUNT(no_pemesanan)+1
                                                    from dt01_lgu_pemesanan_hd
                                                    where org_id='".$orgid."'
                                                    and   from_department_id='".$departmentid."'
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

        function datarequest($orgid,$status){
            $query =
                    "
                        select a.no_pemesanan, no_spu, no_pemesanan_unit, judul_pemesanan, note, attachment, attachment_note, from_department_id, subtotal, harga_ppn, total, cito, status, date_format(a.created_date, '%d.%m.%Y %H:%i:%s')tglbuat,
                            (select department from dt01_gen_department_ms where org_id=a.org_id and active=a.active and department_id=a.from_department_id)unit,
                            (select department from dt01_gen_department_ms where org_id=a.org_id and active=a.active and department_id=a.department_id)unitdituju,
                            (select name from dt01_gen_user_data where org_id=a.org_id and active=a.active and user_id=a.created_by)dibuatoleh,
                            (select count(item_id) from dt01_lgu_pemesanan_dt where org_id=a.org_id and active=a.active and no_pemesanan=a.no_pemesanan)jmlitem,
                            (select color from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_1' and code=a.status)colorstatus,
                            (select master_name from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_1' and code=a.status)namestatus
                        from dt01_lgu_pemesanan_hd a
                        where a.org_id='".$orgid."'
                        ".$status."
                        and   a.active='1'
                        and   a.type='20'
                        order by created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        // function masterbarang($orgid,$nopemesanan,$parameter){
        //     $query =
        //             "
        //                 select x.*,
        //                     case 
        //                         when x.itemid is null then
        //                         '0' 
        //                         else
        //                         '1' 
        //                     end as status
        //                 from(
        //                     select a.barang_id,nama_barang,
        //                         (select item_id            from dt01_lgu_pemesanan_dt where org_id=a.org_id and barang_id=a.barang_id and no_pemesanan='".$nopemesanan."')itemid,
        //                         (select stock              from dt01_lgu_pemesanan_dt where org_id=a.org_id and barang_id=a.barang_id and no_pemesanan='".$nopemesanan."')stock,
        //                         (select qty_minta          from dt01_lgu_pemesanan_dt where org_id=a.org_id and barang_id=a.barang_id and no_pemesanan='".$nopemesanan."')qty,
        //                         (select qty_req            from dt01_lgu_pemesanan_dt where org_id=a.org_id and barang_id=a.barang_id and no_pemesanan='".$nopemesanan."')qtyreq,
        //                         (select harga              from dt01_lgu_pemesanan_dt where org_id=a.org_id and barang_id=a.barang_id and no_pemesanan='".$nopemesanan."')harga,
        //                         (select ppn                from dt01_lgu_pemesanan_dt where org_id=a.org_id and barang_id=a.barang_id and no_pemesanan='".$nopemesanan."')ppn,
        //                         (select round(harga_ppn,0) from dt01_lgu_pemesanan_dt where org_id=a.org_id and barang_id=a.barang_id and no_pemesanan='".$nopemesanan."')hargappn,
        //                         (select round(total,0)     from dt01_lgu_pemesanan_dt where org_id=a.org_id and barang_id=a.barang_id and no_pemesanan='".$nopemesanan."')total,
        //                         (select note               from dt01_lgu_pemesanan_dt where org_id=a.org_id and barang_id=a.barang_id and no_pemesanan='".$nopemesanan."')note,
                                
        //                         (select satuan from dt01_lgu_satuan_ms where active='1' and org_id=a.org_id and satuan_id=a.satuan_beli_id)satuanbeli,
        //                         (select satuan from dt01_lgu_satuan_ms where active='1' and org_id=a.org_id and satuan_id=a.satuan_pakai_id)satuanpakai,
        //                         (select jenis from dt01_lgu_jenis_barang_ms where active='1' and org_id=a.org_id and jenis_id=a.jenis_id)jenis
        //                     from dt01_lgu_barang_ms a
        //                     where a.active='1'
        //                     and   a.org_id='".$orgid."'
        //                     ".$parameter."
        //                 )x
        //                 order by status desc, nama_barang asc
        //             ";

        //     $recordset = $this->db->query($query);
        //     $recordset = $recordset->result();
        //     return $recordset;
        // }

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

        function checkbalancelast($orgid){
            $query =
                    "
                        select a.balance
                        from dt01_keu_rekening_it a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by created_date desc
                        limit 1;
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
                                                    from dt01_keu_rekening_it
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

        function insertpettycash($data){           
            $sql =   $this->db->insert("dt01_keu_rekening_it",$data);
            return $sql;
        }

        function updatepettycash($nopemesanan,$data){           
            $sql =   $this->db->update("dt01_keu_rekening_it",$data,array("no_pemesanan"=>$nopemesanan));
            return $sql;
        }

        function insertheader($data){           
            $sql =   $this->db->insert("dt01_lgu_pemesanan_hd",$data);
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

        function updateheader($nopemesanan,$data){           
            $sql =   $this->db->update("dt01_lgu_pemesanan_hd",$data,array("no_pemesanan"=>$nopemesanan));
            return $sql;
        }

        function updateitem($barangid,$nopemesanan,$data){           
            $sql =   $this->db->update("dt01_lgu_pemesanan_dt",$data,array("barang_id"=>$barangid,"no_pemesanan"=>$nopemesanan));
            return $sql;
        }

        function updatedetailitem($itemid,$data){           
            $sql =   $this->db->update("dt01_lgu_pemesanan_dt",$data,array("item_id"=>$itemid));
            return $sql;
        }

        function updatestock($transaksiid,$data){           
            $sql =   $this->db->update("dt01_lgu_mutasi_barang",$data,array("transaksi_id"=>$transaksiid));
            return $sql;
        }

    }
?>