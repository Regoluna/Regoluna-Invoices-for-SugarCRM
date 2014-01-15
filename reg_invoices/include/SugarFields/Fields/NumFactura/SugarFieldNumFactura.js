var Dom = YAHOO.util.Dom;
var originalBgColor = '#FFFFFF';
var texto, autogen, autogenText, boton;

function inicializarNumero(id){
	texto = document.getElementById(id);
	autogen = document.getElementById(id + '_autogen');
	autogenText = document.getElementById(id + '_autogenspan');
	boton = document.getElementById(id + '_changeb');
	if(trim(texto.value) != ""){
		textoNoEditable(texto);
		ocultar(autogenText);
		mostrar(boton);
	}else{
		checkboxCambiado();
	}
}

function editarTexto(id){
  textoEditable(texto);
  mostrar(autogenText);
  ocultar(boton);
}

function textoEditable(texto){
	texto.removeAttribute('readOnly');
	Dom.setStyle(texto, 'backgroundColor', originalBgColor);
}

function textoNoEditable(texto){
	texto.setAttribute('readOnly',true);
	Dom.setStyle(texto, 'backgroundColor', '#DCDCDC');
}

function checkboxCambiado(){
	if(autogen.checked){
		textoNoEditable(texto);
		ocultar(texto);
	}else{
		textoEditable(texto);
		mostrar(texto);
	}
}

function ocultar(objeto){ Dom.setStyle(objeto, 'display', 'none'); }
function mostrar(objeto){ Dom.setStyle(objeto, 'display', 'inline'); }

inicializarNumero(id_campo_nombre);