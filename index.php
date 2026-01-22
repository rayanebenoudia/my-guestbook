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
        <li><a href="./index.php">Accueil</a></li>
        <li><a href="./guestbook.php">Livre d'or</a></li>

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

<!-- page d'accueil -->
<main>
    <section class="image-fond">
        <img src="images/15-plus-beaux-maillot-foot-saison-2021-2022.jpg" alt="image-fond">
    <div class="contenue">
        <h1>Bienvenue sur le Guestbook des Nations !</h1>
        <p>Partagez vos impressions, témoignages ou messages avec la communauté internationale.</p>
        <a href="guestbook.php" class="btn">Accéder au livre d'or</a>
    </div>
    </section>
</main>

<footer>
    <p>&copy; 2026 - Guestbook</p>
</footer>

</body>
</html>
