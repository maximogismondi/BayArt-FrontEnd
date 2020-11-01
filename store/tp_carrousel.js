    /*-------------------------------------------------------------------------------------------------------*/ 
function activarCarousel(id, intervalo){
    
    var div_contiene_todo = document.getElementById(id); 
    var cantidadImagenes;
    conseguirCantidadImagenes(id);
    
    var indice = cantidadImagenes;
    var pausa = false;

    mostrarImagenes();
    pasar_imagen_adelante();

    div_contiene_todo.style.border = '5px solid #242424';
    div_contiene_todo.style.borderRadius = '30px';
    div_contiene_todo.style.background = '#242424';
    div_contiene_todo.style.height = '750px';
    div_contiene_todo.style.width = '1000px';
    div_contiene_todo.style.margin = '50px auto';
    div_contiene_todo.style.position = 'relative';

    /*-------------------------barra progreso------------------------------*/

        var automatico_progreso = setInterval(alargar_barra_automatico,intervalo/400);
        var barra_progreso = document.createElement('div');
        barra_progreso.id = 'div_progreso';
        barra_progreso.style.height = '2%';
        barra_progreso.style.width = '0.50%';
        barra_progreso.style.background = '#674ea7';
        barra_progreso.style.opacity = '0.4';
        barra_progreso.style.margin = '10px auto';
        div_contiene_todo.appendChild(barra_progreso);

        var valor_barra = 0;
        var porcentaje_barra = valor_barra + '%';
        var opacidad_de_barra = valor_barra/100;

        function alargar_barra(){   
            porcentaje_barra = valor_barra + '%';
            opacidad_de_barra = valor_barra/100;
            document.getElementById('div_progreso').style.width = porcentaje_barra;
            document.getElementById('div_progreso').style.opacity = opacidad_de_barra; 
            valor_barra = valor_barra + 0.25;
        }
        
    /*------------------------creacion botones-----------------------------*/
    crear_boton('atras');
    crear_boton('pausa');
    crear_boton('adelante');

    function crear_boton(nombre_boton){
        var button = document.createElement("button");
        button.id = nombre_boton;
        button.style.width = '340px';
        button.style.height = '85%';
        button.style.top = '0%';
        button.style.position = 'absolute';
        button.style.opacity = '0';
        div_contiene_todo.appendChild(button);
    }

    $("#adelante").click(pasar_imagen_adelante);
    $("#pausa").click(pausar_imagen);
    $("#atras").click(pasar_imagen_atras);

    document.getElementById('adelante').style.left= '66.5%';
    document.getElementById('pausa').style.left= '33.5%';

    /*------------------------creacion bolitas-----------------------------*/

        var div_centrar_bolitas = document.createElement('div');
        div_centrar_bolitas.id = 'id_centrar_bolitas';
        div_contiene_todo.appendChild(div_centrar_bolitas);
        
        for(var i = 0 ; i <= cantidadImagenes ; i++){
            var nombre_bolita = 'bolita' + i;
            crear_bolita(nombre_bolita);
            if(i == 0){
                document.getElementById(nombre_bolita).style.background = '#00a797';
            }
        }

        function crear_bolita(nombre_bolita){ 
            var bolita = document.createElement('div');
            bolita.id = nombre_bolita;
            bolita.style.width = '20px';
            bolita.style.height = '20px';
            bolita.style.background = '#242424';
            bolita.style.borderRadius = '50%';
            bolita.style.margin = '5px 5px';
            bolita.style.float = 'left';
            div_centrar_bolitas.appendChild(bolita);
            div_centrar_bolitas.style.border = '3px solid #3d3d3d';
            div_centrar_bolitas.style.background = '#3d3d3d';
            div_centrar_bolitas.style.opacity = '0.70';
            div_centrar_bolitas.style.borderRadius = '10px';
            div_centrar_bolitas.style.margin = '20px';
            div_centrar_bolitas.style.height = '5%';
        }

    /*-------------------------------------------------------------------------------------------------------*/

        function mostrarImagenes(){    /*oki*/
            $("#"+ id).find('img').each(function (index){
                if(index == indice){
                    $(this).css("display", "block");
                }
                else{
                   $(this).css("display", "none");
                }
            });
        }
        function conseguirCantidadImagenes(id){  /*oki*/
            $("#"+id).find('img').each(function (i){
                cantidadImagenes = i;
                $(this).css("margin", "20px auto");
                if($(this).height() > $(this).width()){
                    $(this).css("height", "100%");
                } else {
                    $(this).css("width", "100%");
                }
            }); 
        }
        function animar_carousel(estado) { /*oki*/
            $("#"+ id).find('img').each(function (index){
                if(index == indice){
                    if(estado == "block"){
                        $(this).fadeIn("slow").css("display", estado);
                    }
                    else{
                        $(this).css("display", estado);
                    }
                    
                }
            });
        }
        function cambiar_color_bolita(color) {  /*oki*/
            $("#id_centrar_bolitas").find('div').each(function (index){ 
                if(index == indice){
                    $(this).css("background", color);
                }
            });
        }
        function modificar_indice(parametro1, parametro2){ /*oki*/
            valor_barra = 0;
            if(indice == parametro1){
                indice = parametro2;
            }
            else if(parametro1 == cantidadImagenes){
                indice++;
            }
            else{
                indice--;
            }
        }
        function pasar_imagen_adelante(){ /*oki*/
            pausa = false;
            animar_carousel("none");
            cambiar_color_bolita("#242424");
            modificar_indice(cantidadImagenes, 0);
            animar_carousel("block");
            cambiar_color_bolita("#00a797");
        }
        function pasar_imagen_atras(){ /*oki*/
            pausa = false;
            animar_carousel("none");
            cambiar_color_bolita("#242424");
            modificar_indice(0, cantidadImagenes);
            animar_carousel("block");
            cambiar_color_bolita("#00a797");
        }
        function pausar_imagen(){
            pausa = !pausa;
        }
        function alargar_barra_automatico(){
            if(!pausa){
                clearInterval(automatico_progreso);
                alargar_barra();
                if(valor_barra == 95){
                    pasar_imagen_adelante();
                }
                automatico_progreso = setInterval(alargar_barra_automatico,intervalo/400);
            }
            
        } 
}
    /*-------------------------------------------------------------------------------------------------------*/ 