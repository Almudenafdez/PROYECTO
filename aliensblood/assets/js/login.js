document.getElementById('loginForm').addEventListener('submit', function(e) {
  const username = document.querySelector('input[name="username"]').value.trim();
  const password = document.querySelector('input[name="password"]').value.trim();

  if (!username || !password) {
    e.preventDefault();
    alert('Por favor, completa todos los campos.');
  }
});

//OJO