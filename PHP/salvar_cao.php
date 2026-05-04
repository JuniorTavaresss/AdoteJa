<?php
header('Content-Type: application/json; charset=utf-8');

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'adocao_pets_db';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Erro na conexão com o banco de dados: ' . $conn->connect_error
    ]);
    exit;
}

$conn->set_charset('utf8mb4');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Método não permitido'
    ]);
    exit;
}

$nome = trim($_POST['nome'] ?? '');
$sexo = trim($_POST['sexo'] ?? '');
$raca = trim($_POST['raca'] ?? '');
$porte = trim($_POST['porte'] ?? '');
$idade = trim($_POST['idade'] ?? '');
$cidade = trim($_POST['cidade'] ?? '');
$castrado = trim($_POST['castrado'] ?? '');

if ($nome === '' || $sexo === '' || $raca === '' || $porte === '' || $idade === '' || $cidade === '' || $castrado === '') {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => 'Preencha todos os campos obrigatórios.'
    ]);
    exit;
}

$caminhoFoto = '';

if (isset($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE) {
    if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Erro no upload da imagem.'
        ]);
        exit;
    }

    $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];
    $nomeOriginal = $_FILES['foto']['name'];
    $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

    if (!in_array($extensao, $extensoesPermitidas, true)) {
        http_response_code(422);
        echo json_encode([
            'success' => false,
            'message' => 'Formato de imagem inválido. Use JPG, JPEG, PNG ou WEBP.'
        ]);
        exit;
    }

    $diretorioFisico = __DIR__ . '/../img/pets/';
    if (!is_dir($diretorioFisico) && !mkdir($diretorioFisico, 0777, true)) {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Não foi possível criar a pasta de imagens.'
        ]);
        exit;
    }

    $nomeSeguro = preg_replace('/[^a-zA-Z0-9.-]/', '', pathinfo($nomeOriginal, PATHINFO_FILENAME));
    $nomeArquivo = time() . '_' . $nomeSeguro . '.' . $extensao;
    $destinoFisico = $diretorioFisico . $nomeArquivo;

    if (!move_uploaded_file($_FILES['foto']['tmp_name'], $destinoFisico)) {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Não foi possível salvar a imagem enviada.'
        ]);
        exit;
    }

    $caminhoFoto = '../img/pets/' . $nomeArquivo;
}

$sql = 'INSERT INTO cao (nome, sexo, raca, porte, idade, cidade, castrado, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
$stmt = $conn->prepare($sql);

if (!$stmt) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Erro ao preparar cadastro: ' . $conn->error
    ]);
    exit;
}

$stmt->bind_param('ssssssss', $nome, $sexo, $raca, $porte, $idade, $cidade, $castrado, $caminhoFoto);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Pet cadastrado com sucesso!'
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Erro ao cadastrar pet: ' . $stmt->error
    ]);
}

$stmt->close();
$conn->close();
?>