<?php 
$error = null;
if(!empty($_POST['user']) and !empty($_POST['password'])){
	if($_POST['user'] == 'Admin' && $_POST['password'] == 'Admin88'){
		session_start();
		$_SESSION['connecte'] = 1;
		$_SESSION['user'] = $_POST['user'];
		header('location:index.php');
		exit();

	} else{
		$error = "Identifiants incorrects";
	}

}
require 'auth.php';
if(est_connecte()){
	header('location:index.php');
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>    
	<div class="row">
	   <?php if($error) :?>
		<div class="container alert bg-danger" role="alert"><h4 class="container "><?=$error ;?> </h4></div>
		      
		  </div>
	   <?php endif ;?>
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
				<div class="panel-body">
					<form role="form" action="" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Nom d'utilisateur" name="user" type="text" autofocus="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Mot de passe" name="password" type="password"  required>
							</div>
							<div class="checkbox">
								
							</div>
							<input type="submit" class="btn btn-primary" value="Se connecte">
							</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
