function mostrarOcultar(id,tiempo){
    jQuery(id).fadeIn(30).delay(tiempo).fadeOut(tiempo);
}

function ocultarDespDelTiempo(id,tiempo){
    jQuery(id).delay(tiempo).fadeOut(tiempo);
}