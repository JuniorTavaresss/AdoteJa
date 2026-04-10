document.getElementById('formCadastrarCao').addEventListener('submit', function (e) {
    e.preventDefault();

    const dadosCao = {
        nome: document.getElementById('nome').value,
        raca: document.getElementById('raca').value,
        idade: document.getElementById('idade').value,
        tamanho: document.getElementById('tamanho').value,
        cidade: document.getElementById('cidade').value,
        castrado: document.getElementById('castrado').value,
        descricao: document.getElementById('descricao').value
    };

    console.log(dadosCao);

    alert('Cão cadastrado com sucesso!');

    window.location.href = 'adocao.html';
});