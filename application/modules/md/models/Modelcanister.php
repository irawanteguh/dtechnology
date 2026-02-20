<?php
    class Modelcanister extends CI_Model{

        function canister($orgid){
            $query =
                    "
                        select a.canister_id, canister_no, stok, min_stok,
                            case when stok = 0 then '0' else case when stok < min_stok then '1' else '2' end end status,
                            (select nama_barang from dt01_lgu_barang_ms where barang_id=a.obat_id)namaobat
                        from dt01_frm_canister_ms a
                        where a.org_id='".$orgid."'
                        order by status asc, canister_no asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        


    }
?>