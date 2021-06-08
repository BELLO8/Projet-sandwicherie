<?php 
session_start();
$json = array('error'=>true);
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