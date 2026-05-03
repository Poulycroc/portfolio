const burgerBtn = document.getElementById("burgerBtn");
const menuContainer = document.getElementById("menuContainer");

if (burgerBtn && menuContainer) {
  burgerBtn.addEventListener("click", function () {
    this.classList.toggle("active");
    menuContainer.classList.toggle("active");
    document.body.style.overflow = menuContainer.classList.contains("active") ? "hidden" : "";
  });

  menuContainer.querySelectorAll(".menu-link").forEach((link) => {
    link.addEventListener("click", (e) => {
      const href = link.getAttribute("href");
      const hash = href.includes("#") ? "#" + href.split("#")[1] : null;
      const target = hash ? document.querySelector(hash) : null;

      if (target) {
        e.preventDefault();
        burgerBtn.classList.remove("active");
        menuContainer.classList.remove("active");
        document.body.style.overflow = "";

        // Wait for menu close transition, then scroll
        setTimeout(() => {
          target.scrollIntoView({ behavior: "smooth" });
        }, 350);
      } else {
        burgerBtn.classList.remove("active");
        menuContainer.classList.remove("active");
        document.body.style.overflow = "";
      }
    });
  });
}
