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
                        select '1'id, 'Invoice'metod union select '2'id, 'Cash / Bon' metod
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function buatnopemesanan($orgid){
            $query =
                    "
                        SELECT CONCAT(
                                'SPM', 
                                DATE_FORMAT(NOW(), '%Y%m%d'), 
                                LPAD(
                                    COALESCE(
                                        (SELECT COUNT(no_pemesanan) + 1 
                                        FROM dt01_lgu_pemesanan_hd 
                                        WHERE org_id='".$orgid."'
                                        and   DATE_FORMAT(created_date, '%d.%m.%Y') = DATE_FORMAT(CURRENT_DATE, '%d.%m.%Y')
                                        ), 
                                        1
                                    ), 
                                    3, 
                                    '0'
                                )
                            ) AS nomor_pemesanan

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function masterbarang($orgid,$nopemesanan){
            $query =
                    "
                        select x.*,
                            CASE 
                                WHEN x.itemid IS NULL THEN '0' 
                                ELSE '1' 
                            END AS status
                        from(
                            select a.barang_id,nama_barang,
                                (select item_id from dt01_lgu_pemesanan_dt where org_id=a.org_id and barang_id=a.barang_id and no_pemesanan='".$nopemesanan."')itemid,
                                (select stock from dt01_lgu_pemesanan_dt where org_id=a.org_id and barang_id=a.barang_id and no_pemesanan='".$nopemesanan."')stock,
                                (select qty_minta from dt01_lgu_pemesanan_dt where org_id=a.org_id and barang_id=a.barang_id and no_pemesanan='".$nopemesanan."')qty,
                                (select harga from dt01_lgu_pemesanan_dt where org_id=a.org_id and barang_id=a.barang_id and no_pemesanan='".$nopemesanan."')harga,
                                (select ppn from dt01_lgu_pemesanan_dt where org_id=a.org_id and barang_id=a.barang_id and no_pemesanan='".$nopemesanan."')ppn,
                                (select harga_ppn from dt01_lgu_pemesanan_dt where org_id=a.org_id and barang_id=a.barang_id and no_pemesanan='".$nopemesanan."')hargappn,
                                (select total from dt01_lgu_pemesanan_dt where org_id=a.org_id and barang_id=a.barang_id and no_pemesanan='".$nopemesanan."')total,
                                (select note from dt01_lgu_pemesanan_dt where org_id=a.org_id and barang_id=a.barang_id and no_pemesanan='".$nopemesanan."')note,
                                
                                (select satuan from dt01_lgu_satuan_ms where active='1' and org_id=a.org_id and satuan_id=a.satuan_beli_id)satuanbeli,
                                (select satuan from dt01_lgu_satuan_ms where active='1' and org_id=a.org_id and satuan_id=a.satuan_pakai_id)satuanpakai,
                                (select jenis from dt01_lgu_jenis_barang_ms where active='1' and org_id=a.org_id and jenis_id=a.jenis_id)jenis
                            from dt01_lgu_barang_ms a
                            where a.active='1'
                            and   a.org_id='".$orgid."'
                        )x
                        order by status desc, nama_barang asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function cekunitid($orgid,$userid){
            $query =
                    "
                        select a.department_id
                        from dt01_gen_department_ms a
                        where a.org_id='".$orgid."'
                        and   a.user_id='".$userid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function cekitemid($orgid,$nopemesanan,$barangid){
            $query =
                    "
                        select a.*
                        from dt01_lgu_pemesanan_dt a
                        where a.org_id='".$orgid."'
                        and   a.no_pemesanan='".$nopemesanan."'
                        and   a.barang_id='".$barangid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function datarequest($orgid,$status){
            $query =
                    "
                        select a.no_pemesanan, judul_pemesanan, note, invoice, method, cito, attachment_note, subtotal, harga_ppn, total, status, attachment, date_format(a.created_date, '%d.%m.%Y %H:%i:%s')tglbuat,
                            (select supplier from dt01_lgu_supplier_ms where org_id=a.org_id and active=a.active and supplier_id=a.supplier_id)namasupplier,
                            (select name from dt01_gen_user_data where org_id=a.org_id and active=a.active and user_id=a.created_by)dibuatoleh,
                            (select department from dt01_gen_department_ms where org_id=a.org_id and active=a.active and department_id=a.department_id)unit,

                            case 
                                when status = '0'  then 'badge-light-info|New'
                                when status = '1'  then 'badge-light-danger|Cancelled'
                                when status = '2'  then 'badge-light-info|Waiting Approval Manager'
                                when status = '3'  then 'badge-light-danger|Cancelled Manager'
                                when status = '4'  then 'badge-light-info|Approval Manager'
                                when status = '5'  then 'badge-light-danger|Cancelled Finance'
                                when status = '6'  then 'badge-light-info|Approval Finance'
                                when status = '7'  then 'badge-light-danger|Cancelled Vice Director'
                                when status = '8'  then 'badge-light-info|Approval Vice Director'
                                when status = '9'  then 'badge-light-danger|Cancelled Director'
                                when status = '10' then 'badge-light-info|Approval Director'
                                when status = '11' then 'badge-light-info|Invoice Submission'
                                when status = '12' then 'badge-light-danger|Invoice Cancelled Manager'
                                when status = '13' then 'badge-light-info|Invoice Approval Manager'
                                when status = '14' then 'badge-light-danger|Invoice Cancelled Vice Director'
                                when status = '15' then 'badge-light-info|Invoice Approval Vice Director'
                                when status = '16' then 'badge-light-danger|Invoice Cancelled Director'
                                when status = '17' then 'badge-light-info|Invoice Approval Director'
                                when status = '18' then 'badge-light-danger|Invoice Cancelled Finance'
                                when status = '19' then 'badge-light-info|Invoice Approval Finance'
                                when status = '20' then 'badge-light-success|Payment Success'
                                when status = '21' then 'badge-light-success|File Transfer Available'
                                else 'badge-light-secondary|Unknown'
                            end as decoded_status

                        from dt01_lgu_pemesanan_hd a
                        where a.org_id='".$orgid."'
                        ".$status."
                        and   a.active='1'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function detailbarang($orgid,$nopemesanan){
            $query =
                    "
                        select a.item_id, barang_id, note, stock, qty_minta, qty_manager, qty_keu, qty_wadir, qty_dir, harga, harga_ppn, ppn, total,
                            (select satuan from dt01_lgu_satuan_ms where active='1' and org_id=a.org_id and satuan_id=(select satuan_beli_id from dt01_lgu_barang_ms where org_id=a.org_id and barang_id=a.barang_id))satuanbeli,
                            (select satuan from dt01_lgu_satuan_ms where active='1' and org_id=a.org_id and satuan_id=(select satuan_pakai_id from dt01_lgu_barang_ms where org_id=a.org_id and barang_id=a.barang_id))satuanpakai,
                            (select jenis from dt01_lgu_jenis_barang_ms where active='1' and org_id=a.org_id and jenis_id=(select jenis_id from dt01_lgu_barang_ms where org_id=a.org_id and barang_id=a.barang_id))jenis,
                            (select nama_barang from dt01_lgu_barang_ms where org_id=a.org_id and barang_id=a.barang_id)namabarang
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

        function hitungdetail($orgid,$nopemesanan){
            $query =
                    "
                        select sum((total-harga_ppn))harga, sum(harga_ppn)harga_ppn, sum(total)total
                        from dt01_lgu_pemesanan_dt a
                        where a.org_id='".$orgid."'
                        and   a.no_pemesanan='".$nopemesanan."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function updateheader($nopemesanan,$data){           
            $sql =   $this->db->update("dt01_lgu_pemesanan_hd",$data,array("no_pemesanan"=>$nopemesanan));
            return $sql;
        }

        function updatedetailitem($itemid,$data){           
            $sql =   $this->db->update("dt01_lgu_pemesanan_dt",$data,array("item_id"=>$itemid));
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

        function updatebarangid($barangid,$nopemesanan,$data){           
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