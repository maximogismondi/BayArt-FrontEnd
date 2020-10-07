    const input   = document.getElementById('input-image');

    input.addEventListener('change', updateImageDisplay);

    function updateImageDisplay() {
        var image = document.getElementById('img-uploaded');
        image.src = URL.createObjectURL($(input.files).get(0));
        image.style.display = "block";
        
        document.getElementById("img-uploaded").onload = function(){
            setWidthHeight("img-uploaded","div-image",500,500);
            $("#div-drag-drop").css("display","none");
            $("#div-cancel-image").css("display","block");
            $("#div-image-description").css("height",($("#div-image").height()));
            $("#div-description").css("width",($("#div-image-description").width()-$("#div-image").width()-20));
        }
    }
