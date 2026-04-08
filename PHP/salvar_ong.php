<?php

$conn = new mysqli("localhost", "root", "", "adocao_pets_db");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$senha = $_POST['senha'];
$confirmar = $_POST['confirmar_senha'];
$cidade = $_POST['cidade'];

if ($senha !== $confirmar) {
    die("Senhas não coincidem!");
}

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuario_ong (nome, email, senha, cidade, telefone)
        VALUES ('$nome', '$email', '$senha_hash', '$cidade', '$telefone')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('Cadastro realizado com sucesso!');
        window.location.href='../html/Telalogin.html';
    </script>";
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}

$conn->close();
?>