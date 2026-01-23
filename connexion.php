<!DOCTYPE html>
<htlml lang = fr>
<head>
    <title>guestbook</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<div class="rectangle_1"></div>
<div class="rectangle_2"></div>
<div class="accueil">
<a href="guestbook1.php">Acceuil</a>
</div>
<div class="ellipse"></div>
<div class="profil">Profil</div>
<div class="connexion">
</div>
<div class="ellipse2"></div>
<div class="Logo">LOGO</div>
<div class="messages">
<a href="messages.php">Messages</a>
</div>
<div class="rectangle_9"></div>
<form method="POST" action="">
 <label for="email" class="email">Login</label>
  <input
    type="email"
    id="email"
    name="email"
    class="rectangle_10"
    placeholder="LaPlateforme.io"
  >

 
  <label for="password" class="mdp">Mot de passe</label>
  <input
    type="password"
    id="password"
    name="password"
    class="rectangle_11"
    placeholder="LaPlateforme.io"
  >
 
  <button type="submit" class="rectangle_12">
    <span class="je_me_connecte">Connexion</span>
  </button>
  


</form>
</body>
<?php
$pdo =new pdo("mysql:host=localhost;dbname=guestbook;chartset=utf8",
"root",
"",
[
       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
);

$email = filter_var($_POST["email"] ?? '', FILTER_VALIDATE_EMAIL); 
$password = $_POST["password"] ?? ''; // cette ligne permet d'initialiser la password a "" si y'a pas de valeur

if (!$email) {
    echo "Email invalide";
    exit;
}



$stmt = $pdo->prepare("SELECT password FROM user WHERE login = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Email ou mot de passe incorrect";
    exit;
}


var_dump($password, $user['password']);
if (password_verify($password, $user['password'])) {
  $_SESSION['utilisateur'] = $user;
  var_dump($_SESSION);
  echo "Connexion réussie";
  // exit;
  }else{

    echo "Email ou mot de passe incorrect";
  }
  


?>