// Lista padrão usada apenas como fallback caso o backend não responda
let pets = [
    {
        nome: 'Marley',
        sexo: 'Macho',
        idade: '1 ano',
        tamanho: 'Médio',
        cidade: 'Araranguá - SC',
        raca: 'Vira-lata',
        castrado: 'Sim',
        imagem: 'https://images.unsplash.com/photo-1558788353-f76d92427f16'
    },
    {
        nome: 'Thor',
        sexo: 'Macho',
        idade: '3 anos',
        tamanho: 'Grande',
        cidade: 'Criciúma - SC',
        raca: 'Labrador',
        castrado: 'Sim',
        imagem: 'https://images.unsplash.com/photo-1518717758536-85ae29035b6d'
    },
    {
        nome: 'Kiara',
        sexo: 'Fêmea',
        idade: '2 anos',
        tamanho: 'Pequeno',
        cidade: 'Florianópolis - SC',
        raca: 'Vira-lata',
        castrado: 'Não',
        imagem: 'https://images.unsplash.com/photo-1583511655857-d19b40a7a54e'
    }
];

function normalizarSexo(sexo) {
    if (sexo === 'Femea') return 'Fêmea';
    return sexo;
}

// Função para mostrar o modal personalizado
function showAdoptionModal(nomePet) {
    const modal = document.createElement('div');
    modal.className = 'custom-modal';

    modal.innerHTML = `
        <div class="modal-content">
            <div class="dog-icon">🐕</div>
            <h3>🐾 Adoção Solicitada!</h3>
            <p>Obrigado por se interessar em adotar o(a) <strong>${nomePet}</strong>!</p>
            <p>Um de nossos voluntários entrará em contato em breve para dar continuidade ao processo de adoção.</p>
            <button onclick="closeModal(this)">Fechar</button>
        </div>
    `;

    document.body.appendChild(modal);
    document.body.style.overflow = 'hidden';
}

function closeModal(button) {
    const modal = button.closest('.custom-modal');
    if (modal) {
        modal.remove();
        document.body.style.overflow = 'auto';
    }
}

function renderizarPets(petsFiltrados) {
    const grid = document.getElementById('gridPets');

    if (petsFiltrados.length === 0) {
        grid.innerHTML = `
            <div class="sem-resultados">
                <div class="icone">🐕‍🦺</div>
                <p>Nenhum pet encontrado com os filtros selecionados.</p>
                <p style="font-size: 0.9rem;">Tente ajustar os filtros para encontrar mais resultados!</p>
            </div>
        `;
        return;
    }

    grid.innerHTML = petsFiltrados.map(pet => `
        <div class="card">
            <span class="badge">Disponível</span>
            <span class="favorito">❤️</span>
            <img src="${pet.imagem}" alt="${pet.nome}">
            <div class="info">
                <h3>${pet.nome}</h3>
                <div class="dados">
                    <p>🐶 ${normalizarSexo(pet.sexo)}</p>
                    <p>🎂 ${pet.idade}</p>
                    <p>📏 ${pet.tamanho}</p>
                    <p>📍 ${pet.cidade}</p>
                </div>
                <button class="btn-adotar" onclick="adotar('${pet.nome}')">Adotar</button>
            </div>
        </div>
    `).join('');
}

function filtrarPets() {
    const tamanho = document.getElementById('filtroTamanho').value;
    const raca = document.getElementById('filtroRaca').value;
    const castrado = document.getElementById('filtroCastrado').value;
    const cidade = document.getElementById('filtroCidade').value;

    const petsFiltrados = pets.filter(pet => {
        let match = true;

        if (tamanho && pet.tamanho !== tamanho) match = false;
        if (raca && pet.raca !== raca) match = false;
        if (castrado && pet.castrado !== castrado) match = false;
        if (cidade && pet.cidade !== cidade) match = false;

        return match;
    });

    renderizarPets(petsFiltrados);
}

function limparFiltros() {
    document.getElementById('filtroTamanho').value = '';
    document.getElementById('filtroRaca').value = '';
    document.getElementById('filtroCastrado').value = '';
    document.getElementById('filtroCidade').value = '';

    renderizarPets(pets);
}

function adotar(nomePet) {
    showAdoptionModal(nomePet);
}

async function carregarPetsDoBanco() {
    try {
        const response = await fetch('../php/listar_caes.php');
        const resultado = await response.json();

        if (resultado.success && Array.isArray(resultado.pets)) {
            pets = resultado.pets;
        }
    } catch (error) {
        console.error('Não foi possível carregar pets do banco. Usando lista padrão.', error);
    }

    renderizarPets(pets);
}

// Event listeners quando a página carregar
document.addEventListener('DOMContentLoaded', () => {
    carregarPetsDoBanco();

    const btnFiltrar = document.getElementById('btnFiltrar');
    if (btnFiltrar) btnFiltrar.addEventListener('click', filtrarPets);

    const btnLimpar = document.getElementById('btnLimparFiltros');
    if (btnLimpar) btnLimpar.addEventListener('click', limparFiltros);

    const selects = document.querySelectorAll('.filtro-box select');
    selects.forEach(select => {
        select.addEventListener('change', filtrarPets);
    });
});