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
    <link rel="shortcut icon" href="<?php echo URL.DS.'/logo_white.png'?>">
    <!-- Start css -->
    <!-- Switchery css -->
    <link href="<?php echo _path_tmp('plugins/switchery/switchery.min.css')?>" rel="stylesheet">
    <link href="<?php echo _path_tmp('css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
    <link href="<?php echo _path_tmp('css/icons.css')?>" rel="stylesheet" type="text/css">
    <link href="<?php echo _path_tmp('css/flag-icon.min.css')?>" rel="stylesheet" type="text/css">
    <link href="<?php echo _path_tmp('css/style.css')?>" rel="stylesheet" type="text/css">
    <link href="<?php echo _path_public('css/main/global.css')?>" rel="stylesheet" type="text/css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link href="<?php echo _path_tmp('css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
    <link href="<?php echo _path_tmp('css/icons.css')?>" rel="stylesheet" type="text/css">
    <link href="<?php echo _path_tmp('css/flag-icon.min.css')?>" rel="stylesheet" type="text/css">
    <link href="<?php echo _path_tmp('css/style.css')?>" rel="stylesheet" type="text/css"/>

    <link href="<?php echo _path_tmp('plugins/datatables/dataTables.bootstrap4.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo _path_tmp('plugins/datatables/buttons.bootstrap4.min.css')?>" rel="stylesheet" type="text/css" />
    <!-- Responsive Datatable css -->
    <link href="<?php echo _path_tmp('plugins/datatables/responsive.bootstrap4.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo _path_public('css/main/global.css')?>" rel="stylesheet" type="text/css">
    <?php produce('headers')?>
    <!-- End css -->
</head>
<body class="vertical-layout">
    <div class="infobar-settings-sidebar-overlay"></div>
    <!-- End Infobar Setting Sidebar -->
    <!-- Start Containerbar -->

    <?php $isCustomer = whoIs('type') == 'customer';?>
    <div id="containerbar">
        <!-- Start Leftbar -->
            <div class="leftbar">
                <!-- Start Sidebar -->
                <div class="sidebar">
                    <!-- Start Logobar -->
                    <div class="logobar">
                        <a href="index.html" class="logo logo-large">
                            <?php wBackgroundImage([
                                'size' => '200px'
                            ])?>
                        </a>
                        <a href="index.html" class="logo logo-small">
                            <?php wBackgroundImage([
                                'size' => '200px'
                            ])?>
                        </a>
                    </div>
                    <div class="navigationbar">
                        <ul class="vertical-menu">
                            <li>
                                <a href="/DashboardController">
                                    <i class="feather icon-home"></i><span>Dashboard</span>
                                    <!-- <span class="badge badge-success pull-right">New</span> -->
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo _route('project:index')?>">
                                     <i class="feather icon-folder-minus"></i><span>Project</span>
                                    <!-- <span class="badge badge-success pull-right">New</span> -->
                                </a>
                            </li>

                            <?php if(!$isCustomer) :?>
                            <li>
                                <a href="<?php echo _route('projectSector:index')?>">
                                     <i class="feather icon-package"></i><span>Categories</span>
                                    <!-- <span class="badge badge-success pull-right">New</span> -->
                                </a>
                            </li> 

                            <!-- <li>
                                <a href="<?php echo _route('quote:index')?>">
                                     <i class="feather icon-clipboard"></i><span>Quotation</span>
                                    <span class="badge badge-success pull-right">New</span>
                                </a>
                            </li> -->

                            <li>
                                <a href="<?php echo _route('user:index')?>">
                                     <i class="feather icon-users"></i><span>Accounts</span>
                                    <span class="badge badge-success pull-right">New</span>
                                </a>
                            </li> 
                            <?php endif?>
                            <li>
                                <a href="<?php echo _route('profile:index')?>">
                                     <i class="feather icon-user"></i><span>Profile</span>
                                    <!-- <span class="badge badge-success pull-right">New</span> -->
                                </a>
                            </li> 

                            <li>
                                <a href="/SecurityController/logout">
                                     <i class="feather icon-log-out"></i><span>Logout</span>
                                    <!-- <span class="badge badge-success pull-right">New</span> -->
                                </a>
                            </li>                                    
                        </ul>
                    </div>
                </div>
                <!-- End Sidebar -->
            </div>
        <!-- End Leftbar -->
        <!-- Start Rightbar -->
        <div class="rightbar">
            <!-- Start Topbar Mobile -->
            <div class="topbar-mobile">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="mobile-logobar">
                            <a href="index.html" class="mobile-logo"><img src="<?php echo _path_tmp('images/logo.svg')?>" 
                                class="img-fluid" alt="logo"></a>
                        </div>
                        <div class="mobile-togglebar">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <div class="topbar-toggle-icon">
                                        <a class="topbar-toggle-hamburger" href="javascript:void();">
                                            <img src="<?php echo _path_tmp('images/svg-icon/horizontal.svg')?>" 
                                            class="img-fluid menu-hamburger-horizontal" alt="horizontal">
                                            <img src="<?php echo _path_tmp('images/svg-icon/verticle.svg')?>" 
                                            class="img-fluid menu-hamburger-vertical" alt="verticle">
                                         </a>
                                     </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="menubar">
                                        <a class="menu-hamburger" href="javascript:void();">
                                            <img src="<?php echo _path_tmp('images/svg-icon/collapse.svg')?>" class="img-fluid menu-hamburger-collapse" alt="collapse">
                                            <img src="<?php echo _path_tmp('images/svg-icon/close.svg')?>" class="img-fluid menu-hamburger-close" alt="close">
                                         </a>
                                     </div>
                                </li>                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Topbar -->
            <div class="topbar">
                <!-- Start row -->
                <div class="row align-items-center">
                    <!-- Start col -->
                    <div class="col-md-12 align-self-center">
                        <div class="togglebar">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <div class="menubar">
                                        <a class="menu-hamburger" href="javascript:void();">
                                           <img src="<?php echo _path_tmp('images/svg-icon/collapse.svg')?>" class="img-fluid menu-hamburger-collapse" alt="collapse">
                                           <img src="<?php echo _path_tmp('images/svg-icon/close.svg')?>" class="img-fluid menu-hamburger-close" alt="close">
                                         </a>
                                     </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="searchbar">
                                        <form>
                                            <div class="input-group">
                                              <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                                              <div class="input-group-append">
                                                <button class="btn" type="submit" id="button-addon2">
                                                    <img src="<?php echo _path_tmp('images/svg-icon/search.svg')?>" 
                                                    class="img-fluid" alt="search"></button>
                                              </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="infobar">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <div class="notifybar">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle infobar-icon" href="#" role="button" id="notoficationlink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="<?php echo _path_tmp('images/svg-icon/notifications.svg')?>" class="img-fluid" alt="notifications">
                                            <span class="live-icon"></span></a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notoficationlink">
                                                <div class="notification-dropdown-title">
                                                    <h4>Notifications</h4>                            
                                                </div>
                                                <ul class="list-unstyled" id="notification_container">                                                    
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li> 
                                <li class="list-inline-item">
                                    <div class="profilebar">
                                        <div class="dropdown">
                                          <a class="dropdown-toggle" href="#" role="button" id="profilelink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="<?php echo _path_tmp('images/users/profile.svg')?>" 
                                            class="img-fluid" alt="profile"><span 
                                            class="feather icon-chevron-down live-icon"></span></a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profilelink">
                                                <div class="dropdown-item">
                                                    <div class="profilename">
                                                        <h5><?php echo whoIs('first_name') .' '.whoIs('last_name')?></h5>
                                                    </div>
                                                </div>
                                                <div class="userbox">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="media dropdown-item">
                                                            <a href="<?php echo _route('profile:index')?>" class="profile-icon">
                                                                <img src="<?php echo _path_tmp('images/svg-icon/user.svg')?>" class="img-fluid" alt="user">My Profile</a>
                                                        </li>                                                       
                                                        <li class="media dropdown-item">
                                                            <a href="<?php echo _route('sec:logout')?>" class="profile-icon">
                                                                <img src="<?php echo _path_tmp('images/svg-icon/logout.svg')?>" class="img-fluid" alt="logout">Logout</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                   
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End col -->
                </div> 
                <!-- End row -->
            </div>
            <!-- End Topbar -->
            <!-- Start Breadcrumbbar -->


            <?php if( !Material::isInit('pageHeader') ) :?>
                <div style="margin-top: 25px;"></div>
            <?php else:?>
            <!-- <div class="breadcrumbbar">
                <div class="row align-items-center">
                    <div class="col-md-8 col-lg-8">
                        <h4 class="page-title">Starter</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                                <li class="breadcrumb-item"><a href="#">Basic</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Starter</li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="widgetbar">
                            <button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Actions</button>
                        </div>                        
                    </div>
                </div>          
            </div> -->
            <?php endif?>
            <!-- End Breadcrumbbar -->
            <!-- Start Contentbar -->    
            <div class="contentbar">                
                <!-- Start row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="mt-3 mb-5">
                            <?php produce('content')?>
                        </div>
                    </div>
                    <!-- End col -->
                </div>
                <!-- End row -->
            </div>
            <!-- End Contentbar -->
            <!-- Start Footerbar -->
            <div class="footerbar">
                <footer class="footer">
                    <p class="mb-0">© <?php echo date('Y')?> <strong><?php echo COMPANY_NAME?></strong> - All Rights Reserved.</p>
                </footer>
            </div>
            <!-- End Footerbar -->
        </div>
        <!-- End Rightbar -->
    </div>
    <!-- End Containerbar -->
    <!-- Start js -->        
    <script src="<?php echo _path_tmp('js/jquery.min.js')?>"></script>
    <script src="<?php echo _path_tmp('js/popper.min.js')?>"></script>
    <script src="<?php echo _path_tmp('js/bootstrap.min.js')?>"></script>
    <script src="<?php echo _path_tmp('js/modernizr.min.js')?>"></script>
    <script src="<?php echo _path_tmp('js/detect.js')?>"></script>
    <script src="<?php echo _path_tmp('js/jquery.slimscroll.js')?>"></script>
    <script src="<?php echo _path_tmp('js/vertical-menu.js')?>"></script>
    <!-- Switchery js -->
    <script src="<?php echo _path_tmp('plugins/switchery/switchery.min.js')?>"></script>

    <script src="<?php echo _path_public('js/core.js')?>"></script>
    <script src="<?php echo _path_public('js/global.js')?>"></script>

     <!-- Datatable js -->
    <script src="<?php echo _path_tmp('plugins/datatables/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo _path_tmp('plugins/datatables/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo _path_tmp('plugins/datatables/dataTables.buttons.min.js')?>"></script>
    <script src="<?php echo _path_tmp('plugins/datatables/buttons.bootstrap4.min.js')?>"></script>
    <script src="<?php echo _path_tmp('plugins/datatables/jszip.min.js')?>"></script>
    <script src="<?php echo _path_tmp('plugins/datatables/pdfmake.min.js')?>"></script>
    <script src="<?php echo _path_tmp('plugins/datatables/vfs_fonts.js')?>"></script>
    <script src="<?php echo _path_tmp('plugins/datatables/buttons.html5.min.js')?>"></script>
    <script src="<?php echo _path_tmp('plugins/datatables/buttons.print.min.js')?>"></script>
    <script src="<?php echo _path_tmp('plugins/datatables/buttons.colVis.min.js')?>"></script>
    <script src="<?php echo _path_tmp('plugins/datatables/dataTables.responsive.min.js')?>"></script>
    <script src="<?php echo _path_tmp('plugins/datatables/responsive.bootstrap4.min.js')?>"></script>

    <script defer>
        $(document).ready(function() {
            $(".selectSearch").select2({
              tags: true
            });

            $('.dataTable').DataTable({
                responsive: true
            });

            feather.replace();
        });

        /*
        *fetch notifications
        */
        let userNotificationURL = getURL('api/API_Notification/getUserNotification');

        var HTMLNotificationContainer = $("#notification_container");
        $.ajax({
            url : userNotificationURL,
            method: 'post',
            data : {},
            success:function(response)
            {
                response = JSON.parse(response);

                let responseData = response.data;

                let HTMLDocument = '';

                for(let i in responseData)
                {
                    HTMLDocument += `
                        <li class="media dropdown-item">
                            <span class="action-icon badge badge-primary-inverse">
                            <i class="feather icon-dollar-sign"></i></span>
                            <a href="${responseData[i].link}">
                                <div class="media-body">
                                    <p><span class="timing">${responseData[i].notification}</span></p>                            
                                </div>
                            </a>
                        </li>
                    `;
                }

                HTMLNotificationContainer.html(HTMLDocument);

            }
        });

    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <?php produce('scripts')?>
    <!-- End js -->
</body>
</html>