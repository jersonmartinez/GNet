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
      

    <div class="alert alert-border-left alert-dark dark alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <i class="fa fa-cog pr10 hidden"></i>
      <i class="fa fa-warning pr10"></i>
      <strong>¡Up's!</strong>. Ha ocurrido un pequeño problema, 
      <a href="#" class="alert-link">atención, este es un mensaje importante</a>.
    </div>

      <div class="admin-form theme-info" id="login1">
        <div class="panel">
          <div class="panel-heading">
            <span class="panel-title">Fallo de sesión</span>
            <div class="widget-menu pull-right mr10">
              <span class="label bg-primary mr10">Tiempo</span>
              <span class="badge"><?php echo $TimeRest; ?></span>
            </div>
          </div>
          <div class="panel-body">
            <p>Usted ha agotado la cantidad de intentos posibles para dicho usuario, espere <b>5 minutos</b> y vuelva a intentarlo. </p>
            <!-- No perdamos de vista estos valores... -->
            <input type="hidden" id="ValoresSave" value="" />
            <input type="hidden" id="TimeRestActive" value="Yes" />
            <input type="hidden" id="TimeRestHope" value="<?php echo ($tiempo); ?>" />
          </div>
        </div>
        </div>
    </section>
  </section>
</div>

<?php include (PD_CORE."/ic.foot.php"); ?>