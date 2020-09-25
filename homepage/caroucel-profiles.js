var numberImages = 0;
var indexCarouselPosition = 0;
var maxCarouselPosition;

function getNumberProfiles(){
	$("#carousel-images-profiles").find('img').each(function (index){
        $(this).attr("id","img-profile"+index);
        $(this).attr("class","img-profile");
        numberImages++;
    });
}

function rotateCarousel(){
    if(indexCarouselPosition == 0){
        $("#button-carousel-left").css("pointer-events","none");
    }
    else{
        $("#button-carousel-left").css("pointer-events","auto");
    }
    if(indexCarouselPosition == maxCarouselPosition){
        $("#button-carousel-right").css("pointer-events","none");
    }
    else{
        $("#button-carousel-right").css("pointer-events","auto");
    }
	$("#carousel-images-profiles").find('img').each(function (index){
        if(index >= indexCarouselPosition*15 && index < (indexCarouselPosition+1)*15){
        	$(this).css("height","50px");
        	$(this).css("width","50px");
        	$(this).css("margin","0px");
        	$(this).css("border","4px solid #505050");
        	$(this).css("opacity","1");
        }
        else{;
        	$(this).css("width","0px");
        	$(this).css("margin","-2.8px");
        	$(this).css("border","none");
        	$(this).css("opacity","0");
        }
    });
}

function startCarroucelProfiles(){
    getNumberProfiles();
    maxCarouselPosition = parseInt(numberImages/15);
    rotateCarousel();

    $("#button-carousel-right").click(function(){
    	if(indexCarouselPosition < maxCarouselPosition){
			indexCarouselPosition++;
			rotateCarousel();
    	}
    	
    });
    $("#button-carousel-left").click(function(){
    	if(indexCarouselPosition > 0){
    		indexCarouselPosition--; 
    		rotateCarousel();
    	}
    });

}

