<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">

    <!-- Site Metas -->
    <title> <?= $title ?? 'Oops'  ?></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="../assets/images/logo1.png" type="image/x-icon" />
    <link rel="apple-touch-icon" href="../assets/images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- color -->
    <link id="changeable-colors" rel="stylesheet" href="../assets/css/colors/orange.css" />

    <!-- Modernizer -->
    <script src="../assets/js/modernizer.js"></script>

   

</head>


<body>
    <div id="loader">
        <div id="status"></div>
    </div>
<div id="site-header">
        <header id="header" class="header-block-top">
            <div class="container">
                <div class="row">
                    <div class="main-menu">
                        <!-- navbar -->
                        <nav class="navbar navbar-default" id="mainNav">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <div class="logo">
                                    <a class="navbar-brand js-scroll-trigger logo-header" href="../">
                                        <img src="../assets/images/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="<?= ($_SERVER['REQUEST_URI']=== '/') ? 'active' : '' ?>"><a href="<?= $router->generate('home') ?>">Accueil</a></li>
                                    <li><a href="<?= $router->generate('home') ?>#apropos">A propos</a></li>
                                    <li class="<?= ($_SERVER['REQUEST_URI']=== '/Menu') ? 'active' : '' ?>"><a href="<?= $router->generate('menu') ?>">Menus</a></li>
                                    <li><a href="<?= $router->generate('home') ?>#plats">Nos plats</a></li>
                                    <li class="<?= ($_SERVER['REQUEST_URI']=== '/Commander-en-ligne') ? 'active' : '' ?>"><a href="<?= $router->generate('reservation') ?>">Commander</a></li>
                                    <li><a href="<?= $router->generate('home') ?>#contact">Contactez-nous</a></li>
                                </ul>
                            </div>
                            <!-- end nav-collapse -->
                        </nav>
                        <!-- end navbar -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </header>
        <!-- end header -->
    </div>
    
        <section id="main-container" class="main-container" style="top:35%;margin-top:17%">
            <div class="container">

                <div class="row">

                    <div class="error-page text-center">
                    <div class="error-code">
                        <h2 style="font-size:95px;"><strong>404</strong></h2>
                    </div>
                    <div class="error-message">
                        <h3>Oops... Page Not Found!</h3>
                    </div>
                    <div class="error-body">
                        Try using the button below to go to main page of the site <br>
                        <a href="/" class="btn btn-danger" style="margin-top:10px;">Back to Home Page</a>
                    </div>
                    </div>
                
                </div><!-- Content row -->
            </div><!-- Conatiner end -->
        </section><!-- Main container end -->
 
    
    <script src="../assets/js/all.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="../assets/js/sweetalert.min.js"></script>
    <script src="../assets/js/custom.js"></script>
  
</body>

</html>

 