var estadoFlecha = false;
function cambiarFlecha() {
    estadoFlecha = !estadoFlecha;
    if(estadoFlecha == true){
        $('#flecha').css({transform: "rotate(90deg)"});
        $('#filtrar').css({visibility: "visible", opacity: "1"});
    }
    else{
        $('#flecha').css({transform: "rotate(0deg)"});
        $('#filtrar').css({visibility: "hidden", opacity: "0"});
    }
}

var estadoPerfil = true;
function comprobarPerfil(){
    estadoPerfil = !estadoPerfil;
    if(estadoPerfil == true) $('#contenedor-perfil').css({width: "350px"});
    else 					 $('#contenedor-perfil').css({width: "50px"});
}

function estadoCheckBoxFiltrar(idCheck){
    var idLabel = "label" + idCheck.slice(8);
    if($('#'+idCheck).prop('checked')){
        $("#"+idLabel).css( "color" , "white");
    }
    else{
        $("#"+idLabel).css( "color" , " #7c7c7c");
    }
};

