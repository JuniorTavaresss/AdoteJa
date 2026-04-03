<?php

$conn = new mysqli("localhost", "root", "", "adoteja");

if ($conn->connect_error) {
    die("Erro de conexão");
}

$email = $_POST['email'];
$senha = $_POST['senha'];

// verifica se já existe
$sql_verifica = "SELECT * FROM usuarios WHERE email='$email'";
$result = $conn->query($sql_verifica);

if ($result->num_rows > 0) {
    echo "existe";
} else {
    // salva novo usuário
    $sql = "INSERT INTO usuarios (email, senha) VALUES ('$email', '$senha')";
    
    if ($conn->query($sql) === TRUE) {
        echo "sucesso";
    } else {
        echo "erro";
    }
}

$conn->close();
?>