const burgerBtn = document.getElementById("burgerBtn");
const menuContainer = document.getElementById("menuContainer");

if (burgerBtn && menuContainer) {
  burgerBtn.addEventListener("click", function () {
    this.classList.toggle("active");
    menuContainer.classList.toggle("active");
  });
}
