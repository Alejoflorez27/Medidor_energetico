<!--Clase  en la cual van a ver dos secciones-->
<div class="content-wrapper">
  <!--En esta seccion hay un contenido en encabezado de la cual hay una barra para volver a inicio-->
  <section class="content-header">

    <h1>

     Administrar productos

     <small>Panel de control</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar productos</li>

    </ol>

  </section>


  <!--Seccion en la cual va a ver un boton de agregar un producto el cual utiliza un modal--> 
  <section class="content">

   <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-danger" data-toggle="modal" data-target="#modalAgregarProducto">
          
          Agregar productos
        </button>
    
      </div>

    

    <div class="box-body">
      
      <table class="table table-bordered table-striped dt-responsive tablas">
        
        <thead>
          
          <tr>
            
            <th style="width: 10px">#</th>
            <th>Imagen</th>
            <th>Código</th>
            <th>Descripción</th>
            <th>Categoría</th>
            <th>Stock</th>
            <th>Precio de compra</th>
            <th>Precio de venta</th>
            <th>Agregado</th>
            <th>Acciones</th>

          </tr>

        </thead>

        <tbody>

        <?php

          //Para mandar los valores nulos
          $item = null;
          $valor = null;

          //Para mostrar los productos
          $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

          //Para listar los productos que se encuentran en el array 
          //var_dump($productos);

          foreach ($productos as $key => $value) {

            echo '<tr>
                  
                    <td>'.($key+1).'</td>
                    <td><img src="vistas\img\productos\default\anonymous.png" class="img-thumbnail" width="40px"></td>
                    <td>'.$value["codigo"].'</td>
                    <td>'.$value["descripcion"].'</td>';

                    $item = "id";
                    $valor = $value["id_categoria"];

                    //Solicitamos una respuesta de la categoria reciclado metodos
                    $categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                    echo '<td>'.$categoria["categoria"].'</td>
                            <td>'.$value["stock"].'</td>
                            <td>$ '.$value["precio_compra"].'</td>
                            <td>$ '.$value["precio_venta"].'</td>
                            <td>'.$value["fecha"].'</td>
                            <td>
                              
                              <div class="btn-group">
                                
                                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                                <button class="btn btn-danger"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR PRODUCTO
=======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">
      <!--Como se van a subir archivos se pone el enctype-->
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        =======================================-->

        <div class="modal-header" style="background:#dd4b39; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        =======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--ENTRADA PARA EL CÓDIGO-->
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar código" required>

              </div>

            </div>

            <!--ENTRADA PARA LA DESCRIPCIÓN-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" required>

              </div>

            </div>

            <!--ENTRADA PARA SELECCIONAR CATEGORÍA-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" name="nuevaCategoria">
                  
                  <option value="">Seleccione categoría</option>

                  <option value="Taladros">Rock</option>

                  <option value="Andamios">Salsa</option>

                  <option value="Equipos para construcción">Pop</option>

                </select>

              </div>

            </div>

            <!--<div class="form-group">
            <label class="col-form-label" for="inputSuccess"><i class="fas fa-users"></i> Perfil </label>
            <select class="form-control" id="nuevoPerfil" name="nuevoPerfil" required>
              <option value="">Selecionar perfil</option>
              <?php
              /*$item = null;
              $valor = null;
              $generos = ControladorCategorias::ctrMostrarCategorias($item, $valor);
              foreach ($perfiles as $key => $value) {
                echo '<option value="' . $value["id"] . '">' . $value["descripcion"] . '</option>';
              }*/
              ?>
            </select>
          </div>-->

            <!--ENTRADA PARA STOCK-->

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock" required>

              </div>

            </div>

            <!--ENTRADA PARA PRECIO COMPRA-->

            <div class="form-group row">

              <div class="col-xs-6">
              
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                  <input type="number" class="form-control input-lg" name="nuevoPrecioCompra" min="0" placeholder="Precio de compra" required>

                </div>

              </div>

              <!--ENTRADA PARA PRECIO VENTA-->
              <div class="col-xs-6">

                <div class="input-group">
                    
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                  <input type="number" class="form-control input-lg" name="nuevoPrecioVenta" min="0" placeholder="Precio de venta" required>

                </div>

                <br>

                <!--CHECKBOX PARA PORCENTAJE-->

                <div class="col-xs-6">
                  
                  <div class="form-group">
                    
                    <label>
                      
                      <input type="checkbox" class="minimal porcentaje" checked>

                      Utilizar porcentaje

                    </label>

                  </div>

                </div>

                <!--ENTRADA PARA PORCENTAJE-->

                <div class="col-xs-6" style="padding:0">
                  
                  <div class="input-group">
                    
                    <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

              </div>

            </div>

            <!--ENTRADA PARA EL SUBIR FOTO-->

            <div class="form-group">
              
              <div class="panel text">SUBIR IMAGEN</div>

              <input type="file" id="nuevoImagen" name="nuevoImagen">

              <p class ="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas\img\productos\default\anonymous.png" class="img-thumbnail" width="100px">

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
          <button type="submit" class="btn btn-danger">Guardar producto</button>

        </div>



      </form>

    </div>

  </div>

</div>