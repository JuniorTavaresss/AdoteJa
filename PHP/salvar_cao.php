<?php

$conn = new mysqli("localhost", "root", "", "adocao_pets_db");

if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$sexo = $_POST['sexo'];
$Raca = $_POST['Raca'];
$Porte = $_POST['Porte'];
$idade = $_POST['idade'];
$cidade = $_POST['cidade'];
$Castrado = $_POST['castrado'];

// Caminho da foto
$foto = "";

// Upload da imagem
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {

    $pasta = "../html/img/pets/";

    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }

    $nomeArquivo = uniqid() . "_" . basename($_FILES['foto']['name']);
    $caminhoCompleto = $pasta . $nomeArquivo;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoCompleto)) {
        $foto = "img/pets/" . $nomeArquivo;
    }
}

// INSERT seguro
$stmt = $conn->prepare("INSERT INTO table adocao (nome, sexo, Raca, Porte, idade, cidade, castrado, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssisss", $nome, $sexo, $Raca, $Porte, $idade, $cidade, $Castrado, $foto);

if ($stmt->execute()) {
    echo "<script>
        alert('Cadastro realizado com sucesso!');
        window.location.href='../html/Telalogin.html';
    </script>";
} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}

$conn->close();
?>