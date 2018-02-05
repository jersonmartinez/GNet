<?php include (PD_CONTROLLER_PHP."/ic.CalcDate.php"); ?>

<!-- Start: Main -->
  <div id="main" class="animated fadeIn">

    <!-- Start: Content-Wrapper -->
    <section id="content_wrapper">

      <!-- begin canvas animation bg -->
      <div id="canvas-wrapper">
        <canvas id="demo-canvas"></canvas>
      </div>

      <!-- Begin: Content -->
      <section id="content">

        <div class="admin-form theme-info mw600" style="margin-top: 13%;" id="login">
          <div class="row mb15 table-layout">

            <div class="col-xs-6 pln">
              <a href="./" title="InterCloud Logo">
                <img src="app/controller/src/logo/logo.png" title="InterCloud Logo" class="img-responsive w250">
              </a>
            </div>

            <div class="col-xs-6 text-right va-b pr5">
              <div class="login-links">
                <a href="#" class="" onclick="javascript: ChangeUser();" title="Escribir un usuario diferente">Acceder con otro usuario</a>
              </div>

            </div>

          </div>
          <div class="panel panel-info heading-border br-n">

            <!-- end .form-header section -->
            <form id="FormSessionActive">
              <div class="panel-body bg-light pn">

                <div class="row table-layout">
                  <div class="col-xs-3 p20 pv15 va-m br-r bg-light">
                    <img class="br-a bw4 br-grey img-responsive center-block" src="app/controller/src/logo/user.png" title="AdminDesigns Logo">
                  </div>
                  <div class="col-xs-9 p20 pv15 va-m bg-light">

                    <h3 class="mb5"><?php echo @$GameResult['usr']; ?>
                      <small> - Logueado 
                        <b>
                          <?php 
                          $GetLogout = "SELECT * FROM ".$X."control_logout WHERE usr='".@$GameResult['usr']."' AND ip='".$Config->getIpAddr()."' AND remember='1' ORDER BY id DESC LIMIT 1;";

                          $RLogout = $IC->query($GetLogout)->fetch_array(MYSQLI_ASSOC);

                            echo nicetime(date("Y-m-d H:i", $RLogout['date_log_unix'])); 
                          ?> 
                        </b>
                    </h3>

                    <?php
                        include ("app/controller/php/ic.KnowPrivilege.php");        
                    ?>

                    <p class="text-muted"> <?php echo $Privilege; ?> </p>

                    <div class="section mt25">
                      <label for="password" class="field prepend-icon">
                        <input type="password" id="mypassword" class="gui-input" placeholder="Escribir contraseña" autofocus />
                        <label for="password" class="field-icon">
                          <i class="fa fa-lock"></i>
                        </label>
                      </label>
                    </div>
                    <!-- end section -->
                    <button type="button" class="button btn-info pull-right" id="LockSession">Acceder ahora</button>
                  </div>
                </div>
              </div>
              <!-- end .form-body section -->
              <input type="hidden" id="TmpUsername" name="username" value="<?php echo @$GameResult['usr']; ?>" />
              <input type="hidden" id="TmpPassword" name="password" value="" />
              <input type="hidden" id="TmpRemember" name="remember" value="on" />
              <input type="hidden" id="TmpPrivilege" name="privilege" value="<?php echo $PSend; ?>" />
            </form>
          </div>
          
        </div>

      </section>
      <!-- End: Content -->

    </section>
    <!-- End: Content-Wrapper -->

  </div>
  <!-- End: Main -->

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

<?php include (PD_CORE."/ic.foot.php"); ?>