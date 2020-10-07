const input   = document.getElementById('input-image');

input.addEventListener('change', updateImageDisplay);

function updateImageDisplay() {
    var image = document.getElementById('img-uploaded');
    image.src = URL.createObjectURL($(input.files).get(0));
    image.style.display = "block";
    
    document.getElementById("img-uploaded").onload = function(){
        $("#div-drag-drop").css("display","none");
        $("#img-uploaded").css("display","inline-block")
    }
}
