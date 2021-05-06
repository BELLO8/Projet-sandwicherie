<?php
require 'vendor/autoload.php';
require 'src/db.class.php';
require 'src/panier.class.php';
$DB = new DB() ;
$panier = new panier($DB);
$router = new AltoRouter();

$router->map('GET','/','Accueil','home');
$router->map('GET','/Menu','menu','menu');
$router->map('GET','/Commander-en-ligne','reservation','reservation');
$router->map('GET/POST','/Edition-de-panier','editpan','panier');
$router->map('GET/POST','/Information-sur-la-commande','info','info');
$router->map('POST','/Merci','merci','merci');

$match = $router->match();

if(is_array($match)){
    if($match['target']!="editpan"){
        ob_start();
        require "pages/{$match['target']}.php";
        $pagecontent = ob_get_clean();
        require 'elements/part.php';
    }else{
        require "pages/{$match['target']}.php";
    }
   
}
elseif(!$match){
  
    require 'pages/404.php';
    
}

 ?>
  