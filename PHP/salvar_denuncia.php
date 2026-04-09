<?php

$conn = new mysqli("localhost", "root", "", "adocao_pets_db");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Dados do formulário
$tipo_denuncia = $_POST['tipo_denuncia'];
$endereco = $_POST['endereco'];
$descricao = $_POST['descricao'];
$anonimo = isset($_POST['anonimo']) ? 1 : 0;

// Caminho da foto
$foto = "";

// Verifica se foi enviada uma imagem
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {

    // Pasta onde a imagem será salva
    $pasta = "../img/Denuncias/";

    // Cria a pasta se não existir
    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }

    // Nome único para a imagem
    $nomeArquivo = uniqid() . "_" . basename($_FILES['foto']['name']);

    // Caminho completo no servidor
    $caminhoCompleto = $pasta . $nomeArquivo;

    // Move a imagem para a pasta
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoCompleto)) {

        // Caminho salvo no banco
        $foto = "img/Denuncias/" . $nomeArquivo;
    }
}

// Query para inserir no banco
$sql = "INSERT INTO Denuncia 
(tipo_denuncia, endereco, descricao, foto, anonimo)
VALUES (?, ?, ?, ?, ?)";

// Prepara a query
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erro ao preparar a query: " . $conn->error);
}

// Associa os parâmetros
$stmt->bind_param("ssssi", $tipo_denuncia, $endereco, $descricao, $foto, $anonimo);

if ($stmt->execute()) {
    echo "<script>
        alert('Denúncia enviada com sucesso!');
        window.location.href='../Index.html';
    </script>";
} else {
    echo "<script>
        alert('Erro ao cadastrar denúncia!');
        window.history.back();
    </script>";
}

// Fecha conexão
$stmt->close();
$conn->close();

?>