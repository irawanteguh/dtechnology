<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Backupdb extends CI_Controller {

		public static $host;
		public static $user;
		public static $password;
		public static $database;
		public static $port;
		public static $pathdatabase;
		public static $backupPath;

		public function __construct(){
            parent:: __construct();
            rootsystem::system();

			self::$host         = $this->db->hostname;
			self::$user         = $this->db->username;
			self::$password     = $this->db->password;
			self::$database     = $this->db->database;
			self::$port         = !empty($this->db->port) ? $this->db->port : 3306;
			self::$pathdatabase = FCPATH."database/";
			self::$backupPath   = self::$pathdatabase.date('Y-m-d-H:i:s').'.sql';
        }

		public function index(){
            $filesdb = "";
			$directory = FCPATH . 'database/';
			if (is_dir($directory)) {
				$files = glob($directory . '*.sql');
				foreach ($files as $file) {
					$filename = basename($file);
					$fileTime = filemtime($file);
					$dateModified = date("F j, Y", $fileTime);

					$filesdb .= "
						<div class='col-md-6 col-lg-4 col-xl-3 animate__animated animate__zoomIn'>
							<div class='card h-100'>
								<div class='card-body d-flex justify-content-center text-center flex-column p-8'>
									<a href='download.php?file=" . urlencode($filename) . "' class='text-gray-800 text-hover-primary d-flex flex-column'>
										<div class='symbol symbol-60px mb-5'>
											<img src='" . base_url("assets/images/files/sql.svg") . "' alt='sql image'>
										</div>
										<div class='fs-5 fw-bolder mb-2'>" . htmlspecialchars($filename, ENT_QUOTES, 'UTF-8') . "</div>
									</a>
									<div class='fs-7 fw-bold text-gray-400'>" . $dateModified . "</div><br>
									<button onclick='confirmDeletion(\"" . addslashes($filename) . "\")' class='btn btn-danger'>Delete</button>
								</div>
							</div>
						</div>";
				}
			}


            $data['filesdb']  = $filesdb;
            $this->template->load("template/template-sidebar","v_backupdb",$data);
		}

        function backupdatabase() {
			$backupDir  = self::$pathdatabase;
			$backupFile = $backupDir . '/backup_'.$_SESSION['hospitalname'].'_'.date('Y-m-d_H-i-s') . '.sql';
		
			if (!is_dir($backupDir)) {
				if (!mkdir($backupDir, 0777, true)) {
					die("Failed to create directory: $backupDir");
				}
			}
		
			$conn = new mysqli(self::$host, self::$user, self::$password, self::$database, self::$port);
			if ($conn->connect_error) {
				die("Database connection failed: " . $conn->connect_error);
			}
		
			$tables = [];
			$result = $conn->query("SHOW TABLES LIKE 'dt01\_%'");
			while ($row = $result->fetch_row()) {
				$tables[] = $row[0];
			}
		
			$handle = fopen($backupFile, 'w+');
			if (!$handle) {
				die("Failed to open file for writing: $backupFile");
			}
		
			// Daftar tabel yang harus disimpan dengan data
			$tablesWithData = [
				'dt01_gen_enviroment_ms',
				'dt01_gen_document_ms',
				'dt01_gen_modules_ms',
				'dt01_gen_referensi_dt',
				'dt01_gen_role_ms',
				'dt01_gen_role_dt',
				'dt01_gen_role_access',
				'dt01_gen_master_ms',
				'dt01_gen_user_data',
				'dt01_gen_organization_ms',
				'dt01_gen_role_ms'
			];

			foreach ($tables as $table) {

				// DROP TABLE
				// fwrite($handle, "DROP TABLE IF EXISTS `$table`;\n\n");

				// CREATE TABLE
				$createTableQuery = $conn->query("SHOW CREATE TABLE `$table`");

				if (!$createTableQuery) {
					continue;
				}

				$createTable = $createTableQuery->fetch_row();

				fwrite($handle, $createTable[1] . ";\n\n");

				// Backup data jika tabel termasuk daftar
				if (in_array($table, $tablesWithData)) {

					// Default query
					$query = "SELECT * FROM `$table`";

					// Khusus user_data hanya username root
					if ($table == 'dt01_gen_user_data') {
						$query .= " WHERE USERNAME='root'";
					}

					$result = $conn->query($query);

					if (!$result) {
						continue;
					}

					// Ambil metadata field
					$fields = $result->fetch_fields();

					while ($row = $result->fetch_assoc()) {

						$insertValues = [];

						foreach ($fields as $field) {

							$fieldName = $field->name;
							$value = $row[$fieldName];

							// NULL asli database
							if (is_null($value)) {

								$insertValues[] = "NULL";

							}
							// Jika string kosong dan field nullable
							elseif ($value === '' && !($field->flags & 1)) {

								$insertValues[] = "NULL";

							}
							else {

								// Escape karakter khusus
								$escapedValue = $conn->real_escape_string($value);

								$insertValues[] = '"' . $escapedValue . '"';
							}
						}

						// Generate INSERT
						$insertQuery = "INSERT INTO `$table` VALUES (" .
										implode(", ", $insertValues) .
										");\n";

						fwrite($handle, $insertQuery);
					}

					fwrite($handle, "\n\n");
				}
			}
		
			fclose($handle);
			$conn->close();
		
			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Data Berhasil Di Backup";
			$json["url"] = base_url() . "index.php/operation/backupdb";
		
			echo json_encode($json);
		}

	}

?>