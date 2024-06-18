    <!--Clase  en la cual van a ver dos secciones-->
<div class="content-wrapper">
  <!--En esta seccion hay un contenido en encabezado de la cual hay una barra para volver a inicio-->
  <section class="content-header">

    <h1>

     Administrar Generos

     <small>Panel de control</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Generos</li>

    </ol>

  </section>


  <!--Seccion en la cual va a ver un boton de agregar una categoría el cual utiliza un modal--> 
  <section class="content">

   <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-danger" data-toggle="modal" data-target="#modalAgregarCategoria">
          
          Agregar Generos
        </button>
    
      </div>

    <div class="box-body">
      
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        
        <thead>
          
          <tr>
            
            <th style="width: 10px">#</th>
            <th>Genero Musical</th>
            <th>Descripción</th>
            <th>Año</th>
            <th>Acciones</th>

          </tr>

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          //La siguiente variable solicita ya se mostrar un categoria o varias
          $generos = ControladorCategorias::ctrMostrarCategorias($item, $valor);

          //Para revisar que trae categorias
          //var_dump($categorias);

          //El foreach lo hacemos devido a que existe un array
          foreach ($generos as $key => $value) {
            
            echo '<tr>
            
                    <td>'.($key+1).'</td>

                    <td class="text-uppercase">'.$value["nom_genero"].'</td>
                    <td class="text-uppercase">'.$value["descripcion"].'</td>
                    <td class="text-uppercase">'.$value["ano"].'</td>

                    <td>
                      
                      <div class="btn-group">
                        
                        <button class="btn btn-warning btnEditarCategoria" idCategoria="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnEliminarCategoria" idCategoria="'.$value["id"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR CATEGORÍA
=======================================-->

<div id="modalAgregarCategoria" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        =======================================-->

        <div class="modal-header" style="background:#dd4b39; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar genero</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        =======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--ENTRADA PARA CATEGORIAS-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaCategoria" placeholder="Ingresar Genero Musical" required>

              </div>

            </div>
            <!--ENTRADA PARA DESCRIPÓN-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripcion" required>

              </div>

            </div>
            
            <!--ENTRADA PARA AÑO-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="number" class="form-control input-lg" name="nuevaAno" placeholder="Ingresar Año" required>

              </div>

            </div>  
   
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        =======================================-->

        <div class="modal-footer">

          <!--boton generico-->
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <!--boton de envio-->
          <button type="submit" class="btn btn-danger">Guardar Genero</button>

        </div>

        <?php
          //Creo el objeto de la clase ControladorCategorias y invoco un metodo de esa clase
          $crearCategoria = new  ControladorCategorias();
          $crearCategoria -> ctrCrearCategoria();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CATEGORÍA
=======================================-->

<div id="modalEditarCategoria" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        =======================================-->

        <div class="modal-header" style="background:#dd4b39; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Genero</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        =======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--ENTRADA PARA CATEGORIAS-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="editarCategoria" id="editarCategoria" required>

                <!--input oculto para guardar el id-->
                <input type="hidden" name="idCategoria" id="idCategoria" required>

              </div>

            </div>

            <!--ENTRADA PARA DESCRIPÓN-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="editarDescripcion" id="editarDescripcion" required>

              </div>

            </div>

            <!--ENTRADA PARA DESCRIPÓN-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="number" class="form-control input-lg" name="editarAno" id="editarAno" required>

              </div>

            </div>
   
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        =======================================-->

        <div class="modal-footer">

          <!--boton generico-->
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <!--boton de envio-->
          <button type="submit" class="btn btn-danger">Guardar cambios</button>

        </div>

        <?php

          //Creo el objeto de la clase ControladorCategorias y invoco un metodo de esa clase
          $editarCategoria = new  ControladorCategorias();
          $editarCategoria -> ctrEditarCategoria();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  //Creo el objeto de la clase ControladorCategorias y invoco un metodo de esa clase
  $borrarCategoria = new  ControladorCategorias();
  $borrarCategoria -> ctrBorrarCategoria();

?>