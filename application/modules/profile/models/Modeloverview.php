<?php
class Modeloverview extends CI_Model
{

    function datauser($orgid, $userid)
    {
        $query =
            "SELECT *, DATE_FORMAT(DATE_OF_BIRTH,'%d/%m/%Y') TGLLAHIR
                from dt01_gen_user_data a
                where a.active='1'
                and a.org_id='" . $orgid . "'
                and user_id = '{$userid}'
                    ";

        $recordset = $this->db->query($query);
        $recordset = $recordset->row();
        return $recordset;
    }
    public function getemergencycontact($userid)
    {
        $this->db->select('*');
        $this->db->from('dt01_hrd_contact_dt a');
        $this->db->join('dt01_hrd_relationship_ms b', 'a.RELATIONSHIP_ID = b.RELATIONSHIP_ID');
        $this->db->where(['USER_ID' => $userid, 'ACTIVE' => '1']);
        return $this->db->get()->result();
    }

    public function getrelathionship()
    {
        $this->db->select('*');
        $this->db->from('dt01_hrd_relationship_ms');
        return $this->db->get()->result();
    }
    public function getmaritalstatus()
    {
        $this->db->select('*');
        $this->db->from('dt01_gen_marital_ms');
        return $this->db->get()->result();
    }
    public function getethnic()
    {
        $this->db->select('*');
        $this->db->from('dt01_gen_ethnic_ms');
        return $this->db->get()->result();
    }
    public function getreligion()
    {
        $this->db->select('*');
        $this->db->from('dt01_gen_religion_ms');
        return $this->db->get()->result();
    }
    public function insertcontact($data)
    {
        $this->db->insert('dt01_hrd_contact_dt', $data);
        return $this->db->affected_rows();
    }
    public function updatecontact($data, $where)
    {
        $this->db->update('dt01_hrd_contact_dt', $data, $where);
        return $this->db->affected_rows();
    }

    public function selectcontact($userid, $id)
    {
        $this->db->select('*');
        $this->db->from('dt01_hrd_contact_dt a');
        $this->db->join('dt01_hrd_relationship_ms b', 'a.RELATIONSHIP_ID = b.RELATIONSHIP_ID');
        $this->db->where(['USER_ID' => $userid, 'ACTIVE' => '1', 'CONTACT_ID' => $id]);
        return $this->db->get()->row();
    }
    public function getaddress($userid)
    {
        $this->db->select('*');
        $this->db->from('dt01_hrd_address_dt a');
        $this->db->where(['USER_ID' => $userid, 'ACTIVE' => '1']);
        return $this->db->get()->result();
    }
    public function insertaddress($data)
    {
        $this->db->insert('dt01_hrd_address_dt', $data);
        return $this->db->affected_rows();
    }
    public function selectaddress($userid, $id)
    {
        $this->db->select('*');
        $this->db->from('dt01_hrd_address_dt a');
        $this->db->where(['USER_ID' => $userid, 'ACTIVE' => '1', 'ADDRESS_ID' => $id]);
        return $this->db->get()->row();
    }
    public function updateaddress($data, $where)
    {
        $this->db->update('dt01_hrd_address_dt', $data, $where);
        return $this->db->affected_rows();
    }
    public function updateuser($data, $where)
    {
        $this->db->update('dt01_gen_user_data', $data, $where);
        return $this->db->affected_rows();
    }
}
