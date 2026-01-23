<?php
require_once './includes/header.php';
?>
<main>

  <form method="POST" action="inscription.php">
    <label for="pseudo" class="pseudo">Login</label>
    <input
    type="pseudo"
    id="pseudo"
    name="pseudo"
    class="rectangle_10"
    placeholder="LaPlateforme.io"
    >
    
    <!-- Email -->
    <label for="password" class="mdp">Mot de passe</label>
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
    <!-- Bouton -->
    <button type="submit" class="rectangle_12">
      <span class="je_me_connecte">Connexion</span>
    </button>
    
    
    
  </form>
  
</main>

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