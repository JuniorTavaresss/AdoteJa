document.getElementById('formCadastrarCao').addEventListener('submit', function (e) {
    e.preventDefault();
alert('eSTOUI AQUI 01!');
 
    const dadosCao = {
        nome: document.getElementById('nome').value,
        raca: document.getElementById('raca').value,
        idade: document.getElementById('idade').value,
        tamanho: document.getElementById('tamanho').value,
        cidade: document.getElementById('cidade').value,
        castrado: document.getElementById('castrado').value,
        descricao: document.getElementById('descricao').value
        
    };
alert('eSTOUI AQUI 02!');
 
    console.log(dadosCao);
alert('eSTOUI AQUI 03!');
 
    alert('Cão cadastrado com sucesso!');
alert('eSTOUI AQUI 04!');
 
    window.location.href = 'adocao.html';
});