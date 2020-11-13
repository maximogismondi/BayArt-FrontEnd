const input2   = document.getElementById('input-banner');
input2.addEventListener('change', updateBannerDisplay);

function updateBannerDisplay() {
    var image = document.getElementById('img-uploaded-banner');
    image.src = URL.createObjectURL($(input2.files).get(0));
    
    document.getElementById("img-uploaded-banner").onload = function(){

        var input = document.getElementById("input-banner");
        var b64;

        var file = input.files[0],
        reader = new FileReader();

        reader.onloadend = function () {
        $("#input-encode-banner").val(reader.result);
        };

        reader.readAsDataURL(file);

        image.style.display = "block";
        $("#div-drag-drop-banner").css("display","none");
        $("#img-uploaded-banner").css("display","inline-block");
    }
}



