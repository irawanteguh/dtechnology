<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description">
        <meta content="" name="keywords">
        
        <?php          
            include_once(APPPATH."views/template/head.php");
        ?>
    </head>
    <body>
        <?php echo $contents ?>   
        <?php          
            include_once(APPPATH."views/template/script.php");
        ?>
    </body>
</html>