<?php 
require 'auth.php';
force_connexion();
require '../src/db.class.php';
$DB = new DB();
$success = false;
if(isset($_POST) and !empty($_POST)){
	if(isset($_GET['id'])){
		 $cat = $_POST['categorie'];
    $id = (int)$_GET['id'];
   
    $DB->query('UPDATE category SET categorie = :categorie WHERE id= :id',array(
        'categorie'=>$cat,
        'id'=>$id       
	));
	$success = true;
	} else{
		echo 'aucune modification';
	}
   
}

?>


<?php include('includes/sidenav.php');?>

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Categories et Slides</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Categories &amp; Slides</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row" style="margin-bottom:20px;">
		 <h2 class="container">Listes des categories <a href="#" data-toggle="modal" data-target="#1" class="btn btn-sm" style="color:white;background-color:#ff0066">
                                    Ajouter une categorie
                                </a></h2>
		 
                                
                                <div class="modal fade" id="1" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <div class="modal-body">
												<form action="addcat.php" method="post" class="login_form" id="form1">
													<h2>Ajouter une categorie</h2>
													<div class="form-group">
														<label>Nom de la categorie</label>
														<input class="form-control" name="categorie" placeholder="Entrer une categorie" required>
													</div>
													
													<button type="submit" class="btn btn-md" style="color:white;background-color:#ff0066">Ajouter</button>
												</form>
											
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            
               
                     
		 <?php $categories = $DB->select('SELECT * FROM category') ; ?>								
				<?php foreach($categories as $categorie): ?>
			<div class="col-lg-6">
			<div class="panel-heading panel-blue"  style="margin-bottom:10px;border-radius:12px;">
						<?= htmlentities($categorie->categorie) ; ?>
						<a href="" data-toggle="modal" data-target="#editcat<?= $categorie->id ;?>" style="color:#fff;font-size:14px;" class="pull-right">
												<em class="fa fa-pencil"></em> Modifier
											</a>
                                <div class="modal fade" id="editcat<?= $categorie->id ;?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <div class="modal-body">
												<form action="cat.php?id=<?=$categorie->id;?>" method="post" class="login_form" id="editform-<?= $categorie->id ;?>">
												<h2>Edition de la categorie</h2>
												<div class="form-group">
																	<label>Nom de la categorie</label>
																	<input class="form-control" name="categorie" value="<?= htmlentities($categorie->categorie);?>" placeholder="Entrer une categorie" required>
																</div>
																
																<input type="submit" class="btn btn-md" style="color:white;background-color:#ff0066" value="Modifier">
											</form>
											
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
						<ul class="pull-right panel-settings panel-button-tab-right" style="background:transparent;border:none;">
						<form id="delete-<?= $categorie->id ;?>" action="delcat.php?id=<?= $categorie->id ;?>" method="post">
								                    </form>
													<a class="trash" type="submit" style="color:#fff;font-size:14px;" onclick="
																							popup.confirm(
																								{ 
																								content: 'Voulez-vous supprimer la categorie <?= $categorie->categorie ;?>?',
																								default_btns : {
																									ok : 'Oui',
																									cancel : 'Non'
																								},
																								modal_size : 'small',
																								btn_align : 'right'
																								},
																								function(config){
																									
																									if(config.proceed){
																										document.getElementById('delete-<?= $categorie->id ;?>').submit();
																									} else {
																										
																									}
																								}
																							);
														"><em class="fa fa-trash"></em></a>
						
						</ul>
						</span></div>
		       
				</div>
				<?php endforeach ;?>
		</div><!--/.row-->		
		<h2>Listes des slides <a href="#" data-toggle="modal" data-target="#slide" class="btn btn-sm" style="color:white;background-color:#ff0066">
                                    Ajouter un slide
                                </a></h2>
		
                                <div class="modal fade" id="slide" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <div class="modal-body">
											   <form class="login_form " id="slide" action="addslide.php" method="post" enctype="multipart/form-data">
												<h2>Ajouter un slide</h2>
													<div class="form-group">
														<label>Texte de slide</label>
														<input class="form-control" name="texte" placeholder="Entrer un texte" required>
													</div>
													
													<div class="form-group">
														<label>Image de slide</label>
														<input type="file" name="photo" class="form-control" accept="image*/">
														
													</div>
													<button type="submit" class="btn btn-md" style="color:white;background-color:#ff0066">Ajouter</button>
				                                 </form>
											
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
		
		
			
										
				
		    <div class="row" >
			<?php $sliders = $DB->select('SELECT * FROM slider') ; ?>
			<?php foreach($sliders as $slider): ?>
				<div style="margin-left:12px;" class="row col-md-6">
					<div class="panel panel-primary">
					            <a href="#" data-toggle="modal" data-target="#editslide<?= $slider->id ;?>" style="font-weight:800">
									<em class="fa fa-pencil"></em> Modifier
								</a> <a class="trash" type="submit" onclick="
																								popup.confirm(
																									{ 
																									content: 'Voulez-vous supprimer ?',
																									default_btns : {
																										ok : 'Oui',
																										cancel : 'Non'
																									},
																									modal_size : 'small',
																									btn_align : 'right'
																									},
																									function(config){
																										
																										if(config.proceed){
																											document.getElementById('delslide-<?= $slider->id ;?>').submit();
																										} else {
																											
																										}
																									}
																								);
															"><em class="fa fa-trash"></em>Supprimer</a> 
															<form id="delslide-<?= $slider->id ;?>" action="delslide.php?id=<?= $slider->id ;?>" method="post">
								                            </form>

                                <div class="modal fade" id="editslide<?= $slider->id ;?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <div class="modal-body">
												
											   <form class="login_form " id="editslide<?= $slider->id ;?>"  action="editslide.php?id=<?= $slider->id ;?>" method="post" enctype="multipart/form-data">
														<h2>Edition du slide</h2>
														<div class="form-group">
															<label>Texte de slide</label>
															<input class="form-control" name="texte" value="<?=htmlentities($slider->texte);?>" placeholder="Entrer un texte" required>
														</div>
														<div class="form-group">
															<label>Image de slide</label>
															<input type="file" name="slider" class="form-control" accept="image*/">
														</div>				
															<button type="submit" class="btn btn-md" style="color:white;background-color:#ff0066">Modifier</button>
												</form>
											
                                            </div>
                                            
                                        </div>
                                    </div>
								</div> 
						<div class="panel-heading" style="font-size:15px;"><?=Ucfirst($slider->texte) ;?>
						
					
						</div>
						<div class="panel-body ">
							<img src="upload/slider/<?= $slider->images ;?>" style="width:250px;height:250px;" />
							</div>
					</div>
				</div>	
				<?php endforeach ;?>	
		   </div><!-- /.row -->
		
	</div><!--/.main-->
	
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
	<script src="../assets/js/owl.carousel.min.js"></script>
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
