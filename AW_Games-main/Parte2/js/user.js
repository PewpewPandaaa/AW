document.addEventListener("DOMContentLoaded", function() {
// Obtén el enlace actual
  var currentPage = window.location.pathname;

  // Verifica si la página actual coincide con el enlace de "Mis amigos"
  if (currentPage == '/AW_Games/Parte2/amigo.php') {
      var amigoLink = document.getElementById("amigosLink");
      amigoLink.classList.add("marcado");
  }

  if(currentPage == '/AW_Games/Parte2/annadir.php'){
    var x = document.getElementById("xLink");
    x.classList.add("marcado");
}
});


//seleccionar el saldo a recargar 
function seleccionarCantidad(valor) {
    document.getElementById("amount").value = valor;
}

//en la página de chat el scroll permanecer abajo
function enviarMensaje(){
    var chatContainer = document.getElementById("contenido_chat");
    chatContainer.scrollTop = chatContainer.scrollHeight;
}

//mirar si ha escrito algo en el buscador
document.addEventListener("DOMContentLoaded", function() {
    var searchInput = document.getElementById("buscar_1");
    var searchInstruction = document.getElementById("search-instruction");

    searchInput.addEventListener("input", function() {
        if (searchInput.value.trim() !== "") {
            searchInstruction.style.display = "none";
        } else {
            searchInstruction.style.display = "block";
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    buscar_ahora();
  });

//búsqueda instantánea a los usuarios
function buscar_ahora(buscar){
    //buscar tiene el valor introducido en el cuadro de busqueda
    var parametros = {"buscar":buscar};

    $.ajax({
        data:parametros,
        type:'POST',
        url: 'search.php',
        success: function(data){
            var usuarios = JSON.parse(data); // Convertir la respuesta en formato JSON a un objeto JavaScript
                
            var s=0;
                // Generar el HTML para cada usuario
                var contenidoPrincipal = '';
                if(usuarios.length == 1){
                    contenidoPrincipal += ' <div id="verify_search"> <p>No hay ningun resultado! Comprueba </p></div>';   
                }

                var element = document.getElementById("x");
                var r = element !== null ? element.value : " ";

                for (var i = 1; i < usuarios.length; i++) {
                    var usuario = usuarios[i];
                

                    console.log(r);
                    console.log(usuario.nombreUsuario);
                    // Realizar las comprobaciones y generar el HTML correspondiente
                    if (usuario.nombreUsuario === r) {
                        // El usuario coincide con el id, no mostrar nada
                        continue;
                    } else if (usuario.id === "15") {
                        // El usuario es administrador, no mostrar nada
                        continue;
                    } else {
                        // Generar el HTML para mostrar el usuario
                        if (s > 0) {
                            contenidoPrincipal += '<hr>';
                        }
                        
                        contenidoPrincipal += '<div id="Juego_wrapper" class="games">';
                        contenidoPrincipal += '<div id="btn-m-up">';
                        contenidoPrincipal += '<div><a href="perfil.php?idUser=' + usuario.nombreUsuario + '">Más información</div></a>';
                        
                        contenidoPrincipal += '</div>';
                        contenidoPrincipal += '<div class="avatar_wrapper">';
                        
                        if (usuario.imagen === "") {
                            contenidoPrincipal += '<img class="user-img" src="img/avatar.png" alt="juego">';
                        } else {
                            contenidoPrincipal += '<img class="user-img" src="data:image/jpeg;base64,' + usuario.imagen + '" alt="juego">';
                        }
                        
                        contenidoPrincipal += '</div>';
                        contenidoPrincipal += '<div class="title_game_wrapper">';
                        contenidoPrincipal += '<span id="game_info">';
                        contenidoPrincipal += '<div id="game_container_time">';
                        contenidoPrincipal += '<span id="game">' + usuario.nombreUsuario + '</span>';
                        
                        if (usuario.genero === 'femenina') {
                            contenidoPrincipal += '<img class="genero-img" src="img/mujer.png" alt="mujer">';
                        } else if (usuario.genero === 'masculino') {
                            contenidoPrincipal += '<img class="genero-img" src="img/hombre.png" alt="hombre">';
                        }
                        
                        contenidoPrincipal += '</div>';
                        contenidoPrincipal += '</span>';
                        contenidoPrincipal += '</div>';
                        contenidoPrincipal += '</div>';
                        
                        s++;
                    }
                }
                
                // Insertar el contenido generado en el elemento con el id "datos_buscador"
                document.getElementById("datos_buscador").innerHTML = contenidoPrincipal;
            }
    
      
    })
}

$(document).ready(function(){
    $("#importeOK").hide();
    $("#importeNoOK").hide();
    $("#nombreNo").hide();
    $("#infoOK").hide();
    $("#infoNo").hide();
    $("#gameInfoOK").hide();
    $("#gameInfoNo").hide();
    $("#gameDOK").hide();
    $("#gameDNo").hide();
    $("#gamePriceOK").hide();
    $("#gamePriceNo").hide();
    $("#gameOK").hide();
    $("#gameNo").hide();

    $("#gamenameOK").hide();
    $("#gamenameNo").hide();
    $("#rebajaOK").hide();
    $("#rebajaNo").hide();
    $("#GInfoNo").hide();
    $("#GInfoOK").hide();
    
    
  
    $("#amount").change(function(){
        const campo =$("#amount");
        campo[0].setCustomValidity("");
        const esValido = campo[0].checkValidity();

        if(esValido && amountValido(campo.val())){
            campo.removeClass("is-invalid");
            $("#importeOK").show();
            $("#importeNoOK").hide();
        } else{
            $("#importeNoOK").show();
            $("#importeOK").hide();
            campo[0].setCustomValidity("Debe ser un numero entero o decimal");
        }
    });

    function amountValido(cantidad){
        var regex = /^\d+(\.\d+)?$/;

        return regex.test(cantidad);
    }

    $("#username").change(function(){
        const campo =$("#username");
        campo[0].setCustomValidity("");
        const esValido = campo[0].checkValidity();

        if(esValido && campo.val().trim() !== ""){
            campo.removeClass("is-invalid");
            $("#nombreOK").show();
            $("#nombreNo").hide();
        } else{
            $("#nombreNo").show();
            $("#nombreOK").hide();
            campo[0].setCustomValidity("No puede estar vacio");
        }
    });

    $("#infoUser").change(function(){
        const campo =$("#infoUser");
        campo[0].setCustomValidity("");
        const esValido = campo[0].checkValidity();

        if(esValido && campo.val().trim() !== ""){
            campo.removeClass("is-invalid");
            $("#infoOK").show();
            $("#infoNo").hide();
        } else{
            $("#infoNo").show();
            $("#infoOK").hide();
            campo[0].setCustomValidity("El campo información no puede estar vacio");
        }
    });

    $("#precio").change(function(){
        const campo =$("#precio");
        campo[0].setCustomValidity("");
        const esValido = campo[0].checkValidity();

        if(esValido && xDValido(campo.val())){
            $("#gamePriceOK").show();
            $("#gamePriceNo").hide();
        } else{
            $("#gamePriceNo").show();
            $("#gamePriceOK").hide();
            campo[0].setCustomValidity("Debe ser un numero entero o decimal(Formato 0.00)");
        }
    });

    function xDValido(cantidad){
        var regex = /^\d+(?:[.,]\d+)?$/;

        return regex.test(cantidad);
    }

    $("#nombre").change(function(){
        const campo =$("#nombre");
        campo[0].setCustomValidity("");
        const esValido = campo[0].checkValidity();

        if(esValido && campo.val().trim() !== ""){
            campo.removeClass("is-invalid");
            $("#gameOK").show();
            $("#gameNo").hide();
        } else{
            $("#gameNo").show();
            $("#gameOK").hide();
            campo[0].setCustomValidity("No puede estar vacio");
        }
    });

    $("#desarrollador").change(function(){
        const campo =$("#desarrollador");
        campo[0].setCustomValidity("");
        const esValido = campo[0].checkValidity();

        if(esValido && campo.val().trim() !== ""){
            campo.removeClass("is-invalid");
            $("#gameDOK").show();
            $("#gameDNo").hide();
        } else{
            $("#gameDNo").show();
            $("#gameDOK").hide();
            campo[0].setCustomValidity("No puede estar vacio");
        }
    });

    $("#infoBasica").change(function(){
        const campo =$("#infoBasica");
        campo[0].setCustomValidity("");
        const esValido = campo[0].checkValidity();

        if(esValido && campo.val().trim() !== ""){
            campo.removeClass("is-invalid");
            $("#gameInfoOK").show();
            $("#gameInfoNo").hide();
        } else{
            $("#gameInfoNo").show();
            $("#gameInfoOK").hide();
            campo[0].setCustomValidity("No puede estar vacio");
        }
    });

    $("#imagen_juego").change(function(){
        const campo =$("#imagen_juego");
        const archivos = campo[0].files;

        if(archivos.length > 0){
            campo.removeClass("is-invalid");
        }else{
            campo[0].setCustomValidity("Hay que seleccionar un imagen");
        }
    });

    $("#infoGame").change(function(){
        const campo =$("#infoGame");
        campo[0].setCustomValidity("");
        const esValido = campo[0].checkValidity();

        if(esValido && campo.val().trim() !== ""){
            campo.removeClass("is-invalid");
            $("#GInfoOK").show();
            $("#GInfoNo").hide();
        } else{
            $("#GInfoNo").show();
            $("#GInfoOK").hide();
            campo[0].setCustomValidity("La descripción no puede estar vacio");
        }
    });

    $("#gamename").change(function(){
        const campo =$("#gamename");
        campo[0].setCustomValidity("");
        const esValido = campo[0].checkValidity();

        if(esValido && campo.val().trim() !== ""){
            campo.removeClass("is-invalid");
            $("#gamenameOK").show();
            $("#gamenameNo").hide();
        } else{
            $("#gamenameNo").show();
            $("#gamenameOK").hide();
            campo[0].setCustomValidity("No puede estar vacio");
        }
    });

      
    $("#rebaja").change(function(){
        const campo =$("#rebaja");
        campo[0].setCustomValidity("");
        const esValido = campo[0].checkValidity();

        if(esValido && amountValido(campo.val())){
            campo.removeClass("is-invalid");
            $("#rebajaOK").show();
            $("#rebajaNoOK").hide();
        } else{
            $("#rebajaNoOK").show();
            $("#rebajaOK").hide();
            campo[0].setCustomValidity("Debe ser un numero entero o decimal (Si desea no rebajado, rellena con el precio orignal)");
        }
    });

    function amountValido(cantidad){
        var regex = /^\d+(\.\d+)?$/;

        return regex.test(cantidad);
    }


})

