import Swiper from "swiper";
import { Navigation, Pagination, Keyboard } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

export function initLightbox() {
  const bentoGrid = document.querySelector(".bento-grid");
  if (!bentoGrid) return;

  const overlay = document.createElement("div");
  overlay.className = "lightbox-overlay";
  overlay.innerHTML = `
    <button class="lightbox-close" aria-label="Close">&times;</button>
    <div class="swiper lightbox-swiper">
      <div class="swiper-wrapper"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-pagination"></div>
    </div>
  `;
  document.body.appendChild(overlay);

  const swiperWrapper = overlay.querySelector(".swiper-wrapper");
  const images = bentoGrid.querySelectorAll(".bento-item img");

  images.forEach((img) => {
    const slide = document.createElement("div");
    slide.className = "swiper-slide";
    slide.innerHTML = `<img src="${img.src}" alt="${img.alt}" />`;
    swiperWrapper.appendChild(slide);
  });

  let swiper = null;

  function open(index) {
    overlay.classList.add("active");
    document.body.style.overflow = "hidden";

    if (!swiper) {
      swiper = new Swiper(".lightbox-swiper", {
        modules: [Navigation, Pagination, Keyboard],
        initialSlide: index,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        keyboard: { enabled: true },
        loop: images.length > 1,
      });
    } else {
      swiper.slideTo(index, 0);
    }
  }

  function close() {
    overlay.classList.remove("active");
    document.body.style.overflow = "";
  }

  images.forEach((img, i) => {
    img.style.cursor = "pointer";
    img.addEventListener("click", () => open(i));
  });

  overlay.querySelector(".lightbox-close").addEventListener("click", close);

  overlay.addEventListener("click", (e) => {
    if (e.target === overlay) close();
  });

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && overlay.classList.contains("active")) close();
  });
}
