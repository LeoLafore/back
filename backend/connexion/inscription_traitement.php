<?php
include ('../../BDD/config_db.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $retype_password = $_POST['retype_password'];
    $genre = $_POST['genre'];
    $id_role = $_POST['role'];

    if (strlen($password) < 8) {
        $_SESSION['error'] = "Le mot de passe doit contenir au moins 8 caractères.";
        header("Location: ../../register.php");
        exit();
    }

    if ($password !== $retype_password) {
        $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
        header("Location: ../../register.php");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    try {
        $sql = "INSERT INTO utilisateur (id_role, email, password, nom, prenom, genre, actif) VALUES (:id_role, :email, :password, :nom, :prenom, :genre, 1)";
        
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id_role', $id_role);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':genre', $genre);

        $stmt->execute();

        $_SESSION['email'] = $email;
        $_SESSION['role'] = $id_role;
        header("Location: ../../index.php");
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur lors de l'inscription: " . $e->getMessage();
        header("Location: ../../register.php");
    }
} else {
    header("Location: ../../register.php");
}