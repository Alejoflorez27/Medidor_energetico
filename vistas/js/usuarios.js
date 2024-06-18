/* ============================================= 
SUBIENDO LA FOTO DEL USUARIO
==============================================*/

$(".nuevaFoto").change(function() {

	//utilizando la consola de js nos damos cuenta de la posicion
	var imagen = this.files[0];
	//console.log("imagen");  //consola de javscript

	/* ============================================= 
	VALIDAMOS EL FORMATO DE LA IMAGEN SE JPG O PNG
	==============================================*/

	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

		//Refrescamos lo que este
		$(".nuevaFoto").val("");

		//Sacamos un mensaje de alerta en caso de no ser del formato correcto
		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen debe de estar en formato JPG o PNG!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	}else if (imagen["size"] > 2000000) {

		//Refrescamos lo que este
		$(".nuevaFoto").val("");

		//Sacamos un mensaje de alerta en caso que pase de tamaño de 2MB
		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen no debe pesar más 2MB!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	}else{

		//Creamos una objeto de tipo FileReader para leer el fichero de la imagen
		var datosImagen = new FileReader;

		//Se usa para leer el contenido de un file o un blog (especificado)
		datosImagen.readAsDataURL(imagen);

		//Utilizando un metodo de jQuery el cual se dispara cuando termina de cargar un recurso
		$(datosImagen).on("load",function(event){

			//A rutaImagen le ponen lo de la function cuando termina la carga
			var rutaImagen = event.target.result;

			//Esto se esta llamando de la clase de la etiqueta img de nuevaFoto
			$(".previsualizar").attr("src", rutaImagen);

		})

	}


})

/*============================================= 
EDITAR USUARIO
==============================================*/
//Se realiza de esta manera para que al momento de editar en un movil me presente la info de un usuario
$(document).on("click", ".btnEditarUsuario", function(){

	var idUsuario = $(this).attr("idUsuario");

	//me permite revisar que este correcto el id de cada usuario
	//console.log("idUsuario",idUsuario);

	var datos = new FormData();
	datos.append("idUsuario", idUsuario);

	$.ajax({

		url: "ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache:false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			//Permite ver el usuario a editar con sus respectivos datos desde la consola con datos tipo jason
			//console.log("respuesta", respuesta);

			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			//Esto se hace de esta manera (html) devido a que es un options en la vista
			$("#editarPerfil").html(respuesta["perfil"]);
			$("#editarPerfil").val(respuesta["perfil"]);
			$("#fotoActual").val(respuesta["foto"]);


			$("#passwordActual").val(respuesta["password"]);

			if (respuesta["foto"] != "") {

				$(".previsualizar").attr("src", respuesta["foto"]);
			}

		}
	});

})

/*============================================= 
ACTIVAR USUARIO
==============================================*/

$(document).on("click", ".btnActivar", function(){

	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	//Se va a solicitar en el archivo de ajax que realize las actualizaciones en la BD de acuerdo con el archivo ajax
	var datos = new FormData();
	datos.append("activarId",idUsuario);
	datos.append("activarUsuario",estadoUsuario);

	$.ajax({

	  url: "ajax/usuarios.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
	  contentType: false,
	  processData: false,
	  success: function(respuesta){

	  	//Le vamos a preguntar si estamos en una resolucion pequeña
	  	if (window.matchMedia("(max-width:767px)").matches) {

		  //Se crea una alerta suave para decir que ha sido actualizado
		  swal({

		    title: 'El usuario a sido actualizado',			//Aqui se crea el titlo de la alerta suave
		    type: 'success',										//Aqui se le dice de que va a ser la alerta suave
		    confirmButtonText: '¡Cerrar!'							//Texto del boton de ¡Cerrar!

		    //Este result se escribe de esta manera para que sea soportado en internet explorer 11
		    }).then(function(result){

			    if(result.value){ //Si la variable existe Realiza el direccionamiento

			      window.location = "usuarios";

			    }

		  	});

	  	}
	  		
	  }

	})


	//Es para cambiar el estado del usuario en la parte de la vista si el estado es cero 
	if (estadoUsuario == 0) {

		$(this).removeClass('btn-success'); //Se remueve la parte de activo 
		$(this).addClass('btn-danger');     //Se le adiciona un boton de tipo desactivado
		$(this).html('Desactivado');        //Se le muestra ese cambio en el html
		$(this).attr('estadoUsuario',1);    //Se le coloca el atributo que biene de estadoUsuario

	}else{ //si estado es uno

		$(this).addClass('btn-success');    //Se le adiciona un botón de tipo activo
		$(this).removeClass('btn-danger');  //Se remueve a la parte de desctivado
		$(this).html('Activado');           //Se muestra ese cambio en el html
		$(this).attr('estadoUsuario',0);    //Se coloca el estadoUsuario con su atributo

	}


})

/* ============================================= 
REVISAR SI EL USUARIO YA ESTÁ REGISTRADO
==============================================*/

$("#nuevoUsuario").change(function(){

	$(".alert").remove();

	var usuario = $(this).val();

	var datos = new FormData();
	datos.append("validarUsuario", usuario);

	 $.ajax({
	 	url:"ajax/usuarios.ajax.php",
	 	method:"POST",
	 	data:datos,
	 	cache: false,
	 	contentType: false,
	 	processData: false,
	 	dataType: "json",

	 	success:function(respuesta){

	 		//Para ver si el usuario existe o no en la hora del registro
	 		//console.log("respuesta", respuesta);

	 		if (respuesta) {

	 			$("#nuevoUsuario").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de base de datos</div>')

	 			$("#nuevoUsuario").val("");

	 		}
	 	}


	 })


})

/*=============================================
ELIMINAR USUARIO
=============================================*/
$(document).on("click", ".btnEliminarUsuario", function(){

  //Se crean las varibles para las variables que vienen de la vista
  var idUsuario = $(this).attr("idUsuario");
  var fotoUsuario = $(this).attr("fotoUsuario");
  var usuario = $(this).attr("usuario");

  //Se crea una alerta suave para decir que la accion de borrar ha sido exitosa
  swal({

    title: '¿Está seguro de borrar el usuario?',			//Aqui se crea el titlo de la alerta suave
    text: "¡Si no lo está puede cancelar la accíón!",		//Aqui se le pone el texto a la alerta suave
    type: 'warning',										//Aqui se le dice de que va a ser la alerta suave
    showCancelButton: true,									//Aqui se le dice que el botón es visble
    confirmButtonColor: '#3085d6',							//Se le dice el color del botón de Si, borrar usuario!
    cancelButtonColor: '#d33',								//Se le dice el color del botón de cancelar
    cancelButtonText: 'Cancelar',							//Texto del boton de cancelar
    confirmButtonText: 'Si, borrar usuario!'				//Texto del boton de Si, borrar usuario!

     //Este result se escribe de esta manera para que sea soportado en internet explorer 11
  }).then(function(result){

    if(result.value){ //Si la variable existe Realiza el direccionamiento

      window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;

    }

  })

})