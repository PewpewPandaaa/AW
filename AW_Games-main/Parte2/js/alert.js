function avisa() {
    var motivo = document.getElementById('motivoReport').value;
    if(motivo === '' ){

        alert("No se ha enviado el report");

    } else {

        alert("Se ha enviado correctamente el report");
    }

}

