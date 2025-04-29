// Aceptar las cookies y que aparezcan en ventana
function aceptarCookies() {
    localStorage.setItem('cookiesAceptadas', 'true');
    document.getElementById('cookie-banner').style.display = 'none';
}

window.onload = function () {
    if (!localStorage.getItem('cookiesAceptadas')) {
        document.getElementById('cookie-banner').style.display = 'block';
    }

    mostrarScrollAnimaciones();
};

// Scroll fade-in
function mostrarScrollAnimaciones() {
    const elementos = document.querySelectorAll('.fade-in');
    function mostrarElemento() {
        elementos.forEach(el => {
            const top = el.getBoundingClientRect().top;
            if (top < window.innerHeight - 50) {
                el.classList.add('visible');
            }
        });
    }
    window.addEventListener('scroll', mostrarElemento);
    mostrarElemento();
}

// Validación en formulario de registro
function validarFormulario() {
    const email = document.querySelector('input[name="email"]').value;
    const password = document.querySelector('input[name="password"]').value;

    if (!email.includes('@') || password.length < 6) {
        alert("Por favor ingresa un email válido y una contraseña de al menos 6 caracteres.");
        return false;
    }
    return true;
}

    window.addEventListener('DOMContentLoaded', () => {
        const animated = document.querySelectorAll('.fade-in-up');
        animated.forEach(el => {
            el.classList.add('visible');
        });
    });

    // carrito contador
document.addEventListener('DOMContentLoaded', () => {
    const animatedTitle = document.querySelector('.animated-title');
    if (animatedTitle) {
      animatedTitle.classList.add('visible');
    }
  });
  
