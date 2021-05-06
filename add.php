<?php 
require '../src/db.class.php';

	$success = false;
	$DB = new DB();
    if(isset($_POST) and !empty($_POST)){
        if(isset($_FILES['images']) && !empty($_FILES['images']['name'])){
            $nomfichier = utf8_encode($_FILES['images']['name']);
            $tmp = $_FILES['images']['tmp_name'];
            $dossier = "upload/food/";
            if(is_uploaded_file($tmp)){
                if(file_exists($dossier)){
                  if(move_uploaded_file($tmp,$dossier.$nomfichier)){             
                            $cat_id = $_POST['cat'];
                            $nom = $_POST['nom'];
                            $details = $_POST['details'];
                            $prix = $_POST['prix'];                       
                        $DB->query('INSERT INTO food(cat_id,nom, details, prix, images) VALUES(:cat_id, :nom, :details, :prix , :images)',array(
                            'cat_id'=>$cat_id,
                            'nom'=>$nom,
                            'details'=>$details,
                            'prix'=>$prix,
                            'images'=>$nomfichier

                        ));
                        $success = true;
                        echo " fichier uploader avec succes";
                   }  else echo "fichier non uploader";
                }else{
                    mkdir($dossier,0777,true);
                            if(move_uploaded_file($tmp,$dossier.$nomfichier)){             
                                    $cat_id = $_POST['cat'];
                                    $nom = $_POST['nom'];
                                    $details = $_POST['details'];
                                    $prix = $_POST['prix'];                       
                                   $DB->query('INSERT INTO food(cat_id,nom, details, prix, images) VALUES(:cat_id, :nom, :details, :prix , :images)',array(
                                    'cat_id'=>$cat_id,
                                    'nom'=>$nom,
                                    'details'=>$details,
                                    'prix'=>$prix,
                                    'images'=>$nomfichier

                                 ));
                                $success = true;
                                echo " fichier uploader avec succes";
                            }  else echo "fichier non uploader";

                }
            }else{
                echo " le fichier n'a pas ete uploadé";
            }
        }else{
            echo " le fichier n'existe pas ";
        }
		
    
}

if($success === true){
    header('location: index.php');
}

?>