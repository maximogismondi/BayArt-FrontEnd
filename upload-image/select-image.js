var input = document.getElementById("input-image");
input.addEventListener("change", updateImageDisplay);

function updateImageDisplay() {
  var image = document.getElementById("img-uploaded");
  image.src = URL.createObjectURL($(input.files).get(0));

  document.getElementById("img-uploaded").onload = function () {
    uploadImageOrder();

    var input = document.getElementById("input-image");
    var b64;

    var file = input.files[0],
      reader = new FileReader();

    reader.onloadend = function () {
      $("#input-encode-image").val(reader.result);
    };

    reader.readAsDataURL(file);
  };
}
