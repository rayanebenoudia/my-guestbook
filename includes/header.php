<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="logo_guestbook">
    <div>
        <img src="images/logo-nations-removebg-preview.png" alt="logo_guestbook">
    </div>
    <nav class="menu">
    <ul>
        <li><a href="/index.php">Accueil</a></li>
        <li><a href="/guestbook.php">Livre d'or</a></li>

        <?php
        if (isset($_SESSION['user_id'])) {
            echo '<li><a href="/profil.php">Profil</a></li>';
            echo '<li><a href="/logout.php">Déconnexion</a></li>';
        } else {
            echo '<li><a href="/connexion.php">Connexion</a></li>';
            echo '<li><a href="/inscription.php">Inscription</a></li>';
        }
        ?>
    </ul>
    </nav>
</header>

</body>
</html>