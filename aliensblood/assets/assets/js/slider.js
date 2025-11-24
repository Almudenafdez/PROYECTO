document.addEventListener('DOMContentLoaded', () => {
    const sliderContainer = document.getElementById('slider');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');

    let designers = [];
    let currentIndex = 0;
    let autoSlideInterval;

    // Función para renderizar el diseñador actual
    function showDesigner(index) {
        const designer = designers[index];
        sliderContainer.innerHTML = `
            <div class="designer-card">
                <img src="assets/img/${designer.image}" alt="${designer.name}">
                <h3>${designer.name}</h3>
                <p>${designer.bio}</p>
            </div>
        `;
    }

    // Función para iniciar el slider automático
    function startAutoSlide() {
        autoSlideInterval = setInterval(() => {
            currentIndex = (currentIndex + 1) % designers.length;
            showDesigner(currentIndex);
        }, 4000); // Cambiar cada 4 segundos
    }

    // Función para detener el slider automático
    function stopAutoSlide() {
        clearInterval(autoSlideInterval);
    }

    // Botones manuales
    prevBtn.addEventListener('click', () => {
        stopAutoSlide();
        currentIndex = (currentIndex - 1 + designers.length) % designers.length;
        showDesigner(currentIndex);
        startAutoSlide();
    });

    nextBtn.addEventListener('click', () => {
        stopAutoSlide();
        currentIndex = (currentIndex + 1) % designers.length;
        showDesigner(currentIndex);
        startAutoSlide();
    });

    // Cargar datos desde la base de datos
    async function fetchDesigners() {
        try {
            const res = await fetch('get_designers.php');
            designers = await res.json();

            if (designers.length > 0) {
                showDesigner(currentIndex);
                startAutoSlide();
            } else {
                sliderContainer.innerHTML = "<p>No hay diseñadores registrados.</p>";
            }
        } catch (err) {
            sliderContainer.innerHTML = `<p>Error al cargar diseñadores: ${err.message}</p>`;
        }
    }

    fetchDesigners();
});
