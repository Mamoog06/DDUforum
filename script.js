document.querySelectorAll(".scrollable-container").forEach((container) => {
  let isDown = false;
  let startX;
  let scrollLeft;

  const startScroll = (e) => {
    isDown = true;
    container.classList.add("active");
    startX = e.pageX || e.touches[0].pageX; // Adjusted to capture the exact position
    scrollLeft = container.scrollLeft;
  };

  const endScroll = () => {
    isDown = false;
    container.classList.remove("active");
  };

  const moveScroll = (e) => {
    if (!isDown) return; // Prevent moving if not clicked
    e.preventDefault(); // Prevent text selection
    const x = e.pageX || e.touches[0].pageX; // Adjusted to capture the exact position
    const walk = (x - startX) * 1; // Calculate distance to scroll
    container.scrollLeft = scrollLeft - walk; // Apply scroll
  };

  // Mouse events
  container.addEventListener("mousedown", startScroll);
  container.addEventListener("mouseleave", endScroll);
  container.addEventListener("mouseup", endScroll);
  container.addEventListener("mousemove", moveScroll);

  // Touch events
  container.addEventListener("touchstart", startScroll);
  container.addEventListener("touchend", endScroll);
  container.addEventListener("touchmove", moveScroll);
});
