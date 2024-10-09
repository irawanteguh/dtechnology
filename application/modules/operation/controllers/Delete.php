<?php
// Define the path to the file storage
define("FILE_DIR", FCPATH.'/database/');

// Check if the 'file' GET variable is set
if (isset($_GET['file']) && !empty($_GET['file'])) {
    $filename = basename($_GET['file']);
    $filepath = FILE_DIR . '/' . $filename;

    // Ensure the file exists
    if (file_exists($filepath)) {
        // Attempt to delete the file
        if (unlink($filepath)) {
            echo "<script>window.location.href='backupdb';</script>";
        } else {
            echo "<script>window.location.href='backupdb';</script>";
        }
    } else {
        echo "Error: The file does not exist.";
    }
} else {
    echo "Error: No file specified.";
}
?>
