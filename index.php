<?php
session_start();

if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
    echo '<a href="#"><button>Administration</button></a>';
}

if (isset($_SESSION['email'])) {
    echo $_SESSION['email'];
}
?>
