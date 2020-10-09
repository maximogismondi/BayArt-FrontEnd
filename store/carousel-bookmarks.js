var imageIndex;
var numberImages = 0;

setTimeout( function(){
            $('#div-bpoints').css({display: "inline-block"});
            $('#div-name-type').css({display: "inline-block"});
            $('#div-name-type').css({opacity: "1"});
        },550);

function rotateCarousel(){
    $("#div-carousel-images").find('div').each(function (index){ 
        if(index == imageIndex){
            $("#div-image-" + index).css("opacity","1");
            $("#div-image-" + index).css("height","250px");
            $("#div-image-" + index).css("width","250px");
            $("#div-image-" + index).css("margin-left","0");
        }
        else if(index == imageIndex-1 || index == imageIndex+1){
            $("#div-image-" + index).css("opacity","1");
            $("#div-image-" + index).css("height","200px");
            $("#div-image-" + index).css("width","200px");
            $("#div-image-" + index).css("margin-left","0");
        }
        else{
            $("#div-image-" + index).css("height","0");
            $("#div-image-" + index).css("width","0");
            $("#div-image-" + index).css("opacity","0");
            $("#div-image-" + index).css("pointer-event","none");
            $("#div-image-" + index).css("margin-left","-115px");
        }
    });
}

function decreseIndex(){
    if(imageIndex > 1) imageIndex--;
    rotateCarousel();
}

function incrementIndex(){
    if(imageIndex < numberImages-2) imageIndex++;
    rotateCarousel();
}

function startCarousel(){
    
    /* get number of images */
    $("#div-carousel-images").find('img').each(function (){ numberImages++ });

    /* set image index */
    imageIndex = numberImages/2;

    console.log(imageIndex);
    /* create all the containers for the images */
    $("#div-carousel-images").find('img').each(function (index){

        $(this).attr("id","image-" + index); 

        if (document.getElementById($(this).attr("id")).naturalHeight > document.getElementById($(this).attr("id")).naturalWidth){
            $(this).css("height","100%");
            $(this).css("width","auto");
        } 
        else {
            $(this).css("width","100%");
            $(this).css("height","auto");
        }

        var divCancelImage = document.createElement('div');
            divCancelImage.id        = "div-cancel-image-" + index;
            divCancelImage.className = "div-cancel-image";

            var cancelImage = document.createElement('img');
                cancelImage.src = "../icons/cancel.png";

            divCancelImage.appendChild(cancelImage);

        var divImage = document.createElement('div');
            divImage.id         = "div-image-" + index;
            divImage.className  = "div-image";

        divImage.appendChild(document.getElementById($(this).attr("id")));
        divImage.appendChild(divCancelImage);
        $("#div-carousel-images").append(divImage); 
    });

    rotateCarousel();

    $("#button-carousel-right").click(incrementIndex);
    $("#button-carousel-left").click(decreseIndex);
}


