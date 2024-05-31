document.addEventListener("DOMContentLoaded", () => {
  const svgElement = document.querySelector(".draw-svg svg");

  if (svgElement) {
    const svgPaths = svgElement.querySelectorAll("path");

    svgPaths.forEach((svgPath) => {
      const length = svgPath.getTotalLength();
      svgPath.style.strokeDasharray = length;
      svgPath.style.strokeDashoffset = length;
      svgPath.style.animation = "none"; // Reset any previous animation

      setTimeout(() => {
        svgPath.style.transition = "stroke-dashoffset 5s ease";
        svgPath.style.strokeDashoffset = "0";
      }, 1000); // Delay to start the animation, e.g., 1 second after page load
    });
  } else {
    console.error("SVG element not found");
  }
});
