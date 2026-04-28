const STAR_COLOR = '#e4f0fb';

const LAYERS = [
  { count: 80, size: 1, opacity: 0.25, speed: 0.05, blur: true },
  { count: 40, size: 2, opacity: 0.5, speed: 0.15, blur: false },
  { count: 20, size: 3, opacity: 0.85, speed: 0.35, blur: false },
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

function drawStars(ctx, layers, scrollProgress, canvasHeight, dpr) {
  ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);

  const scrollHeight = canvasHeight;

  for (const layer of layers) {
    ctx.globalAlpha = layer.opacity;

    for (const star of layer.stars) {
      const yOffset = scrollProgress * layer.speed * scrollHeight;
      let drawY = (star.y * dpr + yOffset * dpr) % (canvasHeight * dpr);
      if (drawY < 0) drawY += canvasHeight * dpr;

      const drawX = star.x * dpr;
      const radius = layer.size * dpr;

      ctx.beginPath();
      if (layer.blur) {
        // Simulate blur: draw a larger, fainter circle
        ctx.arc(drawX, drawY, radius * 2, 0, Math.PI * 2);
        ctx.fillStyle = STAR_COLOR;
        ctx.globalAlpha = layer.opacity * 0.5;
        ctx.fill();
        ctx.globalAlpha = layer.opacity;
        ctx.beginPath();
      }
      ctx.arc(drawX, drawY, radius, 0, Math.PI * 2);
      ctx.fillStyle = STAR_COLOR;
      ctx.fill();
    }
  }

  ctx.globalAlpha = 1;
}

export { LAYERS, STAR_COLOR, generateStars, createCanvas, resizeCanvas, drawStars };
