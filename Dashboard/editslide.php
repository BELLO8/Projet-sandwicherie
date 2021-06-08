<?php 
require '../src/db.class.php';
$DB = new DB();
$success = false;
if(isset($_POST) and !empty($_POST)){
    if(isset($_GET['id'])){
        $texte = $_POST['texte']; 
        $id = $_GET['id'];
        if(isset($_FILES['slider'])){
             $nomfichier = utf8_encode($_FILES['slider']['name']);
             $tmp = $_FILES['slider']['tmp_name'];
             $dossier = 'upload/slider/';
             $req = new DB();
             $images = $req->select('SELECT images FROM slider WHERE id=:id',array('id'=>$id));
             foreach($images as $image){
                 $photo = $image->images;
             }
             if(file_exists($dossier.$photo)){
                 if(empty($nomfichier)){

                     $DB->query('UPDATE slider SET texte=:texte , images=:images WHERE id=:id',array(
                         'texte'=>$texte,
                         'images'=>$photo,
                         'id'=>$id
                     ));
                     $success = true;
                     
                 } else{

                         if( unlink($dossier.$photo)){
                                if(move_uploaded_file($tmp,$dossier.$nomfichier)){
                                    $DB->query('UPDATE slider SET texte=:texte , images=:images WHERE id=:id',array(
                                    'texte'=>$texte,
                                    'images'=>$nomfichier,
                                     'id'=>$id
                                     ));
                                   $success = true;
                                 }
                         }
                     
                   }
                
             } else{
                     mkdir($dossier);
                     if(move_uploaded_file($tmp,$dossier.$nomfichier)){
                            $DB->query('UPDATE slider SET texte=:texte , images=:images WHERE id=:id',array(
                            'texte'=>$texte,
                            'images'=>$nomfichier,
                            'id'=>$id
                        ));
                        $success = true;
                     }
                     
             }
        } else echo 'fichier n\'existe pas ';
    }
}

if($success == true){
    header('location:cat.php');
}

?>