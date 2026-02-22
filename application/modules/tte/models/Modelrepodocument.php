<?php
    class Modelrepodocument extends CI_Model{

        function userassign($orgid){
            $query =
                    "
                        select a.nik, name
                        from dt01_gen_user_data a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.certificate='3'
                        order by name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function alldocument(){
            $query =
                    "
                        select a.transaksi_id, status_sign, storage, no_file, jenis_doc, type_of, provider_sign, from_in, type_certificate, quick_sign, note_1, note_2, date_format(a.created_date, '%d.%m.%Y %H:%i:%s')tglbuat,
                            (select name from dt01_gen_user_data where org_id=a.org_id and (user_id=a.created_by or nik=a.created_by))dibuatoleh,
                            (select name from dt01_gen_user_data where org_id=a.org_id and nik=a.signer_id)name,
                            (select email from dt01_gen_user_data where org_id=a.org_id and nik=a.signer_id)email,
                            (select color       from dt01_gen_master_ms where org_id=a.org_id and jenis_id='Statussign_2' and code=a.status_sign)colorstatus,
                            (select master_name from dt01_gen_master_ms where org_id=a.org_id and jenis_id='Statussign_2' and code=a.status_sign)namestatus,
                            (select description from dt01_gen_master_ms where org_id=a.org_id and jenis_id='Statussign_2' and code=a.status_sign)descriptionstatus
                        from dt01_sign_document_dt a
                        where a.active='1'
                        order by created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertdocument($data){           
            $sql =   $this->db->insert("dt01_sign_document_dt",$data);
            return $sql;
        }

        function updatedocument($data,$transaksiid){           
            $sql =   $this->db->update("dt01_sign_document_dt",$data,array("transaksi_id"=>$transaksiid));
            return $sql;
        }

    }
?>