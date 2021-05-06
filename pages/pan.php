<?php 
session_start();
$json = array('error'=> true);
$total= 0;

// ajouter un produit au panier //

if(isset($_POST['id'])){
    if(isset($_POST)){ 
         if(isset($_SESSION['panier'])){
            $item_array_id = array_column($_SESSION['panier'],"item_id");
             if(!empty($_POST['suplement'])){
                    if(!in_array($_POST['id'],$item_array_id)){
                                    $json['error'] = false;
                                    $count = count($_SESSION['panier']);
                                    $item_array = array(            
                                        "item_id"=>$_POST['id'],
                                        "item_name"=>$_POST['food'],
                                        "item_detail"=>$_POST['suplement'],
                                        "item_qte"=>$_POST['qte'],
                                        "item_price"=>$_POST['prix'],
                                        "item_img"=>$_POST['img']
                                    );
                                    
                                    $_SESSION['panier'][$count]= $item_array; 
                                    $json['message'] = $_POST['food'] . ' a été ajouté ';
                                    $json['count'] = count($_SESSION['panier']);
                                    foreach($_SESSION['panier'] as $key=>$product){
                                        $total += $product['item_qte']*$product['item_price'];
                                         $json['sous_total'] = number_format($total,0,',',' ');
                                        $json['total'] = number_format($total + 200,0,',',' ');
                                      }
                                    
                                }else{
                                    $json['error'] = false;
                                    $json['message'] = $_POST['food'] . " deja ajouté";
                                    $json['count'] = count($_SESSION['panier']);
                                   

                                }
             }else{
                if(!in_array($_POST['id'],$item_array_id)){
                    $json['error'] = false;
                    $count = count($_SESSION['panier']);
                    $item_array = array(            
                        "item_id"=>$_POST['id'],
                        "item_name"=>$_POST['food'],
                        "item_qte"=>$_POST['qte'],
                        "item_price"=>$_POST['prix'],
                        "item_img"=>$_POST['img']
                    );
                    
                    $_SESSION['panier'][$count]= $item_array; 
                    $json['message'] = $_POST['food'] . ' a été ajouté ';
                    $json['count'] = count($_SESSION['panier']);
                    foreach($_SESSION['panier'] as $key=>$product){
                        $total += $product['item_qte']*$product['item_price'];
                         $json['sous_total'] = number_format($total,0,',',' ');
                        $json['total'] = number_format($total + 200,0,',',' ');
                      }
                    /*header('location:/Reservation');*/
                    
                }else{
                    $json['error'] = false;
                    $json['message'] = $_POST['food'] . " deja ajouté";
                    $json['count'] = count($_SESSION['panier']);
                   

                }
             }
         
         }
         else{
            $item_array = array(  
                "item_id"=>$_POST['id'],
                "item_name"=>$_POST['food'],
                "item_detail"=>$_POST['suplement'],
                "item_qte"=>$_POST['qte'],
                "item_price"=>$_POST['prix'],
                "item_img"=>$_POST['img']
               );
               $_SESSION['panier'][0]= $item_array;
         }    
    }
}

//Supprimer un produit au panier //

if(isset($_GET['delpanier'])){
    $total= 0 ;
    foreach($_SESSION['panier'] as $keys =>$values){
      if($values['item_id'] == $_GET['delpanier']){
          unset($_SESSION['panier'][$keys]);
          $json['error'] = false;
          $json['count'] = count($_SESSION['panier']);
          $json['message'] = $values['item_name'] ." supprimé !";
          
          foreach($_SESSION['panier'] as $key=>$product){
            $total += $product['item_qte']*$product['item_price'];
            $json['sous_total'] = number_format($total,0,',',' ');
            $json['total'] = number_format($total + 200,0,',',' ');
          }
         
      }
      
  }
  
  }

echo json_encode($json);
?>
                                 