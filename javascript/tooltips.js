/**
 * Script para adicionar Tooltips automaticamente em elementos HTML
 * Uso: Adicione <script src="add-tooltips.js"></script> no final do seu HTML
 * 
 * O script detecta automaticamente elementos interativos e adiciona tooltips
 * com mensagens personalizadas baseadas em seletores CSS.
 */

(function() {
    // CSS para os tooltips
    const tooltipCSS = `
        /* Estilos para Tooltips Personalizados */
        .tooltip-container {
            position: relative;
            display: inline-block;
        }

        .tooltip-text {
            visibility: hidden;
            width: 200px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 8px 12px;
            position: absolute;
            z-index: 1000;
            bottom: 125%;
            left: 50%;
            margin-left: -100px;
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 12px;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            white-space: normal;
            line-height: 1.4;
        }

        .tooltip-text::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #333 transparent transparent transparent;
        }

        .tooltip-container:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        /* Para tooltips em elementos do menu lateral */
        .sidebar .item {
            position: relative;
        }

        .sidebar .item .tooltip-text {
            bottom: auto;
            top: 50%;
            left: 110%;
            margin-left: 0;
            transform: translateY(-50%);
            width: 150px;
        }

        .sidebar .item .tooltip-text::after {
            top: 50%;
            left: auto;
            right: 100%;
            margin-left: 0;
            margin-top: -5px;
            border-color: transparent #333 transparent transparent;
        }

        .sidebar .item:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        /* Para tooltips em botões */
        .btn, .btn-outline {
            position: relative;
        }

        /* Para tooltips nas estatísticas */
        .stats div {
            position: relative;
            cursor: help;
        }

        .stats div .tooltip-text {
            width: 180px;
            bottom: 120%;
        }
    `;

    // Mapeamento de seletores para mensagens de tooltip
    const tooltipMap = {
        '.logo': 'Voltar para a página inicial',
        'nav.menu ul li a[href="#"]': 'Ir para o início da página',
        'nav.menu ul li a[href="html/adocao.html"]': 'Veja os animais disponíveis para adoção',
        'nav.menu ul li a[href="html/denuncia.html"]': 'Relate casos de maus-tratos ou abandono',
        'a.btn-login': 'Acesse sua conta ou cadastre-se',
        'a.btn[href="html/adocao.html"]': 'Clique para encontrar seu novo melhor amigo',
        'a.btn-outline[href="html/denuncia.html"]': 'Denuncie maus-tratos de forma segura',
        '#menuTrigger': 'Clique para abrir o menu de opções',
        '.sidebar .item[onclick*="adocao.html"]': 'Ver pets para adoção',
        '.sidebar .item[onclick*="Apoiar.html"]': 'Saiba como ajudar nossas causas',
        '.sidebar .item[onclick*="Feiras.html"]': 'Confira as próximas feiras de adoção',
        '.sidebar .item[onclick*="Perdipet.html"]': 'Encontrou ou perdeu um pet? Clique aqui',
        '.sidebar .item[onclick*="denuncia.html"]': 'Fazer uma denúncia de maus-tratos',
        '.sidebar .item[onclick*="Telalogin.html"]': 'Entrar na sua conta',
    };

    /**
     * Função para adicionar um tooltip a um elemento
     * @param {Element} element - O elemento HTML
     * @param {string} message - A mensagem do tooltip
     */
    function addTooltip(element, message) {
        // Verifica se já possui tooltip
        if (element.classList.contains('tooltip-container') || element.querySelector('.tooltip-text')) {
            return;
        }

        // Adiciona a classe ao elemento
        element.classList.add('tooltip-container');

        // Cria o span do tooltip
        const tooltipSpan = document.createElement('span');
        tooltipSpan.className = 'tooltip-text';
        tooltipSpan.textContent = message;

        // Adiciona o tooltip ao elemento
        element.appendChild(tooltipSpan);
    }

    /**
     * Função para adicionar tooltips nas estatísticas
     */
    function addStatsTooltips() {
        const statsMessages = [
            'Total de animais que encontraram um lar',
            'Animais resgatados das ruas',
            'Atendimentos realizados pela nossa rede'
        ];

        const statsDivs = document.querySelectorAll('.stats div');
        statsDivs.forEach((div, index) => {
            if (statsMessages[index]) {
                addTooltip(div, statsMessages[index]);
            }
        });
    }

    /**
     * Função principal para inicializar todos os tooltips
     */
    function initTooltips() {
        // Injeta o CSS no head
        const style = document.createElement('style');
        style.textContent = tooltipCSS;
        document.head.appendChild(style);

        // Adiciona tooltips baseado no mapa de seletores
        Object.entries(tooltipMap).forEach(([selector, message]) => {
            try {
                const elements = document.querySelectorAll(selector);
                elements.forEach(element => {
                    addTooltip(element, message);
                });
            } catch (e) {
                console.warn(`Seletor inválido: ${selector}`, e);
            }
        });

        // Adiciona tooltips nas estatísticas
        addStatsTooltips();

        console.log('✅ Tooltips adicionados com sucesso!');
    }

    // Executa quando o DOM estiver completamente carregado
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTooltips);
    } else {
        initTooltips();
    }
})();