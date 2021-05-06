<?php 
 if(session_status() === PHP_SESSION_NONE){
           session_start();
	   }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tableau de bord | Sandwicherie chez David</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/popupmodal.css" />
	<link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
	<link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

	<script src="js/jquery.min.js"></script>

	
		
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<style>
       * {
box-sizing: border-box;
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
margin: 8px -16px;
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
/* Clear floats after rows */
.row:after {
content: "";
display: table;
clear: both;
}
/* Content */
.content {
	border-radius:20px;
background-color: white;
padding: 10px;
}
/* The "show" class is added to the filtered elements */
.show {
display: block;
}
/* Style the buttons */

.round-image{
	border-radius:5px;
}

</style>

<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="/Dashboard/"><span>Tableau de </span> Bord</a>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="../../assets/images/logo1.png" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?= $_SESSION['user'] ;?></div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		
		<ul class="nav menu">
			<li class="<?=($_SERVER['REQUEST_URI']=== '/Dashboard/' ? 'active': '')?>"><a href="/Dashboard/"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li class="<?=($_SERVER['REQUEST_URI']=== '/Dashboard/publication.php' ? 'active': '')?>"><a href="publication.php"><em class="fa fa-image">&nbsp;</em> Publication</a></li>
			<li class="<?=($_SERVER['REQUEST_URI']=== '/Dashboard/food.php' ? 'active' : '')?>"><a href="food.php"><em class="fa fa-book">&nbsp;</em> Fast food &amp; Categorie</a></li>
			<li class="<?=($_SERVER['REQUEST_URI']=== '/Dashboard/commande.php' ? 'active' : '')?>"><a href="commande.php"><em class="fa fa-shopping-bag">&nbsp;</em> Commandes</a></li>
			<li class="<?=($_SERVER['REQUEST_URI']=== '/Dashboard/cat.php' ? 'active' : '')?>"><a href="cat.php"><em class="fa fa-clipboard">&nbsp;</em> Categories &amp; Slides</a></li>
			<li> <?php if(est_connecte()) :?>
			<a href="logout.php"><em class="fa fa-power-off">&nbsp;</em>Deconnexion</a>
			<?php endif ;?>
			</li>
		</ul>
	</div><!--/.sidebar-->
		