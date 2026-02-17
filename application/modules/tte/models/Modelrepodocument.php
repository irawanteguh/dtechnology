<?php
    class Modelrepodocument extends CI_Model{

        function alldocument(){
            $query =
                    "
                        select a.transaksi_id, no_file, jenis_doc, type_of, provider_sign, from_in, type_certificate, quick_sign, note_1, note_2, date_format(a.created_date, '%d.%m.%Y %H:%i:%s')tglbuat,
                            (select name from dt01_gen_user_data where org_id=a.org_id and (user_id=a.created_by or nik=a.created_by))dibuatoleh,
                            (select name from dt01_gen_user_data where org_id=a.org_id and nik=a.signer_id)name,
                            (select email from dt01_gen_user_data where org_id=a.org_id and nik=a.signer_id)email,
                            (select color       from dt01_gen_master_ms where org_id=a.org_id and jenis_id='Statussign_1' and code=a.status_sign)colorstatus,
                            (select master_name from dt01_gen_master_ms where org_id=a.org_id and jenis_id='Statussign_1' and code=a.status_sign)namestatus
                        from dt01_sign_document_dt a
                        where a.active='1'
                        order by created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>