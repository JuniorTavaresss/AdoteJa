<?php
// api/pets.php
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config/conexao.php';

$pagina     = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina  = 15;
$offset     = ($pagina - 1) * $porPagina;

$especie = $_GET['especie'] ?? '';
$raca    = $_GET['raca']    ?? '';
$busca   = $_GET['busca']   ?? '';

$sql = "SELECT id, nome, especie, raca, idade, imagem 
        FROM pets 
        WHERE status = 'disponivel'";

$params = [];

if ($especie !== '') {
    $sql .= " AND especie = :especie";
    $params[':especie'] = $especie;
}
if ($raca !== '') {
    $sql .= " AND raca LIKE :raca";
    $params[':raca'] = "%$raca%";
}
if ($busca !== '') {
    $sql .= " AND nome LIKE :busca";
    $params[':busca'] = "%$busca%";
}

$sql .= " ORDER BY cadastrado_em ASC LIMIT :limite OFFSET :offset";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':limite', $porPagina, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

if (!empty($params)) {
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
}

$stmt->execute();
$pets = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Contar total
$totalStmt = $pdo->prepare("SELECT COUNT(*) FROM pets WHERE status = 'disponivel'");
$totalStmt->execute();
$total = $totalStmt->fetchColumn();

echo json_encode([
    'pets'        => $pets,
    'paginaAtual' => $pagina,
    'totalPaginas'=> ceil($total / $porPagina),
    'total'       => $total
], JSON_UNESCAPED_UNICODE);


