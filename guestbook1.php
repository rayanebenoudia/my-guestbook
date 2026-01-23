<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "guestbook");
if (!$conn) {
    die("Erreur de connexion à la base de données.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Livre d'or</title>
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
        <li><a href="guestbook1.php">Livre d'or</a></li>

        <?php
        if (isset($_SESSION['user_id'])) {
            echo '<li><a href="./profil.php">Profil</a></li>';
            echo '<li><a href="./logout.php">Déconnexion</a></li>';
        } else {
            echo '<li><a href="./connexion.php">Connexion</a></li>';
            echo '<li><a href="./inscription.php">Inscription</a></li>';
        }
        ?>
    </ul>
    </nav>
</header>

<main class="guestbook-main">
    <h2>Livre d'or</h2>

    <?php
    $result = mysqli_query($conn, "
        SELECT m.message, m.date, u.login 
        FROM message m 
        JOIN user u ON m.id_user = u.id 
        ORDER BY m.date DESC
    ");

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="message-card">';
            echo '<div class="author">Posté par <strong>' . htmlspecialchars($row['login']) . '</strong></div>';
            echo '<div class="date">' . date('d/m/Y à H:i', strtotime($row['date'])) . '</div>';
            echo '<div class="content">' . nl2br(htmlspecialchars($row['message'])) . '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>Aucun message pour le moment.</p>';
    }

    mysqli_close($conn);
    ?>

    <?php
    if (isset($_SESSION['user_id'])) {
        echo '<a href="message.php" class="post-btn">+ Poster un message</a>';
    }
    ?>
</main>

<footer>
    <p>&copy; 2026 - Guestbook</p>
    <div class="liens">
        <a href="./index.php">Accueil</a>
        <a href="./guestbook1.php">Livre d'or</a>

    </div>
</footer>

</body>
</html>