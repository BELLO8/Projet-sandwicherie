<?php 
if(isset($_GET['action'])){
    if(isset($_POST) && !empty($_POST)){
       if(!empty($_POST['suplement'])){
           $item_array = array(            
            "item_id"=>$_GET['action'],
            "item_name"=>$_POST['food'],
            "item_detail"=>$_POST['suplement'],
            "item_qte"=>$_POST['qte'],
            "item_price"=>$_POST['prix'],
            "item_img"=>$_POST['img']
           );
       }else{
        $item_array = array(            
            "item_id"=>$_GET['action'],
            "item_name"=>$_POST['food'],
            "item_qte"=>$_POST['qte'],
            "item_price"=>$_POST['prix'],
            "item_img"=>$_POST['img']
           );
       }
        
         $item_array_id = array_column($_SESSION["panier"],"item_id");
      if(in_array($_GET['action'],$item_array_id)){
          foreach($_SESSION['panier'] as $keys=>$values){
              if($values['item_id']==$_GET['action']){
                  if(!empty($item_array['item_detail'])){
                    $item1 = $_SESSION['panier'][$keys];       
                    $item1 = array_replace($_SESSION['panier'][$keys],$item_array);
                    $_SESSION['panier'][$keys] = $item1;
                  } else{
                    $item_array = array(            
                        "item_id"=>$_GET['action'],
                        "item_name"=>$_POST['food'],
                        "item_qte"=>$_POST['qte'],
                        "item_price"=>$_POST['prix'],
                        "item_img"=>$_POST['img']
                       );
                    $item1 = array_replace($_SESSION['panier'][$keys],$item_array);
                    $_SESSION['panier'][$keys] = $item1;
                  }
                  header('location:'.$router->generate('reservation'));
              }
          }
              
        
       }
    }
   
 

}


?>
       
<?php  if(isset($_GET['action'])) :?>
    <?php foreach($_SESSION['panier'] as $keys=>$values) :?>
        <?php if($values['item_id'] == $_GET['action']){
            $id = $values["item_id"];
            
        ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">

    <!-- Site Metas -->
    <title> Edition panier</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="../assets/images/logo1.png" type="image/x-icon" />
    <link rel="apple-touch-icon" href="../assets/images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../assets/css/aqua.css" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- color -->
    <link id="changeable-colors" rel="stylesheet" href="../assets/css/colors/orange.css" />

    <!-- Modernizer -->
    <script src="../assets/js/modernizer.js"></script>

   

</head>
                  
    <div id="reservation" class="reservations-main pad-top-100 pad-bottom-100">
        <div class="container">
            <div class="row">
                <div class="form-reservations-box">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                                <h2 class="block-title text-center">Modification de commande</h2>
                            </div>
                            <div class="row"  style="margin-top:42px;">
                                <?php $foods = $DB->select('SELECT category.categorie,food.id,food.nom,food.details,food.images,food.prix FROM category INNER JOIN food ON food.cat_id=category.id WHERE food.id=:id',array('id'=>$id));?>
                                <?php foreach($foods as $food) :?>
                                <img src="../Dashboard/upload/food/<?=$values['item_img'] ;?>" class=" round-image" height="70" width="70">
                                <div class="col-md-8">
                                        <h5 style="font-weight:bold"><?=$values['item_name'] ;?></h5>
                                        <p style="text-align:left;font-size:12px;font-weight:900;color:#e07c09;">
                                        <?php if(isset($values['item_detail'])) :?>
                                        Votre <?=$values['item_name'] ;?> est composé de <?=implode(",",$values['item_detail']) ;?>.</p>
                                        <?php else :?>
                                          <?=$values['item_name'] ;?> : <?= htmlentities($food->details);?>.</p>
                                        <?php endif;?>
                                </div>
                                <div class="row col-md-12"> 
                                    <form  class="form-horizontal" action="" method="post">
                                                <?php $tab = explode(',',$food->details); 
                                                    $trimed =$tab[0];
                                                    $tab = implode(",",$tab);
                                                    $trim_sup  = trim($tab,$trimed);  
                                                    $suplements = explode(",",$trim_sup);
                                                    if(count($suplements) == 1): ?>
                                                <input type="text" name="food" id="food" hidden value="<?=htmlentities($food->nom) ;?>">
                                                <?php if($food->categorie == "Poulet") :?>
                                                <?php if(empty($values['item_detail'])) :?>
                                                <?php else :?>
                                                   <h2 style="text-align:left;font-size:14px;font-weight:900;color:#e07c09;">Les supplements de votre choix</h2>
                                                    <div class="row">
                                                                                        
                                                        <div class="form-check col-md-6">                                                          
                                                        
                                                            <input type="checkbox"  <?php
                                                        if(in_array("Assiette jetable (+100 CFA)",$values['item_detail']) ){
                                                            echo 'checked';
                                                        }else{

                                                        }
                                                    ?> class="form-check-input bounce" name="suplement[]" value="Assiette jetable (+100 CFA)"> 
                                                            <label style="font-size:15px;"class="form-check-label">Assiette jetable (+100 CFA)</label>
                                                            
                                                        </div>

                                                        <div class="form-check col-md-6">                                                          
                                                        
                                                            <input type="checkbox"  class="form-check-input bounce" <?php
                                                        if(in_array("Piment en pâte",$values['item_detail']) ){
                                                            echo 'checked';
                                                        }else{

                                                        }
                                                    ?> name="suplement[]" value="Piment en pâte">  
                                                            <label style="font-size:15px;"class="form-check-label">Piment en pâte</label>
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                <?php endif ;?>
                                               
                                                <?php endif;?>
                                                <?php else : ?>
                                                <fieldset>
                                                <input type="text" name="food" hidden value="<?=$values['item_name'] ;?>">
                                            <h2 style="text-align:left;font-size:12px;font-weight:900;color:#e07c09;">Composition de base</h2>
                                            <div class="form-check">
                                                <input
                                                type="radio"
                                                name="compo"
                                                class="form-check-input bounce"
                                                value="Pain" checked
                                                />
                                                <label style="font-size:15px;" class="form-check-label" for="pain">Pain</label>
                                                
                                            </div>              
                                            <hr>
                                            <h2 style="text-align:left;font-size:15px;font-weight:900;color:#e07c09;">Les ingrédients du <?=$values['item_name'] ;?></h2>
                                            <p style="text-align:left;font-size:14px;font-weight:900;color:#e75b1e"> vous avez la possibilité de choisir les ingrédients de votre choix qui feront parties de votre <?=$values['item_name'] ;?></p>
                                            <!-- Name input-->
                                            <div class="row">
                                            
                                                <?php    foreach($suplements as $key=> $suplement) : ?>               
                                                    
                                                    <?php if(empty($suplement)) : ?>

                                                    <?php else : ?>
                                                <div class="form-check col-md-6">                                                          
                                                    
                                                    <input type="checkbox" <?php foreach($values['item_detail'] as $key=>$checks) {
                                                        if($suplement == $checks){
                                                            echo 'checked';
                                                        }else{

                                                        }
                                                    }?> class="form-check-input bounce" name="suplement[]"  id="" value="<?= $suplement ;?>"> 
                                                        
                                                    <label style="font-size:15px;"class="form-check-label" for="<?=$suplement ;?>"><?=$suplement ;?></label>
                                                    
                                                </div>
                                                <?php endif;?>
                                                <?php endforeach;?>
                                                </div>
                                                <h2 style="text-align:left;font-size:14px;font-weight:900;color:#e07c09;">Les supplements de votre choix</h2>
                                                    <div class="row">
                                                    
                                                    <div class="form-check col-md-6">                                                          
                                                    
                                                        <input type="checkbox"  <?php foreach($values['item_detail'] as $keys=>$check) {
                                                        if($suplement == $check){
                                                            echo 'checked';
                                                        }else{

                                                        }
                                                    }?> class="form-check-input bounce" name="suplement[]"   value="piment en poudre"> 
                                                        <label style="font-size:15px;"class="form-check-label" for="piment_poudre">Piment en poudre</label>
                                                        
                                                    </div>
                                                   
                                                    </div>
                                                </fieldset>
                                                <?php endif;?>

                                            <div class="col-md-12 descript" style="background:#e07c09; border-bottom-left-radius:7px;border-bottom-right-radius:7px;">
                                            <div class="row">                
                                                <label style="font-size:17px;font-weight:800;color:#fff;padding:14px;">Quantité 
                                            <!-- <button id="btn1" class="btn  btn-default" style="width:40px;height:40px;font-size:18px;font-weight:800;border-radius:4px; color:#e07c09;">-</button>-->
                                                <input  id="input" name="qte" type="number"  value="<?=$values['item_qte'];?>" class="nb" min="1" max="9" style="font-weight:800;text-align:center;font-size:18px;color:#fff;background:none;border:none;width:40px;height:40px;" required>
                                                <input type="text" name="prix" hidden  value="<?=$values['item_price'];?>"/>
                                                <input type="text" name="img"  hidden value="<?=$values['item_img'];?>"/>
                                                <!--<button id="btn2" class="btn btn-default" style="width:40px;height:40px;font-size:18px;font-weight:800;border-radius:4px; color:#e07c09;">+</button>-->
                                                </label>                                       
                                                <input class="btn btn-default" type="submit" style="font-size:10px;font-weight:800;border-radius:4px; color:#e07c09;padding:8px;" value="Modifier ma commande" />                                                           
                                            </div>
                                        </div> 

                                    </form>                
                                </div>
                                <?php endforeach ;?> 
                            </div> 
                     </div>
                    <!-- end col -->
                </div>
                <!-- end reservations-box -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <script src="../assets/js/all.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="../assets/js/sweetalert.min.js"></script>
    <script src="../assets/js/custom.js"></script>
                                     <!-- end form -->
                               
                                       <?php } else{
                                            
                                       }
                                       ?>
                                        
                                    <?php endforeach ;?>
                                    <?php endif;?>
              
                        
                