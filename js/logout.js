setTimeout(() => {
  document.getElementById('logoutModal').classList.add('fade-out');

  setTimeout(() => {
    window.location.href = "/MetaTrack/index.php";
  }, 800);
}, 2500);
