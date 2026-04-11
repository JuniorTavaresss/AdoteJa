<?php

$conn = new mysqli("localhost", "root", "", "adocao_pets_db");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Dados do formulário
$nome_pet = $_POST['nome_pet'];
$local_perdido = $_POST['local_perdido'];
$data_perdido = $_POST['data_perdido'];
$telefone = $_POST['telefone'];
$descricao = $_POST['descricao'];

// Caminho da foto
$foto = "";

// Upload da imagem
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {

    $pasta = "../img/PerdiPet";

    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }

    $nomeArquivo = uniqid() . "_" . basename($_FILES['foto']['name']);
    $caminhoCompleto = $pasta . $nomeArquivo;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoCompleto)) {
        $foto = "img/Perdidos/" . $nomeArquivo;
    }
}

// SQL
$sql = "INSERT INTO PerdiPet 
(nome_pet, local_perdido, data_perdido, telefone, descricao, foto)
VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erro ao preparar: " . $conn->error);
}

$stmt->bind_param("ssssss", 
    $nome_pet, 
    $local_perdido, 
    $data_perdido, 
    $telefone, 
    $descricao, 
    $foto
);

if ($stmt->execute()) {
    echo "<script>
        alert('Pet perdido cadastrado com sucesso!');
        window.location.href='../Index.html';
    </script>";
} else {
    echo "<script>
        alert('Erro ao cadastrar pet perdido!');
        window.history.back();
    </script>";
}

// Fecha conexão
$stmt->close();
$conn->close();

?>
?>