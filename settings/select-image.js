const input   = document.getElementById('input-image');

input.addEventListener('change', updateImageDisplay);

function updateImageDisplay() {
    var image = document.getElementById('img-uploaded');
    image.src = URL.createObjectURL($(input.files).get(0));
    
    
    document.getElementById("img-uploaded").onload = function(){
        image.style.display = "block";
        $("#div-drag-drop").css("display","none");
        $("#img-uploaded").css("display","inline-block");
    }
}
