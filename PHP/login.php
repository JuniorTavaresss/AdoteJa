<?php
session_start();
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($senha, $usuario['senha'])) {

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];

            header("Location: index.php");
            exit;

        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Email não encontrado!";
    }

    $stmt->close();
    $_SESSION["email"] = $email;

header("Location: index.php");
exit;
}
?>

