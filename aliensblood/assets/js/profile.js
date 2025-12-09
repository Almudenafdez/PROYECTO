//alterna la clase
document.getElementById('uploadBtn').addEventListener('click', function() {
    const form = document.getElementById('uploadForm');
    form.classList.toggle('hidden');
  });
  
  //NUEVA CONTRASEÑA PARA USUARIO
  document.getElementById('editForm').addEventListener('submit', function(e) {
    const password = document.querySelector('input[name="new_password"]').value;
    if (password && password.length < 6) {
      e.preventDefault();
      alert('La nueva contraseña debe tener al menos 6 caracteres.');
    }
  });