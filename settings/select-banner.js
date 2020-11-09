const input2   = document.getElementById('input-banner');

input2.addEventListener('change', updateImageDisplay);

function updateImageDisplay() {
    var image = document.getElementById('img-uploaded-banner');
    image.src = URL.createObjectURL($(input2.files).get(0));
    
    document.getElementById("img-uploaded-banner").onload = function(){
        image.style.display = "block";
        $("#div-drag-drop-banner").css("display","none");
        $("#img-uploaded-banner").css("display","inline-block");
    }
}



