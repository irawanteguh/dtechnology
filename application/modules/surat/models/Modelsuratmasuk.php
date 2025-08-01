<?php
    class Modelsuratmasuk extends CI_Model{

        function asalsurat(){
            $query =
                    "
                        select 'E'kode, 'Surat External' keterangan union
                        select 'I'kode, 'Surat Internal' keterangan
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


        function pengirimsurat($orgid){
            $query =
                    "
                        select '1'jenisid, a.department_id pengirimid, concat('[',(select replace(replace(department, 'Manajer ', ''),'Direktur ','') from dt01_gen_department_ms where active='1' and org_id=a.org_id and department_id=a.header_id),'] ',department)keterangan
                        from dt01_gen_department_ms a
                        where a.active='1'
                        and   a.level_id='5'
                        and   a.org_id='".$orgid."'

                        union

                        select '2'jenisid, a.user_id pengirimid, name keterangan
                        from dt01_gen_user_data a
                        where a.active='1'
                        and   a.suspended='N'
                        and   a.org_id='".$orgid."'

                        order by jenisid asc, keterangan asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function suratmasuk($orgid){
            $query =
                    "
                        select a.trans_id, no_urut, no_agenda, kode_surat, nomor_surat, asal_surat, dari_text, perihal, ringkasan,
                            date_format(a.tanggal_surat,'%d.%m.%Y')tglsurat,
                            date_format(a.tanggal_masuk_surat,'%d.%m.%Y')tglmasuksurat,
                            date_format(a.created_date,'%d.%m.%Y %H:%i:%s')tgldibuat,
                            (select name from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.created_by)dibuatoleh,
                            case 
                                when a.asal_surat='I' then
                                    coalesce(
                                                (
                                                select department
                                                from dt01_gen_department_ms
                                                where active='1'
                                                and   org_id=a.org_id
                                                and   department_id=a.dari_id
                                                ),
                                                (
                                                select name
                                                from dt01_gen_user_data
                                                where active='1'
                                                and   org_id=a.org_id
                                                and   user_id=a.dari_id
                                                )
                                            )
                                else
                                dari_text
                            end pengirimsurat,
                            case 
                                when a.asal_surat='I' then
                                (select name from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=(select user_id from dt01_gen_department_ms where active='1' and org_id=a.org_id and department_id=a.dari_id))
                                else
                                ''
                            end namapengirimsurat
                        from dt01_sek_surat_hd a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertsuratmasuk($data){           
            $sql =   $this->db->insert("dt01_sek_surat_hd",$data);
            return $sql;
        }


    }
?>