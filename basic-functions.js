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
        $('#div-filter').css({visibility: "hidden", opacity: "0"});
    }
}

/*Estirar Perfil*/
var profileState = true;
function changeProfileWidth(){
    profileState = !profileState;
    if(profileState == true) $('#div-profile').css({width: "275px"});
    else 					 $('#div-profile').css({width: "50px"});
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

