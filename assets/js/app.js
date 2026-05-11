import "../scss/app.scss";
import { initStarfield } from "./starfield.js";
import { initReveal } from "./reveal.js";
import { initLightbox } from "./lightbox.js";
import "./burgerMenu.js";

initStarfield();
initReveal();
initLightbox();

// Header glossy blur on scroll
const header = document.querySelector("header.main");
if (header) {
  window.addEventListener("scroll", () => {
    header.classList.toggle("scrolled", window.scrollY > 50);
  }, { passive: true });
}
