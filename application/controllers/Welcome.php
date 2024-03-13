<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->library('encryption');

		// Teks yang akan dienkripsi
		$teksAsli = 'irawanteguh';

		// Enkripsi teks
		$teksTerenskripsi = $this->encryption->encrypt($teksAsli);

		// Tampilkan teks terenskripsi
		echo 'Teks Terenskripsi: ' . base64_encode($teksTerenskripsi) . '<br>';

		// Dekripsi teks
		$teksDekripsi = $this->encryption->decrypt($teksTerenskripsi);

		// Tampilkan teks setelah didekripsi
		echo 'Teks Setelah Didekripsi: ' . $teksDekripsi;
		
		$this->load->view('welcome_message');
	}
}
