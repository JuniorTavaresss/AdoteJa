<?php

$conn = new mysqli("localhost", "root", "", "adocao_pets_db");

if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirmar = $_POST['confirmar_senha'];
$cidade = $_POST['cidade'];

if ($senha !== $confirmar) {
    die("Senhas não coincidem!");
}

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO Usuario (nome, email, senha, cidade)
        VALUES ('$nome', '$email', '$senha_hash', '$cidade')";

if ($conn->query($sql)) {
    echo "<script>alert('Cadastro realizado com sucesso!');</script>";
} else {
    echo "Erro: " . $conn->error;
}

$conn->close();
?>