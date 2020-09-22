var divCarouselImages;
var numberImages = 0;
var actualImage;

function getNumberImages(){
    $("#div-carousel-images").find('img').each(function (index){
        $(this).attr("id","img"+index);
        numberImages++;
    });
    console.log(numberImages);
}

function createContainerImg(){
    $("#div-carousel-images").find('img').each(function (index){
        var divContainer = document.createElement('div');
            divContainer.id = "div-container" + index;
            divContainer.className = "div-container";

            var imageBookmark = document.getElementById($(this).attr("id"));
                imageBookmark.style.borderRadius = "10px";
            
            if(imageBookmark.naturalHeight < imageBookmark.naturalWidth){
                imageBookmark.style.width  = "90%";
                imageBookmark.style.height = "auto";
            }
            else{
                imageBookmark.style.height = "90%";
                imageBookmark.style.widht  = "auto";
            }   
            divContainer.appendChild(imageBookmark);
        
            /*----------panel inferior del container----------------*/
            var divPanel = document.createElement('nav');
                divPanel.id = "div-panel" + index; 
                divPanel.className = "div-panel";

                /*-----boton para expandir------*/
                var buttonExpand = document.createElement('button');
                    buttonExpand.id = "buttonExpand" + index;
                    buttonExpand.className = "buttonExpand";

                    /*---imagen boton de compra------*/
                    var imgButtonExpand = document.createElement('img');
                        imgButtonExpand.src = "../icons/buttonExpand.png";
                        imgButtonExpand.id = "imgButtonExpand";

                        buttonExpand.appendChild(imgButtonExpand);
                

                divPanel.appendChild(buttonExpand);

                /*-----boton de compra------*/
                var buttonBuy = document.createElement('button');
                    buttonBuy.id = "buttonBuy" + index;
                    buttonBuy.className = "buttonPanel";

                    /*---imagen boton de compra------*/
                    var imgBuy = document.createElement('img');
                        imgBuy.src = "../icons/buy.png";
                        imgBuy.id = "imgBuy";

                        buttonBuy.appendChild(imgBuy);

                    divPanel.appendChild(buttonBuy);

                /*-----boton de remover bookmark------*/
                var buttonRemoveBookmark = document.createElement('button');
                    buttonRemoveBookmark.id = "buttonRemoveBookmark" + index;
                    buttonRemoveBookmark.className = "buttonPanel";
                    buttonRemoveBookmark.classList.add("removeBookmark"); 

                    /*---imagen boton de remover bookmark------*/
                    var imgRemoveBookmark = document.createElement('img');
                        imgRemoveBookmark.src = "../icons/bookmark-disable.png";
                        imgRemoveBookmark.id = "imgRemoveBookmark";

                        buttonRemoveBookmark.appendChild(imgRemoveBookmark);

                    divPanel.appendChild(buttonRemoveBookmark);

                divContainer.appendChild(divPanel);
                /*------------------------------------------------*/
        
        divCarouselImages.appendChild(divContainer);
    });
}

function transformPanel(id,h,a,mt,o){
    $("#div-panel"    + id).css("height", h+"px");
    $("#buttonExpand" + id).css({transform: "rotate("+a+"deg)"});
    $("#buttonExpand" + id).css({marginTop: mt+"px"});
    $(".buttonPanel"  + id).css({opacity: o});
}

function expandPanel(idButton){
    if($("#div-panel" + idButton.slice(12)).height() == 0){
        transformPanel(idButton.slice(12),50,180,10,1);
    }
    else{
        transformPanel(idButton.slice(12),0,0,-30,0);
    }
}

function show_Or_Hidden_ConfirmRemoveBookmaker_Panel(o,pe,mt){
    $("#div-confirmRemoveBookmaker-panel").css("opacity", o);
    $("#div-container" + actualImage).css("pointer-events", pe);
    $("#div-container" + actualImage).css("marginTop", mt + "px");
}

function rotateCarousel(){
    $("#div-confirmRemoveBookmaker-panel").css("opacity", "0");
    $("#div-carousel-images").find('div').each(function (index){
        console.log($(this));
        if(index >= actualImage-1 && actualImage+1 >= index){
            if(index == actualImage-1 || index == actualImage+1){
                $(this).css("height", "200px");
                $(this).css("width", "225px");
                $(this).css("opacity", "80%");
                $(this).css("margin","0px");
                $(this).css("pointer-events","none");
                transformPanel(this.id.slice(13),0,0,-30,0);
                $("#div-container" + index).css("border", "none");
                $("#buttonExpand" + this.id.slice(13)).css("opacity", "0");

            }
            else{
                $(this).css("height", "500px");
                $(this).css("width", "500px");
                $(this).css("opacity", "100%");
                $(this).css("margin","10px");
                $(this).css("pointer-events","auto");
                $("#buttonExpand" + this.id.slice(13)).css("opacity", "1");
            }

        }
        else{
            $(this).css("width", "0px");
            $(this).css("height", "0px");
            $(this).css("opacity", "0%");
            $(this).css("margin","0px");
        }
    });
}

function startCarousel(){
    divCarouselImages = document.getElementById('div-carousel-images');
    getNumberImages();
    actualImage = parseInt((numberImages+1)/2);
    createContainerImg();
    rotateCarousel();

    $("#button-carousel-right").click(decreseIndex);
    $("#button-carousel-left").click(incrementIndex);

    $(".removeBookmark").click(function(){
        show_Or_Hidden_ConfirmRemoveBookmaker_Panel(1,"none",-35);
    });

    $("#cancel").click(function(){
        show_Or_Hidden_ConfirmRemoveBookmaker_Panel(0,"auto",0);
    });

    $("#confirm").click(function(){
        var containerToEliminate = document.getElementById($("#div-container"+actualImage).attr("id"));
        
    });

    $(".buttonExpand").click(function (){
        var idPanel = $(this).attr("id");
        expandPanel(idPanel);

    }); 
}

function incrementIndex(){
    if(actualImage > 0){
        actualImage--;
    }
    //var firstContainer = document.getElementById($("#div-carousel-images div:first-child").attr("id"));
    rotateCarousel();
}

function decreseIndex(){
    if(actualImage < numberImages - 1){
        actualImage++;
    }
    rotateCarousel();
}


