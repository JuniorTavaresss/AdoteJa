<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: login.html");
    exit;
}
?>

<h1>Bem-vindo</h1>
<p>Email logado: <?php echo $_SESSION["email"]; ?></p>