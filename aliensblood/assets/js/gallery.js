document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("image-modal");
    const modalImg = document.getElementById("modal-image");
    const modalCaption = document.getElementById("modal-caption");
    const closeBtn = document.querySelector(".close");
    const images = document.querySelectorAll(".thumbnail");
    let currentIndex = -1;

    function updateModal(index) {
        const img = images[index];
        modalImg.src = img.dataset.full;
        modalImg.alt = img.dataset.title;
        modalCaption.innerHTML = `<strong>${img.dataset.title}</strong><br><em>por ${img.dataset.author}</em>`;
        currentIndex = index;
    }

    images.forEach((img, index) => {
        img.addEventListener("click", () => {
            updateModal(index);
            modal.style.display = "flex";
        });
    });

    closeBtn.addEventListener("click", () => {
        modal.style.display = "none";
        modalImg.src = ""; // Limpiar imagen
    });

    document.getElementById("prev-btn").addEventListener("click", () => {
        if (currentIndex > 0) updateModal(currentIndex - 1);
    });

    document.getElementById("next-btn").addEventListener("click", () => {
        if (currentIndex < images.length - 1) updateModal(currentIndex + 1);
    });

    // Cerrar haciendo clic fuera
    window.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
            modalImg.src = "";
        }
    });
});
