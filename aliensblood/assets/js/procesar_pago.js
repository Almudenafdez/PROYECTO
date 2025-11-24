// Formatear el número de tarjeta en tiempo real
new Cleave('#card-number', {
    creditCard: true
});

// Mostrar loader en el botón al enviar el formulario
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('payment-form');
    const btnText = document.querySelector('.btn-text');
    const loader = document.querySelector('.btn-loader');

    form.addEventListener('submit', function () {
        btnText.style.display = 'none';
        loader.style.display = 'inline-block';
    });
});
