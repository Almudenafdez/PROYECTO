document.addEventListener("DOMContentLoaded", () => {
    const themeSelect = document.getElementById("theme-select");
    const body = document.body;

    // Cargar tema guardado
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme) {
        body.classList.remove("dark-mode", "light-mode", "blue-mode", "green-mode");
        body.classList.add(savedTheme);
        if (themeSelect) themeSelect.value = savedTheme;
    }

    // Escuchar cambios en el select
    if (themeSelect) {
        themeSelect.addEventListener("change", (e) => {
            const selectedTheme = e.target.value;
            body.classList.remove("dark-mode", "light-mode", "blue-mode", "green-mode");
            body.classList.add(selectedTheme);
            localStorage.setItem("theme", selectedTheme);
        });
    }
});
 