<?php 
require 'auth.php';
force_connexion();
require '../src/db.class.php';
$DB = new DB();
$nbfood = $DB->count('SELECT COUNT(*) FROM food');
$nbslide = $DB->count('SELECT COUNT(*) from slider');
$nbcomm = $DB->count('SELECT COUNT(*) from commande');
$nbcat = $DB->count('SELECT COUNT(*) from category');
$success = false;
if(isset($_POST) and !empty($_POST)){
    $cat = $_POST['categorie'];
    
    $DB->query('INSERT INTO category(categorie) VALUES(:categorie)',array(
        'categorie'=>$cat       
    ));
    $success = true;
    $message ='categorie ajoutée avec succes!';
}

?>

<?php include('includes/sidenav.php');?>		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-container">
			<div class="row">
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-shopping-bag color-blue"></em>
							<div class="large"><?= $nbcomm ;?></div>
							<div class="text-muted">Nouvelles commandes</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-book color-orange"></em>
							<div class="large"><?= $nbfood ;?></div>
							<div class="text-muted">Fast food</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-clipboard color-teal"></em>
							<div class="large"><?= $nbcat . " / " . $nbslide ;?></div>
							<div class="text-muted">Categorie  /  Slides</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-red panel-widget ">
						<div class="row no-padding"><em class="fa fa-xl fa-users color-red"></em>
							<div class="large">25.2k</div>
							<div class="text-muted">Visiteurs de la page</div>
						</div>
					</div>
				</div>
			</div><!--/.row-->
		</div>

		<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>New Orders</h4>
						<div class="easypiechart" id="easypiechart-blue" data-percent="92" ><span class="percent">92%</span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Comments</h4>
						<div class="easypiechart" id="easypiechart-orange" data-percent="65" ><span class="percent">65%</span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>New Users</h4>
						<div class="easypiechart" id="easypiechart-teal" data-percent="56" ><span class="percent">56%</span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Visitors</h4>
						<div class="easypiechart" id="easypiechart-red" data-percent="27" ><span class="percent">27%</span></div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
	
																  
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-info chat">
					<div class="panel-heading">
						Liste des Fast Food
						
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body articles-container">
					<?php  $fastfood = $DB->select('SELECT * FROM food');?> 
                     <?php foreach ($fastfood as $food) :?>
						<div class="article border-bottom">
							<div class="col-xs-12">
								<div class="row">
									<div class="col-xs-2 col-md-2 date">
										<div class="large"><h4 style="font-weight:900;font-size:14px;	"><?=$food->prix ; ?> CFA</h4></div>
										
									</div>
									<div class="col-xs-7 col-md-7">
										<h4 style="font-size:15px;font-weight:900;"><a href="" data-toggle="modal" data-target="#<?=$food->id ;?>"><?=$food->nom ; ?></a></h4>
										<p style="text-align:left;font-size:11px;font-weight:700;"><?=$food->details ; ?></p>										
									</div>
									<div class="col-xs-3 col-md-3">
									<img src="upload/food/<?=$food->images ;?>" class="round-image" height="70" width="70">										
									</div>
									
								</div>
							</div>
							<div class="clear">
							       <form id="del-<?= $food->id ;?>" action="del.php?id=<?= $food->id ;?>" method="post">
								   </form>
								<a class="trash" type="submit" onclick="
																			popup.confirm(
																				{ 
																				content: 'Voulez-vous supprimer <?=$food->nom ; ?>?',
																				default_btns : {
																					ok : 'Oui',
																					cancel : 'Non'
																				},
																				modal_size : 'small',
																				btn_align : 'right',
																				
																				},
																				function(config){
																					
																					if(config.proceed){
																						document.getElementById('del-<?= $food->id ;?>').submit();
																						
																					} else {
																						
																					}
																				}
																			);
										"><em class="fa fa-trash"></em></a>
										<div class="box">
											<a href="#" data-toggle="modal" data-target="#<?=$food->id ;?>">
												Modifier <i class="fa fa-pencil"></i>
											</a>
											<div class="modal fade" id="<?=$food->id ;?>" tabindex="-1" role="dialog">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
														<div class="modal-body">
														<form class="login_form row" action="editfood.php?id=<?=$food->id ;?>" id="editfood-<?= $food->id ;?>" method="post" enctype="multipart/form-data">
															
															<h2>Edition du fast food </h2>
															
																<!-- Name input-->
																<div class="form-group col-md-6 col-sm-12">
																
																		<label class="control-label" >Categorie</label>
																	
																		<?php $categories = $DB->select('SELECT category.categorie , food.cat_id  FROM category INNER JOIN food on category.id=food.cat_id WHERE food.id=:id',array('id'=>$food->id));?>
																				
																			<select class="form-control" name="cat">  
																			<?php foreach($categories as $categorie): ?>                 
																				<option  value="<?=$categorie->cat_id ;?>">
																				<?=$categorie->categorie ;?>
																				</option>
																				<?php endforeach ; ?>
																			</select>
																		
																	</div>
																	
																<div class="form-group col-md-6 col-sm-12">
																	<label class="control-label" for="name">Nom du fast food</label>
																	
																		<input id="name" name="nom" value="<?= htmlentities($food->nom) ;?>" type="text" placeholder="nom du fast food" class="form-control" required>
																	
																</div>
															
																<!-- Email input-->
																<div class="form-group col-md-6 col-sm-12">
																	<label class="control-label" for="details">Details</label>
																	
																		<input id="details" name="details" value="<?= htmlentities($food->details);?>" type="text" placeholder="Details" class="form-control" required>
																	
																</div>
																
																<!-- Message body -->
																<div class="form-group col-md-6 col-sm-12">
																	<label class=" control-label" for="message">Prix</label>
																	
																	<input  name="prix" type="number"  value="<?=$food->prix ;?>" min="150" max="35000" class="form-control" required>
																	
																</div>

			
															

																<div class="form-group" style="margin-bottom:22px;">
																	
																	<div class="col-md-6">
																		<label class="control-label">Choisissez une image</label>												
																			<input type="file" name="photo" class="form-control" accept="image/*"/>																																			
																	</div>	
																	<div class="form-group col-md-6">
																	<img src="upload/food/<?=$food->images ;?>" class="round-image col-md-4" height="80" width="80">
																	</div>												   					
																</div>													
																<!-- Form actions -->
																<input type="submit" class="btn btn-md" style="color:white;background-color:#ff0066" value="Modifier">
															
														</form>
														
														</div>
													</div>
												</div>
											</div>
										</div>
										
							          <!--<a href="#editfood-?= //$food->id ;?" rel="modal:open">Edit</a>-->
										<form class="login_form modal row" action="editfood.php?id=<?=$food->id ;?>" id="editfood-<?= $food->id ;?>" method="post" enctype="multipart/form-data">
												
												<h2>Edition du fast food </h2>
												
													<!-- Name input-->
													<div class="form-group col-md-6 col-sm-12">
													
															<label class="control-label" >Categorie</label>
														
															<?php $categories = $DB->select('SELECT category.categorie , food.cat_id  FROM category INNER JOIN food on category.id=food.cat_id WHERE food.id=:id',array('id'=>$food->id));?>
																	
																<select class="form-control" name="cat">  
																<?php foreach($categories as $categorie): ?>                 
																	<option  value="<?=$categorie->cat_id ;?>">
																	<?=$categorie->categorie ;?>
																	</option>
																	<?php endforeach ; ?>
																</select>
															
														</div>
														
													<div class="form-group col-md-6 col-sm-12">
														<label class="control-label" for="name">Nom du fast food</label>
														
															<input id="name" name="nom" value="<?= htmlentities($food->nom) ;?>" type="text" placeholder="nom du fast food" class="form-control" required>
														
													</div>
												
													<!-- Email input-->
													<div class="form-group col-md-6 col-sm-12">
														<label class="control-label" for="details">Details</label>
														
															<input id="details" name="details" value="<?= htmlentities($food->details);?>" type="text" placeholder="Details" class="form-control" required>
														
													</div>
													
													<!-- Message body -->
													<div class="form-group col-md-6 col-sm-12">
														<label class=" control-label" for="message">Prix</label>
														
														<input  name="prix" type="number"  value="<?=$food->prix ;?>" min="150" max="35000" class="form-control" required>
														
													</div>

 
												  

													<div class="form-group" style="margin-bottom:22px;">
														
														 <div class="col-md-6">
															<label class="control-label">Choisissez une image</label>												
																<input type="file" name="photo" class="form-control" accept="image/*"/>																																			
														</div>	
														<div class="form-group col-md-6">
														  <img src="upload/food/<?=$food->images ;?>" class="round-image col-md-4" height="80" width="80">
														</div>												   					
													</div>													
													<!-- Form actions -->
													<input type="submit" class="btn btn-md" style="color:white;background-color:#ff0066" value="Modifier">
												
											</form>
						    </div>
						</div><!--End .article-->
                         
						<?php endforeach ; ?>
						
						
					</div>
				</div><!--End .articles-->
				
				
				<div class="panel panel-info">
					<div class="panel-heading">
						Liste des categories
				<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<ul class="todo-list">
							<?php $categories = $DB->select('SELECT * FROM category') ; ?>
							<?php foreach($categories as $categorie): ?>
							<li class="todo-list-item">
								<div class="checkbox">
									<input type="checkbox" id="checkbox-<?= $categorie->id ;?>" />
									<label for="checkbox-<?= $categorie->id ;?>"><?= $categorie->categorie ;?></label>
								</div>
								<div class="pull-right action-buttons">
									<form id="delete-<?= $categorie->id ;?>" action="delcat.php?id=<?= $categorie->id ;?>" method="post">
								   </form>
								   <a class="trash" type="submit" onclick="
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
								   
								<a href="#editform-<?= $categorie->id ;?>" rel="modal:open" >Edit</a>
								          <form action="editcat.php?id=<?=$categorie->id;?>" method="post" class="login_form modal" id="editform-<?= $categorie->id ;?>" style="display:none;">
												<h2>Edition de la categorie</h2>
												<div class="form-group">
													<label>Nom de la categorie</label>
													<input class="form-control" name="categorie" value="<?= $categorie->categorie;?>" placeholder="Entrer une categorie" required>
												</div>
																
												<input type="submit" class="btn btn-md" style="color:white;background-color:#ff0066" value="Modifier">
											</form>
								
								</div>
							</li>
							<?php endforeach ; ?>
	
						</ul>
					</div>
					<div class="panel-footer">
						<form action="" method="post">
							<div class="form-group">
							    <input  type="text" class="form-control" placeholder="Ajouter une categorie" name="categorie" required/>
								<span class="">
								<button class="btn btn-primary btn-md" type="submit" id="btn-todo">Ajouter une categorie</button>
						       </span>
						</div>
						</form>
						
					</div>
				</div>
				
			</div><!--/.col-->
			
			<div class="col-md-6">
				<div class="panel panel-red">
					<div class="panel-heading">
						Calendar
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<div id="calendar"></div>
					</div>
				</div>
				
				<div class="panel panel-warning">
					<div class="panel-heading">
					Ajouter un fast food
					
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<form class="form-horizontal" action="add.php" method="post" enctype="multipart/form-data">
							<fieldset>
								<!-- Name input-->
								<div class="form-group">
										<label class="col-md-3 control-label" >Categorie</label>
										<div class="col-md-9">
											<select class="form-control" name="cat">
											<?php $categories = $DB->select('SELECT * FROM category') ; ?>
											<?php foreach($categories as $categorie): ?>
												<option value="<?=$categorie->id ;?>"><?=$categorie->categorie ;?></option>
											<?php endforeach ; ?>
											</select>
										</div>
									</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Nom du fast food</label>
									<div class="col-md-9">
										<input id="name" name="nom" type="text" placeholder="nom du fast food" class="form-control" required>
									</div>
								</div>
							
								<!-- Email input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="details">Details</label>
									<div class="col-md-9">
										<input id="details" name="details" type="text" placeholder="Details" class="form-control" required>
									</div>
								</div>
								
								<!-- Message body -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Prix</label>
									<div class="col-md-9">
									<input  name="prix" type="number"  min="150" max="35000" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Image</label>
									<div class="col-md-9">
									<input type="file" name="images" class="form-control" accept="image/*"/>
									</div>
									
								</div> 
								<!-- Form actions -->
								<div class="form-group">
									<div class="col-md-12 widget-right">
										<button type="submit" class="btn btn-default btn-md pull-right">Ajouter</button>
									</div>
								</div>

								

							</fieldset>
						</form>
					</div>
				</div>
			</div><!--/.col-->
			<div class="col-sm-12">
				<p class="back-link"></p>
			</div>
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
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
		
</body>
</html>