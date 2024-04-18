<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include ('./BDD/config_db.php');

$sql = "SELECT id_role, nom_role FROM role WHERE actif = 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Formulaire d'inscription</title>
</head>

<body>

    <form action="./backend/connexion/inscription_traitement.php" method="post">
    <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="error-message">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>
        <p>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
        </p>
        <p>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>
        </p>
        <p>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
        </p>
        <p>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </p>
        <p>
            <label for="retype_password">Retaper le mot de passe :</label>
            <input type="password" id="retype_password" name="retype_password" required>
        </p>
        <p>
            <label for="genre">Genre :</label>
            <select id="genre" name="genre" required>
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
                <option value="autre">Autre</option>
            </select>
        </p>
        <p>
            <label for="role">Rôle :</label>
            <select id="role" name="role">
                <?php
                while ($row = $stmt->fetch()) {
                    echo '<option value="' . htmlspecialchars($row['id_role']) . '">' . htmlspecialchars($row['nom_role']) . '</option>';
                }
                ?>
            </select>
        </p>
        <p>
            <button type="submit">S'inscrire</button>
        </p>
    </form>

</body>

</html>