<?php
    class Modelrepodocument extends CI_Model{

        function dataupload($parameter,$startDate,$endDate){
            $query =
                    "
                        select x.*,
                            (select user_identifier from dt01_gen_user_data   where active='1' and identity_no=x.assign)useridentifier,
                            (select name            from dt01_gen_user_data   where active='1' and identity_no=x.assign)assignname,
                            (select name            from dt01_gen_user_data   where active='1' and user_id=x.created_by)createdby,
                            (select document_name   from dt01_gen_document_ms where active='1' and jenis_doc=x.jenis_doc)jenisdocument,
                            (select master_name     from dt01_gen_master_ms   where active='1' and jenis_id='Statussign_1' and code=x.status_sign)status,
                            (select description     from dt01_gen_master_ms   where active='1' and jenis_id='Statussign_1' and code=x.status_sign)descriptionstatus,
                            (select color           from dt01_gen_master_ms   where active='1' and jenis_id='Statussign_1' and code=x.status_sign)colorstatus
                        from(
                            select a.no_file, filename, status_sign, status_file, link, note, source_file, created_date, assign, created_by, jenis_doc, pasien_idx, transaksi_idx, date_format(created_date,'%d.%m.%Y %H:%i:%s')tgljam 
                            from dt01_gen_document_file_dt a
                            where a.active='1'
                            and   a.assign='1234567890123456'
                            and   a.status_sign not in ('5','99')
                            ".$parameter."
                            and   a.assign=(select identity_no from dt01_gen_user_data where org_id=a.org_id and active='1' and certificate='3' and identity_no=a.assign)

                            union

                            select a.no_file, filename, status_sign, status_file, link, note, source_file, created_date, assign, created_by, jenis_doc, pasien_idx, transaksi_idx, date_format(created_date,'%d.%m.%Y %H:%i:%s')tgljam 
                            from dt01_gen_document_file_dt a
                            where a.active='1'
                            and   a.assign='1234567890123456'
                            and   a.status_sign in ('5','99')
                            and   a.created_date between '".$startDate."' and '".$endDate."'
                            ".$parameter."
                            and   a.assign=(select identity_no from dt01_gen_user_data where org_id=a.org_id and active='1' and certificate='3' and identity_no=a.assign)
                        )x
                        order by created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function checkroleaccess($orgid,$userid){
            $query =
                    "
                        select a.trans_id
                        from dt01_gen_role_access a
                        where a.org_id='".$orgid."'
                        and   a.user_id='".$userid."'
                        and   a.role_id='34c2e933-4b1b-47cd-8497-71de44ac4e01'
                        and   a.active='1'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterdocument($orgid){
            $query =
                    "
                        select a.jenis_doc, document_name
                        from dt01_gen_document_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by document_name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function userassign($orgid){
            $query =
                    "
                        select a.identity_no, name
                        from dt01_gen_user_data a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function positionsigner(){
            $query =
                    "
                        select '1'id, 'Signer 1' position union
                        select '2'id, 'Signer 2' position union
                        select '3'id, 'Signer 3' position union
                        select '4'id, 'Signer 4' position union
                        select '5'id, 'Signer 5' position union
                        select '6'id, 'Signer 6' position union
                        select '7'id, 'Signer 7' position union
                        select '8'id, 'Signer 8' position union
                        select '9'id, 'Signer 9' position union
                        select '10'id, 'Signer 10' position
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertsigndocument($data){           
            $sql =   $this->db->insert("dt01_gen_document_file_dt",$data);
            return $sql;
        }

        function updatefile($data,$nofile){           
            $sql =   $this->db->update("dt01_gen_document_file_dt",$data,array("no_file"=>$nofile));
            return $sql;
        }


    }
?>