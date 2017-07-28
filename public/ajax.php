<?php


// Fichier en cours, non fini




include_once '../private/app/init-ajax.php';
// On accepte les requetes POST uniquement
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  header("Content-type:application/json");
  $save = true;
  // Récupération des données du $_POST
  $pwd_old = isset($_POST['pwd_old']) ? $_POST['pwd_old'] : null;
  $pwd_new = isset($_POST['pwd_new']) ? $_POST['pwd_new'] : null;
  $pwd_repeat = isset($_POST['pwd_repeat']) ? $_POST['pwd_repeat'] : null;
  // Controle des données
  // - Controle du mot de passe actuel
  // --
  // -> le mot de passe ne doit pas être vide
  if (empty($pwd_old)) {
    $save = false;
  }
  // -> le mot de passe doit correspondre avec celui deja enregistré dans la BDD
  // - Controle du nouveau mot de passe
  // --
  // -> doit contenir au moins 8 caractères
  // -> doit contenir au plus 16 caractères
  if (strlen($pwd_new) < 8 || strlen($pwd_new) > 16) {
      $save = false;
      // setFlashbag("danger", "Le mot de passe doit avoir 8 caractères minimum et 16 caractères maximum.");
      echo "{\"state\":\"danger\", \"message\":\"Le mot de passe doit avoir 8 caractères minimum et 16 caractères maximum.\"}";
  }
  // -> doit avoir au moins un caractère de type numérique
  elseif (!preg_match("/[0-9]/", $pwd_new)) {
      $save = false;
      // setFlashbag("danger", "Le mot de passe doit contenir au moins un caractère numérique.");
      echo '{"state":"danger", "message":"Le mot de passe doit contenir au moins un caractère numérique."}';
  }
  // elseif (strlen(filter_var($password, FILTER_SANITIZE_NUMBER_INT)) <= 0) {
  //     $send = false;
  //     setFlashbag("danger", "Le mot de passe doit contenir au moins un caractère numérique."};
  // }
  // -> doit avoir au moins un caractère en majuscule
  elseif (!preg_match("/[A-Z]/", $pwd_new)) {
      $save = false;
      // setFlashbag("danger", "Le mot de passe doit contenir au moins un caractère en majuscule.");
      echo json_encode(array(
        "state" => "danger",
        "message" => "Le mot de passe doit contenir au moins un caractère en majuscule."
      ));
  }
  // -> doit avoir au moins un caractère spécial (#@!=+-_)
  elseif (!preg_match("/(#|@|!|=|\+|-|_)/", $pwd_new)) {
      $save = false;
      // setFlashbag("danger", "Le mot de passe doit contenir au moins un caractère spécial (#@!=+-_).");
      echo json_encode(array(
        "state" => "danger",
        "message" => "Le mot de passe doit contenir au moins un caractère spécial (#@!=+-_)."
      ));
  }
  // - Controle de la répétition du nouveau mot de passe
  // --
  // -> Les mots de passe doivent être identique
  if ($save) {
    // Cryptage du nouveau mot de passe
    // Requete de modification du mot de passe dans la BDD
    // Definition du message de réponse + encodage de la reponse en JSON
  }
}
// Si les requetes ne sont pas en POST, on refuse l'accès.
else {
  echo "Vous n'avez pas l'autorisation d'afficher ce fichier.";
}


