const slides = document.querySelectorAll(".slide");
const btns = document.querySelectorAll(".btn");
let currentSlide = 1;

//slider manual navigation
const manualNav = function (manual) {
  slides.forEach((slide) => {
    slide.classList.remove("active-slider");

    btns.forEach((btn) => {
      btn.classList.remove("active-slider");
    });
  });

  slides[manual].classList.add("active-slider");
  btns[manual].classList.add("active-slider");
};

btns.forEach((btn, i) => {
  btn.addEventListener("click", () => {
    manualNav(i);
    currentSlide = i;
  });
});

//slider autoplay navigation
const repeat = function (activeClass) {
  let active = document.getElementsByClassName("active-slider");
  let i = 1;

  const repeater = () => {
    setTimeout(function () {
      [...active].forEach((activeSlide) => {
        activeSlide.classList.remove("active-slider");
      });

      slides[i].classList.add("active-slider");
      btns[i].classList.add("active-slider");
      i++;

      if (slides.length == i) {
        i = 0;
      }
      if (i >= slides.length) {
        return;
      }
      repeater();
    }, 3000);
  };
  repeater();
};
repeat();
