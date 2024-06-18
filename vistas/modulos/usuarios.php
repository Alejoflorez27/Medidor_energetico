  <!--Clase  en la cual van a ver dos secciones-->
<div class="content-wrapper">
  <!--En esta seccion hay un contenido en encabezado de la cual hay una barra para volver a inicio-->
  <section class="content-header">

    <h1>

     Administrar usuario

     <small>Panel de control</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar usuarios</li>

    </ol>

  </section>


  <!--Seccion en la cual va a ver un boton de agregar un usuario el cual utiliza un modal--> 
  <section class="content">

   <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-danger" data-toggle="modal" data-target="#modalAgregarUsuario">
          
          Agregar usuario
        </button>
    
      </div>

    
    <!--Parte donde va la tabla con sus campos-->
    <div class="box-body">
      
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        
        <thead>
          
          <tr>
            
            <th style="width: 10px">#</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Foto</th>
            <th>Perfil</th>
            <th>Estado</th>
            <th>Último login</th>
            <th>Acciones</th>

          </tr>

        </thead>

        <tbody>


          <?php

          //se ponen en vacio
          $item = null;
          $valor = null;

          //En esta parte vamos a mostrar la parte de la informacion en la BD en la tabla de vistas
          $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

          //Esto es una prueba para mirar si la informacion esta, que viene de la BD
          //var_dump($usuarios);

          //Se hace un foreach para imprimir los indices de la tabla de BD para cada item
          foreach ($usuarios as $key => $value) {
            
              //Para ser visibles a los usuarion en la parte de la tabla de usuarios todo esto es traido de la BD y conserva configuracion por defecto
              echo '<tr>
                    <td>'.($key+1).'</td>
                    <td>'.$value["nombre"].'</td>
                    <td>'.$value["usuario"].'</td>';

                    //Es para mirar si hay foto en ese item si si se pone la que se fue subida sino la que esta por defecto
                    if ($value["foto"] != "") {
                      
                      echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';

                    }else{

                      echo '<td><img src="vistas\img\usuarios\default\anonymous.png" class="img-thumbnail" width="40px"></td>';

                    }

                    //Se le indica el rol que tiene en la pagina web y lo demas que tien la tabla y falta por habilitar
                    echo '<td>'.$value["perfil"].'</td>';

                    //Se revisa en la vase de datos por medio de las variables de secion se revisa el estado en el que se encuentra el usuario de lo contrario estara desactivado
                    if ($value["estado"] != 0) {
                      
                      echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'"estadoUsuario="0">Activado</button></td>';

                    }else{

                      echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["id"].'"estadoUsuario="1">Desactiado</button></td>';

                    }
       
                    echo '<td>'.$value["ultimo_login"].'</td>
                            <td>
                              
                              <div class="btn-group">
                                
                                <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>

                                <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'"fotoUsuario="'.$value["foto"].'"usuario="'.$value["usuario"].'"><i class="fa fa-times"></i></button>

                              </div>

                          </td>

                        </tr>';

                    }

                    ?>
 

        </tbody>

      </table>

    </div>

  </div>

</section>


</div>

<!--=====================================
MODAL AGREGAR USUARIO
=======================================-->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">
      <!--enctype para las imagenes-->
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        =======================================-->
        <div class="modal-header" style="background:#dd4b39; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        =======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--ENTRADA PARA EL NOMBRE-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!--ENTRADA PARA EL USUARIO-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" required>

              </div>

            </div>

            <!--ENTRADA PARA EL CONTRASEÑA-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>

              </div>

            </div>

            <!--ENTRADA PARA EL PERFIL-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="nuevoPerfil">
                  
                  <option value="">Seleccione perfil</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Especial</option>

                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

            <!--ENTRADA PARA EL SUBIR FOTO-->

            <div class="form-group">
              
              <div class="panel text">SUBIR FOTO</div>

              <!--La foto se pone en una clase para luego ser mas facil editarla-->
              <input type="file" class="nuevaFoto" name="nuevaFoto">

              <p class ="help-block">Peso máximo de la foto 200 MB</p>

              <img src="vistas\img\usuarios\default\anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>          

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        =======================================-->

        <div class="modal-footer" >

          <!--Boton generico sale de una del modal-->
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <!--Boton de envio de datos al agregar un usuario nuevo-->
          <button type="submit" class="btn btn-danger">Guardar usuario</button>

        </div>

        <?php

            //creo un objeto de la clase ControladorUsuarios
            $crearUsuario = new ControladorUsuarios();
            //llamo un metodo de la clase ControladorUsuarios que es ctrCrearUsuario
            $crearUsuario -> ctrCrearUsuario();

        ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR USUARIO
=======================================-->
<div id="modalEditarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        =======================================-->

        <div class="modal-header" style="background:#dd4b39; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        =======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--ENTRADA PARA EL NOMBRE-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>

              </div>

            </div>

            <!--ENTRADA PARA EL USUARIO-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <!--Esto va a funcionar para los campos del modal y que aparesca la info en el campo de usuario ademas se bloque al editar para evitar conflicto y carpetas basura con otras carpetas (readonly)-->
                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>

              </div>

            </div>

            <!--ENTRADA PARA EL CONTRASEÑA-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">

                <!--Esto se usa para ocultar debido a que al actualizar en la BD lo realiza en todos los campos asi no hayan sido afectados por ende se oculta y el id se usa en el js de usuario -->
                <input type="hidden" id="passwordActual" name="passwordActual">

              </div>

            </div>

            <!--ENTRADA PARA EL PERFIL-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="editarPerfil">
                  
                  <option value="" id="editarPerfil"></option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Especial</option>

                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

            <!--ENTRADA PARA EL SUBIR FOTO-->

            <div class="form-group">
              
              <div class="panel text">SUBIR FOTO</div>

              <!--La foto se pone en una clase para luego ser mas facil editarla-->
              <input type="file" class="nuevaFoto" name="editarFoto">

              <p class ="help-block">Peso máximo de la foto 200 MB</p>

              <img src="vistas\img\usuarios\default\anonymous.png" class="img-thumbnail previsualizar" width="100px"> 

              <input type="hidden" name="fotoActual" id="fotoActual">

            </div>          

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        =======================================-->

        <div class="modal-footer">

          <!--Boton generico sale de una del modal-->
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <!--Boton de envio de datos al agregar un usuario nuevo-->
          <button type="submit" class="btn btn-danger">Modificar usuario</button>

        </div>

        <?php

            //creo un objeto de la clase ControladorUsuarios
            $editarUsuario = new ControladorUsuarios();
            //llamo un metodo de la clase ControladorUsuarios que es ctrEditarUsuario
            $editarUsuario -> ctrEditarUsuario();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  //creo un objeto de la clase ControladorUsuarios
  $borrarUsuario = new ControladorUsuarios();

  //llamo un metodo de la clase ControladorUsuarios que es ctrEditarUsuario
  $borrarUsuario -> ctrBorrarUsuario();

?>