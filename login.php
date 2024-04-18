<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Formulaire de connexion</title>
    <link href="styles.css" rel="stylesheet">
</head>

<body>
<div class="card-login">
    <form action="./backend/connexion/connexion_traitement.php" method="post">
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="error-message">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>
        <p>
            <label for="email" style="color: red;" >Email :</label>
            <input type="email" id="email" name="email" required>
        </p>
        <p>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </p>
        <p>
            <button type="submit">Se connecter</button>
        </p>
    </form>
</div>

<style>
    .card-login {
        background-color: yellow;
    }
</style>


</body>

</html>