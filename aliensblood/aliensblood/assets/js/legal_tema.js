document.addEventListener("DOMContentLoaded", () => {
    const toggleBtn = document.getElementById("theme-toggle");
    const body = document.body;

    // Load saved preference
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme) {
        body.classList.remove("dark-mode", "light-mode");
        body.classList.add(savedTheme);
    }

    toggleBtn.addEventListener("click", () => {
        if (body.classList.contains("dark-mode")) {
            body.classList.remove("dark-mode");
            body.classList.add("light-mode");
            localStorage.setItem("theme", "light-mode");
        } else {
            body.classList.remove("light-mode");
            body.classList.add("dark-mode");
            localStorage.setItem("theme", "dark-mode");
        }
    });
});
