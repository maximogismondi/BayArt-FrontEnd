var estadoFlecha = false;
function cambiarFlecha() {
    estadoFlecha = !estadoFlecha;
    if(estadoFlecha == true){
        $('#flecha').css({transform: "rotate(90deg)"});
    }
    else{
        $('#flecha').css({transform: "rotate(0deg)"});
    }
}

var estadoPerfil = true;
function comprobarPerfil(){
    estadoPerfil = !estadoPerfil;
    if(estadoPerfil == true) $('#contenedor-perfil').css({width: "350px"});
    else 					 $('#contenedor-perfil').css({width: "50px"});
}	

