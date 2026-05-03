document.getElementById('formCadastrarCao').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    // Criar FormData para enviar arquivos
    const formData = new FormData(this);
    
    // Mostrar loading
    const botao = document.querySelector('button[type="submit"]');
    const textoOriginal = botao.textContent;
    botao.textContent = 'Cadastrando...';
    botao.disabled = true;
    
    try {
        const response = await fetch('../php/salvar_cao.php', {
            method: 'POST',
            body: formData
        });
        
        const resultado = await response.json();
        
        if (resultado.success) {
            alert(resultado.message);
            // Limpar formulário
            document.getElementById('formCadastrarCao').reset();
            
            // Opcional: redirecionar após 2 segundos
            setTimeout(() => {
                window.location.href = '../Index.html';
            }, 2000);
        } else {
            alert('Erro: ' + resultado.message);
        }
    } catch (error) {
        console.error('Erro:', error);
        alert('Erro ao conectar com o servidor');
    } finally {
        botao.textContent = textoOriginal;
        botao.disabled = false;
    }
});

// Preview da imagem (opcional, mas legal)
document.getElementById('foto').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Verificar se já existe uma preview
            let preview = document.querySelector('.preview-imagem');
            if (!preview) {
                preview = document.createElement('div');
                preview.className = 'preview-imagem';
                document.querySelector('.formulario').insertBefore(preview, document.querySelector('button'));
            }
            preview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width: 200px; margin: 10px 0;">`;
        };
        reader.readAsDataURL(file);
    }
});