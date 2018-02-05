<?php
	$fn = "../../../config/Config.tcb";
	include ("../../../config/connect_server/ic.connect_server.php");

	$R = $IC->query("SELECT * FROM ".$X."network ORDER BY id DESC;");
	$count = 0;
  
	while ($Row = $R->fetch_array(MYSQLI_ASSOC)){
		?>
			<div class="panel">
          <div class="panel-heading" role="tab" id="headingTwo<?php echo $count; ?>">
            <span class="panel-title">
              <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo<?php echo $count; ?>" aria-expanded="false" aria-controls="collapseTwo<?php echo $count; ?>">
                <?php echo "<b>SSID (Nombre) de la Red: </b>".$Row['name']; ?>
              </a>
            </span>
          </div>
          <div id="collapseTwo<?php echo $count; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo<?php echo $count++; ?>">
            <div class="panel-body">
              <?php echo "<b>Clave personal: </b>".$Row['pass']; ?>
            </div>
            <div class="panel-body">
              <?php 
              	if ($Row['allow'] == 0){
  	        			echo "<b>Estado: </b>No habilitada";
  	        		} else {
  	        			echo "<b>Estado: </b>Habilitada";
  	        		}
              ?>
            <div class="switch switch-info round switch-inline" style="position: absolute; right: 10px; margin-top: -3px;">
              <input id="<?php echo $Row['name']; ?>" type="checkbox">
              <label for="<?php echo $Row['name']; ?>" id="dropdown-Network"></label>
              <?php
                if ($Row['allow'] == 0){
                  ?>
                    <input type="hidden" id="SwitchNetworkHistory<?php echo $count; ?>" value="Off">
                  <?php
                } else {
                  ?>
                    <input type="hidden" id="SwitchNetworkHistory<?php echo $count; ?>" value="On">
                  <?php
                }
              ?>  
            </div>
            </div>
          </div>
        </div>
		<?php
	}
?>