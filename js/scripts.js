window.addEventListener("DOMContentLoaded", () => {
  const animatedElements = document.querySelectorAll(".animate");
  const bounceBtn = document.querySelector(".bounce");

  animatedElements.forEach((el, i) => {
    setTimeout(() => {
      el.classList.add("active");
    }, 300 + i * 200);
  });

  if (bounceBtn) {
    setTimeout(() => {
      bounceBtn.classList.add("active");
    }, 300 + animatedElements.length * 200 + 200);
  }
});

const testimonials = [
  {
    text: "“MetaTrack made it easy for me to stay on track. I lost 8kg in 2 months!”",
    author: "- Igon D."
  },
  {
    text: "“I love the clean UI and smooth tracking. Highly recommended.”",
    author: "- Joey C."
  },
  {
    text: "“The best app I’ve used to manage my nutrition goals!”",
    author: "- Jason A."
  }
];

let currentTestimonial = 0;

function changeTestimonial(direction) {
  const box = document.getElementById("testimonialBox");

  box.classList.add("fade-out");

  setTimeout(() => {
    currentTestimonial += direction;
    if (currentTestimonial < 0) currentTestimonial = testimonials.length - 1;
    if (currentTestimonial >= testimonials.length) currentTestimonial = 0;

    box.innerHTML = `
      <blockquote>
        ${testimonials[currentTestimonial].text}
        <br><span>${testimonials[currentTestimonial].author}</span>
      </blockquote>
    `;

    box.classList.remove("fade-out");
  }, 300);
}

document.addEventListener("DOMContentLoaded", () => {
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("visible");
      }
    });
  }, {
    threshold: 0.1
  });

  document.querySelectorAll(".scroll-animate").forEach(el => {
    observer.observe(el);
  });
});

document.querySelectorAll(".faq-question").forEach(button => {
  button.addEventListener("click", () => {
    const answer = button.nextElementSibling;
    const arrow = button.querySelector(".arrow");

    const isOpen = answer.classList.contains("open");

    document.querySelectorAll(".faq-answer").forEach(a => {
      a.classList.remove("open");
    });
    document.querySelectorAll(".arrow").forEach(ar => {
      ar.classList.remove("rotate");
    });

    if (!isOpen) {
      answer.classList.add("open");
      arrow.classList.add("rotate");
    }
  });
});

// Drop down toggle
function toggleDropdown() {
  const dropdown = document.getElementById("userDropdown");
  const icon = document.querySelector(".dropdown-icon");
  dropdown.classList.toggle("show");
  icon.classList.toggle("rotate");
}

// Close dropdown if clicking outside
window.addEventListener("click", function (e) {
  const dropdown = document.getElementById("userDropdown");
  const button = document.querySelector(".user-btn");

  if (!button.contains(e.target) && !dropdown.contains(e.target)) {
    dropdown.classList.remove("show");
    document.querySelector(".dropdown-icon").classList.remove("rotate");
  }
});



