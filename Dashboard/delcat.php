<?php 
require '../src/db.class.php';

	$success = false;
	$DB = new DB();


if(isset($_GET['id'])){
	try{
		$DB->query('DELETE FROM category WHERE id= :id',array(
					'id'=>$_GET['id']
				));
				$success = true;
	}  catch(PDOException $e){
	      die('<h1 style = "font-size:25px; color:red ; margin:auto;"> Impossible d\'effectuer cette action, car cette categorie est liée a un fast food ! <h1>');
	    }
		   
}

    if($success === true){
    header('location: cat.php');
    }

?>