<?php 
require '../src/db.class.php';
$DB = new DB();
$success = false;
if(isset($_POST) and !empty($_POST)){
    if(isset($_GET['id'])){
        $cat_id = $_POST['cat'];
        $nom = $_POST['nom'];
        $details = $_POST['details'];
        $prix = $_POST['prix'];
        $id = $_GET['id'];
          
    if(isset($_FILES['photo'])){
        $nomfichier = utf8_encode($_FILES['photo']['name']);
        $tmp = $_FILES['photo']['tmp_name'];
        $dossier = "upload/food/";  
        $req = new DB();
        $images = $req->select('SELECT images FROM food WHERE id= :id ' ,array(
            'id'=>$_GET['id']));
                foreach($images as $image){
                    $photo = $image->images;
                }
               if(file_exists($dossier.$photo)){
                        if(empty($nomfichier)){
                                                         
                                    $DB->query('UPDATE food SET cat_id=:cat,nom=:nom,details=:details,prix=:prix,images=:photo WHERE id=:id ',array(
                                    'cat'=>$cat_id,
                                    'nom'=>$nom,
                                    'details'=>$details,
                                    'prix'=>$prix,
                                    'photo'=>$photo,
                                    'id'=>$id
                                ));
                                 $success = true;
                        } else{
                                  
                            if(unlink($dossier.$photo)){
                                if(move_uploaded_file($tmp,$dossier.$nomfichier)){  
                                                        
                                    $DB->query('UPDATE food SET cat_id=:cat,nom=:nom,details=:details,prix=:prix,images=:photo WHERE id=:id ',array(
                                        'cat'=>$cat_id,
                                        'nom'=>$nom,
                                        'details'=>$details,
                                        'prix'=>$prix,
                                        'photo'=>$nomfichier,
                                        'id'=>$id
                                    ));
                                    $success = true;
                               }
                            }
                        }
                  
               } else{         
                                 mkdir($dossier);
                                if(move_uploaded_file($tmp,$dossier.$nomfichier)){                                            
                                                          
                                $DB->query('UPDATE food SET cat_id=:cat,nom=:nom,details=:details,prix=:prix,images=:photo WHERE id=:id ',array(
                                    'cat'=>$cat_id,
                                    'nom'=>$nom,
                                    'details'=>$details,
                                    'prix'=>$prix,
                                    'photo'=>$nomfichier,
                                    'id'=>$id
                                ));
                                $success = true;
                            
                        }
               }
             
    }else echo " le fichier n'exite pas";
    }
    
}

if($success == true){
    header('location:index.php');
}

?>

