<?php 
require '../src/db.class.php';

	$success = false;
	$DB = new DB();
	$select = new DB();

   $images = $select->select('SELECT images FROM slider WHERE id= :id ',array('id'=>$_GET['id']));
    foreach($images as $image){

		$photo = $image->images;

	}
	$dossier = 'upload/slider/';

if(isset($_GET['id'])){
	    if(file_exists($dossier.$photo)){
			if(unlink($dossier.$photo)){
					$DB->query('DELETE FROM slider WHERE id= :id',array(
			                 'id'=>$_GET['id']
		));
         $success = true;
			}
		} else{
			
		}
	}
    if($success === true){
    header('location: cat.php');
}
?>