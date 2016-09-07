/**
 * Carga la interfaz seleccionada
 * @param  {string} contenedor Nombre del contenedor donde se va a cargar
 * @param  {string} url        Url que va a cargar
 * @param  {array} datos      Datos a cargar
 * @return {void}            
 */
function cargar_interfaz(contenedor, url, datos)
{
    // Carga de la interfaz
    $("#" + contenedor)/*.hide()*/.load(url, datos)/*.fadeIn('500')*/;
} // cargar_interfaz

function imprimir(mensaje){
	//Se imprime el mensaje
 	console.log(mensaje);
}//Imprimir