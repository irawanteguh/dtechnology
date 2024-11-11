<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Backupdb extends CI_Controller {

		public static $host;
		public static $user;
		public static $password;
		public static $database;
		public static $pathdatabase;
		public static $backupPath;

		public function __construct(){
            parent:: __construct();
            rootsystem::system();

			self::$host         = $this->db->hostname;
			self::$user         = $this->db->username;
			self::$password     = $this->db->password;
			self::$database     = $this->db->database;
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

        function backupdatabase(){
			// Define the backup directory and file path
			$backupDir = self::$pathdatabase;
			$backupFile = $backupDir . '/backup_' . date('Y-m-d_H-i-s') . '.sql';
		
			// Create the directory if it doesn't exist
			if (!is_dir($backupDir)) {
				if (!mkdir($backupDir, 0777, true)) {
					die("Failed to create directory: $backupDir");
				}
			}
		
			// Connect to the database
			$conn = new mysqli(self::$host, self::$user, self::$password, self::$database);
			if ($conn->connect_error) {
				die("Database connection failed: " . $conn->connect_error);
			}
		
			// Retrieve table names
			$tables = [];
			$result = $conn->query("SHOW TABLES LIKE 'dt01\_%'");
			while ($row = $result->fetch_row()) {
				$tables[] = $row[0];
			}
		
			// Open the file for writing
			$handle = fopen($backupFile, 'w+');
			if (!$handle) {
				die("Failed to open file for writing: $backupFile");
			}
		
			// Loop through tables and export data
			foreach ($tables as $table) {
				// Add DROP TABLE statement
				fwrite($handle, "DROP TABLE IF EXISTS `$table`;\n\n");
		
				// Add CREATE TABLE statement
				$createTableQuery = $conn->query("SHOW CREATE TABLE `$table`");
				$createTable = $createTableQuery->fetch_row();
				fwrite($handle, $createTable[1] . ";\n\n");
		
				// Add INSERT INTO statements for each row
				$result = $conn->query("SELECT * FROM `$table`");
				$numColumns = $result->field_count;
		
				while ($row = $result->fetch_row()) {
					$row = array_map('addslashes', $row);
					$insertQuery = "INSERT INTO `$table` VALUES (";
					for ($i = 0; $i < $numColumns; $i++) {
						$insertQuery .= '"' . $row[$i] . '", ';
					}
					$insertQuery = substr($insertQuery, 0, -2);
					$insertQuery .= ");\n";
					fwrite($handle, $insertQuery);
				}
				fwrite($handle, "\n\n\n");
			}
		
			// Close the file and connection
			fclose($handle);
			$conn->close();
		
			// Return success response
			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Data Berhasil Di Backup";
			$json["url"] = base_url() . "index.php/operation/backupdb";
			echo json_encode($json);
		}
		

		function backuptable(){
			if(!is_dir(self::$pathdatabase)){
				mkdir(self::$pathdatabase, 0777, true);      
			};
			
			$conn = new mysqli(self::$host, self::$user, self::$password, self::$database);
			if ($conn->connect_error) {
				die("Koneksi ke database gagal: " . $conn->connect_error);
			}
			
			$tables = array();
			$result = $conn->query("SHOW TABLES LIKE 'dt01\_%'");
			while($row = $result->fetch_row()){
				$tables[] = $row[0];
			}
			
			$handle = fopen(self::$backupPath,'w+');
			foreach($tables as $table){
				$result     = $conn->query("SELECT * FROM $table");
				$numColumns = $result->field_count;
				
				fwrite($handle, "DROP TABLE IF EXISTS $table;\n\n");
				
				$createTableQuery = $conn->query("SHOW CREATE TABLE $table");
				$createTable      = $createTableQuery->fetch_row();
				fwrite($handle, $createTable[1].";\n\n");
				
				fwrite($handle, "\n\n\n");
			}
			fclose($handle);
			$conn->close();

			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Data Berhasil Di Backup";
			$json["url"]        = base_url()."index.php/operation/backupdb";

			echo json_encode($json);
		}

	}

?>