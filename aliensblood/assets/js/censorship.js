// censorship.js

document.addEventListener("DOMContentLoaded", function () {
  const nsfwWrappers = document.querySelectorAll(".image-wrapper[data-nsfw='1']");

  nsfwWrappers.forEach(wrapper => {
    wrapper.addEventListener("click", () => {
      const confirmAge = confirm("Este contenido es para mayores de 18 años. ¿Deseás continuar?");
      if (confirmAge) {
        nsfwWrappers.forEach(w => {
          w.classList.remove("censored");
          const overlay = w.querySelector(".censor-overlay");
          if (overlay) overlay.remove();
        });
      }
    });
  });
});
