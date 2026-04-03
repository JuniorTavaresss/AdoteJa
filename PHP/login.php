<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const email = document.getElementById('email').value;
    const senha = document.getElementById('password').value;

    fetch('../php/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `email=${email}&senha=${senha}`
    })
    .then(res => res.text())
    .then(data => {
        if (data === "sucesso") {
            localStorage.setItem("usuarioLogado", email);
            window.location.href = "../index.html";
        } else {
            alert("Email ou senha inválidos");
        }
    });
});
</script>