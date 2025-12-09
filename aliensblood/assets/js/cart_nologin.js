/*INDICA SI CARGA EL CARRITO DE COMPRA CON CUENTA LOGUEADA. NO LOGUEADA == VUELTA A CARRITO SIN COMPRA*/
document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById("cyber-btn");

    btn.addEventListener("click", () => {
        window.location.href = "cart.php";
    });
});