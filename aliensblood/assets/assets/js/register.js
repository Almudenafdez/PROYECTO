const passwordInput = document.getElementById("password");
const strengthFill = document.getElementById("strength-fill");
const strengthText = document.getElementById("strength-text");

const rules = {
  lengthRule: password => password.length >= 8,
  uppercaseRule: password => /[A-Z]/.test(password),
  lowercaseRule: password => /[a-z]/.test(password),
  numberRule: password => /\d/.test(password),
  specialCharRule: password => /[\W_]/.test(password)
};

passwordInput.addEventListener("input", () => {
  document.getElementById("registerForm").addEventListener("submit", function (e) {
  const password = passwordInput.value;
  let allValid = true;

  // Verificar si todos los criterios se cumplen
  Object.entries(rules).forEach(([id, test]) => {
    if (!test(password)) {
      allValid = false;
    }
  });

  // Si no cumple, prevenir el envío y mostrar mensaje
  if (!allValid) {
    e.preventDefault();
    strengthText.textContent = "Por favor, cumple todos los requisitos de contraseña ❌";
    strengthText.className = "weak-text";
    strengthFill.style.backgroundColor = "red";
  }
});

  const password = passwordInput.value;
  let strength = 0;

  // Validar criterios
  Object.entries(rules).forEach(([id, test]) => {
    const item = document.getElementById(id);
    if (test(password)) {
      item.classList.add("valid");
      strength++;
    } else {
      item.classList.remove("valid");
    }
  });

  // Barra visual de fuerza
  const percent = (strength / Object.keys(rules).length) * 100;
  strengthFill.style.width = percent + "%";

  if (strength <= 2) {
    strengthFill.style.backgroundColor = "red";
    strengthText.textContent = "Contraseña débil ❌";
    strengthText.className = "weak-text";
  } else if (strength === 3 || strength === 4) {
    strengthFill.style.backgroundColor = "#f9c74f";
    strengthText.textContent = "Contraseña media ⚠️";
    strengthText.className = "medium-text";
  } else {
    strengthFill.style.backgroundColor = "#7aff7a";
    strengthText.textContent = "Contraseña fuerte ✅";
    strengthText.className = "strong-text";
  }
});
