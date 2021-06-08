<?php 
require '../src/db.class.php';
$DB = new DB();
$success = false;
if(isset($_POST) and !empty($_POST)){
    $cat = $_POST['categorie'];
    
    $DB->query('INSERT INTO category(categorie) VALUES(:categorie)',array(
        'categorie'=>$cat       
    ));
    $success = true;
    $message ='categorie ajoutée avec succes!';
}

if($success){
    header('location:index.php');
}

?>

