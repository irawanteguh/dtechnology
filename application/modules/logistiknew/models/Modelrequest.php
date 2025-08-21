<?php
    class Modelrequest extends CI_Model{

        function datapemesanan($orgid,$status,$orderby){
            $query =
                    "
                        select a.no_pemesanan, no_spu, no_pemesanan_unit, pettycash_id, judul_pemesanan, note, attachment, attachment_note, supplier_id, invoice, invoice_no, from_department_id, department_id, type, method methodid, status_vice, status_dir, status_com, subtotal, harga_ppn, total, cito, status,
                            date_format(a.created_date, '%d.%m.%Y %H:%i:%s')tglbuat,
                            (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.created_by)dibuatoleh,
                            (select color from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_2' and code=a.method)colorjenis,
                            (select master_name from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_2' and code=a.method)namejenis,
                            (select department from dt01_gen_department_ms where org_id=a.org_id and active=a.active and department_id=a.department_id)unitpelaksana,
                            (select supplier from dt01_lgu_supplier_ms where org_id=a.org_id and active=a.active and supplier_id=a.supplier_id)namasupplier,
                            (select count(item_id) from dt01_lgu_pemesanan_dt where org_id=a.org_id and active=a.active and no_pemesanan=a.no_pemesanan)jmlitem,
                            (select count(item_id) from dt01_lgu_pemesanan_dt where org_id=a.org_id and active=a.active and no_pemesanan=a.no_pemesanan and total=0)itemhargakosong
                            

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

        function mastersupplier(){
            $query =
                    "
                        select a.supplier_id, supplier
                        from dt01_lgu_supplier_ms a
                        where a.active='1'
                        order by supplier asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterunit($orgid,$userid){
            $query =
                    "
                        select a.department_id, department
                        from dt01_gen_department_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.user_id='".$userid."'
                        order by department asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function method(){
            $query =
                    "
                        select a.code, master_name
                        from dt01_gen_master_ms a
                        where a.active='1'
                        and   a.jenis_id='PO_2'
                        order by master_name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function buatnopemesanan($orgid, $departmentid, $parameter){
            $query = "
                SELECT CONCAT(
                        LPAD(COUNT(hd.no_pemesanan) + 1, 3, '0'),
                        '/',
                        COALESCE(dm.code, 'XXX'),
                        '/',
                        DATE_FORMAT(CURDATE(), '%m'),
                        '/',
                        DATE_FORMAT(CURDATE(), '%Y')
                    ) AS nomor_pemesanan
                FROM dt01_lgu_pemesanan_hd hd
                LEFT JOIN dt01_gen_department_ms dm 
                    ON dm.org_id = hd.org_id 
                    AND dm.department_id = hd.department_id
                WHERE hd.org_id = ".$this->db->escape($orgid)."
                AND hd.department_id = ".$this->db->escape($departmentid)."
                ".$parameter."
                AND YEAR(hd.created_date) = YEAR(CURDATE())
            ";

            $recordset = $this->db->query($query)->row();
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
                            AND B.active='1'
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

        function updateitem($barangid,$nopemesanan,$data){           
            $sql =   $this->db->update("dt01_lgu_pemesanan_dt",$data,array("barang_id"=>$barangid,"no_pemesanan"=>$nopemesanan));
            return $sql;
        }

        function insertstock($data){           
            $sql =   $this->db->insert("dt01_lgu_mutasi_barang",$data);
            return $sql;
        }

        function updatestock($transaksiid,$data){           
            $sql =   $this->db->update("dt01_lgu_mutasi_barang",$data,array("transaksi_id"=>$transaksiid));
            return $sql;
        }

    }
?>