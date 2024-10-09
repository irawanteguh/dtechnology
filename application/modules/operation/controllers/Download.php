<?php
    // Define the path to the file storage
    define("FILE_DIR", FCPATH.'/database/');

    // Check if the 'file' GET variable is set
    if(isset($_GET['file']) && !empty($_GET['file'])) {
        $filename = basename($_GET['file']);
        $filepath = FILE_DIR . $filename;

        // Ensure the file exists and is readable
        if(file_exists($filepath) && is_readable($filepath)) {
            // Set the appropriate headers to prompt a download
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));

            // Clear the output buffer
            flush();
            // Read the file and output its contents
            readfile($filepath);
            exit;
        } else {
            echo 'Error: The file does not exist or is not readable.';
        }
    } else {
        echo 'Error: No file specified.';
    }
?>
