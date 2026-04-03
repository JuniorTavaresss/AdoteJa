document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('loginForm');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const email = document.getElementById('email').value.trim();
        const senha = document.getElementById('password').value.trim();

        if (email === "" || senha === "") {
            alert("Preencha e-mail e senha.");
            return;
        }

        localStorage.setItem("usuarioLogado", email);
        window.location.href = "../index.html";
    });
});