var cantidadImagenes;
var indiceCentral;

function conseguirCantidadImagenes(){  
    $("#carrousel").find('img').each(function (i){
    	$(this).css("transition", "height 1s, width 1s, right 1s, opacity 1s, margin 1s");
        cantidadImagenes = i;
    }); 
    cantidadImagenes++;
}

function rotarCarrousel(){
	$("#carrousel").find('img').each(function (index){
        if(index >= indiceCentral-2 && indiceCentral+2 >= index){
    		if(index == indiceCentral-2 || index == indiceCentral+2){
				$(this).css("height", "180px");
				$(this).css("width", "150px");
				$(this).css("opacity", "50%");
				$(this).css("margin","10px");
    		}
    		else if(index == indiceCentral-1 || index == indiceCentral+1){
    			$(this).css("height", "280px");
    			$(this).css("width", "200px");
    			$(this).css("opacity", "80%");
    			$(this).css("margin","0px");
    		}
        	else{
				$(this).css("height", "370px");
				$(this).css("width", "230px");
				$(this).css("opacity", "100%");
				$(this).css("margin","10px");
        	}
        }
        else{
            $(this).css("width", "0px");
            $(this).css("opacity", "0%");
            $(this).css("margin","0px");
        }
    });
}

function startCarrousel(){
	conseguirCantidadImagenes();
	indiceCentral = cantidadImagenes/2;
	rotarCarrousel();

	$("#carrouselDer").click(incrementarIndice);
	$("#carrouselIzq").click(decrementarIndice);
}

function decrementarIndice(){
	if(indiceCentral > 0){
		indiceCentral--;
		rotarCarrousel();
	}
}

function incrementarIndice(){
	if(indiceCentral < cantidadImagenes - 1){
		indiceCentral++;
		rotarCarrousel();
	}
}


