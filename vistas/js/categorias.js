/*==============================
EDITAR CATEGORIA
==============================*/

$(".btnEditarCategoria").click(function(){

	//Creo una variable para guardar una variable post
	var idCategoria = $(this).attr("idCategoria");

	//Creo un objeto de tipo ajax llamado FormData en el cual va a guardar los datos
	var datos = new FormData();
	datos.append("idCategoria", idCategoria);

	$.ajax({

		//Creo el archivo de ajax para faciltar la comunicacion con la base de datos
		url: "ajax/categorias.ajax.php",
		method: "POST",
		data: datos,
		cache:false,
		contentType: false,
		processData: false,
		dataType: "json",

		success: function(respuesta){

			$("#editarCategoria").val(respuesta["nom_genero"]);
			$("#editarDescripcion").val(respuesta["descripcion"]);
			$("#editarAno").val(respuesta["ano"]);
			$("#idCategoria").val(respuesta["id"]);
			//Para observar los datos tipo son
			//console.log("respuesta",respuesta);




		}


	})

})

/*==============================
ELIMINAR CATEGORIA
==============================*/

$(".btnEliminarCategoria").click(function(){

	//Creo una variable para guardar una variable post
	var idCategoria = $(this).attr("idCategoria");
 
	//Una alerta suave para borrar una categoria
	swal({

		title: '¿Está seguro de borrar el genero?',
		text: "¡Si no lo está puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar genero!'
	 }).then((result)=>{

	 	//Si result viene en verdadero
	 	if(result.value){

	 		//esto es para una variable get para borrar desde el controlador endpoints
	 		window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;

	 	}


	 })

})
