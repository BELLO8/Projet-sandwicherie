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

    <?php if ($_SERVER['REQUEST_URI'] == '/') :?>
       
        <?php else : ?>
                            
                <style>
                    #header
                {
                    background:#fff;
                }
                    .carte:hover {
                            background:#e75b1e;
                            background-color:white;
                        border-radius:30px;
                    
                    }
                    
                    .price{
                    
                        width: 80px;
                        height: 80px;
                        line-height: 80px;
                        border: dashed 1px #e75b1e;
                        border-radius: 92px;  
                        color: #000;
                        font-size: 26px;
                        font-family: 'Roboto', sans-serif;
                        text-align: center;
                        letter-spacing: .5px;
                    
                        }
                    
                    </style>

    <?php endif ;?>
   

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