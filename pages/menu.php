<?php
    $title = 'Menu | Sandwicherie chez David';
    $meta_content='';

    ?>
  
    <div class="pad-top-100 parallax flou" style="background:url(../assets/images/IMG_218.jpg) center fixed; background-size:cover;" >
        <div class="container" style="border:10px solid white;margin-top:5%;">
            <div id="menu" class="menu-main pad-top-90 pad-bottom-100">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                            <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                                <h2 class="block-title text-center" style="color:#fff">
                                Nos Menus 	
                            </h2>
                                <p class="title-caption text-center" > </p>
                            </div>
                            <div >
                               
                            <div class="col-md-12">
				
                                <div id="myBtnContainer" style="margin-left:12%">
                                    <button style="font-weight:bold;font-size:17px;color:#e75b1e;" class="block-title bt btn-link btn " onclick="filterSelection('all')">Tous</button>
                                        <?php $categories = $DB->select('SELECT * FROM category ');?>						
                                        <?php foreach($categories as $categorie): ?> 
                                    <button style="font-weight:bold;font-size:17px;color:#e75b1e;" class="block-title bt btn-link btn " onclick="filterSelection('<?= htmlentities($categorie->categorie) ;?>')"><?php if($categorie->categorie == "Burger Ivoire"){echo 'Burger  "ivoire" '; }else{ echo htmlentities($categorie->categorie) ;} ?></button>
                                        <?php endforeach ; ?>
                                </div>

                                <div class="row">
                                    <?php $foods = $DB->select('select category.categorie,food.id,food.nom,food.details,food.images,food.prix from category inner join food on food.cat_id=category.id ');?>
                                    <?php foreach($foods as $food) :?>
                                        <div class="col-md-6">
                                            <div class=" column panel panel-default <?=$food->categorie ;?>" style="border-radius:20px;">
                                            <div class="content" >
                                                <div class="row">
                                                    <div class="col-md-4">
                                                    <img src="../Dashboard/upload/food/<?=$food->images ;?>" class=" round-image" height="125" width="148">
                                                    </div>                                
                                                    <div class="col-md-8">
                                                        <h5 style="font-size:15px;font-weight:800;text-align:center;"><?= $food->nom ;?></h5>
                                                        <p style="text-align:center;font-size:14px;font-weight:900;color:#e07c09;"><?=$food->details ;?></p>
                                                      <img src ="../assets/images/prices.png" width="150" height="100"/>
                                                      <span style="margin-left:-108px;font-weight:800;font-size:11px;color:#fff;"><?=$food->prix;?> FCFA</span>
                                                    </div>
                                                </div>                                                       
                                            </div>                              
                                        </div>
                                        </div>
                          <?php endforeach ;?>
                               </div>
                            </div>
                               
                            </div>
                            <!-- end tab-menu -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
            <!-- end container -->
            </div>
            
            <!-- end row -->
        </div>
        <!-- end container -->
        
    </div>
