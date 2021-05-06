<?php 
require '../src/db.class.php';
$DB = new DB();
$success = false;
if(isset($_POST) and !empty($_POST)){
	if(isset($_GET['id'])){
		 $cat = $_POST['categorie'];
    $id = (int)$_GET['id'];
   
    $DB->query('UPDATE category SET categorie = :categorie WHERE id= :id',array(
        'categorie'=>$cat,
        'id'=>$id       
	));
	$success = true;
	} else{
		echo 'aucune modification';
	}
   
}
  if($success == true){
	header('location: index.php');
  }

?>

   