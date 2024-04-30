<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Creates design and develop construction plans, construct buildings & other structures, provides painting and waterproofing services.">
    <meta name="keywords" content="Paintman Construction , Industrial , Paint , buildings , waterproofing , construction services">
    <meta name="author" content="Chromatic Softwares">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?php echo $title ?? ''?><?php echo '|'.COMPANY_NAME ?></title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="<?php echo _path_asset('logo.png')?>">
    <!-- Start css -->
    <link href="<?php echo _path_tmp('css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
    <link href="<?php echo _path_tmp('css/icons.css')?>" rel="stylesheet" type="text/css">
    <link href="<?php echo _path_tmp('css/style.css')?>" rel="stylesheet" type="text/css">
    <link href="<?php echo _path_public('css/main/global.css')?>" rel="stylesheet" type="text/css">
    <link href="<?php echo _path_public('css/main/public_global.css')?>" rel="stylesheet" type="text/css">
    <!-- End css -->

    <style type="text/css">
        section.section{
            background: #fff;
            padding: 50px;
            margin: 10px 0px;
            min-height: 350px;
        }
    </style>
    <?php produce('headers')?>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-default" style="background:#fff">
      <div class="container">
        <a class="navbar-brand" href="/LandingController/index">
            <?php wBackgroundImage(['size' => '50px'])?>
        </a>

        <button class="navbar-toggler" type="button" 
        data-toggle="collapse" 
        data-target="#navbarSupportedContent" 
        aria-controls="navbarSupportedContent" aria-expanded="false" 
        aria-label="Toggle navigation"
        style="color: #16213E;">
            <span class="feather icon-menu"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="<?php echo _route('landing:index')?>">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo _route('landing:about')?>">About</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="<?php echo _route('landing:services')?>">Services</a>
              </li> -->
              <li class="nav-item">
                <a class="nav-link" href="<?php echo _route('landing:portfolio')?>">Portfolio</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="<?php echo _route('landing:contact' , null , ['page'=>'contact#contactForm'])?>">Contact</a>
              </li> -->
              <li class="nav-item">
                <a class="nav-link" href="<?php echo _route('sec:login')?>">Sign In</a>
              </li>
            </ul>
        </div>
      </div>
    </nav>

    <div id="main">
        <!-- Start Containerbar -->
        <?php produce('content')?>
        <!-- End Containerbar -->
    </div>
    <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col">
                   <div class="footer-group">
                        <h3 class="footer-title"><?php echo COMPANY_NAME?></h3>
                        <p>raw denim aesthetic synth nesciunt you probably City</p>
                   </div>

                    <ul class="list-unstyled">
                        <li> <strong>Contacts</strong></li>
                        <li>+631231230000</li>
                        <li>+631231230000</li>
                    </ul>
                </div>

                <div class="col">
                    <div class="footer-group">
                        <h3 class="footer-title">Services</h3>
                        <p>. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of 
                          them accusamus labore sustainable</p>
                    </div>
                </div>

                <div class="col">
                    <h3 class="footer-title">References</h3>
                    <ul class="list-unstyled">
                        <li> <a href="#">Portfolio</a> </li>
                        <li> <a href="#">Services</a> </li>
                        <li> <a href="#">About</a> </li>
                    </ul>
                </div>
            </div>
        </div>
        <p class="footer-copyright">Copyright 2021 <?php echo COMPANY_NAME?> . All Rights Reserved.</p>
    </div>
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