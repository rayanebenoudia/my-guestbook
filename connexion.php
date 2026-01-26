<?php
require_once './includes/header.php'; // ⚠️ Doit être en PREMIER

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=guestbook;charset=utf8", "root", "", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $email = filter_var($_POST["email"] ?? '', FILTER_VALIDATE_EMAIL); 
        $password = $_POST["password"] ?? '';

        if (!$email) {
            $message = "Email invalide";
        } else {
            $stmt = $pdo->prepare("SELECT id, password FROM user WHERE login = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                $message = "Email ou mot de passe incorrect";
            } elseif (!password_verify($password, $user['password'])) {
                $message = "Email ou mot de passe incorrect";
            } else {
                $_SESSION['user_id'] = $user['id'];
                header("Location: index.php");
                exit();
            }
        }
    } catch (Exception $e) {
        $message = "Erreur BDD";
    }
}
?>

<body class="page-connexion">

<main>
  <div class="formulaire-cadre">
    <h2>Connectez-vous</h2>

    <form method="POST" action="connexion.php">
      <label for="email" class="mdp">Email</label>
      <input type="email" id="email" name="email" class="rectangle_10" placeholder="LaPlateforme.io">

      <label for="password" class="mdp">Mot de passe</label>
      <input type="password" id="password" name="password" class="rectangle_11" placeholder="LaPlateforme.io">

      <button type="submit" class="rectangle_12">
        <span class="je_me_connecte">Je me connecte</span>
      </button>
    </form>

    <?php if (!empty($message)): ?>
      <p style="color: red; margin-top: 1rem;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <p><a href="inscription.php">Je n'ai pas de compte, je m'inscris ici</a></p>
  </div>
</main>

<?php require_once 'includes/footer.php'; ?>