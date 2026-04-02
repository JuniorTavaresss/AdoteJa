/**
 * script.js - Interatividade para o projeto AdoteJá
 */

document.addEventListener('DOMContentLoaded', () => {
    const menuTrigger = document.getElementById('menuTrigger');
    const sidebar = document.getElementById('sidebar');
    const menuItems = document.querySelectorAll('.sidebar .item');

    // 1. Abrir/Fechar Menu ao Clicar no Ícone ☰
    menuTrigger.addEventListener('click', (e) => {
        e.stopPropagation(); // Evita que o clique feche o menu imediatamente
        sidebar.classList.toggle('active');
        
        // Muda o ícone ou cor quando aberto
        if (sidebar.classList.contains('active')) {
            menuTrigger.innerHTML = '✕'; // Muda para um X
            menuTrigger.style.backgroundColor = '#ff6600';
            menuTrigger.style.color = 'white';
        } else {
            menuTrigger.innerHTML = '☰';
            menuTrigger.style.backgroundColor = 'white';
            menuTrigger.style.color = '#003d7a';
        }
    });

    // 2. Fechar o menu ao clicar em qualquer lugar fora dele
    document.addEventListener('click', (e) => {
        if (sidebar.classList.contains('active') && !sidebar.contains(e.target) && e.target !== menuTrigger) {
            sidebar.classList.remove('active');
            menuTrigger.innerHTML = '☰';
            menuTrigger.style.backgroundColor = 'white';
            menuTrigger.style.color = '#003d7a';
        }
    });

    // 3. Feedback Visual ao Clicar nos Itens do Menu
    menuItems.forEach(item => {
        item.addEventListener('click', () => {
            // Pequena animação de "pulso" ao clicar
            item.style.transform = 'scale(0.8)';
            setTimeout(() => {
                item.style.transform = 'scale(1.1)';
            }, 100);
            
            console.log("Item clicado: " + item.querySelector('p').innerText);
        });
    });
});