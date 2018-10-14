<!-- Start: Main -->
<div id="main" class="animated fadeIn tray tray-center">

  <!-- Start: Content-Wrapper -->
  <section id="content_wrapper">

    <!-- begin canvas animation bg -->
    <div id="canvas-wrapper">
      <canvas id="demo-canvas"></canvas>
    </div>

    <!-- Begin: Content -->
    <section id="content" class="animated fadeInLeft">

      <div class="admin-form theme-info" id="login1" style="max-width: 700px;">
        <!-- <label>Instalación de base de datos</label> -->
        <div class="row">
          <div class="col-xs-8">
            <a href="./">
              <img src="app/controller/src/logo/logo.png" class="img-responsive w150">
            </a>
          </div>

          <div class="col-xs-4">
            <label style="color: #fff; font-size: 17px; margin-top: 20px;"><i class="fa fa-database"></i> Servidor de base de datos</label>
          </div>
        </div>

        <div class="panel panel-info mt5 br-n">
          <div class="panel-heading heading-border bg-white"></div>
          <!-- end .form-header section -->
          <form id="InstallationCompleteNow" method="post">
            <div class="panel-body bg-light p30">
              <div class="row">
           
                <div class="row animated-delay" data-animate='["800","fadeInDown"]'>
                  <div class="col-xs-6">
                     <label for="password" class="field-label text-muted fs18 mb10">Dirección del servidor</label>
                    <label for="password" class="field prepend-icon">
                    <input type="text" name="host" id="InstallHost" class="form-control" placeholder="[localhost | 127.0.0.1] [Servidor remoto]" data-toggle="tooltip" data-placement="left" data-original-title="Dirección IP del servidor" required autofocus/>
                      <label for="password" class="field-icon"> 
                        <i class="fa fa-desktop"></i>
                      </label>
                    </label>
                  </div>
                  <div class="col-xs-6">
                       <label for="password" class="field-label text-muted fs18 mb10">Nombre de usuario</label>
                    <label for="password" class="field prepend-icon">
                    <input type="text" name="username" id="InstallUsername" class="form-control" placeholder="root" data-toggle="tooltip" data-placement="right" data-original-title="Nombre de usuario en MySQL" required/>
                    <label for="password" class="field-icon">
                        <i class="fa fa-user"></i>
                      </label>
                    </label>
                  </div>
                  
                </div>
                <br>
                <div class="row animated-delay" data-animate='["1200","fadeInDown"]'>
                  <div class="col-xs-6">
                     <label for="password" class="field-label text-muted fs18 mb10">Contraseña</label>
                    <label for="password" class="field prepend-icon">
                    <input type="password" name="password" id="InstallPassword" class="form-control" placeholder="..."  data-toggle="tooltip" data-placement="left" data-original-title="Clave del usuario MySQL" required />
                      <label for="password" class="field-icon">
                          <i class="fa fa-lock"></i>
                      </label>
                    </label>
                  </div>
                  <div class="col-xs-6">
                     <label for="password" class="field-label text-muted fs18 mb10">Repetir contraseña</label>
                    <label for="password" class="field prepend-icon">
                      <input type="password" name="repeat_password" id="InstallRepeatPassword" class="form-control" placeholder="..." data-toggle="tooltip" data-placement="right" data-original-title="Repita la clave anterior" required />
                      <label for="password" class="field-icon">
                          <i class="fa fa-unlock-alt"></i>
                      </label>
                    </label>
                  </div>
                </div>

                <br>
                <div class="row animated-delay" data-animate='["1600","fadeInDown"]'>
                  <div class="col-xs-6">
                     <label for="password" class="field-label text-muted fs18 mb10">Base de datos</label>
                    <label for="password" class="field prepend-icon">
                    <input type="text" name="database" id="InstallDatabase" class="form-control" placeholder="GNet" data-toggle="tooltip" data-placement="left" data-original-title="Nombre de base de datos donde se volcarán los datos" required />
                      <label for="password" class="field-icon">
                          <i class="fa fa-database"></i>
                      </label>
                    </label>
                  </div>
                  <div class="col-xs-6">
                      <label for="password" class="field-label text-muted fs18 mb10">Prefijo de tablas</label>
                      <label for="password" class="field prepend-icon">
                      <input type="text" name="prefix" id="InstallPrefix" class="form-control" placeholder="Ejemplo: tcb" data-toggle="tooltip" data-placement="right" data-original-title="Escribir un prefijo es opcional"/>
                      <label for="password" class="field-icon">
                          <i class="fa fa-table"></i>
                      </label>
                    </label>
                  </div>
                </div>

              </div>
            </div>
            <!-- end .form-body section -->
            <div class="panel-footer clearfix p10 ph15 animated-delay" data-animate='["1700", "fadeInUp"]'>
              <button type="button" id="ConfigureInstallation" class="button btn-primary mr10 pull-right" data-toggle="tooltip" data-placement="right" data-original-title="Estoy listo">Configurar</button>
             
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary btn-lg animated-delay" data-animate='["1700", "fadeInUp"]' data-toggle="modal" data-target="#myModal">
                ¡Necesito ayuda!
              </button>

              <button type="hidden" id="InstallValidation" class="btn btn-primary btn-lg animated-delay" data-animate='["1700", "fadeInUp"]' data-toggle="modal" data-target="#ValidationOfTheData">
                Validar Datos
              </button>
            </div>
            <!-- end .form-footer section -->
          </form>
        </div>
      </div>
    </section>
    <!-- End: Content -->

  </section>
  <!-- End: Content-Wrapper -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="ModalAgreements" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" title="Licencia de GNet" id="ModalAgreements">Guia de instalación | GNet (Gestión de Red)</h4>
      </div>
      <div class="modal-body">
        <p><b>Dirección del servidor</b></p>
        <p>Para conectarse al sistema gestor de base de datos (SGDB), se necesita conocer la dirección del host, ya sea si está local (localhost | 127.0.0.1) o remoto (en una LAN o en la nube).</p>
        <br/>
        <p><b>Nombre de usuario</b></p>
        <p>Todo SGDB debe tener un usuario por omisión (root), o bien, algunos previamente configurados, así que tendrá que facilitarlo para tener permisos necesarios al SGDB.</p>
        <br/>
      
        <p><b>Contraseña</b></p>
        <p>La clave de acceso es necesaria para acceder al SGDB de acuerdo al usuario facilitado, normalmente MySQL | MariaDB tiene un usuario por omisión (root), sin embargo, ninguna clave.</p>
        <br/>
      
        <p><b>Base de datos</b></p>
        <p>Agregue el nombre de la base de datos para volcar las tablas que utilizará GNet, para ello, es opcional que haga la base de datos de forma manual, ya que el sistema lo crea automáticamente.</p>
        <br/>

        <p><b>Prefijo de tablas</b></p>
        <p>Este prefijo simplemente es para evitar las confusiones entre diferentes etapas del proyecto sobre la misma base de datos y que sea fácil de respaldar.</p>
        <br/>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <!-- <button type="button" class="btn btn-primary" data-dismiss="modal">De acuerdo</button> -->
      </div>
    </div>
  </div>
</div>

<!-- Confirmar sus datos, estado de verificación -->
<div class="modal fade" id="ValidationOfTheData" tabindex="-1" role="dialog" aria-labelledby="InstallProcessVerification" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="InstallProcessVerification">Confirme sus datos</h4>
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

<button type="hidden" id="CallModalSuccessful" class="btn btn-primary btn-lg animated-delay" data-animate='["1700", "fadeInUp"]' data-toggle="modal" data-target="#InstallationSuccessful">Validar Datos</button>

<!-- Modal -->
<div class="modal fade" id="InstallationSuccessful" tabindex="-1" role="dialog" aria-labelledby="ModalInstallCompleted" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="ModalInstallCompleted">Instalación completada</h4>
      </div>
      <div class="modal-body">
        <p><b>¡Que emoción!, ahora ya estamos listos.</b></p>

        <div class="row">
          <div class="col-xs-2">
            <i class="fa fa-smile-o fa-5x" aria-hidden="true"></i>
          </div>
          <div class="col-xs-10 InstallationSuccessData">
            
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="javascript: GoHome();">Empezar ahora</button>
      </div>
    </div>
  </div>
</div>

<?php include ("app/core/ic.foot.php"); ?>