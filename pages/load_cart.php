<?php 
session_start();
$total_price = 0;
$output ='  
        
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
                    <th scope="col" class="border-0 bg-light">
                        <div class="py-2 text-uppercase">Action</div>
                    </th>
                    
                    </tr>
                </thead>

';
if(!empty($_SESSION['panier'])){

    foreach($_SESSION['panier'] as $keys=>$product){
           
          $output .= ' <tbody>
                        <tr id="ligne-'.$product['item_id'].'">
                            <th scope="row">
                                <div class="p-2">
                                <h5 class="mb-0"><a  href="Edition-de-panier?action='. $product['item_id'].'"  style="font-size:11px;font-weight:800;color:#e07c09;">'.$product['item_name'].'</a></h5>        
                                <div class="col-md-6">
                                <ul style="text-align:left;">  
                                ';
                                if(!empty($product['item_detail'])){
                                    $output.= '<li style="font-size:12px;">Composé de :</li>';
                                     foreach($product['item_detail'] as $key=>$value){ 
                                         $output .= '<li style="list-style:circle;font-size:10px;text-decoration:underline;">'.$value.'</li>';
          
                                     }

                                    }
                                      
        $output .= ' 
                                </ul>
                                </div>
                                <a  href="Edition-de-panier?action='.$product['item_id'].'"  style="font-size:11px;font-weight:800;color:#e07c09;"><img src="../Dashboard/upload/food/'.$product['item_img'].'" alt="" width="75" class="img-fluid rounded shadow-sm"></a>
                                </div>
                            </th>
                            <td class="align-middle"><strong style="font-size:12px;">'.$product['item_qte'].' x '. number_format($product['item_price'],0,',',' ').' CFA</strong></td>
                            <td class="align-middle"><strong style="font-size:12px;">'.number_format($product['item_price']* $product['item_qte'],0,',',' ').' CFA</strong></td>
                            <td class="align-middle"><a  href="Edition-de-panier?action='.$product['item_id'].'"  style="font-size:11px;font-weight:800;color:#e07c09;">  Modifier <i class="glyphicon glyphicon-edit" style="font-size:15px;"></i></a>
                            <a href="pages/pan.php?delpanier='.$product['item_id'].'" class=" delpanier" data-id="'.$product['item_id'].'"><i class="fa fa-trash"></i></a>
                            
                            </td>
                            
                            
                        </tr>
        ';
        $total_price += $product['item_qte']*$product['item_price'];
     
    }

    $output .= '
    <tr style="border:2px solid #e75b1e;border-radius:12px;">
    <th class="row">
    <h2 class="block-title" style="font-size:18px;font-weight:900;letter-spacing:3;text-decoration:underline;">Votre commande </h2>
        <tr>
            <td>
            <ul class="list-unstyled mb-4">
                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted" style="color:#3b3843;">Sous-total  :  </strong></li>
            </ul>    
            </td>  
            <td><strong id="sous-total">'.number_format($total_price,0,',',' 
                    ').' CFA</strong></td>              
        </tr>
        <tr>
        <td>
    
        <ul>
           <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted" style="color:#3b3843;font-size:12px;"><img src="assets/images/livre.png" width="120">Frais de livraison 200 CFA</strong></li>
             
         </ul>
         
     </td>
        </tr>
        <tr>
        <td>
           <ul>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted" style="color:#3b3843;">Total + Frais de livraison:  </strong></li>
                
            </ul>
        </td>

        <td><strong id="total" data-total = "'.number_format($total_price+ 200,0,',',' ').'">'.number_format($total_price+ 200,0,',',' ').' CFA</strong></td>
       
        </tr>   
                                               
    </th>                  
  </tr>         

    ';

}else{

    $output .= '
                <tr>
                <td id="vide" data-vide="vide">
                     Panier vide ! 
                </td>
                </tr>
    ';
}

$output .= ' </tbody>
   </table>
';
$data = array(
    'cart_item'  => $output
);
echo json_encode($data);

?>             
                                     