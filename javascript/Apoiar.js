// BANCO DE DADOS DAS ONGS DE CRICIÚMA
const ongsCriciuma = [
    { nome: "SOS Vira-Lata", pix: "11825120000144" },
    { nome: "ONG Animal.com", pix: "31339925000195" },
    { nome: "Grupo Unidos Pelos Animais", pix: "48999644565" },
    { nome: "Amigo Bicho (Içara/Criciúma)", pix: "22941257000180" }
];

// Função para carregar as ONGs no select assim que a página carregar
window.onload = function() {
    const select = document.getElementById('ongSelect');
    
    ongsCriciuma.forEach(ong => {
        const option = document.createElement('option');
        option.value = ong.pix;
        option.text = ong.nome;
        option.setAttribute('data-nome', ong.nome);
        select.appendChild(option);
    });
};

// Função para atualizar as informações do PIX ao selecionar uma ONG
function updatePixInfo() {
    const select = document.getElementById('ongSelect');
    const pixBox = document.getElementById('pixBox');
    const ongNomeDisplay = document.getElementById('ongNomeDisplay');
    const pixKeyDisplay = document.getElementById('pixKeyDisplay');
    
    if (select.value) {
        const selectedOption = select.options[select.selectedIndex];
        ongNomeDisplay.innerText = selectedOption.getAttribute('data-nome');
        pixKeyDisplay.innerText = select.value;
        pixBox.style.display = 'block';
    } else {
        pixBox.style.display = 'none';
    }
}

// Função para copiar a chave PIX para a área de transferência
function copyPix() {
    const pixKey = document.getElementById('pixKeyDisplay').innerText;
    navigator.clipboard.writeText(pixKey).then(() => {
        const tooltip = document.getElementById("myTooltip");
        tooltip.innerHTML = "Copiado!";
        setTimeout(() => {
            tooltip.innerHTML = "Copiar para área de transferência";
        }, 2000);
    });
}