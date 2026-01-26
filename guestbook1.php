<?php

// Connexion BDD
$conn = mysqli_connect("localhost", "root", "", "guestbook");
if (!$conn) {
    die("Erreur de connexion à la base de données.");
}
?>

<?php require_once './includes/header.php'; ?>

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

    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="message.php" class="post-btn">+ Poster un message</a>
    <?php endif; ?>
</main>

<?php require_once 'includes/footer.php'; ?>