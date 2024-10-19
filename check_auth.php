<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    echo 'connected'; // Utilisateur connecté
} else {
    echo 'not_connected'; // Utilisateur non connecté
}
?>
