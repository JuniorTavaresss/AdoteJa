<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetImagens - Pets para Adoção</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .btn-cadastro {
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            margin-bottom: 20px;
        }
        .btn-cadastro:hover {
            background-color: #218838;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 1000;
        }
        .modal-content {
            background: white;
            margin: 5% auto;
            padding: 25px;
            width: 90%;
            max-width: 500px;
            border-radius: 12px;
        }
        .close {
            float: right;
            font-size: 28px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>🐾 Pets para Adoção</h1>
    
    <!-- Botão de Cadastro -->
    <button class="btn-cadastro" onclick="abrirModalCadastro()">+ Cadastrar Novo Pet</button>

    <!-- Filtros -->
    <div class="filtros">
        <form id="formFiltro">
            <select name="especie" id="especie">
                <option value="">Todas as espécies</option>
                <option value="cachorro">Cachorro</option>
                <option value="gato">Gato</option>
            </select>

            <input type="text" id="raca" placeholder="Raça...">
            <input type="text" id="busca" placeholder="Buscar por nome...">

            <button type="submit">Filtrar</button>
            <button type="button" id="limpar">Limpar Filtros</button>
        </form>
    </div>

    <!-- Grade de Pets -->
    <div id="gridPets" class="grid-pets"></div>

    <!-- Paginação -->
    <div class="paginacao">
        <button id="btnAnterior">← Anterior</button>
        <span id="infoPagina">Página 1 de 1</span>
        <button id="btnProxima">Próxima →</button>
    </div>
</div>

<!-- Modal de Cadastro -->
<div id="modalCadastro" class="modal">
    <div class="modal-content">
        <span class="close" onclick="fecharModalCadastro()">&times;</span>
        <h2>Cadastrar Novo Pet</h2>
        
        <form id="formCadastro" enctype="multipart/form-data">
            <label>Nome do Pet:</label>
            <input type="text" name="nome" required>

            <label>Espécie:</label>
            <select name="especie" required>
                <option value="">Selecione</option>
                <option value="cachorro">Cachorro</option>
                <option value="gato">Gato</option>
            </select>

            <label>Raça:</label>
            <input type="text" name="raca">

            <label>Idade (em anos):</label>
            <input type="number" name="idade" min="0" max="20" required>

            <label>Foto do Pet:</label>
            <input type="file" name="imagem" accept="image/*" required>

            <button type="submit">Cadastrar Pet</button>
        </form>
    </div>
</div>

<script src="assets/js/script.js"></script>
</body>
</html>
