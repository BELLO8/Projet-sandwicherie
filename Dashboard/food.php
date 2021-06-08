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
				<li class="active">Fast food et categories</li>
			</ol>
		</div><!--row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Charts</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-teal" data-percent="56" ><span class="percent">56%</span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-blue" data-percent="92" ><span class="percent">92%</span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-orange" data-percent="65" ><span class="percent">65%</span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<div class="easypiechart" id="easypiechart-red" data-percent="27" ><span class="percent">27%</span></div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<h2>Liste des Fast Food par categories <a href="#" data-toggle="modal" data-target="#1" class="btn btn-sm btn-danger">
                                    Ajouter un Fast Food
                                </a></h2> 
				           
                                
                                <div class="modal fade" id="1" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <div class="modal-body">
											   <form class="login_form " action="add.php" id="addfood" method="post" enctype="multipart/form-data">
												
						                          <h2>Ajout de Fast Food </h2>
												
														<!-- Name input-->
															<div class="form-group col-md-6">
														
																<label class="control-label" >Categorie</label>
															
																<?php $categories = $DB->select('SELECT * FROM category');?>
																		
																	<select class="form-control" name="cat">  
																	<?php foreach($categories as $categorie): ?>                 
																		<option  value="<?=$categorie->id ;?>">
																		<?=$categorie->categorie ;?>
																		</option>
																		<?php endforeach ; ?>
																	</select>
																
															</div>
															
														<div class="form-group col-md-6">
															<label class="control-label" for="name">Nom du fast food</label>
															
																<input id="name" name="nom"  type="text" placeholder="nom du fast food" class="form-control" required>
															
														</div>
																		
														<!-- Email input-->
														<div class="form-group col-md-6">
															<label class="control-label" for="details">Details</label>
															
																<input id="details" name="details"  type="text" placeholder="Details" class="form-control" required>
															
														</div>
														
														<!-- Message body -->
														<div class="form-group col-md-6">
															<label class=" control-label" for="message">Prix</label>
															
															<input  name="prix" type="number" min="150" max="35000" class="form-control" required>
															
														</div>

														<div class="form-group">
																
																	<label class="control-label">Choisissez une image</label>												
																	<input type="file" name="images" class="form-control" accept="image/*"/>																																			
																																
														</div>													
														<!-- Form actions -->
														<input type="submit" class="btn btn-md" style="color:white;background-color:#ff0066" value="Ajouter le Fast Food">
																		
												</form>
						   
			
											
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            
				</div>
						
			<div class="col-md-12">
				
				
				<div id="myBtnContainer" class="">
				  <button class="btn btn-md btn-primary active" onclick="filterSelection('all')">Show all</button>
					<?php $categories = $DB->select('SELECT * FROM category ');?>						
					<?php foreach($categories as $categorie): ?> 
				  <button class="btn btn-md btn-primary" onclick="filterSelection('<?=$categorie->categorie ;?>')"><?=$categorie->categorie ;?></button>
				    <?php endforeach ; ?>
				</div>

				<!-- Portfolio Gallery Grid -->
				<div class="row" id="owl-demo">
				<?php $foods = $DB->select('select category.categorie,food.cat_id,food.nom,food.details,food.images,food.prix from category inner join food on food.cat_id=category.id ');?>
				<?php foreach($foods as $food) :?>
				<div class=" column panel panel-default <?=$food->categorie ;?>" style="border-radius:20px;">
				<div class="content">
					<div class="row">
						<div class="col-md-4">
						<img src="upload/food/<?=$food->images ;?>" class=" round-image" height="70" width="70">
						</div>
					
						<div class="col-md-8">
							<h4><?= $food->nom ;?></h4>
							<p style="text-align:left;font-size:11px;font-weight:700;"><?=$food->details ;?></p>
							<span style="box-shadow:2px 2px 1px 2px grey;border:2px solid black;border-radius:12px;font-weight:800;font-size:14px;padding:5px;"><?=$food->prix;?> Fr</span>
						</div>
					</div>
					
				
										
				</div>
				</div>	
											
				<!-- END GRID -->
				<?php endforeach ;?>
				</div>
			</div><!-- /.col-->
		
		
	</div>	<!--/.main-->
	  

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script src="../assets/js/owl.carousel.min.js"></script>
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
						var btns = btnContainer.getElementsByClassName("btn");
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
