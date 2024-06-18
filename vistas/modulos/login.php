<!--En esta parte se llama el metodo del logo-page #back que es donde esta las caracteristicas
es posible acceder a esta mediante el login-page que contiene el body en plantilla.php-->
<div id="back"></div>

<!--En esta parte se va llevar a cabo la parte del login-->
<div class="login-box">

  <!--En esta parte se va llevar a cabo la parte del logo del login-->
  <div class="login-logo">

    <img src="vistas/img/plantilla/sci_high.jpeg" class=
    "img-responsive" style="padding:30px 100px 0px 100px">

  </div>

 <!--la clase login-box-body sirve para la caja de donde se ingresa el
  usuario, contraseña y el boton ingresar -->
  <div class="login-box-body">
    <!--Parrafo del titulo-->
    <h2 class="login-box-msg">Medidor Energetico</h2>

    <!--metodo con el cual se ingresa el usuario, contraseña y el botton ingresar-->
    <form method="post">

      <!--Parte del usuario-->
      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <!--Parte de la contraseña-->
      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword"required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

      </div>
      
      <!--Parte del boton-->
      <div class="row">
        <!--Parte la version de columnas para movil-->
        <div class="col-xs-12">

          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>

        </div>
        
      </div>

      <?php

        //creo un objeto de la clase ControladorUsuarios
        $login = new ControladorUsuarios();
        //llamo un metodo de la clase ControladorUsuarios que es ctrIngrsoUsuario
        $login -> ctrIngresoUsuario();

      ?>

    </form> 

  </div>
  
</div>
