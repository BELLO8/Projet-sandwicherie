<?php
require 'auth.php';
force_connexion();
require '../src/db.class.php';
$DB = new DB();

// Vérification de la méthode HTTP
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: publications.php?error=1');
    exit;
}

// Récupération de l'action
$action = isset($_POST['action']) ? $_POST['action'] : '';

// Fonction pour gérer l'upload d'image
function handleImageUpload($file)
{
    $target_dir = "upload/publications/";

    // Créer le dossier s'il n'existe pas
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Générer un nom unique pour l'image
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $filename = uniqid() . '.' . $extension;
    $target_file = $target_dir . $filename;

    // Vérifier le type de fichier
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($extension, $allowed_types)) {
        return false;
    }

    // Déplacer le fichier uploadé
    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        return $filename;
    }

    return false;
}

try {
    switch ($action) {
        case 'create':
            // Validation des champs requis
            if (empty($_POST['titre']) || empty($_POST['description']) || empty($_FILES['image'])) {
                throw new Exception("Tous les champs sont obligatoires");
            }

            // Upload de l'image
            $image = handleImageUpload($_FILES['image']);
            if (!$image) {
                throw new Exception("Erreur lors de l'upload de l'image");
            }

            // Insertion dans la base de données
            $sql = "INSERT INTO publications (titre, description, image, date_creation) VALUES (?, ?, ?, NOW())";
            $params = [$_POST['titre'], $_POST['description'], $image];

            if ($DB->query($sql, $params)) {
                header('Location: publications.php?success=create');
            } else {
                throw new Exception("Erreur lors de la création de la publication");
            }
            break;

        case 'update':
            // Validation des champs requis
            if (empty($_POST['id']) || empty($_POST['titre']) || empty($_POST['description'])) {
                throw new Exception("Les champs titre et description sont obligatoires");
            }

            $params = [$_POST['titre'], $_POST['description']];
            $sql = "UPDATE publications SET titre = ?, description = ?";

            // Gestion de l'image si une nouvelle est uploadée
            if (!empty($_FILES['image']['name'])) {
                $image = handleImageUpload($_FILES['image']);
                if (!$image) {
                    throw new Exception("Erreur lors de l'upload de l'image");
                }
                $sql .= ", image = ?";
                $params[] = $image;

                // Supprimer l'ancienne image
                $old_image = $DB->select("SELECT image FROM publications WHERE id = ?", [$_POST['id']])[0]->image;
                if ($old_image && file_exists("upload/publications/" . $old_image)) {
                    unlink("upload/publications/" . $old_image);
                }
            }

            $sql .= " WHERE id = ?";
            $params[] = $_POST['id'];

            if ($DB->query($sql, $params)) {
                header('Location: publications.php?success=update');
            } else {
                throw new Exception("Erreur lors de la mise à jour de la publication");
            }
            break;

        case 'delete':
            // Validation de l'ID
            if (empty($_POST['id'])) {
                throw new Exception("ID de publication manquant");
            }

            // Récupérer l'image avant la suppression
            $publication = $DB->select("SELECT image FROM publications WHERE id = ?", [$_POST['id']])[0];

            // Supprimer la publication
            if ($DB->query("DELETE FROM publications WHERE id = ?", [$_POST['id']])) {
                // Supprimer l'image associée
                if ($publication->image && file_exists("upload/publications/" . $publication->image)) {
                    unlink("upload/publications/" . $publication->image);
                }
                header('Location: publications.php?success=delete');
            } else {
                throw new Exception("Erreur lors de la suppression de la publication");
            }
            break;

        default:
            throw new Exception("Action non valide");
    }
} catch (Exception $e) {
    header('Location: publications.php?error=1&message=' . urlencode($e->getMessage()));
}
