<?php
defined('BASEPATH') or exit('No direct script access allowed');
class overview extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		rootsystem::system();
		$this->load->model("Modeloverview", "md");
	}

	public function index()
	{

		$this->template->load("template/template-sidebar", "v_overview");
	}
	public function datauser()
	{
		$result = $this->md->datauser($_SESSION['orgid'], $_SESSION['userid']);

		if (!empty($result)) {
			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Data Found";
			$json['responResult'] = $result;
		} else {
			$json["responCode"] = "01";
			$json["responHead"] = "info";
			$json["responDesc"] = "Data Not Found";
		}

		echo json_encode($json);
	}
	public function updateuserdata()
	{
		$userid = $_SESSION['userid'];
		$dob = $this->input->post('dob');
		$dob = $dob ? DateTime::createFromFormat('d/m/Y', $dob)->format('Y-m-d') : '';
		$data['NAME'] = $this->input->post('name');
		$data['DATE_OF_BIRTG'] = $dob;
		echo json_encode($data);
	}

	public function getmaritalstatus()
	{
		$result = $this->md->getmaritalstatus();
		if (!empty($result)) {
			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Data Found";
			$json['responResult'] = $result;
		} else {
			$json["responCode"] = "01";
			$json["responHead"] = "info";
			$json["responDesc"] = "Data Not Found";
		}
		echo json_encode($json);
	}
	public function getethnic()
	{
		$result = $this->md->getethnic();
		if (!empty($result)) {
			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Data Found";
			$json['responResult'] = $result;
		} else {
			$json["responCode"] = "01";
			$json["responHead"] = "info";
			$json["responDesc"] = "Data Not Found";
		}
		echo json_encode($json);
	}
	public function getreligion()
	{
		$result = $this->md->getreligion();
		if (!empty($result)) {
			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Data Found";
			$json['responResult'] = $result;
		} else {
			$json["responCode"] = "01";
			$json["responHead"] = "info";
			$json["responDesc"] = "Data Not Found";
		}
		echo json_encode($json);
	}
	public function saveoverview()
	{
		$userid = $_SESSION['userid'];
		$dob = $this->input->post('dob');
		$data['IDENTITY_NO'] = $this->input->post('identity_no');
		$data['NAME'] = $this->input->post('name');
		$data['NAME_IDENTITY'] = $this->input->post('name_identity');
		$data['PLACE_OF_BIRTH'] = $this->input->post('pob');
		$data['DATE_OF_BIRTH'] = $dob ? DateTime::createFromFormat('d/m/Y', $dob)->format('Y-m-d') : '';
		$data['SEX_ID'] = $this->input->post('gender');
		$data['MARITAL_ID'] = $this->input->post('marital_status');
		$data['RELIGION_ID'] = $this->input->post('religion');
		$data['BLOOD_TYPE'] =  $this->input->post('blood_type');
		$data['RHESUS'] =  $this->input->post('rhesus');
		$data['ETHNIC_ID'] =  $this->input->post('ethnic');
		$data['CLOTHES_SIZE'] =  $this->input->post('clothes_size');
		$data['PHONE'] =  $this->input->post('phone');
		$data['EMAIL'] =  $this->input->post('email');
		$update = $this->md->updateuser($data, ['USER_ID' => $userid]);
		if ($update) {
			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Saved Successfully";
		} else {
			$json["responCode"] = "01";
			$json["responHead"] = "info";
			$json["responDesc"] = "Failed to Save";
		}
		echo json_encode($json);
	}
	/*CONTACT*/
	public function savecontact()
	{
		$userid = $_SESSION['userid'];
		$contactname = $this->input->post('contact_name');
		$contactaddress = $this->input->post('contact_address');
		$contactphone = $this->input->post('contact_phone');
		$contactrelationship = $this->input->post('contact_relationship');
		$contactprimary = $this->input->post('contact_primary');
		$data['CONTACT_PRIMARY'] = $contactprimary;
		$data['CONTACT_NAME'] = $contactname;
		$data['CONTACT_ID'] = generateuuid();
		$data['USER_ID'] = $userid;
		$data['CONTACT_NAME'] = $contactname;
		$data['CONTACT_ADDRESS'] = $contactaddress;
		$data['CONTACT_PHONE'] = $contactphone;
		$data['RELATIONSHIP_ID'] = $contactrelationship;
		$data['CREATED_BY'] = $userid;
		$insert = $this->md->insertcontact($data);
		if ($insert) {
			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Saved Successfully";
		} else {
			$json["responCode"] = "01";
			$json["responHead"] = "info";
			$json["responDesc"] = "Failed to Save";
		}
		echo json_encode($json);
	}
	public function updatecontact()
	{
		$userid = $_SESSION['userid'];
		$idcontact = $this->input->post('idcontact');
		$contactname = $this->input->post('contact_name');
		$contactaddress = $this->input->post('contact_address');
		$contactphone = $this->input->post('contact_phone');
		$contactrelationship = $this->input->post('contact_relationship');
		$contactprimary = $this->input->post('contact_primary');
		$data['CONTACT_PRIMARY'] = $contactprimary;
		$data['CONTACT_NAME'] = $contactname;
		$data['CONTACT_ADDRESS'] = $contactaddress;
		$data['CONTACT_PHONE'] = $contactphone;
		$data['RELATIONSHIP_ID'] = $contactrelationship;
		$data['UPDATED_DATE'] = date('Y-m-d H:i:s');
		$data['UPDATED_BY'] = $userid;
		$insert = $this->md->updatecontact($data, ['USER_ID' => $userid, 'CONTACT_ID' => $idcontact]);
		if ($insert) {
			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Saved Successfully";
		} else {
			$json["responCode"] = "01";
			$json["responHead"] = "info";
			$json["responDesc"] = "Failed to Save";
		}
		echo json_encode($json);
	}
	public function deletecontact()
	{
		$idcontact = $this->input->post('id');
		$data['ACTIVE'] = '0';
		$insert = $this->md->updatecontact($data, ['CONTACT_ID' => $idcontact]);
		if (!empty($insert)) {
			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Deleted Successfully";
		} else {
			$json["responCode"] = "01";
			$json["responHead"] = "info";
			$json["responDesc"] = "Failed to Delete";
		}
		echo json_encode($json);
	}
	public function selectcontact()
	{
		$userid = $_SESSION['userid'];
		$id = $this->input->post('id');
		$result = $this->md->selectcontact($userid, $id);
		if (!empty($result)) {
			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Data Found";
			$json['responResult'] = $result;
		} else {
			$json["responCode"] = "01";
			$json["responHead"] = "info";
			$json["responDesc"] = "Data Not Found";
		}
		echo json_encode($json);
	}
	public function getemergencycontact()
	{
		$userid = $_SESSION['userid'];
		$getemergencycontact = $this->md->getemergencycontact($userid);
		if (!empty($getemergencycontact)) {
			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Data Found";
			$json['responResult'] = $getemergencycontact;
		} else {
			$json["responCode"] = "01";
			$json["responHead"] = "info";
			$json["responDesc"] = "Data Not Found";
		}
		echo json_encode($json);
	}

	public function getrelathionship()
	{
		$result = $this->md->getrelathionship();
		if (!empty($result)) {
			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Data Found";
			$json['responResult'] = $result;
		} else {
			$json["responCode"] = "01";
			$json["responHead"] = "info";
			$json["responDesc"] = "Data Not Found";
		}
		echo json_encode($json);
	}
	/*ADDRESS*/
	public function saveaddress()
	{
		$userid = $_SESSION['userid'];
		$addresslabel = $this->input->post('address_label');
		$address = $this->input->post('address');
		$data['ADDRESS_ID'] = generateuuid();
		$data['USER_ID'] = $userid;
		$data['ADDRESS_LABEL'] = $addresslabel;
		$data['ADDRESS'] = $address;
		$data['CREATED_BY'] = $userid;
		$data['PRIMARY'] = $this->input->post('address_primary');
		$insert = $this->md->insertaddress($data);
		if (!empty($insert)) {
			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Saved Successfully";
		} else {
			$json["responCode"] = "01";
			$json["responHead"] = "info";
			$json["responDesc"] = "Failed to Save";
		}
		echo json_encode($json);
	}
	public function updateaddress()
	{
		$userid = $_SESSION['userid'];
		$addresslabel = $this->input->post('address_label');
		$address = $this->input->post('address');
		$idaddress = $this->input->post('idaddress');
		$data['ADDRESS_LABEL'] = $addresslabel;
		$data['ADDRESS'] = $address;
		$data['UPDATED_DATE'] = date('Y-m-d H:i:s');
		$data['UPDATED_BY'] = $userid;
		$data['PRIMARY'] = $this->input->post('address_primary');
		$insert = $this->md->updateaddress($data, ['USER_ID' => $userid, 'ADDRESS_ID' => $idaddress]);
		if (!empty($insert)) {
			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Saved Successfully";
		} else {
			$json["responCode"] = "01";
			$json["responHead"] = "info";
			$json["responDesc"] = "Failed to Save";
		}
		echo json_encode($json);
	}
	public function selectaddress()
	{
		$userid = $_SESSION['userid'];
		$id = $this->input->post('id');
		$result = $this->md->selectaddress($userid, $id);
		if (!empty($result)) {
			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Data Found";
			$json['responResult'] = $result;
		} else {
			$json["responCode"] = "01";
			$json["responHead"] = "info";
			$json["responDesc"] = "Data Not Found";
		}
		echo json_encode($json);
	}
	public function getaddress()
	{
		$userid = $_SESSION['userid'];
		$getaddress = $this->md->getaddress($userid);
		if (!empty($getaddress)) {
			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Data Found";
			$json['responResult'] = $getaddress;
		} else {
			$json["responCode"] = "01";
			$json["responHead"] = "info";
			$json["responDesc"] = "Data Not Found";
		}
		echo json_encode($json);
	}
	public function deleteaddress()
	{
		$id = $this->input->post('id');
		$data['ACTIVE'] = '0';
		$insert = $this->md->updateaddress($data, ['ADDRESS_ID' => $id]);
		if (!empty($insert)) {
			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Deleted Successfully";
		} else {
			$json["responCode"] = "01";
			$json["responHead"] = "info";
			$json["responDesc"] = "Failed to Delete";
		}
		echo json_encode($json);
	}
}
