<?php 
require 'auth.php';
force_connexion();
require '../src/db.class.php';
$DB = new DB();

include('includes/sidenav.php');?>	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Commandes</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header" style="font-weight:900;">Commandes</h2>
			</div>
		</div><!--/.row-->
				
	<div class="table-responsive">
	<?php $commandes = $DB->select('SELECT * FROM commande');?>
			<?php if(empty($commandes)) :?>
				<h3 class="m-0  " style="text-align:center;color:#ccc;font-weight:900;">Aucune commandes</h3>
				<?php else :?>
	  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		<thead style="font-size:11px;">
					
		  <tr>
			<th>Nom et Prenom</th>
			<th>Numero</th>
			<th>Adresse</th>
			<th>Livraison</th>
			<th>Date livraison</th>
			<th>Produits commandés</th>
			<th>Date et Heure de commande</th>
			<th>Status de la commande</th>
			
		  </tr>
		</thead>
		<tbody>	 				
			<?php foreach($commandes as $commande) :?>
			<tr>
			<td><?=ucfirst($commande->nom_cli)." ".ucfirst($commande->prenom_cli);?></td>
			<td><?=$commande->num_cli ;?></td>
			<td><?=ucfirst($commande->add_cli) ;?></td>
			<td><?=ucfirst($commande->livraison) ;?></td>
			<td><?php $t=strtotime($commande->date_livr);
			  echo date("d-m-Y ",$t);
			  ?></td>
			<td><a href="#" class="btn btn-info" data-toggle="modal" data-target="#produit-<?=$commande->id_command ;?>">
                                    Produits commandés
                                </a>
			
                                
                                <div class="modal fade" id="produit-<?=$commande->id_command ;?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <div class="modal-body">
													
																<table class="table">
														<thead style="background:#e75b1e;">
															<tr style="color:#fff;">
															<th scope="col" class="border-0 bg-light">
																<div class="p-2 px-3 text-uppercase">Produits</div>
															</th>
															<th scope="col" class="border-0 bg-light">
																<div class="py-2 text-uppercase">Prix</div>
															</th>
															<th scope="col" class="border-0 bg-light">
																<div class="py-2 text-uppercase">Sous-Total</div>
															</th>
															
															</tr>
														</thead>
														<tbody>
														<?php $total2 = 0 ;
														foreach(unserialize($commande->produits_command) as $key=>$produit) :?>
															<tr>
															<th scope="row" class="border-0">
															<div class="col-md-6">
																								<ul style="text-align:left;">  
																								
																								<?php  if(!empty($produit['item_detail'])){
																									echo '<li style="font-size:10px;">Composé de:</li>';
																									foreach($produit['item_detail'] as $key=>$value){ 
																										
																								?>      
																									<li style="list-style:circle;font-size:10px;text-decoration:underline;"><?= $value?></li>   
																								<?php }
																										}?>
																								</ul>
																								</div>
																<div class="p-2">
																<img src="../Dashboard/upload/food/<?= $produit['item_img'] ;?>" alt="" width="95" class="img-fluid rounded shadow-sm">
																<div class="ml-3 d-inline-block align-middle">
																	<h5 class="mb-0" style="font-weight:900;"><?= $produit['item_name'] ;?></h5>
																</div>
																</div>
															</th>
															<td class="align-middle"><strong><?=  $produit['item_qte'] ;?> x <?= number_format($produit['item_price'],0,',',' ') ;?> CFA</strong></td>
															<td class="align-middle"><strong><?= number_format($produit['item_price']* $produit['item_qte'],0,',',' ') ;?> CFA</strong></td>
															
															</tr>

															<?php $total2 += $produit['item_qte']* $produit['item_price']; ?>
															<?php endforeach ;?>
															<tr style="background:#e75b1e;color:#fff;">
																
															<th scope="row" class="border-0">
																<div class="p-2">
																<div class="ml-3 d-inline-block align-middle">
																	<h2 class="mb-0" style="font-size:15px;font-weight:900;color:#fff;">Total + frais de livraison: </h2>
																</div>
																</div>
															</th>
															<td class="border-0 align-middle"><strong></strong></td>
															<td class="border-0 align-middle"><strong style="font-size:17px;font-weight:900"><?= number_format($total2 + 200,0,',',' ')  ;?>CFA</strong></td>
															
															</tr>
															
														</tbody>
														</table>
														
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
			
		    </td>
			<td>
			 <?php $t=strtotime($commande->date_comm);
			  echo date("(D) d-M(m)-Y H:i:s",$t);
			  
			  ?>
			</td>		
			<td> 

			 <a class="btn <?=($commande->status_command == 0) ? "btn-info" : "btn-success";?>">
			          <?=($commande->status_command == 0) ? "livraison en cours..." : "commande validée";?>
			</a>
			</td>
		  </tr>
		<?php endforeach ;?>
			<?php endif;?>
		</tbody>
	  </table>
	</div>
  </div>
</div>

</div>
				
<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>

</body>
</html>
