<?php
// init-ajax.php
include_once '../private/app/config.php';
include_once '../private/app/autoload.php';


// --------------------
// AUTOLOADER
// --------------------

// Autoload des fonctions / controllers
autoload(FUNCTIONS_DIRECTORY, FUNCTIONS_FILES);

// Autoload des models
autoload(MODELS_DIRECTORY, MODELS_FILES);


// --------------------
// CONFIG PHP
// --------------------
if (MODE === "dev") {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
}



// --------------------
// INITIALISATION DE SESSION
// --------------------
session_start();


// --------------------
// CONNEXION BDD
// --------------------

// On teste la connexion à la BDD
try {
    // Création de la connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $pass);
    if (MODE === "dev") {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
// Si la connexion échoue, on attrape l'exception (message d'erreur)
// et on arrete l'execution du programme
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
