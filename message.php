<?php
session_start(); // ⚠️ Doit être en PREMIÈRE ligne

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

$message_erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $msg = trim($_POST['message'] ?? '');
    if (empty($msg)) {
        $message_erreur = "Le message ne peut pas être vide.";
    } else {
        $conn = mysqli_connect("localhost", "root", "", "guestbook");
        if (!$conn) {
            die("Erreur BDD");
        }
        $msg_safe = mysqli_real_escape_string($conn, $msg);
        $user_id = (int)$_SESSION['user_id'];
        mysqli_query($conn, "INSERT INTO message (message, id_user, date) VALUES ('$msg_safe', $user_id, NOW())");
        mysqli_close($conn);
        header("Location: guestbook1.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau message</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="page-message">

<?php require_once './includes/header.php'; ?>

<main>
    <h2>Écrire un message</h2>

    <?php if ($message_erreur): ?>
        <p style="color:red;"><?= htmlspecialchars($message_erreur) ?></p>
    <?php endif; ?>

    <form method="POST">
        <textarea name="message" placeholder="Votre message..."></textarea><br><br>
        <button type="submit">Publier</button>
        <a href="guestbook1.php">Annuler</a>
    </form>
</main>

<?php require_once './includes/footer.php'; ?>

</body>
</html>