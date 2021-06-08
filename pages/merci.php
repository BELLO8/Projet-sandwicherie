<?php
    $title = 'Merci';
    $meta_content='';
    $success = false;
  if(!empty($_SESSION['panier'])){
  if(isset($_POST) && !empty($_POST)){
       $nom = $_POST['name'];
       $prenom = $_POST['prenom'];
       $numero = $_POST['phone'];
       $addresse = $_POST['addresse'];
       $livraison = $_POST['livraison'];
       $date = $_POST['date'];
       
       $products = serialize($_SESSION['panier']);
       $DB->query('INSERT INTO commande (nom_cli,prenom_cli,num_cli	,add_cli,	livraison,	date_livr,	produits_command,status_command,date_comm) VALUES(:nom,:prenom,:numero,:addresse,:livraison,:date_livr,:product, 0,Now())',array(
              "nom"=>$nom,
              "prenom"=>$prenom,
              "numero"=>$numero,
              "addresse"=>$addresse,
              "livraison"=>$livraison,
              "date_livr"=>$date,
              "product"=>$products
       ));
       unset($_SESSION['panier']);
       $success = true;
  }
}    
    ?>
    <div id="reservation" class="reservations-main pad-top-100 pad-bottom-100" style="margin-top:4%;">
        <div class="container">
            <div class="row">
                <div class="form-reservations">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="wow fadeIn alert alert-success" data-wow-duration="1s" data-wow-delay="0.1s" style="background:#99cc99;border-radius:5px;">
                          <h2  style="font-size:20px;text-align:left;padding:12px;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Votre panier a été validé</h2>
                      </div>
                            <div class="col-md-12" style="background:#f2f2f2;border-radius:8px;margin-top:1%;padding:8px;">
                                 <div class="row">
                                 <div class="col-md-12" style="text-align:center;align-items:center;">
                                 <img src="../assets/images/bag-success.png" height="80" width="80" style="margin-top:20px;opacity:0.8;">
                                   
                                 <h2 class=" text-center block-title" >Merci !</h2>
                                     <h2 class="block-title" style="font-weight:700; font-size:18px;color:grey;">Votre commande a été traitée avec succès ! </h2>
                                    <hr>
                                    <h2 class="block-title" style="font-size:14px;">Votre commande sera prête le <b style="color:green"><?php $t=strtotime($date); echo date("d - M  - Y ",$t);?> </b>  dans <b style="color:green"> 20 mininutes !</b>  
                                    </h2> 
                                    <h2 style="font-size:16px;">Nous vous contacterons pour une re-comfirmaion de votre commande une fois prète merci !</h2>
                                      <a href="<?=$router->generate('reservation');?>" class="btn btn-success btn-sm" style="font-weight:900">Continuer votre achat</a>
                                    </div> 
                                </div>
                            </div>
                     </div>                           
                </div>        
            </div>
        </div>
    </div>
   


  
                     
       
                                