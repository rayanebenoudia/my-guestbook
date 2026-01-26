<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "guestbook");
if (!$conn) {
    die("Erreur BDD");
}

if (!empty($_POST['message'])) {
    $msg = mysqli_real_escape_string($conn, $_POST['message']);
    $user_id = $_SESSION['user_id'];

    mysqli_query(
        $conn,
        "INSERT INTO message (message, id_user, date)
         VALUES ('$msg', $user_id, NOW())"
    );

    header("Location: guestbook1.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Poster un avis</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="logo_guestbook">
    <nav class="menu">
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="guestbook1.php">Livre d'or</a></li>
        </ul>
    </nav>
</header>

<main class="guestbook-main">
    <h2>Poster un avis</h2>

    <form method="post">
        <textarea name="message" rows="6" required></textarea><br><br>
        <button type="submit" class="btn">Publier</button>
    </form>
</main>

</body>
</html>
