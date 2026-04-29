import { gsap } from 'gsap'; // needed for registerPlugin
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

const STAR_COLOR = '#e4f0fb';

const LAYERS = [
  { count: 30, size: 0.5, opacity: 0.15, speed: 0.05, blur: true },
  { count: 15, size: 1, opacity: 0.3, speed: 0.15, blur: false },
  { count: 8, size: 1.5, opacity: 0.5, speed: 0.35, blur: false },
];

function generateStars(width, height) {
  return LAYERS.map((layer) => ({
    ...layer,
    stars: Array.from({ length: layer.count }, () => ({
      x: Math.random() * width,
      y: Math.random() * height * 1.5,
    })),
  }));
}

function createCanvas() {
  const canvas = document.createElement('canvas');
  canvas.id = 'starfield';
  canvas.style.cssText =
    'position:fixed;top:0;left:0;width:100%;height:100%;z-index:-1;pointer-events:none;';
  document.body.prepend(canvas);
  return canvas;
}

function resizeCanvas(canvas) {
  const dpr = window.devicePixelRatio || 1;
  canvas.width = window.innerWidth * dpr;
  canvas.height = window.innerHeight * dpr;
  return dpr;
}

function drawStars(ctx, layers, scrollProgress, viewportHeight, dpr) {
  ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);

  const totalScroll = document.documentElement.scrollHeight - viewportHeight;

  ctx.fillStyle = STAR_COLOR;

  for (const layer of layers) {
    ctx.globalAlpha = layer.opacity;
    const yOffset = scrollProgress * layer.speed * totalScroll;

    for (const star of layer.stars) {
      let drawY = (star.y * dpr + yOffset * dpr) % (viewportHeight * dpr);
      if (drawY < 0) drawY += viewportHeight * dpr;

      const drawX = star.x * dpr;
      const radius = layer.size * dpr;

      ctx.beginPath();
      if (layer.blur) {
        ctx.arc(drawX, drawY, radius * 2, 0, Math.PI * 2);
        ctx.globalAlpha = layer.opacity * 0.5;
        ctx.fill();
        ctx.globalAlpha = layer.opacity;
        ctx.beginPath();
      }
      ctx.arc(drawX, drawY, radius, 0, Math.PI * 2);
      ctx.fill();
    }
  }

  ctx.globalAlpha = 1;
}

function initStarfield() {
  if (document.getElementById('starfield')) return;

  const canvas = createCanvas();
  const ctx = canvas.getContext('2d');
  let dpr = resizeCanvas(canvas);
  let layers = generateStars(window.innerWidth, window.innerHeight);
  let lastProgress = -1;
  let scrollProgress = 0;

  // Initial draw
  drawStars(ctx, layers, 0, window.innerHeight, dpr);

  // GSAP ScrollTrigger drives the parallax
  ScrollTrigger.create({
    trigger: document.documentElement,
    start: 'top top',
    end: 'bottom bottom',
    scrub: true,
    onUpdate: (self) => {
      scrollProgress = self.progress;
    },
  });

  // Render loop — only redraws when scroll changed
  function tick() {
    if (scrollProgress !== lastProgress) {
      lastProgress = scrollProgress;
      drawStars(ctx, layers, lastProgress, window.innerHeight, dpr);
    }
    requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);

  // Resize handler (debounced)
  let resizeTimer;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
      dpr = resizeCanvas(canvas);
      layers = generateStars(window.innerWidth, window.innerHeight);
      drawStars(ctx, layers, lastProgress, window.innerHeight, dpr);
    }, 200);
  });
}

export { initStarfield };
