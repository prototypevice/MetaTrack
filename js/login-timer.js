document.addEventListener('DOMContentLoaded', () => {
  const circle = document.querySelector('.circle-progress');
  const timerText = document.getElementById('timer');
  let seconds = 5;
  const total = 282.6;

  const interval = setInterval(() => {
    seconds--;
    timerText.textContent = seconds;

    const dashOffset = (seconds / 5) * total;
    circle.style.strokeDashoffset = total - dashOffset;

    if (seconds <= 0) {
      clearInterval(interval);
      window.location.href = 'tracker_dashboard.php';
    }
  }, 1000);
});
