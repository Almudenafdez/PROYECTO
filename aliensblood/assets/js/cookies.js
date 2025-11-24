//COOKIES PARA LAS PÁGINAS

document.addEventListener("DOMContentLoaded", () => {
    const cookieBanner = document.getElementById("cookie-banner");
  
    if (!localStorage.getItem("cookiesAccepted")) {
      cookieBanner.style.display = "block";
    }
  
    document.getElementById("accept-cookies").addEventListener("click", () => {
      localStorage.setItem("cookiesAccepted", true);
      cookieBanner.style.display = "none";
    });
  
    document.getElementById("ignore-cookies").addEventListener("click", () => {
      cookieBanner.style.display = "none";
    });
  });
  