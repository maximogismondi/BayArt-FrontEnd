var estadoFlecha = false;
var imgFlecha    = document.getElementById('flecha');
function cambiarFlecha() {
	estadoFlecha = !estadoFlecha;
	if(estadoFlecha == true){
		imgFlecha.style.transform = "rotate(90deg)";
	}
	else{
		imgFlecha.style.transform = "rotate(0deg)";
	}
}

var estadoPerfil = true;
var contenedorPerfil = document.getElementById('contenedor-perfil');

function comprobarPerfil(){
	estadoPerfil = !estadoPerfil;
	if(estadoPerfil == true) contenedorPerfil.style.width = "200px";
	else 					 contenedorPerfil.style.width = "50px";
}	

