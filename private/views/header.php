<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Food Trucks</title>
    <link href="vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/theme.css" rel="stylesheet">
  </head>
  <body>

    <div class="container">

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <div class="masthead">
        <h3 class="text-muted">Les Foodtrucks du coin !</h3>

        <nav>

            <?php if (!(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']) && is_numeric($_SESSION['user']['id']))) : ?>
            <a href="index.php?page=register">Inscription</a>
            <a href="index.php?page=login">Connexion</a>
            <?php else: ?>
            <a href="index.php?page=profile"><?php echo $_SESSION['user']['firstname']; ?></a>
            <a href="index.php?page=logout">Déconnexion</a>
            <?php endif; ?>

        </nav>

        <hr>

        <nav>
          <ul class="nav nav-justified">
            <li><a href="index.php?page=home">Home</a></li>
            <li><a href="index.php?page=foodtrucks">Liste des Foodtrucks</a></li>
            <li><a href="index.php?page=contact">Contact</a></li>
          </ul>
        </nav>
      </div>

      <div id="content">

        <?php getFlashbag(); ?>
