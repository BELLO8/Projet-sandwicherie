<?php 
require 'auth.php';
force_connexion();
require '../src/db.class.php';
$DB = new DB();

?>
	<?php include('includes/sidenav.php');?>

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Publications</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Publications <a href="#" data-toggle="modal" data-target="#slide" class="btn btn-sm" style="color:white;background-color:#ff0066">
						Ajouter une Publication
						</a></h1>
					<div class="modal fade" id="slide" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
								<div class="modal-body">
									<form class="login_form "  action="addpost.php" method="post" enctype="multipart/form-data">
									<h2>Ajouter une Publication</h2>
										<div class="form-group">
											<label>Titre de la publication</label>
											<input class="form-control" name="texte" placeholder="Entrer un texte" required>
										</div>
										
										<div class="form-group">
											<label>Image de la publication</label>
											<input type="file" name="photo" class="form-control" accept="image*/">
											
										</div>
										<button type="submit" class="btn btn-md" style="color:white;background-color:#ff0066">Ajouter</button>
										</form>
								
								</div>
								
							</div>
						</div>
					</div>
				</div>
		</div><!--/.row-->

		<div class="row">
		
		</div><!--/.row-->
	</div>	<!--/.main-->
	  

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/polyfill.js"></script>
 	<script src="js/popupmodal-min.js"></script>
	 <script>

$(function()
{ 
	//$("#dialogue").dialog();// création de la fenêtre
	//
	$("#dialogue").dialog({buttons: [{text: "Valider", click: function() {$(this).dialog("close");}}]}); // ajout d'un bouton pour fermet la fenêtre

	$("#dialogue").dialog({draggable: true});// autorise le déplacement de la fenêtre
	$("#dialogue").dialog({width: 550});// la largeur de la fenêtre

	$("#dialogue").dialog({modal: true});// bloc l'accès aux éléments sous la fenêtre
	$("#dialogue").dialog({resizable: true});// autorise le redimensionnement de la fenêtre

	$("#dialogue").dialog({show: "slow"});// ajoute une animation à l'ouverture de la fenêtre

	$( "#button" ).button();
	$( "#button" ).click(function( event ) { // au clic sur le bouton --> ouvre la fenêtre
		$("#dialogue").dialog("open");
	});
});

</script>
</body>
</html>
