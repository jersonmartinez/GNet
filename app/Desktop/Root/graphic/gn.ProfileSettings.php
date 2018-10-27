<?php  
  @session_start();
?>
<!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn" style="width: 80%; margin: 0px auto;">

  <!-- begin: .tray-center -->
  <div class="tray tray-center">

    <!-- create new order panel -->
    <div class="panel mb20 mt5">
      <div class="panel-heading">
        <span class="panel-title hidden-xs"><i class="fa fa-user"></i>Mi perfil</span>
        <ul class="nav panel-tabs-border panel-tabs">
          <li class="active">
            <a href="#tab1_1" data-toggle="tab">General</a>
          </li>
          <li>
            <a href="#tab1_2" data-toggle="tab">Editar cuenta</a>
          </li>
        </ul>
      </div>
      <div class="panel-body p20 pb10">
        <div class="tab-content pn br-n admin-form">
          <div id="tab1_1" class="tab-pane active">

            <div class="col-md-3">
              <div class="fileupload fileupload-new admin-form" data-provides="fileupload">
                <div class="fileupload-preview thumbnail mb15">
                  <!-- <img data-src="holder.js/100%x147" alt="Imagen de relleno"> -->
                  <img src="app/Desktop/Root/src/user1.png" alt="Avatar" style="width: 75%; height: 147px;">
                </div>
                <span class="button btn-system btn-file btn-block ph5">
                  <span class="fileupload-new">Cargar imagen</span>
                  <span class="fileupload-exists">Cargar imagen</span>
                  <input type="file">
                </span>
              </div>
            </div>
            <div class="col-md-9">
              <div class="section row mbn">
              <div class="col-md-12 pl15">
                <div class="section row mb15">
                    <label for="name1" class="field prepend-icon">
                      <input type="text" name="name1" id="name1" class="event-name gui-input br-light light" placeholder="Nombre">
                      <label for="name1" class="field-icon">
                        <i class="fa fa-user"></i>
                      </label>
                    </label>
                </div>  
                <div class="section row mb15">
                    <label for="name2" class="field prepend-icon">
                      <input type="text" name="name2" id="name2" class="event-name gui-input br-light light" placeholder="Apellido">
                      <label for="name2" class="field-icon">
                        <i class="fa fa-user"></i>
                      </label>
                    </label>
                </div>
                <div class="section row mb15">
                  <label for="email" class="field prepend-icon">
                    <input type="text" name="email" id="email" class="event-name gui-input br-light bg-light" placeholder="Dirección de correo eletrónico">
                    <label for="email" class="field-icon">
                      <i class="fa fa-envelope"></i>
                    </label>
                  </label>
                </div>
                <div class="section row mb15">
                  <button type="submit" class="button btn-primary pull-right">Guardar</button>
                </div>
              </div>
              
            </div>
            <!-- end section row -->
            </div>

          </div>

          <div id="tab1_2" class="tab-pane">
            <div class="section row mbn">
              <div class="col-md-9 pl15">
                <div class="section row mb15">
                  <div class="smart-widget sm-right smr-120">
                    <label for="username" class="field prepend-icon">
                      <input type="text" name="username" id="username" class="gui-input" placeholder="Nombre de usuario" value="Tu nombre de usuario es <?php echo @$_SESSION['username']; ?>">
                      <label for="username" class="field-icon">
                        <i class="fa fa-user"></i>
                      </label>
                    </label>
                    <label for="username" class="button" id="btnChangeUserName">
                      <i class="fa fa-pencil"></i>
                    </label>
                  </div>
                </div>
                
                <div class="section row mb15">
                    <label for="password" class="field prepend-icon">
                      <input type="password" name="password" id="password" class="event-name gui-input br-light light" placeholder="Escribe tu contraseña actual">
                      <label for="password" class="field-icon">
                        <i class="fa fa-unlock"></i>
                      </label>
                    </label>
                </div>
                <div class="section row mb15">
                    <label for="password2" class="field prepend-icon">
                      <input type="password2" name="password2" id="password2" class="event-name gui-input br-light light" placeholder="Escribe tu nueva contraseña">
                      <label for="password2" class="field-icon">
                        <i class="fa fa-unlock-alt"></i>
                      </label>
                    </label>
                </div>
                <div class="section row mb15">
                  <label for="password3" class="field prepend-icon">
                    <input type="password3" name="password3" id="password3" class="event-name gui-input br-light light" placeholder="Confirma tu nueva contraseña">
                    <label for="password3" class="field-icon">
                      <i class="fa fa-lock"></i>
                    </label>
                  </label>
                </div>
                <div class="section row mb15">
                  <div class="panel-footer clearfix">
                    <button type="submit" class="button btn-primary pull-right">Cambiar contraseña</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- end: .tray-center -->

</section>
<!-- End: Content -->