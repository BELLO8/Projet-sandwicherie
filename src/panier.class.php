<?php 
 class panier {
     private $db;
     

    public function __construct($db){
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['panier'])){
          $_SESSION['panier'] = array();
        }
        $this->db = $db;
        
        if(isset($_GET['delpanier'])){
            $this->del($_GET['delpanier']);
            
        }
       
    }
    
    
    public function count(){
        return array_sum($_SESSION['panier']);
    }

    
    public function del($product_id){
        foreach($_SESSION['panier'] as $keys =>$values){
            if($values['item_id'] == $product_id){
                unset($_SESSION['panier'][$keys]);
            }
        }
        
    }

 }

