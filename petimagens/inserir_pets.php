<?php
// inserir_pets.php - Coloque na raiz: C:\xampp\htdocs\petimagens\inserir_pets.php

require_once 'config/conexao.php';

echo "<h2>Inserindo 12 pets automaticamente...</h2>";
echo "<hr>";

$pasta = 'uploads/pets/';

for ($i = 1; $i <= 12; $i++) {
    $nomeArquivo = "pet- ($i).jpg";           // Nome exato que você criou
    $caminhoImagem = $pasta . $nomeArquivo;

    if (file_exists($caminhoImagem)) {
        
        $nomePet   = "Pet " . $i;
        $especie   = ($i % 2 === 0) ? 'cachorro' : 'gato';
        $raca      = ($i % 3 === 0) ? 'Vira-lata' : 'Sem raça definida';
        $idade     = rand(1, 10);

        $sql = "INSERT INTO pets (nome, especie, raca, idade, imagem, status, cadastrado_em) 
                VALUES (:nome, :especie, :raca, :idade, :imagem, 'disponivel', NOW())";

        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([
                ':nome'     => $nomePet,
                ':especie'  => $especie,
                ':raca'     => $raca,
                ':idade'    => $idade,
                ':imagem'   => $caminhoImagem
            ]);

            echo "Sucesso: <strong>$nomePet</strong> → $nomeArquivo <br>";
        } catch (Exception $e) {
            echo "Erro ao inserir Pet $i: " . $e->getMessage() . "<br>";
        }

    } else {
        echo "Arquivo não encontrado: <strong>$nomeArquivo</strong><br>";
    }
}

echo "<hr>";
echo "<h3>Processo finalizado!</h3>";
echo "<p><a href='index.php' style='font-size:18px;'>→ Ir para a página principal (index.php)</a></p>";
echo "<p><a href='api/pets.php' style='font-size:18px;' target='_blank'>→ Testar API (ver JSON)</a></p>";
?>
