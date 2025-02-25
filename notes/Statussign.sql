select a.status_sign, count(no_file)jml
from dt01_gen_document_file_dt a
where a.active='1'
and   a.status_file='1'
and   a.assign=(select nik from dt01_gen_user_data where org_id=a.org_id and active='1' and certificate='3' and nik=a.assign)
group by status_sign