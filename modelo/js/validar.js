
function soloNumeros(e){
	key = e.keyCode || e.which;
	teclado = String.fromCharCode(key);
	numeros = "0123456789";
	especiales = "8-37-38-46";
	teclado_especial = false;

	for(var i in especiales){
		if (key == especiales[i]) {
			teclado_especial = true;
		}
	}
	if (numeros.indexOf(teclado)==-1 && !teclado_especial) {
		return false;
	}
}

function soloLetras(e){
	key = e.keyCode || e.which;
	teclado = String.fromCharCode(key);
	numeros = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
	especiales = "8-37-38-46";
	teclado_especial = false;

	for(var i in especiales){
		if (key == especiales[i]) {
			teclado_especial = true;
		}
	}
	if (numeros.indexOf(teclado)==-1 && !teclado_especial) {
		return false;
	}
}

function validarProyecto(){
	var tipo = document.getElementById("tipoproyecto");
	var texto = tipo.options[tipo.selectedIndex].text;
   	if (texto != "INSTRUCTOR") {
   		document.getElementById("notamateria").disabled = true;
   		document.getElementById("cum").disabled = true;
   	}
   	else{
   		document.getElementById("notamateria").disabled = false;	
   		document.getElementById("cum").disabled = false;
   	}

}