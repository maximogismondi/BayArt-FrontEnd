function startCarroucelProfiles() {
  var carouselImagesProfiles = document.getElementById(
    "carousel-images-profiles"
  );
  var numberIndexSection = 0;
  var actualIndex = 1;

  $("#carousel-images-profiles")
    .find("img")
    .each(function (index) {
      $(this).attr("class", "img-profile-carrousel");
    });

  $("#button-carousel-right").on("click", function () {
    $("#carousel-images-profiles").animate({ scrollLeft: "+=100" }, 200);
  });

  $("#button-carousel-left").on("click", function () {
    $("#carousel-images-profiles").animate({ scrollLeft: "-=100" }, 200);
  });

  document.addEventListener("DOMContentLoaded", function () {
    var button = document.getElementById("button-carousel-left");
    button.onclick = function () {
      document.getElementById("carousel-images-profiles").scrollLeft -= 500;
    };
  });
}

$(document).ready(function () {
  $("#carousel-images-profiles").css({ opacity: "1" });
});
