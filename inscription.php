<!DOCTYPE html>
<html lang = fr>
<head>
<title>inscription</title>
<meta charset=utf-8>
<link rel=stylesheet href="style1.css">

</head>
<body>
  <main>
    <header class="header">
      <div class="accueil">
        <a href="guestbook1.php">Acceuil</a>
      </div>
      <div class="profil">Profil</div>
      <div class="connexion">
      <a href="connexion.php">Connexion</a>
      </div>
        <div class="messages">
        <a href="messages.php">Messages</a>
      </div>
    </header>
  
    <!-- <div class="rectangle_2"></div>
    <div class="creation_compte"></div>
    <div class="ellipse"></div>
    <div class="ellipse2"></div>
    <div class="Logo">LOGO</div>
    <div class="rectangle_9"></div> -->
    <form method="POST" action="inscription.php">
      <label for="pseudo" class="pseudo">Pseudo</label>
      <input
      type="text"
      id="pseudo"
      name="pseudo"
      class="rectangle_10"
      placeholder="LaPlateforme.io"
      >
      
      <!-- Email -->
      <label for="email" class="email">Email</label>
      <input
      type="email"
      id="email"
      name="email"
      class="rectangle_14"
      placeholder="LaPlateforme.io"
      >
      
      <!-- Mot de passe -->
      <label for="password" class="mots_de_passe">Mot de passe</label>
      <input
      type="password"
      id="password"
      name="password"
      class="rectangle_11"
      placeholder="LaPlateforme.io"
      >
      
      <!-- Confirmation mot de passe -->
      <label for="confirm_password" class="Confirmation_de_mot_de_passe">
        Confirmation de mot de passe
      </label>
      <input
      type="password"
      id="confirm_password"
      name="confirm_password"
      class="rectangle_13"
      placeholder="LaPlateforme.io"
      >
      
      <!-- Bouton -->
      <button type="submit" class="rectangle_12">
        <span class="je_m_inscrit">Je m’inscris</span>
      </button>
      
      
    </form>
    
    
  </main>
</body>
<?php
// 1️⃣ Connexion à la base
$pdo = new PDO(
    "mysql:host=localhost;dbname=guestbook;charset=utf8",
    "root",
    "",
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
);

// 2️⃣ Vérifier que le formulaire a été envoyé
if (!empty($_POST['email']) && !empty($_POST['password'])) {

    // 3️⃣ Valider et récupérer les données
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    if (!$email) {
        echo "Email invalide";
        exit;
    }

    // 4️⃣ Vérifier si l'email existe déjà
    $check = $pdo->prepare("SELECT id FROM user WHERE login = ?");
    $check->execute([$email]);
    if ($check->rowCount() > 0) {
        echo "Email déjà utilisé";
        exit;
    }

    // 5️⃣ Hacher le mot de passe
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // 6️⃣ Insérer en base
    $stmt = $pdo->prepare("INSERT INTO user (login, password) VALUES (?, ?)");
    $stmt->execute([$email, $password]);

    echo "Inscription réussie";
}