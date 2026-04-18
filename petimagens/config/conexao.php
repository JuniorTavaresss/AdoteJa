<?php
// config/conexao.php
$host     = 'localhost';
$dbname   = 'bdpetimagens';      // ← mude se o nome do seu banco for diferente
$username = 'root';              // usuário padrão do XAMPP
$password = '';                  // senha padrão do XAMPP geralmente é vazia

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexão OK";   // descomente só para testar
} catch (PDOException $e) {
    die("Erro de conexão com o banco: " . $e->getMessage());
}
?>
