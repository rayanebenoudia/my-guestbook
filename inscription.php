<?php

// Si déjà connecté, rediriger vers l'accueil
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=guestbook;charset=utf8", "root", "", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $pseudo = $_POST['pseudo'] ?? '';
        $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        if (empty($pseudo) || empty($email) || empty($password) || empty($confirm_password)) {
            $message = "Veuillez remplir tous les champs.";
        } elseif ($password !== $confirm_password) {
            $message = "Les mots de passe ne correspondent pas.";
        } else {
            // Vérifier si l'email existe déjà
            $stmt = $pdo->prepare("SELECT id FROM user WHERE login = ?");
            $stmt->execute([$email]);
            if ($stmt->rowCount() > 0) {
                $message = "Cet email est déjà utilisé.";
            } else {
                // Hacher le mot de passe
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insérer l'utilisateur
                $stmt = $pdo->prepare("INSERT INTO user (login, password) VALUES (?, ?)");
                $stmt->execute([$email, $hashed_password]);

                $message = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            }
        }
    } catch (Exception $e) {
        $message = "Erreur lors de l'inscription.";
    }
}
?>

<?php require_once 'includes/header.php'; ?>

<body class="page-inscription">

<main>
  <div class="formulaire-cadre">
    <h2>Crée un compte</h2>

    <?php if (!empty($message)): ?>
      <p style="color: red; margin-top: 1rem;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST" action="inscription.php">
      <!-- Pseudo -->
      <label for="pseudo" class="pseudo">Pseudo</label>
      <input type="text" id="pseudo" name="pseudo" class="rectangle_10" placeholder="LaPlateforme.io" required>

      <!-- Email -->
      <label for="email" class="email">Email</label>
      <input type="email" id="email" name="email" class="rectangle_14" placeholder="LaPlateforme.io" required>

      <!-- Mot de passe -->
      <label for="password" class="mots_de_passe">Mot de passe</label>
      <input type="password" id="password" name="password" class="rectangle_11" placeholder="LaPlateforme.io" required>

      <!-- Confirmation mot de passe -->
      <label for="confirm_password" class="Confirmation_de_mot_de_passe">Confirmation de mot de passe</label>
      <input type="password" id="confirm_password" name="confirm_password" class="rectangle_13" placeholder="LaPlateforme.io" required>

      <!-- Bouton -->
      <button type="submit" class="rectangle_12">
        <span class="je_m_inscrit">Je m’inscris</span>
      </button>
    </form>
  </div>
</main>

<?php require_once 'includes/footer.php'; ?>