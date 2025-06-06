document.querySelectorAll('.design-actions').forEach(container => {
  const decrementBtn = container.querySelector('button[data-action="decrement"]');
  const incrementBtn = container.querySelector('button[data-action="increment"]');
  const qtyInput = container.querySelector('input.qty-input');
  const hiddenInput = container.querySelector('input[type="hidden"].quantity-hidden-' + qtyInput.dataset.designId);
  const form = container.querySelector('form');

  decrementBtn.addEventListener('click', () => {
    let val = parseInt(qtyInput.value) || 1;
    if (val > 1) qtyInput.value = val - 1;
    if(hiddenInput) hiddenInput.value = qtyInput.value;
  });

  incrementBtn.addEventListener('click', () => {
    let val = parseInt(qtyInput.value) || 1;
    qtyInput.value = val + 1;
    if(hiddenInput) hiddenInput.value = qtyInput.value;
  });

  qtyInput.addEventListener('input', () => {
    let val = parseInt(qtyInput.value);
    if (isNaN(val) || val < 1) qtyInput.value = 1;
    if(hiddenInput) hiddenInput.value = qtyInput.value;
  });

  // Actualiza el hidden input antes de enviar el formulario
  if(form){
    form.addEventListener('submit', e => {
      if(hiddenInput) hiddenInput.value = qtyInput.value;
    });
  }
});
