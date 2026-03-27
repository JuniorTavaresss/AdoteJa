// Banco de dados dos pets
const pets = [
    {
        nome: "Marley",
        sexo: "Macho",
        idade: "1 ano",
        tamanho: "Médio",
        cidade: "Araranguá - SC",
        raca: "Vira-lata",
        castrado: "Sim",
        imagem: "https://images.unsplash.com/photo-1558788353-f76d92427f16"
    },
    {
        nome: "Thor",
        sexo: "Macho",
        idade: "3 anos",
        tamanho: "Grande",
        cidade: "Criciúma - SC",
        raca: "Labrador",
        castrado: "Sim",
        imagem: "https://images.unsplash.com/photo-1518717758536-85ae29035b6d"
    },
    {
        nome: "Kiara",
        sexo: "Fêmea",
        idade: "2 anos",
        tamanho: "Pequeno",
        cidade: "Florianópolis - SC",
        raca: "Vira-lata",
        castrado: "Não",
        imagem: "https://images.unsplash.com/photo-1583511655857-d19b40a7a54e"
    },
    {
        nome: "Bob",
        sexo: "Macho",
        idade: "4 anos",
        tamanho: "Médio",
        cidade: "Araranguá - SC",
        raca: "Pitbull",
        castrado: "Sim",
        imagem: "https://images.unsplash.com/photo-1548199973-03cce0bbc87b"
    },
    {
        nome: "Luna",
        sexo: "Fêmea",
        idade: "1 ano",
        tamanho: "Pequeno",
        cidade: "Criciúma - SC",
        raca: "Vira-lata",
        castrado: "Não",
        imagem: "https://images.unsplash.com/photo-1561037404-61cd46aa615b"
    },
    {
        nome: "Max",
        sexo: "Macho",
        idade: "5 anos",
        tamanho: "Grande",
        cidade: "Florianópolis - SC",
        raca: "Labrador",
        castrado: "Sim",
        imagem: "https://images.unsplash.com/photo-1601758123927-196f47c8f0c8"
    },
    {
        nome: "Bella",
        sexo: "Fêmea",
        idade: "2 anos",
        tamanho: "Pequeno",
        cidade: "Araranguá - SC",
        raca: "Vira-lata",
        castrado: "Sim",
        imagem: "https://images.unsplash.com/photo-1592194996308-7b43878e84a6"
    },
    {
        nome: "Rex",
        sexo: "Macho",
        idade: "3 anos",
        tamanho: "Grande",
        cidade: "Criciúma - SC",
        raca: "Pitbull",
        castrado: "Sim",
        imagem: "https://images.unsplash.com/photo-1576201836106-db1758fd1c97"
    },
    {
        nome: "Mel",
        sexo: "Fêmea",
        idade: "1 ano",
        tamanho: "Médio",
        cidade: "Florianópolis - SC",
        raca: "Vira-lata",
        castrado: "Não",
        imagem: "https://images.unsplash.com/photo-1543466835-00a7907e9de1"
    },
    {
        nome: "Toby",
        sexo: "Macho",
        idade: "4 anos",
        tamanho: "Pequeno",
        cidade: "Araranguá - SC",
        raca: "Vira-lata",
        castrado: "Sim",
        imagem: "https://images.unsplash.com/photo-1568572933382-74d440642117"
    }
];

// Função para mostrar o modal personalizado
function showAdoptionModal(nomePet) {
    // Criar o modal
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
    
    // Impedir scroll da página enquanto o modal está aberto
    document.body.style.overflow = 'hidden';
}

// Função para fechar o modal
function closeModal(button) {
    const modal = button.closest('.custom-modal');
    if (modal) {
        modal.remove();
        document.body.style.overflow = 'auto';
    }
}

// Função para renderizar os cards
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
                    <p>🐶 ${pet.sexo}</p>
                    <p>🎂 ${pet.idade}</p>
                    <p>📏 ${pet.tamanho}</p>
                    <p>📍 ${pet.cidade}</p>
                </div>
                <button class="btn-adotar" onclick="adotar('${pet.nome}')">Adotar</button>
            </div>
        </div>
    `).join('');
}

// Função para filtrar os pets
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

// Função para limpar todos os filtros
function limparFiltros() {
    document.getElementById('filtroTamanho').value = '';
    document.getElementById('filtroRaca').value = '';
    document.getElementById('filtroCastrado').value = '';
    document.getElementById('filtroCidade').value = '';
    
    renderizarPets(pets);
}

// Função para quando clicar em adotar
function adotar(nomePet) {
    showAdoptionModal(nomePet);
}

// Event listeners quando a página carregar
document.addEventListener('DOMContentLoaded', () => {
    renderizarPets(pets);
    
    const btnFiltrar = document.getElementById('btnFiltrar');
    if (btnFiltrar) btnFiltrar.addEventListener('click', filtrarPets);
    
    const btnLimpar = document.getElementById('btnLimparFiltros');
    if (btnLimpar) btnLimpar.addEventListener('click', limparFiltros);
    
    const selects = document.querySelectorAll('.filtro-box select');
    selects.forEach(select => {
        select.addEventListener('change', filtrarPets);
    });
});