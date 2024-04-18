<?php
include('../../BDD/config_db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $sql = "SELECT * FROM utilisateur WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $user['id_role'];
                header("Location: ../../index.php");
                exit();
            } else {
                $_SESSION['error'] = "L'adresse e-mail ou le mot de passe est incorrect.";
                header("Location: ../../login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "L'adresse e-mail ou le mot de passe est incorrect.";
            header("Location: ../../login.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur de connexion: " . $e->getMessage();
        header("Location: ../../login.php");
        exit();
    }
} else {
    header("Location: ../../login.php");
    exit();
}
