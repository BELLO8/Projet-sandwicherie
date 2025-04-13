<?php
require 'auth.php';
force_connexion();
require '../src/db.class.php';
$DB = new DB();

// Vérifier si les paramètres sont présents
if (!isset($_GET['id']) || !isset($_GET['status'])) {
    header('Location: commande.php');
    exit();
}

// Récupérer et nettoyer les paramètres
$id = (int)$_GET['id'];
$status = (int)$_GET['status'];

// Mettre à jour le statut de la commande
$query = "UPDATE commande SET status_command = :status WHERE id_command = :id";
$params = array(
    'status' => $status,
    'id' => $id
);

try {
    $DB->query($query, $params);
    header('Location: commande.php?success=1');
    exit();
} catch (Exception $e) {
    // En cas d'erreur, rediriger avec un message d'erreur
    header('Location: commande.php?error=1');
    exit();
}