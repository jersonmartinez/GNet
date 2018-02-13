<!-- Start: Main -->
<div id="main" class="animated fadeIn">

  <!-- Start: Content-Wrapper -->
  <section id="content_wrapper">

    <!-- begin canvas animation bg -->
    <div id="canvas-wrapper">
      <canvas id="demo-canvas"></canvas>
    </div>

    <!-- Begin: Content -->
    <section id="content" class="animated fadeInDown">

      <div class="admin-form theme-info" id="login1">

        <div class="row mb15 table-layout">

          <div class="col-xs-6 va-m pln animated-delay" data-animate='["1000","fadeInDown"]' data-toggle="tooltip" data-placement="top" data-original-title="InterCloud Logo">
            <a href="./">
              <img src="app/controller/src/logo/logo.png" class="img-responsive w250">
            </a>
          </div>

          <div class="col-xs-6 text-right va-b pr5 animated-delay" data-animate='["500","fadeInDown"]'>
            <!-- Split button -->
            <div class="btn-group">
              <button type="button" id="btn_session" data-container="body" data-toggle="popover" data-placement="top" data-content="Seleccione el tipo de usuario con que desea iniciar sesión." class="btn btn-danger">Iniciar como</button>
              
              <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>

              <ul class="dropdown-menu" id="NewOption" role="menu">

                <?php
                  $Priv = $IC->query("SELECT * FROM ".$X."privileges WHERE state='1';");

                  if ($Priv->num_rows > 0){
                    while ($RPriv = $Priv->fetch_array(MYSQLI_ASSOC)){
                      ?>
                        <li id="<?php echo $RPriv['privileges']; ?>"><a href="#"><?php echo $RPriv['privileges']; ?></a></li>
                      <?php
                    }
                  }
                ?>
              </ul>
            </div>
          </div>

        </div>

        <div class="panel panel-info mt5 br-n">
          <div class="panel-heading heading-border bg-white"></div>
          <!-- end .form-header section -->
          <form id="FormGoLogin">
            <div class="panel-body bg-light p30">
              <div class="row animated-delay" data-animate='["200","fadeInDown"]'>
                <div class="col-sm-15 pr0">
                  <div class="section">
                    <label for="username" class="field-label text-muted fs18 mb10 LbUsername">Nombre de usuario</label>
                    <label for="username" class="field prepend-icon">
                      <input type="text" name="username" id="username" class="gui-input" placeholder="Escriba el nombre de usuario" required autofocus />
                      <label for="username" class="field-icon">
                        <i class="fa fa-user"></i>
                      </label>
                    </label>
                  </div>
                  <!-- end section -->

                  <div class="section">
                    <label for="password" class="field-label text-muted fs18 mb10">Contraseña</label>
                    <label for="password" class="field prepend-icon">
                      <input type="password" name="password" id="password" class="gui-input" placeholder="Escriba la contraseña" required />
                      <label for="password" class="field-icon">
                        <i class="fa fa-lock"></i>
                      </label>
                    </label>
                  </div>
                  <!-- end section -->

                </div>
              </div>
            </div>
            <!-- end .form-body section -->
            <div class="panel-footer clearfix p10 ph15 animated-delay" data-animate='["400","fadeInDown"]'>
              
              <button type="submit" id="BtnLogin" name="SendData" class="button btn-primary mr10 pull-right" data-toggle="tooltip" data-placement="right" data-original-title="Voy a por ello!.">Iniciar sesión</button>

              <label class="switch ib switch-primary pull-left input-align mt10">
                <input type="checkbox" name="remember" id="remember" checked>
                <label for="remember" id="rememberTwo" data-on="OK" data-off="NO"></label>
                <span>Recordar sesión</span>
              </label>
            </div>

            <input type="hidden" id="privilege" name="privilege" value="admin" />
            <!-- end .form-footer section -->
          </form>
        </div>
      </div>

    </section>
  </section>
</div>

<button type="hidden" id="BtnModalLogin" class="btn btn-primary btn-lg animated-delay" data-animate='["1700", "fadeInUp"]' data-toggle="modal" data-target="#ValidationProblemUser"></button>

<!-- Confirmar sus datos, estado de verificación -->
<div class="modal fade" id="ValidationProblemUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirmación de los datos</h4>
      </div>
      <div class="modal-body">
        <p><b>En el proceso de verificación de los datos nos dimos cuenta qué: </b></p>
        
      </div>
      <div class="row">
          <div class="col-xs-2" style="margin-left: 50px;">
            <i class="fa fa-frown-o fa-5x" aria-hidden="true"></i>
          </div>
          <div class="col-xs-8 InstallationSuccessData" style="margin-top: 10px;">
            <p class="VerifyInformation"></p>
          </div>
        </div>

      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> -->
        <button type="button" class="btn btn-primary" data-dismiss="modal">De acuerdo</button>
      </div>
    </div>
  </div>
</div>
</div>

<?php include ("app/core/ic.foot.php"); ?>