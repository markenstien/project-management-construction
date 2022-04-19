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

    <style type="text/css">
        
        .carousel-item {
          height: 90vh;
        }

        .carousel-item img{
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100%;
            min-height: 300px !important;
        }
    </style>
    <?php produce('headers')?>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Projects</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Others
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Login</a>
                  <a class="dropdown-item" href="#">Quotation</a>
                </div>
              </li>
            </ul>
          </div>
      </div>
    </nav>

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?php echo _path_tmp('images/ui-carousel/bg1.jpg')?>" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
              <h5>Third slide label</h5>
              <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>

              <button> TEST </button>
            </div>
        </div>
        <div class="carousel-item">
          <img src="<?php echo _path_tmp('images/ui-carousel/bg2.jpg')?>" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img src="<?php echo _path_tmp('images/ui-carousel/bg3.jpg')?>" alt="Third slide">
        </div>
      </div>

       <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
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
