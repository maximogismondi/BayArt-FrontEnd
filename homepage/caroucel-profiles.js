function startCarroucelProfiles(){
    var carouselImagesProfiles = document.getElementById("carousel-images-profiles");
    var numberIndexSection = 0;
    var actualIndex  = 1;

    $("#carousel-images-profiles").find('img').each(function (index){
        $(this).attr("id","img-profile"+index);
        $(this).attr("class","img-profile");
    });

    $("#button-carousel-right").on('click', function() {
        $('#carousel-images-profiles').animate( { scrollLeft: '+=400' }, 200);    
    });

    $("#button-carousel-left").on('click', function() {
        $('#carousel-images-profiles').animate( { scrollLeft: '-=400' }, 200);
    });

    document.addEventListener('DOMContentLoaded', function () {   
        var button = document.getElementById('button-carousel-left');
        button.onclick = function () {
            document.getElementById('carousel-images-profiles').scrollLeft -= 500;
        };
    });

}


/*$('#carousel-images-profiles').animate({scrollRight:200},150);*/