(function($){
  $.fn.extend({
    enviarDatos: function(opciones) {
      var defaults = {
	ignoreColumn: [],
	escape: true,
	htmlContent: false,
	consoleLog: false,
	type: 'xml',
	file: 'horarios'
      };
      var opciones = $.extend(defaults,opciones);
      var tabla = this;
      switch(defaults.file) {
	case "horarios":
	  var carnet = $("#carnet").val();
	  var tipoins = $(".tipoinscripcion:checked").val();
	  var tipopro = $("#tipoproyecto option:selected").val();
	  var numhrs = $("#numerodehoras").val();
	  var alumnos = $("#alumnosatendidos").val();
	  var notamat = $("#notamateria").val();
	  var nompro = $("#nombreproyecto").val();
	  var inst = $("#institucion").val();
	  var dirin = $("#direccioninstitucion").val();
	  var telfijo = $("#fijoIns").val();
	  var telmovil = $("#celularIns").val();
	  var nomcon = $("#nombrecontacto").val();
	  var fechaini = $("#fechaini").val();
	  var fechafin = $("#fechafin").val();
	  var fecha = $("#fecha").val();
	  var tutor = $("#tutor option:selected").val();
	  if(defaults.type == 'xml') {
	    var horarios = crearXml();
	    }else if(defaults.type == 'excel') {
	      var horarios = crearExcel();
	}
	  $.ajax({
	  type: 'POST', 
	  url: 'salvarregistros.php', 
	  data: {'horarios': horarios, 'tipoins': tipoins, 'tipopro': tipopro, 'numhrs': numhrs, 'carnet': carnet,
			  'alumnos': alumnos, 'notamat': notamat, 'nompro': nompro,
			  'inst': inst, 'dirin': dirin, 'telfijo': telfijo,
			  'telmovil': telmovil, 'nomcon': nomcon, 'fechaini': fechaini,
			  'fechafin': fechafin, 'fecha': fecha, 'tutor': tutor
	  },
	  dataType: 'text',
	  success: function(arg1,arg2){
	    switch (arg1) {
	      case "0":
		alert("Hubo un error al guardar los datos");
		break;
	      case "1":
		alert("Proyecto guardado con exito");
		break;
	    }      
	  },
	  error: function(arg1,arg2,arg3) {
	    alert("Error:\n"+arg2);
	  }
	  });
	  break;
	case "controltiempo":
	  var idproyecto = $("#idproyecto").val();
	  var estudiante = $("#nombreestudiante").val();
	  var tutor = $("#tutor").val();
	  var nombreproyecto = $("#nombreproyecto").val();
	  var observaciones = $("#observaciones");
	  var fecha = $("#fecha").val();
	  var carrera = $("#carrera").val();
	  var fechaini = $("#fechaini").val();
	  var fechafin = $("#fechafin").val();
	  break;
	case "informeservicio":
	  var idproyecto = $("#idproyecto").val();
	  var objetivogeneral = $("#objetivogeneral").val();
	  var objetivoespecifico = $("#especifico").val();
	  var fecha = $("fecha").val();
	  break;
	case "planejecucion":
	  var idproyecto = ("#idproyecto").val();
	  var carnet = $("#carnet").val();
	  var estudiante = $("#nombreestudiante").val();
	  var carrera = $("#codigocarrera").val();
	  var deparpais = $("#deparpais").val();
	  var municipio = $("#municipio");
	  var tutor = $("#tutor").val();
	  var departutor = $("#departutor").val()
	  var objetivogeneral = $("#objetivogeneral").val();
	  var objetivoespecifico = $("#especifico").val();
	  break;
	case "hojaevaluacion":
	  var idproyecto = $("#idproyecto").val();
	  var estudiante = $("#nombreestudiante").val();
	  var nombreproyecto = $("#nombreproyecto").val();
	  var institucion = $("#institucion").val();
	  var tutor = $("#tutor").val();
	  var contacto = $("#contacto").val();
	  var observaciones = $("#observaciones");
	  var fecha = $("#fecha").val();
	  if(defaults.type == 'xml') {
	    
	  }
	  break;
      }
      
      /*
       * Funcion que permite escapar caracteres especiales
       * o guardar la tabla con el contenido HTML de la misma
       * como los atributos de las <td>. No usar htmlContent = true si el archivo
       * es XML
       */
      function parseString(data){				
	if(defaults.htmlContent == 'true'){
		content_data = data.html().trim();
	}else{
		content_data = data.text().trim();
	}
	
	if(defaults.escape == 'true'){
		content_data = escape(content_data);
	}
	return content_data;
      }
      
      /*
       * Funcion para crear el archivo XML de los datos de la tabla
       */
      function crearXml() {
	var xml = '<?xml version="1.0" encoding="utf-8"?>';
	xml += '<tabledata><fields>';

	// Header
	$(tabla).find('thead').find('tr').each(function() {
		$(this).filter(':visible').find('th').each(function(index,data) {
			if ($(this).css('display') != 'none'){					
				if(defaults.ignoreColumn.indexOf(index) == -1){
					xml += "<field>" + parseString($(this)) + "</field>";
				}
			}
		});									
	});					
	xml += '</fields><data>';
	
	// Row Vs Column
	var rowCount=1;
	$(tabla).find('tbody').find('tr').each(function() {
		xml += '<row id="'+rowCount+'">';
		var colCount=0;
		$(this).filter(':visible').find('td').each(function(index,data) {
			if ($(this).css('display') != 'none'){	
				if(defaults.ignoreColumn.indexOf(index) == -1){
					xml += "<column-"+colCount+">"+parseString($(this))+"</column-"+colCount+">";
				}
			}
			colCount++;
		});															
		rowCount++;
		xml += '</row>';
	});					
	xml += '</data></tabledata>'
	
	if(defaults.consoleLog == 'true'){
		console.log(xml);
	}
	
	return xml;
      }
      
      /*
       * Funcion para crear el archivo de Excel de los datos de la tabla
       */
      function crearExcel() {
	var excel="<table>";
	// Header
	$(tabla).find('thead').find('tr').each(function() {
		excel += "<tr>";
		$(this).filter(':visible').find('th').each(function(index,data) {
			if ($(this).css('display') != 'none'){					
				if(defaults.ignoreColumn.indexOf(index) == -1){
					excel += "<td>" + parseString($(this))+ "</td>";
				}
			}
		});	
		excel += '</tr>';						
		
	});					
	
	
	// Row Vs Column
	var rowCount=1;
	$(tabla).find('tbody').find('tr').each(function() {
		excel += "<tr>";
		var colCount=0;
		$(this).filter(':visible').find('td').each(function(index,data) {
			if ($(this).css('display') != 'none'){	
				if(defaults.ignoreColumn.indexOf(index) == -1){
					excel += "<td>"+parseString($(this))+"</td>";
				}
			}
			colCount++;
		});															
		rowCount++;
		excel += '</tr>';
	});					
	excel += '</table>'
	
	if(defaults.consoleLog == 'true'){
		console.log(excel);
	}
	
	var excelFile = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:x='urn:schemas-microsoft-com:office:"+defaults.type+"' xmlns='http://www.w3.org/TR/REC-html40'>";
	excelFile += "<head>";
	excelFile += "<!--[if gte mso 9]>";
	excelFile += "<xml>";
	excelFile += "<x:ExcelWorkbook>";
	excelFile += "<x:ExcelWorksheets>";
	excelFile += "<x:ExcelWorksheet>";
	excelFile += "<x:Name>";
	excelFile += "{worksheet}";
	excelFile += "</x:Name>";
	excelFile += "<x:WorksheetOptions>";
	excelFile += "<x:DisplayGridlines/>";
	excelFile += "</x:WorksheetOptions>";
	excelFile += "</x:ExcelWorksheet>";
	excelFile += "</x:ExcelWorksheets>";
	excelFile += "</x:ExcelWorkbook>";
	excelFile += "</xml>";
	excelFile += "<![endif]-->";
	excelFile += "</head>";
	excelFile += "<body>";
	excelFile += excel;
	excelFile += "</body>";
	excelFile += "</html>";
	
	return excelFile;
      }
      
    }
  });
})(jQuery); 