<?php

function est_connecte()
{
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  return !empty($_SESSION['connecte']);
}
function force_connexion()
{
  if (!est_connecte()) {
    header('location:/Dashboard/login.php');
    exit();
  }
}
