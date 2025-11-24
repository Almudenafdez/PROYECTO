document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('imageModal');
  const modalImage = document.getElementById('modalImage');
  const modalTitle = document.getElementById('modalTitle');
  const modalDesigner = document.getElementById('modalDesigner');
  const closeBtn = modal.querySelector('.close-btn');
  const prevBtn = document.getElementById('modalPrevBtn');
  const nextBtn = document.getElementById('modalNextBtn');

  // Contenedor para mostrar botón de confirmar edad en modal
  let confirmAgeBtn;

  modal.style.display = 'none';

  const images = Array.from(document.querySelectorAll('.image-wrapper'));
  let currentIndex = -1;

  // Función para saber si usuario ya confirmó edad para esta imagen
  function isAgeConfirmed(imageId) {
    return sessionStorage.getItem('ageConfirmed_' + imageId) === 'true';
  }

  // Función para marcar que usuario confirmó edad
  function setAgeConfirmed(imageId) {
    sessionStorage.setItem('ageConfirmed_' + imageId, 'true');
  }

  function showModal(index) {
    if (index < 0 || index >= images.length) return;
    currentIndex = index;

    const imgWrapper = images[currentIndex];
    const isNsfw = imgWrapper.dataset.nsfw === '1' || imgWrapper.dataset.nsfw === 'true';
    const imageId = imgWrapper.dataset.id;  // Suponiendo que tienes data-id con el id

    modalTitle.textContent = imgWrapper.dataset.title || '';
    modalDesigner.textContent = imgWrapper.dataset.designer || '';

    // Limpia confirmAgeBtn si existe
    if(confirmAgeBtn) {
      confirmAgeBtn.remove();
      confirmAgeBtn = null;
    }

    if (isNsfw && !isAgeConfirmed(imageId)) {
      // Mostrar imagen censurada (con filtro blur)
      modalImage.src = imgWrapper.dataset.image;
      modalImage.alt = imgWrapper.dataset.title || 'Imagen censurada';
      modalImage.style.filter = 'blur(10px)';
      modalImage.style.pointerEvents = 'none';  // para que no se pueda clicar

      // Añadir botón para confirmar edad
      confirmAgeBtn = document.createElement('button');
      confirmAgeBtn.textContent = 'Confirmar que soy mayor de edad';
      confirmAgeBtn.style.marginTop = '10px';
      confirmAgeBtn.style.padding = '10px 20px';
      confirmAgeBtn.style.backgroundColor = '#ff4081';
      confirmAgeBtn.style.color = 'white';
      confirmAgeBtn.style.border = 'none';
      confirmAgeBtn.style.borderRadius = '5px';
      confirmAgeBtn.style.cursor = 'pointer';
      confirmAgeBtn.style.fontSize = '1rem';

      confirmAgeBtn.addEventListener('click', () => {
        setAgeConfirmed(imageId);
        modalImage.style.filter = 'none';
        modalImage.style.pointerEvents = 'auto';
        confirmAgeBtn.remove();
      });

      modal.querySelector('.modal-content').appendChild(confirmAgeBtn);

    } else {
      // Imagen normal sin censura
      modalImage.src = imgWrapper.dataset.image;
      modalImage.alt = imgWrapper.dataset.title || 'Imagen';
      modalImage.style.filter = 'none';
      modalImage.style.pointerEvents = 'auto';
    }

    modal.style.display = 'flex';
    modal.focus();
  }

  function closeModal() {
    modal.style.display = 'none';
    currentIndex = -1;
    if(confirmAgeBtn) {
      confirmAgeBtn.remove();
      confirmAgeBtn = null;
    }
  }

  images.forEach((imgWrapper, index) => {
    imgWrapper.addEventListener('click', () => {
      showModal(index);
    });
  });

  closeBtn.addEventListener('click', closeModal);

  prevBtn.addEventListener('click', () => {
    if (currentIndex > 0) {
      showModal(currentIndex - 1);
    }
  });

  nextBtn.addEventListener('click', () => {
    if (currentIndex < images.length - 1) {
      showModal(currentIndex + 1);
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modal.style.display === 'flex') {
      closeModal();
    }
  });

  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      closeModal();
    }
  });
});
