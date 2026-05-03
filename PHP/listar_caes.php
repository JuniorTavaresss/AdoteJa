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
        'message' => 'Erro na conexão com o banco de dados: ' . $conn->connect_error,
        'pets' => []
    ]);
    exit;
}

$conn->set_charset('utf8mb4');

$sql = 'SELECT nome, sexo, raca, porte, idade, cidade, castrado, foto FROM cao ORDER BY id DESC';
$result = $conn->query($sql);

if (!$result) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Erro ao buscar pets: ' . $conn->error,
        'pets' => []
    ]);
    exit;
}

$pets = [];
while ($row = $result->fetch_assoc()) {
    $pets[] = [
        'nome' => $row['nome'],
        'sexo' => $row['sexo'],
        'idade' => $row['idade'],
        'tamanho' => $row['porte'],
        'cidade' => $row['cidade'],
        'raca' => $row['raca'],
        'castrado' => $row['castrado'],
        'imagem' => !empty($row['foto']) ? $row['foto'] : 'https://via.placeholder.com/400x300?text=Pet+sem+foto'
    ];
}

echo json_encode([
    'success' => true,
    'pets' => $pets
]);

$conn->close();
?>