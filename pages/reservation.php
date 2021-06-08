<?php
    $title = 'Commander | Sandwicherie chez David';
    $meta_content='';
    $compos = [ 'pain'];
    
    ?>

    <div class="banner full-screen-mode" style="background:url(../assets/images/IMG_2182.jpg) no-repeat center;background-size:cover; ">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="banner-static">
                    <div class="banner-text">
                        <div class="banner-cell">
                        <h2 class="block-title text-center" style="font-weight:800;background:#fff;color:#e07205;margin-top:40px;margin-bottom:10%; border:2px solid #fff; padding:7px; border-radius:8px;">
                                              Votre espace de commande                        
                                        </h2>
                                        <a href="#reservation">
                                       <div class="mouse"></div>
                                        </a>
                        </div>
                        <!-- end banner-cell -->
                    </div>
                    <!-- end banner-text -->
                </div>
                <!-- end banner-static -->
            </div>
            <!-- end col -->
        </div>
        <!-- end container -->
    </div>

    <div id="reservation" class="reservations-main pad-top-100 pad-bottom-100" >
        <div class="container">
            <div class="row">
                        <div class="form-reservations wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                        
                        <div class="col-md-12">
				
                                <div id="myBtnContainer" class="">
                                    <button style="font-weight:bold;font-size:17px;" class="block-title bt btn-link btn " onclick="filterSelection('all')">Tous</button>
                                        <?php $categories = $DB->select('SELECT * FROM category ');?>						
                                        <?php foreach($categories as $categorie): ?> 
                                    <button style="font-weight:bold;font-size:17px;" class="block-title bt btn-link btn " onclick="filterSelection('<?= htmlentities($categorie->categorie) ;?>')"><?php if($categorie->categorie == "Burger Ivoire"){echo 'Burger  (ivoire) '; }else{ echo htmlentities($categorie->categorie) ;} ?></button>
                                        <?php endforeach ; ?>
                                </div>

                                <div class="row">
                                    <?php $foods = $DB->select('select category.categorie,food.id,food.nom,food.details,food.images,food.prix from category inner join food on food.cat_id=category.id ');?>
                                    <?php foreach($foods as $food) :?>
                                        <div class="col-md-6">
                                            <a href="#" data-toggle="modal" data-target="#<?=$food->id ;?>">
                                                <div class=" column panel panel-default <?=$food->categorie ;?>" style="border-radius:20px;">
                                                    <div class="content carte" >
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                            <img src="../Dashboard/upload/food/<?=$food->images ;?>" class=" round-image" height="125" width="148">
                                                            </div>                                
                                                            <div class="col-md-8">
                                                                <h5 style="font-size:14px;letter-spacing:2px;font-weight:700;" class="text-center"><?= $food->nom ;?></h5>
                                                                <p style="text-align:center;font-size:13px;margin-left:10px;font-weight:900;color:#e07c09;"><?=$food->details ;?></p>
                                                                <img src ="../assets/images/prices.png" width="150" height="100"/>
                                                                <span  style="margin-left:-115px;font-weight:800;font-size:11px;padding:5px;color:#fff;"><?= number_format($food->prix,0,',',' ');?> FCFA</span>
                                                            </div>
                                                        </div>                                                       
                                                    </div>                              
                                                </div>
                                           </a>

                                           <div class="modal fade" id="<?=$food->id ;?>" tabindex="-1" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        <div class="modal-body">
                                                        <div class="row">
                                                            <img src="../Dashboard/upload/food/<?=$food->images ;?>" class=" round-image" height="135" width="150">
                                                            <div class="col-md-8">
                                                                    <h5 style="font-weight:bold"><?= $food->nom ;?></h5>
                                                                    <p style="text-align:left;font-size:12px;font-weight:900;color:#e07c09;"><?= htmlentities($food->details) ;?></p>
                                                            
                                                            </div>
                                                            <div class="row col-md-12"> 
                                                                        <form  class="form-horizontal addpanier"  id="form" action="pages/pan.php" method="post">
                                                                            <input type="number" id="id" hidden name="id" value="<?=$food->id ;?>">
                                                                                <?php $tab = explode(',',$food->details); 
                                                                                     $trimed =$tab[0];
                                                                                     $tab = implode(",",$tab);
                                                                                     $trim_sup  = trim($tab,$trimed);  
                                                                                     $suplements = explode(",",$trim_sup);
                                                                                     if(count($suplements) == 1): ?>
                                                                                    <input type="text" name="food" id="food" hidden value="<?= htmlentities($food->nom) ;?>">
                                                                                    <?php if($food->categorie == "Poulet") :?>
                                                                                    <h2 style="text-align:left;font-size:14px;font-weight:900;color:#e07c09;">Les supplements de votre choix</h2>
                                                                                    <div class="row">
                                                                                    
                                                                                    <div class="form-check col-md-6">                                                          
                                                                                   
                                                                                      <input type="checkbox"  id="assiete" class="form-check-input bounce" name="suplement[]" value="Assiette jetable (+100 CFA)"> 
                                                                                      <label style="font-size:15px;" class="form-check-label">Assiette jetable (+100 CFA)</label>
                                                                                     
                                                                                    </div>

                                                                                    <div class="form-check col-md-6">                                                          
                                                                                   
                                                                                      <input type="checkbox"  id="piment" class="form-check-input bounce" name="suplement[]" value="Piment en pâte">  
                                                                                      <label style="font-size:15px;"class="form-check-label">Piment en pâte</label>
                                                                                     
                                                                                    </div>
                                                                                    
                                                                                    </div>
                                                                                              <?php endif;?>
                                                                                  <?php else : ?>
                                                                                    <fieldset>
                                                                                    <input type="text" name="food" id ="food" hidden value="<?=$food->nom ;?>">
                                                                                <h2 style="text-align:left;font-size:13px;font-weight:900;color:#e07c09;">Composition de base</h2>
                                                                             
                                                                            <?php    foreach($compos as $value=> $compo) :  ?> 
                                                                                <div class="form-check">
                                                                                    <input
                                                                                    id="compo"
                                                                                    type="radio"
                                                                                    name="compo[]"
                                                                                    class="form-check-input bounce"
                                                                                    value="<?=$compo ;?>" checked
                                                                                    />
                                                                                    <label style="font-size:15px;" class="form-check-label" for="<?=$compo ;?>"><?=$compo ;?></label>
                                                                                    
                                                                                </div>

                                                                                <?php endforeach ;?>
                                                                                           
                                                                                <hr>
                                                                                <h2 style="text-align:left;font-size:14px;font-weight:900;color:#e07c09;">Les ingrédients du <?= htmlentities($food->nom) ;?></h2>
                                                                                <p style="text-align:left;font-size:13px;font-weight:900;color:#e75b1e"> vous avez la possibilité de choisir les ingrédients de votre choix qui feront parties de votre <?=htmlentities($food->nom) ;?></p>
                                                                                <!-- Name input-->
                                                                                <div class="row">
                                                                                
                                                                                 <?php      foreach($suplements as $key=> $suplement) : ?>               
                                                                                      
                                                                                      <?php if(empty($suplement)) : ?>
                                                                                        
                                                                                        <?php else : ?>
                                                                                    <div class="form-check col-md-6">                                                          
                                                                                   
                                                                                     <input type="checkbox"  class="form-check-input bounce" name="suplement[]"  id="" value="<?= $suplement ;?>"> 
                                                                                      <label style="font-size:15px;"class="form-check-label" for="<?=$suplement ;?>"><?=$suplement ;?></label>
                                                                                        
                                                                                    </div>
                                                                                        <?php endif;?>
                                                                                    <?php endforeach;?>
                                                                                    </div>

                                                                                    <h2 style="text-align:left;font-size:14px;font-weight:900;color:#e07c09;">Les supplements de votre choix</h2>
                                                                                    <div class="row">
                                                                                    
                                                                                    <div class="form-check col-md-6">                                                          
                                                                                   
                                                                                     <input type="checkbox"  class="form-check-input bounce" name="suplement[]"   value="piment en poudre"> 
                                                                                      <label style="font-size:15px;"class="form-check-label" for="piment_poudre">Piment en poudre</label>
                                                                                     
                                                                                    </div>
                                                                                    
                                                                                    </div>
                                                                                    </fieldset>
                                                                                            <?php endif;?>

                                                                             <div class="col-md-12 descript" style="background:#e07c09; border-bottom-left-radius:7px;border-bottom-right-radius:7px;">
                                                                                <div class="row">                
                                                                                    <label style="font-size:17px;font-weight:800;color:#fff;padding:14px;">Quantité 
                                                                                <!-- <button id="btn1" class="btn  btn-default" style="width:40px;height:40px;font-size:18px;font-weight:800;border-radius:4px; color:#e07c09;">-</button>-->
                                                                                    <input     name="qte"  type="number" id="qte"  class="nb" min="1" max="100" value="1" style="font-weight:800;text-align:center;font-size:18px;color:#fff;background:none;border:none;width:40px;height:40px;" required>
                                                                                    <input type="text" name="prix" id="prix-<?=$food->id ;?>" data-i="<?=$food->id ;?>" hidden value="<?=$food->prix;?>">
                                                                                    <input type="text" name="img"  id="img"  hidden value="<?=$food->images;?>">
                                                                                    <!--<button id="btn2" class="btn btn-default" style="width:40px;height:40px;font-size:18px;font-weight:800;border-radius:4px; color:#e07c09;">+</button>-->
                                                                                    </label>                                       
                                                                                    <input class="btn btn-default "  type="submit" style="font-size:10px;font-weight:800;border-radius:4px; color:#e07c09;padding:8px;" value="Ajouter à ma commande" />                                                           
                                                                                </div>
                                                                            </div> 

                                                                        </form>                
                                                            </div>
                                                            
                                                        </div>          
                                                     </div>
                                                        

                                                                                                                 
                                                    </div>
                                                </div>
                                           </div>

                                        </div>                                  	                             
                                    <?php endforeach ;?>
                               </div>
                            </div>
                     </div>                           
                </div>        
            </div>
        </div>
    </div>

  
   
            <div class="box close-color-panel" id="color-panel" style="width:75px;height:65px;border:3px solid #e07c09; text-align:center;padding:8px;border-radius:8px; background:#fff;">
            
            <a href="#" data-toggle="modal" class="cart" data-target="#panier" >
                <i class="fa fa-shopping-bag " style="color:#e07205;font-size:30px;">     
                </i>
            </a>
            <span id="count" class="badge badge-pill badge-info" style="margin-top:-79px;margin-left:33px;"><?= (empty($_SESSION['panier'])) ? " " : count($_SESSION['panier']) ?></span>
           
            </div>

               <div class="modal fade" id="panier" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <div class="modal-body">
                                  <div class="row">
                                     <div class="col-md-12" style="border:3px solid #e76557 ; border-radius:17px;padding:8px; margin-bottom:12px;">
                                       <h5 class="block-title" style="font-weight:700; font-size:20px;">Ma commande</h5>
                                       <h5 class="block-title" style="text-align:right;font-weight:700; font-size:14px;color:#3b3843;">
                                         (<span id="count1"><?= count($_SESSION['panier']);?></span>) élément(s) commandé(s)</h5>
                                      </div>
                                      
                                      <div id="cart_item"> 

                                      </div>
                                      <a href="<?=$router->generate('info');?>" class="btn btn-default pan_info " style="margin-top:12px;color:#e07205;font-weight:800;">Commander</a>
                                    </div>
                                               
                            </div>
                        </div>
                            
                    </div>
                </div>
            </div>


                                