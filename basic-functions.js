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

/*Estirar Perfil*/
var profileState = true;
var changing = false;
function changeProfileWidth(){
    if(!changing){
        profileState = !profileState;
    if(profileState) {
        changing = true;
        console.log(changing);
        $('#div-profile').css({width: "350px"});
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
            console.log(changing);
        },850);
        
    }
    else{
        changing = true;
        console.log(changing);
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
        setTimeout( function(){
            changing=false;
            console.log(changing);
        },1050);
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

