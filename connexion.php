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
    class="rectangle_11"
    placeholder="LaPlateforme.io"
  >
 <!-- Bouton -->
  <button type="submit" class="rectangle_12">
    <span class="je_me_connecte">Connexion</span>
  </button>
  


</form>
</body>