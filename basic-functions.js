/*Rotar Flecha*/
var arrowState = false;
function changeArrow() {
    arrowState = !arrowState;
    if(arrowState == true){
        $('#img-arrow').css({transform: "rotate(90deg)"});
        $('#div-filter').css({visibility: "visible", opacity: "1"});
    }
    else{
        $('#img-arrow').css({transform: "rotate(0deg)"});
        $('#div-filter').css({opacity: "0"});
        setTimeout( function(){
            $('#div-filter').css({visibility: "hidden"});
        },100);
    }
}

var firstUbication = window.pageYOffset;
window.onscroll = function(){
    var actualUbication = window.pageYOffset;
    if (firstUbication < actualUbication){
        document.getElementById("nav-subtitle").style.opacity = "0";
        document.getElementById("nav-subtitle").style.marginTop = "-200px";
        if(arrowState == true){
            changeArrow();
        }
    } 
    else {
        document.getElementById("nav-subtitle").style.opacity = "1";
        document.getElementById("nav-subtitle").style.marginTop = "20px";
    }
    firstUbication = actualUbication;
}

/*Estirar Perfil*/
var profileState = true;
var changing = false;
function changeProfileWidth(){
    if(!changing){
        profileState = !profileState;
    if(profileState) {
        changing = true;
        console.log(changing);
        $("#div-secondary-buttons").css({opacity: "0"});
        $('#div-profile').css({width: "350px"});
        setTimeout( function(){
            $("#div-secondary-buttons").css({visibility: "hidden"});
        },100);
        setTimeout( function(){
            $('#div-bpoints').css({display: "inline-block"});
            $('#div-name-type').css({display: "inline-block"});
            $('#div-name-type').css({opacity: "1"});
        },550);
        setTimeout( function(){
            $('#label-bpoints').css({opacity: "1"});
        },650);
        setTimeout( function(){
            $('#img-bpoints').css({opacity: "1"});
        },750);
        setTimeout( function(){
            changing=false;
        },850);
        
    }
    else{
        changing = true;
        $('#img-bpoints').css({opacity: "0"});
        setTimeout( function(){
            $('#label-bpoints').css({opacity: "0"});
        },100);
        setTimeout( function(){
            $('#div-name-type').css({opacity: "0"});
        },200);
        setTimeout( function(){
            $('#div-bpoints').css({display: "none"});
            $('#div-name-type').css({display: "none"});
            $('#div-profile').css({width: "50px"});
        },300);
        setTimeout(function(){
            $("#div-secondary-buttons").css({visibility: "visible"});
            $("#div-secondary-buttons").css({opacity: "1"});
        },800)
        setTimeout( function(){
            changing=false;
        },1050);
    }
    }
}

/*Animacion botones secundarios*/

function secondaryButtonsHover(buttonName, shown){
    if(shown){
        $("#div-secondary-button-"+buttonName+"-text").css("color", "#00a797");
        $("#img-secondary-button-"+buttonName+"-white").css("opacity",0);
        $("#img-secondary-button-"+buttonName+"-green").css("opacity",1);
        if(buttonName == "settings"){
            $("#img-secondary-button-settings-green").css("transform","rotate(90deg)");	
            $("#img-secondary-button-settings-white").css("transform","rotate(90deg)");	    
        }
        else{
            $("#img-secondary-button-library-green").css("transform","translateY(-6px)"); 
            $("#img-secondary-button-library-white").css("transform","translateY(-6px)");     
        }
    }
    else{
        $("#div-secondary-button-"+buttonName+"-text").css("color", "white");
        $("#img-secondary-button-"+buttonName+"-white").css("opacity",1);
        $("#img-secondary-button-"+buttonName+"-green").css("opacity",0);
        if(buttonName == "settings"){    
            $("#img-secondary-button-settings-green").css("transform","rotate(0deg)");	
            $("#img-secondary-button-settings-white").css("transform","rotate(0deg)");	    
        }
        else{
            $("#img-secondary-button-library-green").css("transform","translateY(0)"); 
            $("#img-secondary-button-library-white").css("transform","translateY(0)");
        }
    }
        
}

/*Cambiar texto label checkBox*/
function checkBoxState(idCheck, color1, color2){
    var idLabel = "label" + idCheck.slice(14);
    if($('#'+idCheck).prop('checked')){
        $("#"+idLabel).css( "color" , color1);
    }
    else{
        $("#"+idLabel).css( "color" , color2);
    }
};

/*Ocultar/Mostrar contraseña*/
var visibility = false;
function showPassword(){
    if(!visibility){
        document.getElementById("input-password").type = "text";
        document.getElementById("img-eye").src = "../icons/closed-eye.png"; 
    }
    else{
        document.getElementById("input-password").type = "password";
        document.getElementById("img-eye").src = "../icons/open-eye.png"; 
    }
    visibility = !visibility;
}

/*Setear alto y ancho de imagen*/

function setWidthHeight(idImage, idDiv, maxWidth, maxHeight){

    var height = $("#"+idImage).height();
    var width = $("#"+idImage).width();

    var relationHeightMaxHeight = height/maxHeight;
    var relationWidhtMaxWidth = width/maxWidth;

    if(relationHeightMaxHeight > relationWidhtMaxWidth){
        $("#"+idImage).css('height',maxHeight);
        $("#"+idDiv).css('height',(maxHeight+40));
        $("#"+idImage).css('width',"auto");
        $("#"+idDiv).css('width',(width/relationHeightMaxHeight+40));
    }
    else{
        $("#"+idImage).css('width',maxWidth);
        $("#"+idDiv).css('width',(maxWidth+40));
        $("#"+idImage).css('height',"auto");
        $("#"+idDiv).css('height',(height/relationWidhtMaxWidth+40));
    }

}

/*------------------------------------------------------------------------*/
function getWidth(element){
    return parseFloat((window.getComputedStyle(element).width).slice(0,-2));
}


/*Ordenar fotos menu principal*/

function orderImages(id, minHeight, margin){

    var numImages = 0;
    var actualImage = 0;
    var totalHeight = margin;

    //Agregar id a las imagenes y obtener la cantidad

    $("#"+id).find('img').each(function (index){

        $(this).attr('id','img-main-'+index);
        numImages++;

    }); 

    //Insertar x imagenes en un sub div y ajustarlas

    for (var actualRow = 0; actualImage < numImages; actualRow++) {

        var changeRow = false;
        var rowWidth = 0;
        var numImagesRow = 0;

        var newRow = document.createElement('div');
        newRow.id = "image-row-"+actualRow;
        newRow.style.marginTop = margin;

        //Agregar Imagenes a fila

        while(!changeRow  && actualImage < numImages){

            var idWidth = getWidth(document.getElementById(id)) - margin;
            var insertImage = document.getElementById("img-main-"+actualImage);

            insertImage.style.height = minHeight;
            insertImage.style.width = "auto";
            insertImage.style.borderRadius = "10px";

            if (getWidth(insertImage) + margin > idWidth) {
                insertImage.style.width = idWidth-margin;
                insertImage.style.height = "auto";
            }

            //Agrega Imagenes
            
            if((idWidth - rowWidth ) >= getWidth(insertImage) + margin){       

                rowWidth += getWidth(insertImage);
                
                newDivImage = document.createElement("div");
                newDivImage.id = "div-img-main-"+actualImage;
                newDivImage.style.display = "inline-block";
                newDivImage.style.marginLeft = margin;
                newDivImage.appendChild(insertImage);

                newRow.appendChild(newDivImage);
                actualImage++;
                numImagesRow++;

            }

            //Cambiar de fila

            else{
                changeRow = true;
            }
        }

        //Inserta fila al id enviado

        document.getElementById(id).appendChild(newRow);

        //Ajusta el width de las fotos para un encastre perfecto

        var multiplierToGrow = (idWidth - numImagesRow*margin) / rowWidth;

        $("#image-row-"+actualRow).find('img').each(function (index){

            if ($(this).height()*multiplierToGrow <= minHeight*2) {
                $(this).css("width", $(this).width()*multiplierToGrow);
                $(this).css("height", $(this).height()*multiplierToGrow);
            }

            else {
                $(this).css("height",minHeight*2);
                $(this).css("width","auto");
            }
        });
        
        totalHeight += ($("#image-row-"+actualRow).height() + margin);

    }

    $("#"+id).css("height",totalHeight);
    console.log(totalHeight);
}