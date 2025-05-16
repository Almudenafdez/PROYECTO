document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("image-modal");
    const modalImg = document.getElementById("modal-image");
    const closeBtn = document.querySelector(".close");

    document.querySelectorAll(".thumbnail").forEach(img => {
        img.addEventListener("click", function () {
            modal.style.display = "block";
            modalImg.src = this.dataset.full;
        });
    });

    closeBtn.onclick = function () {
        modal.style.display = "none";
        modalImg.src = "";
    };

    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
            modalImg.src = "";
        }
    };
});
