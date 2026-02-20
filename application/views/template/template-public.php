<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include_once(APPPATH."views/template/head.php");
        ?>
    </head>
    <body id="kt_body" data-bs-spy="scroll" data-bs-target="#kt_landing_menu" data-bs-offset="200" class="bg-white position-relative">
        <?php echo $contents ?>
        <?php
            include_once(APPPATH."views/template/script.php");
        ?>
    </body>
</html>