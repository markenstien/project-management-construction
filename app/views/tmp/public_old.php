<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Orbiter is a bootstrap minimal & clean admin template">
    <meta name="keywords" content="admin, admin panel, admin template, admin dashboard, responsive, bootstrap 4, ui kits, ecommerce, web app, crm, cms, html, sass support, scss">
    <meta name="author" content="Themesbox">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?php echo $title ?? ''?><?php echo '|'.COMPANY_NAME ?></title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="<?php echo _path_tmp('images/favicon.ico')?>">
    <!-- Start css -->
    <link href="<?php echo _path_tmp('css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
    <link href="<?php echo _path_tmp('css/icons.css')?>" rel="stylesheet" type="text/css">
    <link href="<?php echo _path_tmp('css/style.css')?>" rel="stylesheet" type="text/css">
    <link href="<?php echo _path_public('css/main/global.css')?>" rel="stylesheet" type="text/css">
    <!-- End css -->
    <?php produce('headers')?>
</head>
<body class="vertical-layout">
    <!-- Start Containerbar -->
    <?php produce('content')?>
    <!-- End Containerbar -->
    <!-- Start js -->        
    <script src="<?php echo _path_tmp('js/jquery.min.js')?>"></script>
    <script src="<?php echo _path_tmp('js/popper.min.js')?>"></script>
    <script src="<?php echo _path_tmp('js/bootstrap.min.js')?>"></script>
    <script src="<?php echo _path_tmp('js/modernizr.min.js')?>"></script>
    <script src="<?php echo _path_tmp('js/detect.js')?>"></script>
    <script src="<?php echo _path_tmp('js/jquery.slimscroll.js')?>"></script>
    <!-- End js -->
</body>
</html>