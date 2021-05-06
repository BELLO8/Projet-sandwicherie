<?php 
require '../src/db.class.php';
$DB = new DB();
$success = false;
if(isset($_POST) and !empty($_POST)){
    if(isset($_FILES['photo'])){
        $nomfichier = utf8_encode($_FILES['photo']['name']);
        $tmp = $_FILES['photo']['tmp_name'];
        $dossier = 'upload/slider/';
        if(is_uploaded_file($tmp)){
            if(file_exists($dossier)){
                if(move_uploaded_file($tmp,$dossier.$nomfichier)){
                    $texte = $_POST['texte'];   
                    $DB->query('INSERT INTO slider(texte,images) VALUES(:texte,:images)',array(
                        'texte'=>$texte ,
                        'images'=>$nomfichier      
                    ));
                    $success = true;
                } else {
                    echo 'pas uploader';
                }
            } else{
                      mkdir($dossier);
                        if(move_uploaded_file($tmp,$dossier.$nomfichier)){
                            $texte = $_POST['texte'];   
                            $DB->query('INSERT INTO slider(texte,images) VALUES(:texte,:images)',array(
                                'texte'=>$texte ,
                                'images'=>$nomfichier      
                            ));
                            $success = true;
                        } else {
                            echo 'pas uploader';
                             }
                }
        } else{
            echo " le fichier n'a pas ete uploadé";
        }
       
    } else{
        echo " le fichier n'existe pas ";
    }

}
if($success){
    header('location:cat.php');
}
?>