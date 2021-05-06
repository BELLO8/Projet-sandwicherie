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
    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="../assets/css/aqua.css" />
    <!-- color -->
    <link id="changeable-colors" rel="stylesheet" href="../assets/css/colors/orange.css" />
   
    <!-- Modernizer -->
    <script src="../assets/js/modernizer.js"></script>
    <script src="../assets/js/jquery.steps.js"></script>
    <script src="../assets/js/jquery.steps.min.js"></script>
   
   

</head>

    <?php if ($_SERVER['REQUEST_URI'] == '/') :?>
       
        <?php else : ?>
                            
                <style>
                    #header
                {
                    background:#e6e5b5;
                }
                   
                    
                    .price{
                    
                        width: 40px;
                        height: 40px;
                        line-height: 40px;
                        border: dashed 1px #e75b1e;
                        border-radius: 92px;  
                        color: #000;
                        font-size: 26px;
                        font-family: 'Roboto', sans-serif;
                        text-align: center;
                        letter-spacing: .5px;
                    
                        }
                        .round-image{
                            border-radius: 20px;
                        }

                        * {
box-sizing: border-box;
}
.bt:hover{
      background:#000;
      border-radius: 8px;
}
.bt.active{
    background:#000;
      border-radius: 8px;
}

/* Center website */
.main {
max-width: 1000px;

}
h1 {
font-size: 50px;
word-break: break-all;
}
.row {
margin: 2px -6px;
}
/* Add padding BETWEEN each column (if you want) */
.row,
.row > .column {
padding: 8px;
}
/* Create three equal columns that floats next to each other
*/
.column {
	width:95%;
	margin: 8px ;
display: none; /* Hide columns by default */
}
.carte:hover{
    background: #e4e4e4a2;
    transition-delay: 2ms;
    
}
/* Clear floats after rows */
.row:after {
content: "";
display: table;
clear: both;
}
/* Content */
.content {
	border-radius: 20px;
background-color: white;
padding: 10px;
}
/* The "show" class is added to the filtered elements */
.show {
display: block;
}
#regForm {
  background-color: #ffffff;
  margin: 0 auto;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 35px;
  width: 110px;
  margin: 0 2px;
  background-color: #e75b1e;
  border: none; 
  border-radius: 8px;
  font-weight:900;
  color:#ffdddd;
  font-size:12px;
  display: inline-block;
  opacity: 0.5;
  padding:7px;
}

/* Mark the active step: */
.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
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
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="<?= ($_SERVER['REQUEST_URI']=== '/') ? 'active' : '' ?>"><a href="<?= $router->generate('home') ?>#banner">Accueil</a></li>
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
    <?= $pagecontent ?>

    <div id="footer" class="footer-main">
        <!-- end footer-news -->
        <div class="footer-box pad-top-70">
            <div class="container">
                <div class="row">
                    <div class="footer-in-main">
                     
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="footer-box-a">
                                <h3>A propos</h3>
                                <p>Nous sommes specialisé dans la restauration rapide qu'on appel fast food notre but
                            est de faire gagner du temps aux clients ...</p>
                                <ul class="socials-box footer-socials pull-left">
                                    <li>
                                        <a href="#">
                                            <div class="social-circle-border"><i class="fa  fa-facebook"></i></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="social-circle-border"><i class="fa fa-twitter"></i></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="social-circle-border"><i class="fa fa-google-plus"></i></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="social-circle-border"><i class="fa fa-pinterest"></i></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="social-circle-border"><i class="fa fa-linkedin"></i></div>
                                        </a>
                                    </li>
                                </ul>

                            </div>
                            <!-- end footer-box-a -->
                        </div>
                        <!-- end col -->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="footer-box-b">
                                <h3>Nos Menus</h3>
                                <ul>
                                    <li><a href="<?= $router->generate('menu');?>">Burgers (Ivoire)</a></li>
                                    <li><a href="<?= $router->generate('menu');?>">Burgers </a></li>
                                    <li><a href="<?= $router->generate('menu');?>">Chawarmas</a></li>
                                    <li><a href="<?= $router->generate('menu');?>">Desserts et Gâteux de cérémonies</a></li>
                                    <li><a href="<?= $router->generate('menu');?>">Les Kits Burgers </a></li>
                                    <li><a href="<?= $router->generate('menu');?>">Poulet Frites </a></li>
                                </ul>
                            </div>
                            <!-- end footer-box-b -->
                        </div>
                        <!-- end col -->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="footer-box-c">
                                <h3>Contact </h3>
                                <p>
                                    <i class="fa fa-map-signs" aria-hidden="true"></i>
                                    <span>Dabou, Taxis gare en face de la station total, Côte d'Ivoire</span>
                                </p>
                                <p>
                                    <i class="fa fa-mobile" aria-hidden="true"></i>
                                    <span>
									+225 42 03 19 95 | 09 72 66 46 | 65 06 90 25
								</span>
                                </p>
                                <p>
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <span><a href="#">alipoegroupentreprise@gmail.com</a></span>
                                </p>
                            </div>
                            <!-- end footer-box-c -->
                        </div>
                        <!-- end col -->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="footer-box-d">
                                <h3>Heure d'ouverture</h3>

                                <ul>
                                    <li>
                                        <p>Lundi - Samedi </p>
                                        <span> 08:00  - 23:00</span>
                                    </li>
                                    <li>
                                        <p>Dimanche</p>
                                        <span>  16:00 - 23:00</span>
                                    </li>
                                </ul>
                            </div>
                            <!-- end footer-box-d -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end footer-in-main -->
                </div>
                <!-- end row -->
            </div>
        
            <!-- end copyright-main -->
        </div>
        <!-- end footer-box -->
    </div>
    
    <a href="#" class="scrollup" style="display: none;">Scroll</a>

    <!-- ALL JS FILES -->
    

    <script src="../assets/js/all.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/sweetalert.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script>
       filterSelection("all") 
						function filterSelection(c) {
						var x, i;
						x = document.getElementsByClassName("column");
						if (c == "all") c = "";

						
						for (i = 0; i < x.length; i++) {
						w3RemoveClass(x[i], "show");
						if (x[i].className.indexOf(c) > -1) w3AddClass(x[i],
						"show");
						}
						}
						// Show filtered elements
						function w3AddClass(element, name) {
						var i, arr1, arr2;
						arr1 = element.className.split(" ");
						arr2 = name.split(" ");
						for (i = 0; i < arr2.length; i++) {
						if (arr1.indexOf(arr2[i]) == -1) {
						element.className += " " + arr2[i];
						}
						}
						}
						// Hide elements that are not selected
						function w3RemoveClass(element, name) {
						var i, arr1, arr2;
						arr1 = element.className.split(" ");
						
						arr2 = name.split(" ");
						for (i = 0; i < arr2.length; i++) {
						while (arr1.indexOf(arr2[i]) > -1) {
						arr1.splice(arr1.indexOf(arr2[i]), 1);
						}
						}
						element.className = arr1.join(" ");
						}
						// Add active class to the current button (highlight it)
						var btnContainer = document.getElementById("myBtnContainer");
						var btns = btnContainer.getElementsByClassName("bt");
						for (var i = 0; i < btns.length; i++) {
						btns[i].addEventListener("click", function(){
						var current = document.getElementsByClassName("active");
						current[0].className = current[0].className.replace("active", "");
						this.className += " active";
						});
						}
    
</script>

</body>

</html>

 