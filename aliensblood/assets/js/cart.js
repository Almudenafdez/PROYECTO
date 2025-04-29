//Cuenta para el carrito
document.addEventListener('DOMContentLoaded', () => {
  updateCartCount();

  const addToCartButtons = document.querySelectorAll('.add-to-cart');
  addToCartButtons.forEach(button => {
    button.addEventListener('click', () => {
      const productId = button.dataset.productId;
      fetch(`add_to_cart.php?id=${productId}`)
        .then(response => response.json())
        .then(data => {
          if (data.success) updateCartCount(data.count);
        });
    });
  });
});

function updateCartCount(count = null) {
  const cartCount = document.getElementById('cart-count');

  if (count !== null) {
    cartCount.textContent = count;
  } else {
    fetch('get_cart_count.php')
      .then(response => response.json())
      .then(data => {
        cartCount.textContent = data.count;
      });
  }
}
