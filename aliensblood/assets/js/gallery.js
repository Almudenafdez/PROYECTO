document.addEventListener("DOMContentLoaded", () => {
  const thumbnails = Array.from(document.querySelectorAll(".thumbnail"));
  const modal = document.getElementById("image-modal");
  const modalContent = document.querySelector(".modal-content-wrapper") || document.querySelector(".cyber-modal") || null;
  const modalImg = document.getElementById("modal-image");
  const modalCaption = document.getElementById("modal-caption");
  const closeBtn = document.querySelector(".close");
  const prevBtn = document.getElementById("prev-btn");
  const nextBtn = document.getElementById("next-btn");

  if (!modal || !modalImg || thumbnails.length === 0) return; // seguridad

  let currentIndex = -1;

  // Construir array de imágenes desde atributos data-*
  const images = thumbnails.map(t => ({
    src: t.dataset.full || t.src,
    title: t.dataset.title || t.alt || "",
    author: t.dataset.author || ""
  }));

  function updateModal(index) {
    if (index < 0 || index >= images.length) return;
    currentIndex = index;
    const item = images[currentIndex];

    // cargar imagen y texto
    modalImg.src = item.src;
    modalImg.alt = item.title || "Imagen";
    modalCaption.innerHTML = `<strong>${escapeHtml(item.title)}</strong><br><em>por ${escapeHtml(item.author)}</em>`;

  }

  function openModal(index) {
    updateModal(index);
    modal.classList.add("active");
    closeBtn?.focus?.();
    document.body.style.overflow = "hidden"; // evitar scroll de fondo
  }

  function closeModal() {
    modal.classList.remove("active");
    // limpiar imagen (libera memoria)
    modalImg.src = "";
    modalImg.alt = "";
    modalCaption.innerHTML = "";
    currentIndex = -1;
    document.body.style.overflow = ""; // restaurar scroll
  }

  // Escapar HTML para evitar XSS si vienen datos poco fiables (no se si es recomendable)
  function escapeHtml(str) {
    if (!str) return "";
    return str.replace(/[&<>"'`]/g, (s) => {
      return {
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
        '"': "&quot;",
        "'": "&#39;",
        "`": "&#96;"
      }[s];
    });
  }

  // Asignar clic a miniaturas
  thumbnails.forEach((thumb, i) => {
    thumb.addEventListener("click", (e) => {
      e.preventDefault();
      openModal(i);
    });
    // soporte keyboard (Enter) sobre miniaturas
    thumb.addEventListener("keydown", (e) => {
      if (e.key === "Enter" || e.key === " ") {
        e.preventDefault();
        openModal(i);
      }
    });
  });

  // Botones prev/next con wrap-around
  prevBtn?.addEventListener("click", () => {
    if (images.length === 0) return;
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    updateModal(currentIndex);
  });

  nextBtn?.addEventListener("click", () => {
    if (images.length === 0) return;
    currentIndex = (currentIndex + 1) % images.length;
    updateModal(currentIndex);
  });

  // Cerrar con botón
  closeBtn?.addEventListener("click", () => {
    closeModal();
  });

  // Cerrar clicando fuera del contenido 
  modal.addEventListener("click", (e) => {
    // si hay un wrapper específico, comprueba que el click no vino dentro de él
    if (modalContent) {
      if (!modalContent.contains(e.target)) closeModal();
    } else {
      // si no hay wrapper conocido, usar el comportamiento clásico
      if (e.target === modal) closeModal();
    }
  });

  // Teclas: ESC, flechas
  document.addEventListener("keydown", (e) => {
    if (!modal.classList.contains("active")) return;

    if (e.key === "Escape") {
      e.preventDefault();
      closeModal();
      return;
    }
    if (e.key === "ArrowRight") {
      e.preventDefault();
      currentIndex = (currentIndex + 1) % images.length;
      updateModal(currentIndex);
      return;
    }
    if (e.key === "ArrowLeft") {
      e.preventDefault();
      currentIndex = (currentIndex - 1 + images.length) % images.length;
      updateModal(currentIndex);
      return;
    }
  });

  // Evitar que el modal abierto deje atrás capas interceptando clicks en algunos navegadores:
  // Nos aseguramos de usar la clase "active" en vez de manipular display directamente.
  let touchStartX = 0;
  let touchEndX = 0;

  modalImg.addEventListener("touchstart", (e) => {
    touchStartX = e.changedTouches[0].screenX;
  });

  modalImg.addEventListener("touchend", (e) => {
    touchEndX = e.changedTouches[0].screenX;
    const dx = touchEndX - touchStartX;
    const threshold = 40; // px mínimo para considerar swipe
    if (dx > threshold) {
      // swipe right -> prev
      currentIndex = (currentIndex - 1 + images.length) % images.length;
      updateModal(currentIndex);
    } else if (dx < -threshold) {
      // swipe left -> next
      currentIndex = (currentIndex + 1) % images.length;
      updateModal(currentIndex);
    }
  });
});
