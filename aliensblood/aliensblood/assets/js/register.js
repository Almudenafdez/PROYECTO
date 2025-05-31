document.getElementById('registerForm').addEventListener('submit', function(e) {
    const username = document.getElementById('username').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const message = document.getElementById('formMessage');
  
    if (username.length < 3) {
      e.preventDefault();
      message.textContent = 'El nombre de usuario debe tener al menos 3 caracteres.';
      message.style.color = '#ff4081';
    } else if (!validateEmail(email)) {
      e.preventDefault();
      message.textContent = 'Introduce un correo electrónico válido.';
      message.style.color = '#ff4081';
    } else if (password.length < 6) {
      e.preventDefault();
      message.textContent = 'La contraseña debe tener al menos 6 caracteres.';
      message.style.color = '#ff4081';
    } else {
      message.textContent = 'Enviando...';
      message.style.color = '#00ffaa';
    }
  });
  
  function validateEmail(email) {
    const re = /\S+@\S+\.\S+/;
    return re.test(email);
  }
  