document.addEventListener("DOMContentLoaded", () => {
    const toggleButton = document.getElementById("toggle-theme");
    const html = document.documentElement;

    toggleButton.addEventListener("click", () => {
        const currentTheme = html.getAttribute("data-theme");
        const newTheme = currentTheme === "dark" ? "light" : "dark";
        html.setAttribute("data-theme", newTheme);
        localStorage.setItem("theme", newTheme);
    });

    // Aplicar tema guardado al cargar
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme) {
        html.setAttribute("data-theme", savedTheme);
    }
});
