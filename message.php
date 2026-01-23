<?php
session_start();

// Si pas connecté, rediriger vers la connexion
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau message</title>
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

<main>
    <h2>Écrire un message</h2>

    <?php
    // Traitement du formulaire
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $msg = $_POST['message'];
        $user_id = $_SESSION['user_id'];

        if (!empty($msg)) {
            // Connexion BDD
            $conn = mysqli_connect("localhost", "root", "", "guestbook");
            // Insertion simple
            mysqli_query($conn, "INSERT INTO message (message, id_user) VALUES ('$msg', $user_id)");
            mysqli_close($conn);
            // Rediriger vers le livre d'or
            header("Location: guestbook.php");
            exit();
        } else {
            echo "<p style='color:red;'>Le message ne peut pas être vide.</p>";
        }
    }
    ?>

    <form method="POST">
        <textarea name="message" rows="5" cols="50" placeholder="Écrivez votre message ici..."></textarea><br><br>
        <button type="submit">Publier</button>
        <a href="guestbook.php">Annuler</a>
    </form>
</main>

</body>
</html>