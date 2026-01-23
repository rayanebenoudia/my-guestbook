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

require_once('./includes/footer.php')
?>