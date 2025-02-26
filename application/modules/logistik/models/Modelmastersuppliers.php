<?php
    class Modelmastersuppliers extends CI_Model{
        
        function mastersuppliers($orgid){
            $query =
                    "
                        select a.supplier_id, supplier
                        from dt01_lgu_supplier_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by supplier
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updatesupplier($data,$supplierid){           
            $sql =   $this->db->update("dt01_lgu_supplier_ms",$data,array("supplier_id"=>$supplierid));
            return $sql;
        }

        function insertsuppliers($data){           
            $sql =   $this->db->insert("dt01_lgu_supplier_ms",$data);
            return $sql;
        }

    }
?>