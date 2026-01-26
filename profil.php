<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "guestbook");
if (!$conn) {
    die("Erreur de connexion à la base de données");
}

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT login FROM user WHERE id = $user_id");
$user = mysqli_fetch_assoc($result);

if (!empty($_POST['login'])) {
    $new_login = mysqli_real_escape_string($conn, $_POST['login']);

    mysqli_query(
        $conn,
        "UPDATE user SET login = '$new_login' WHERE id = $user_id"
    );

    $_SESSION['login'] = $new_login;
    header("Location: profil.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon profil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="logo_guestbook">
    <div>
        <img src="images/logo-nations-removebg-preview.png" alt="logo">
    </div>
    <nav class="menu">
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="guestbook1.php">Livre d'or</a></li>
            <li><a href="logout.php">Déconnexion</a></li>
        </ul>
    </nav>
</header>

<main class="profil-main">
    <section class="profil-card">
        <h2>Mon profil</h2>

        <p>
            Connecté en tant que :
            <strong><?php echo htmlspecialchars($user['login']); ?></strong>
        </p>

        <form method="post">
            <label for="login">Modifier mon login</label>
            <input type="text" name="login" id="login" required>

            <button type="submit" class="btn">Mettre à jour</button>
        </form>
    </section>
</main>

<footer>
    <p>&copy; 2026 - Guestbook</p>
</footer>

</body>
</html>
