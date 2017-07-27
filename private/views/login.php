<?php


// Cas où l'utilisateur envoie le formulaire (méthode POST)
// Contrôle du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $save = true;
    $user = false;

    // Recupérer les données de $_POST
    $token      = isset($_POST['token']) ? $_POST['token'] : null;
    $login      = isset($_POST['login']) ? $_POST['login'] : null;
    $password   = isset($_POST['password']) ? $_POST['password'] : null;


    // Contrôler l'intégrité du token
    if (!isset($_SESSION['token']) || empty($_SESSION['token']) || $_SESSION['token'] !== $token) {
        $save = false;
        setFlashbag("danger", "Le token est invalide.");
    }


    // Contrôle des données envoyées par l'utilisateur
    // Le champ login ne doit pas etre vide
    // Si le champs est vide , on affiche un message d'erreur
    if (empty($login) || !filter_var($login, FILTER_VALIDATE_EMAIL)) {
        $save = false;
    }



    // Contrôle l'existence de l'utilisateur dans la BDD
    // Recup id, firstname, lastname, email, password
    // On effectue la requête uniquement sur le champ email (where email=$login)
    if ($save) {
        if (!($user = getUserByEmail($login))) {
            $save = false;
            // setFlashbag("danger", "L'utilisateur $login n'a pas été trouvé");
        }
    }


    // Contrôle du MDP
    if ($save && $user) {

        // MDP crypté, récupéré depuis la BDD
        $pwd_hash = $user->password; // la flèche est un opérateur d'objet en PHP (comme le point en JS)
        // MDP en clair récupéré depuis le formulaire de connexion
        $pwd_text = $_POST['password'];

        // On contrôle le HASH des deux MDP
        if (!password_verify($pwd_text, $pwd_hash)) {
            $save = false;
            setFlashbag("danger", "Erreur d'identification");
        }

    }
    else {
        setFlashbag("danger", "Erreur d'identification");
    }

    // On log l'utilisateur si tout s'est bien passé
    if ($save) {

        // Identification de l'utilisateur
        $_SESSION['user'] = [
            "id" => $user->id,
            "firstname" => $user->firstname,
            "lastname" => $user->lastname,
            "email" => $user->email,
            "roles" => explode(ROLES_GLUE,$user->roles)
        ];

        // Destruction du token
        unset($_SESSION['token']);

        // Redirection vers sa page de profil
        header("location: index.php?page=profile");
        exit;
    }

}
else {
    // Definition du token
    $_SESSION['token'] = getToken();
}
?>
<div class="page-header">
    <h2>Connexion</h2>
</div>

<div class="row">
    <div class="col-md-4 col-md-offset-4">

        <?php getFlashbag(); ?>

        <form method="post">

            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

            <div class="form-group">
                <label for="login">Identifiant (adresse email)</label>
                <input  class="form-control" type="text" id="login" name="login">
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input  class="form-control" type="password" id="password" name="password">
            </div>

            <br>
            <button type="submit" class="btn btn-info btn-block">Valider</button>
        </form>

        <p class="text-center">
            <a href="index.php?page=register">Je n'ai pas encore de compte</a>
        </p>

    </div>
</div>