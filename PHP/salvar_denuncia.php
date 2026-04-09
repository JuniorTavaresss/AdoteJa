<?php

$conn = new mysqli("localhost", "root", "", "adocao_pets_db");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$tipo_denuncia = $_POST['tipo_denuncia'];
$endereco = $_POST['endereco'];
$descricao = $_POST['descricao'];
$anonimo = isset($_POST['anonimo']) ? 1 : 0;

$foto = null;

// Verifica se enviou imagem
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {

    $pasta = "../uploads/denuncias/";

    // Cria a pasta se não existir
    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }

    $nomeArquivo = uniqid() . "_" . basename($_FILES['foto']['name']);
    $caminhoCompleto = $pasta . $nomeArquivo;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoCompleto)) {
        $foto = "uploads/denuncias/" . $nomeArquivo;
    }
}

$sql = "INSERT INTO Denuncia 
(tipo_denuncia, endereco, descricao, foto, anonimo)
VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $tipo_denuncia, $endereco, $descricao, $foto, $anonimo);

if ($stmt->execute()) {
    echo "<script>
        alert('Denúncia enviada com sucesso!');
        window.location.href='../html/denuncia.html';
    </script>";
} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>