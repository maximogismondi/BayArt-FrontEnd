var numberImages;
var actualImage;

function getNumberImages(){  
    $("#div-carousel-images").find('img').each(function (i){
    	$(this).css("transition", "height 1s, width 1s, right 1s, opacity 1s, margin 1s");
        numberImages = i;
    }); 
    numberImages++;
}

function rotateCarousel(){
	$("#div-carousel-images").find('img').each(function (index){
        if(index >= actualImage-2 && actualImage+2 >= index){
    		if(index == actualImage-2 || index == actualImage+2){
				$(this).css("height", "180px");
				$(this).css("width", "150px");
				$(this).css("opacity", "50%");
				$(this).css("margin","10px");
    		}
    		else if(index == actualImage-1 || index == actualImage+1){
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

function startCarousel(){
	getNumberImages();
	actualImage = numberImages/2;
	rotateCarousel();

	$("#button-carousel-right").click(decreseIndex);
	$("#button-carousel-left").click(decreseIndex);
}

function decreseIndex(){
	if(actualImage > 0){
		actualImage--;
		rotateCarousel();
	}
}

function decreseIndex(){
	if(actualImage < numberImages - 1){
		actualImage++;
		rotateCarousel();
	}
}


