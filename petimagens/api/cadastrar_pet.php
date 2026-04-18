<?php
// api/cadastrar_pet.php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome'] ?? '');
    $especie  = $_POST['especie'] ?? '';
    $raca     = trim($_POST['raca'] ?? '');
    $idade    = (int)($_POST['idade'] ?? 0);

    // Upload da imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
        $uploadDir = '../uploads/pets/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
        $novoNome = 'pet-' . time() . '.' . $extensao;
        $caminho  = $uploadDir . $novoNome;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {
            $sql = "INSERT INTO pets (nome, especie, raca, idade, imagem, status, cadastrado_em) 
                    VALUES (:nome, :especie, :raca, :idade, :imagem, 'disponivel', NOW())";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nome'    => $nome,
                ':especie' => $especie,
                ':raca'    => $raca,
                ':idade'   => $idade,
                ':imagem'  => 'uploads/pets/' . $novoNome
            ]);

            echo json_encode(['sucesso' => true, 'mensagem' => 'Pet cadastrado!']);
            exit;
        }
    }

    echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao fazer upload ou salvar pet.']);
}
?>