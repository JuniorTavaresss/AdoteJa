<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root"; // seu usuário do MySQL
$password = ""; // sua senha do MySQL
$dbname = "adocao_pets_db";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Erro na conexão: " . $conn->connect_error]));
}

// Verificar se foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Pegar os dados do formulário
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];
    $raca = $_POST['raca'];
    $porte = $_POST['porte'];
    $idade = $_POST['idade'];
    $cidade = $_POST['cidade'];
    $castrado = $_POST['castrado'];
    
    // Processar o upload da foto
    $caminho_foto = "";
    
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $nome_arquivo = time() . '_' . $_FILES['foto']['name'];
        $caminho_destino = "../img/pets/" . $nome_arquivo;
        
        // Criar a pasta se não existir
        if (!file_exists("../img/pets/")) {
            mkdir("../img/pets/", 0777, true);
        }
        
        // Mover o arquivo para a pasta
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminho_destino)) {
            $caminho_foto = "img/pets/" . $nome_arquivo;
        } else {
            echo json_encode(["success" => false, "message" => "Erro ao fazer upload da foto"]);
            exit;
        }
    }
    
    // Preparar a query SQL
    $sql = "INSERT INTO cao (nome, sexo, raca, porte, idade, cidade, castrado, foto) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $nome, $sexo, $raca, $porte, $idade, $cidade, $castrado, $caminho_foto);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Cão cadastrado com sucesso!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao cadastrar: " . $stmt->error]);
    }
    
    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Método não permitido"]);
}

$conn->close();
?>