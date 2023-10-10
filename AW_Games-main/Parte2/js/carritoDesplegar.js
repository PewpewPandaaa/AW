var btnDesplegar = document.querySelectorAll(".btn-desplegar");
btnDesplegar.forEach(function(btn) {
    var textoDesplegable = btn.nextElementSibling;

    btn.addEventListener("click", function() {
        if (textoDesplegable.style.display == "none") {
            textoDesplegable.style.display = "block";
            btn.textContent = "Ocultar descripción";
        } else {
            textoDesplegable.style.display = "none";
            btn.textContent = "Mostrar descripción";
        }
    });
});