let paginaAtual = 1;

async function carregarPets(pagina = 1) {
    paginaAtual = pagina;
    const params = new URLSearchParams({
        pagina: pagina,
        especie: document.getElementById('especie').value,
        raca: document.getElementById('raca').value,
        busca: document.getElementById('busca').value
    });

    try {
        const res = await fetch(`api/pets.php?${params}`);
        const data = await res.json();

        const grid = document.getElementById('gridPets');
        grid.innerHTML = '';

        if (data.pets.length === 0) {
            grid.innerHTML = `<p style="grid-column: span 5; text-align:center; padding:40px;">Nenhum pet encontrado.</p>`;
            return;
        }

        data.pets.forEach(pet => {
            const card = document.createElement('div');
            card.className = 'pet-card';
            card.innerHTML = `
                <img src="${pet.imagem}" alt="${pet.nome}" 
                     onerror="this.src='https://via.placeholder.com/300x180?text=Sem+Foto'">
                <h3>${pet.nome}</h3>
                <p>${pet.especie} • ${pet.raca || '-'} • ${pet.idade} anos</p>
            `;
            card.onclick = () => alert(`Você clicou em: ${pet.nome}`);
            grid.appendChild(card);
        });

        document.getElementById('infoPagina').textContent = 
            `Página ${data.paginaAtual} de ${data.totalPaginas || 1}`;

        document.getElementById('btnAnterior').disabled = data.paginaAtual <= 1;
        document.getElementById('btnProxima').disabled = data.paginaAtual >= data.totalPaginas;

    } catch (error) {
        console.error("Erro:", error);
        document.getElementById('gridPets').innerHTML = `<p style="color:red;">Erro ao carregar pets.</p>`;
    }
}

// Modal de Cadastro
function abrirModalCadastro() {
    document.getElementById('modalCadastro').style.display = 'block';
}

function fecharModalCadastro() {
    document.getElementById('modalCadastro').style.display = 'none';
    document.getElementById('formCadastro').reset();
}

// Envio do formulário de cadastro
document.getElementById('formCadastro').addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    try {
        const res = await fetch('api/cadastrar_pet.php', {
            method: 'POST',
            body: formData
        });

        const data = await res.json();

        if (data.sucesso) {
            alert('Pet cadastrado com sucesso!');
            fecharModalCadastro();
            carregarPets(1);        // Atualiza a grade automaticamente
        } else {
            alert('Erro: ' + data.mensagem);
        }
    } catch (error) {
        alert('Erro ao cadastrar pet.');
        console.error(error);
    }
});

// Eventos dos filtros e paginação
document.getElementById('formFiltro').addEventListener('submit', e => {
    e.preventDefault();
    carregarPets(1);
});

document.getElementById('limpar').addEventListener('click', () => {
    document.getElementById('formFiltro').reset();
    carregarPets(1);
});

document.getElementById('btnAnterior').addEventListener('click', () => {
    if (paginaAtual > 1) carregarPets(paginaAtual - 1);
});

document.getElementById('btnProxima').addEventListener('click', () => {
    carregarPets(paginaAtual + 1);
});

window.onload = () => carregarPets(1);
