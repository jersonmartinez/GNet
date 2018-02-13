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

      <div class="admin-form theme-info mw500" id="login1">

        <div class="row mb15 table-layout">

          <div class="col-xs-6 pln">
              <a href="./" title="Return to Dashboard">
                <img src="app/controller/src/logo/logo.png" title="InterCloud Logo" class="img-responsive w250">
              </a>
            </div>

            <div class="col-xs-6 va-b">
              <div class="login-links text-right">
                <a href="#" class="" title="Mostrar claves" onclick="javascript: ShowFieldsKeys();">Generar contraseña</a>
              </div>
            </div>
          </div>

          <div class="panel panel-info heading-border br-n">

            <form method="post" action="http://intercloud.com/" id="contact">
              <div class="panel-body p15 pt25">

                <div class="alert alert-micro alert-border-left alert-info pastel alert-dismissable mn">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <i class="fa fa-info pr10"></i>Ingrese un <b>Nombre de usuario</b> y una <b>contraseña</b> para tener privilegios de Administrador.
                </div>

              </div>
              <!-- end .form-body section -->
              <div class="panel-footer p25 pv15">
                  <div class="section mn">

                  <div class="smart-widget sm-right smr-120">
                    <label for="email" class="field prepend-icon">
                      <input type="text" name="admin_username" id="admin_username" class="gui-input" placeholder="Nombre de usuario" required autofocus>
                      <label for="email" class="field-icon">
                        <i class="fa fa-user"></i>
                      </label>
                    </label>
                    <label for="email" class="button">Administrador</label>
                  </div>
                  <br/>
                  <div class="row">
                    <div class="col-xs-6">
                      <div class="smart-widget sm-right">
                        <label for="password" class="field prepend-icon">
                          <input type="password" name="admin_password" id="admin_password" class="gui-input" placeholder="Contraseña" required />
                          <label for="password" class="field-icon">
                            <i class="fa fa-lock"></i>
                          </label>
                        </label>
                      </div>
                      
                    </div>
                    <div class="col-xs-6">
                      <div class="smart-widget sm-right">
                        <label for="repeat_password" class="field prepend-icon">
                          <input type="password" name="admin_repeat_password" id="admin_repeat_password" class="gui-input" placeholder="Repetir contraseña" required />
                          <label for="repeat_password" class="field-icon">
                            <i class="fa fa-lock"></i>
                          </label>
                        </label>
                      </div>
                      
                    </div>
                  </div>

                </div>        
              </div>
              <!-- end .form-footer section -->

              <div class="panel-body p15 pt25">
                
                <div class="btn-group">
                  <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" data-original-title="Regresar al paso de instalación" onclick="javascript: BackInstallation();">
                    <i class="fa fa-mail-reply-all"></i> Volver a la instalación
                  </button>
                </div>

                <div class="btn-group" style="float: right;">
                  <button type="button" class="btn btn-dark dark" data-toggle="tooltip" data-placement="top" data-original-title="Limpiar cajas" onclick="javascript: CleanFields();">
                    <i class="fa fa-times-circle"></i>
                  </button>
                  <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="right" data-original-title="Registrarme ahora" onclick="javascript: InsertUsernameAdmin();">
                    <i class="fa fa-home"></i> Terminar e ir a casa
                  </button>
                </div>
              </div>
            </form>

            <form id="ConfigurationUsernameAdmin">
                <input type="hidden" name="tmp_username" id="tmp_username" />
                <input type="hidden" name="tmp_password" id="tmp_password" />
            </form>

          </div>
        </div>
      </div>

    </section>
    <!-- End: Content -->

  </section>
  <!-- End: Content-Wrapper -->

</div>

<button type="hidden" id="ValidateModalProblemUser" class="btn btn-primary btn-lg animated-delay" data-animate='["1700", "fadeInUp"]' data-toggle="modal" data-target="#ValidationProblemUser"></button>

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

        <p class="VerifyInformation"></p>
        
      </div>

      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> -->
        <button type="button" class="btn btn-primary" data-dismiss="modal">De acuerdo</button>
      </div>
    </div>
  </div>
</div>

<button type="hidden" id="VMCreateUser" class="btn btn-primary btn-lg animated-delay" data-animate='["1700", "fadeInUp"]' data-toggle="modal" data-target="#VMUser">Validar Datos</button>

<!-- Modal -->
<div class="modal fade" id="VMUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Instalación completada</h4>
      </div>
      <div class="modal-body">
        <p><b>¡Genial!, ¿Qué esperas para iniciar sesión?.</b></p>

        <div class="row">
          <div class="col-xs-2">
            <i class="fa fa-smile-o fa-5x" aria-hidden="true"></i>
          </div>
          <div class="col-xs-10 InstallationSuccessData">
            
          </div>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="javascript: StartSession();">Iniciar sesión</button>
      </div>
    </div>
  </div>
</div>

<?php include ("app/core/ic.foot.php"); ?>