<?php
    include ($_SERVER['DOCUMENT_ROOT']."/".explode("/", $_SERVER['REQUEST_URI'])[1]."/app/core/ic.const.php");
?>

<link rel="stylesheet" type="text/css" href="<?php echo PDS_DESKTOP_ROOT; ?>/css/vis/style.css">

<script type="text/javascript">
    var nodes = null;
    var edges = null;
    var network = null;
    var popupMenu = undefined;

    function destroy() {
        if (network !== null) {
            network.destroy();
            network = null;
        }
    }

    var DIR = '<?php echo PDS_DESKTOP_ROOT; ?>/src/vis/img/refresh-cl/news/';
    var EDGE_LENGTH_MAIN = 150;
    var EDGE_LENGTH_SUB = 50;

    // Called when the Visualization API is loaded.
    function draw() {
        destroy();
        // Create a data table with nodes.
        nodes = [];

        var arrayNet = [];
        var arrayHost = [];
        var arrayRouter = [];

        LongArrayNet  = arrayNet.length;
        LongArrayHost = arrayHost.length;
        LongArrayRou  = arrayRouter.length; 

          // Create a data table with links.
        edges = [];

        //nodes.push({id: 1, label: change, image: DIR + 'server.png', shape: 'image'});
        //nodes.push({id: 2, label: arrayNet, image: DIR + 'switch.png', shape: 'image'});

        //-----------------------------------
        //Get Networks | ej: 192.168.100.0  -
        //-----------------------------------
        <?php
            ?>
                console.log("------------------ Networks ------------------");
            <?php

            $getMyIPServer  = $CN->getMyIPServer();
            $ReturnIPNets   = $CN->getIPNet();

            if ($ReturnIPNets->num_rows > 0){
                while ($RIP = $ReturnIPNets->fetch_array(MYSQLI_ASSOC)){
                    // $RIPValue = explode(".", $RIP['ip_net'])[2];
                    $RIPValue = implode("", explode("/", implode("", explode(".", $RIP['ip_net']))));
                    ?>
                        console.log("Networks: " + <?php echo $RIPValue; ?>);
                    <?php
                    $Switches = $CN->getHostTypeSwitch($RIP['ip_net']);

                    if ($Switches->num_rows >= 2){
                        ?>
                            nodes.push({id: <?php echo $RIPValue; ?>, label: "<?php echo $RIP['ip_net']; ?>", image: DIR + 'switchs/switchicon1.png', shape: 'image'});
                        <?php
                    }
                }
            }
        ?>

        //-----------------------------------
        //Get Routers | ej: 192.168.100.4   -
        //-----------------------------------
        <?php
            ?>
                console.log("------------------ Routers ------------------");
            <?php

            $Routers = $CN->getHostTypeRouter();
            while ($RRouter = $Routers->fetch_array(MYSQLI_ASSOC)){
                $IDRouter = implode("", explode(".", $RRouter['ip_host']));
                // $IDRouter = implode("", explode(".", implode("", explode("/", $RRouter['net_next']))));
                $RIPValueSwitch = implode("", explode("/", implode("", explode(".", $RRouter['ip_net']))));
                // $IDValueSwitch  = implode("", explode(".", $RRouter['ip_net']));
                
                 ?>
                        console.log("ID Router: " + <?php echo $IDRouter; ?> + " Switch Value: " + <?php echo $RIPValueSwitch; ?>);
                    <?php

                ?>
                    nodes.push({id: <?php echo $IDRouter; ?>, label: "<?php echo $RRouter['net_next']; ?>", image: DIR + 'routers/router2.png', shape: 'image'});
                    
                    // edges.push({from: <?php echo $IDRouter; ?>, to: <?php echo $RIPValueSwitch; ?>, length: EDGE_LENGTH_SUB});
                <?php
            }
        ?>

        <?php
            ?>
                console.log("------------------ Host Type ------------------");
            <?php

            $Machines = $CN->getHostTypeHost();
            while ($rm = $Machines->fetch_array(MYSQLI_ASSOC)){
                $RMValue        = implode("", explode(".", $rm['ip_host']));
                $RMValueSwitch  = implode("", explode("/", implode("", explode(".", $rm['ip_net']))));

                ?>
                        console.log("IP Host: " + <?php echo $RMValue; ?> + " Switch Value: " + <?php echo $RMValueSwitch; ?>);
                    <?php


                if ($getMyIPServer == $rm['ip_host']){
                    ?>
                        nodes.push({id: <?php echo $RMValue; ?>, label: "<?php echo $rm['ip_host']; ?>", image: DIR + 'servers/server1.png', shape: 'image'});
                    
                        
                        // edges.push({from: <?php echo $RMValue; ?>, to: <?php echo $RMValueSwitch; ?> , length: EDGE_LENGTH_SUB});
                    <?php
                } else {
                    ?>
                        nodes.push({id: <?php echo $RMValue; ?>, label: "<?php echo $rm['ip_host']; ?>", image: DIR + 'computers/laptop1.png', shape: 'image'});
                
                    
                        // edges.push({from: <?php echo $RMValue; ?>, to: <?php echo $RMValueSwitch; ?> , length: EDGE_LENGTH_SUB});
                    <?php
                }

            }
        ?>

        <?php
            $ExtgetIPNet = $CN->getIPNet();

            if ($ExtgetIPNet->num_rows > 0){
                while ($ExtGIPN = $ExtgetIPNet->fetch_array(MYSQLI_ASSOC)){
                    // $ExtGIPNValue = explode(".", $ExtGIPN['ip_net'])[2];
                    $ExtGIPNValue   = implode("", explode("/", implode("", explode(".", $ExtGIPN['ip_net']))));
                    $Switches       = $CN->getHostTypeSwitch($ExtGIPN['ip_net']);

                    if ($Switches->num_rows >= 2){

                        // echo "<br/>Network: ".$ExtGIPN['ip_net']." | ID Network: ".$ExtGIPNValue."<br/>";

                        $RecorrerHosts = $CN->getHostNetwork($ExtGIPN['ip_net']);

                        if ($RecorrerHosts->num_rows > 0){
                            while ($RH = $RecorrerHosts->fetch_array(MYSQLI_ASSOC)){
                                $RHValue = implode("", explode(".", $RH['ip_host']));
                                // echo "Host: ".$RH['ip_host']." Cambio: ".$RHValue."<br/>";
                                ?>
                                    edges.push({from: <?php echo $RHValue; ?>, to: <?php echo $ExtGIPNValue; ?>, length: EDGE_LENGTH_SUB});
                                <?php
                            }
                        }
                        
                    } else if ($Switches->num_rows == 1){
                        $getHT = $CN->getHostTypeHost();
                        if ($getHT->num_rows > 0){
                            while ($rowGetHT = $getHT->fetch_array(MYSQLI_ASSOC)){

                                $SFindRouterNext = $CN->getHostTypeRouter();
                                while ($SResultadin = $SFindRouterNext->fetch_array(MYSQLI_ASSOC)){
                                    if ($rowGetHT['ip_net'] == $SResultadin['net_next']){

                                        $MyIDNetNext = implode("", explode(".", $rowGetHT['ip_host']));
                                        $OtherRouter = implode("", explode(".", $SResultadin['ip_host']));

                                        ?>
                                            edges.push({from: <?php echo $MyIDNetNext; ?>, to: <?php echo $OtherRouter; ?>, length: EDGE_LENGTH_SUB});
                                        <?php
                                        goto Finalizando;
                                    }
                                }
                                
                            }
                        }

                        Finalizando:
                            break;

                    }
                }
            }

            $LastRouter = $CN->getHostTypeRouterLast();
            if ($LastRouter->num_rows > 0){
                $LastRouterDato = $LastRouter->fetch_array(MYSQLI_ASSOC);
                $IDLastRouter = implode("", explode(".", $LastRouterDato['ip_host']));
                $LastRouterSwitch = implode("", explode("/", implode("", explode(".", $LastRouterDato['net_next']))));

                ?>
                    edges.push({from: <?php echo $LastRouterSwitch; ?>, to: <?php echo $IDLastRouter; ?>, length: EDGE_LENGTH_SUB});
                    // edges.push({from: 192168101024, to: 1921681012, length: EDGE_LENGTH_SUB});
                <?php
                // echo "ID: ".$IDLastRouter." | LastRouterSwitch: ".$LastRouterSwitch."<br/>";
            }


            //Recorremos los enrutadores para saber quienes son los siguientes conectados.
            $TypeRouter = $CN->getHostTypeRouter();
            if ($TypeRouter->num_rows > 0){

                while ($TypeRouterDato = $TypeRouter->fetch_array(MYSQLI_ASSOC)){
                    $MyNetNext = $TypeRouterDato['net_next'];

                    //Se recorre nuevamente la misma tabla para averiguar

                    $FindRouterNext = $CN->getHostTypeRouter();
                    while ($Resultadin = $FindRouterNext->fetch_array(MYSQLI_ASSOC)){
                        if ($MyNetNext == $Resultadin['ip_net']){

                            $MyIDNetNext = implode("", explode(".", $TypeRouterDato['ip_host']));
                            $OtherRouter = implode("", explode(".", $Resultadin['ip_host']));

                            ?>
                                edges.push({from: <?php echo $MyIDNetNext; ?>, to: <?php echo $OtherRouter; ?>, length: EDGE_LENGTH_SUB});
                            <?php
                        }
                    }
                }
                
                // echo "ID: ".$IDLastRouter." | LastRouterSwitch: ".$LastRouterSwitch."<br/>";
            }
        ?>

        // create a network
        var container = document.getElementById('mynetwork');
        var data = {
            nodes: nodes,
            edges: edges
        };
       
        // var options = {};
        var options = {physics:{stabilization:false}};
        network = new vis.Network(container, data, options);
    
        // add event listeners
        $(container).click(function(){
            document.getElementById("ContextMenuTest").style.visibility = "hidden";
        });

        network.on('select', function(params) {
            document.getElementById('selection').innerHTML = 'Seleccionado: ' + params.nodes;
            if (popupMenu !== undefined) {
                popupMenu.parentNode.removeChild(popupMenu);
                popupMenu = undefined;
            }
        });

        network.on('stabilized', function (params) {
            document.getElementById('stabilization').innerHTML = 'Stabilization took ' + params.iterations + ' iterations.';
        });

        network.on('startStabilization', function (params) {
            document.getElementById('stabilization').innerHTML = 'Stabilizing...';
        });
      
        container.addEventListener('contextmenu', function(e) {
            // if (popupMenu !== undefined) {
            //     popupMenu.parentNode.removeChild(popupMenu);
            //     popupMenu = undefined;
            // }
         
            // if (network.getSelection().nodes.length > 0) {
            //     var offsetLeft = container.offsetLeft + 330;
            //     var offsetTop = container.offsetTop + 10;

            //     alert("Top: " + offsetTop + " | Left: " + offsetLeft);
            //     popupMenu = document.createElement("div");
            //     popupMenu.className = 'popupMenu';          

            //     popupMenu.style.left = e.clientX - offsetLeft + 'px';
            //     popupMenu.style.top = e.clientY - offsetTop +'px';
            //     container.appendChild(popupMenu);


                
            //     CreateItemsMenu("Configurar", "configure");
            //     CreateItemsMenu("Consola", "console");
            //     CreateItemsMenu("Procesos", "process");
            //     CreateItemsMenu("Servicios", "services");
            //     CreateItemsMenu("Iniciar", "start");
            //     CreateItemsMenu("Detener", "stop");
            //     CreateItemsMenu("Apagar", "shutdown");
            //     CreateItemsMenu("Propiedades", "properties");
            // }

                var posx = 0;
                var posy = 0;

                if (!e) var e = window.event;
                
                if (e.pageX || e.pageY) {
                  posx = e.pageX;
                  posy = e.pageY;
                } else if (e.clientX || e.clientY) {
                  posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
                  posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
                }

                popupMenux = document.getElementById("ContextMenuTest");
                popupMenux.style.left = posx - 272 + 'px';
                popupMenux.style.top = posy - 132 + 'px';
                // alert("x: " + e.clientX + " | y: " + e.clientY);
                container.appendChild(popupMenux);
                popupMenux.style.visibility = "visible";
                // popupMenux.innerHTML = "Algo m'as!";
            e.preventDefault()
        }, false);
    }

    function CreateItemsMenu(value, className){
        itemMenu = document.createElement("li");
        // itemMenu.className = 'itemMenuClass' + className;
        $(itemMenu).addClass("itemMenuClass" + className);
        itemMenu.innerHTML = value;
        itemMenu.id = "itemMenuId" + className;
        popupMenu.appendChild(itemMenu);

        $("#itemMenuId" + className).click(function(){
            getDataSelection(className);
        });

        // document.getElementById("itemMenuId" + className).addEventListener("click", function(){
        //     alert("Identificador del host: " + document.getElementById("selection").innerHTML + " para: " + className);
        // });
    }

    function getDataSelection(cn){
        alert("Identificador del host: " + $("#selection").html() + " para: " + $(cn).attr("class"));
    }

</script>

<input type="hidden" style="float: right" id="ClickSondeoFinal" onclick="javascript: draw();" value="Cambiar panorama" />
<div ondblclick="javascript: draw();" id="mynetwork" style="width: 100%; height:470px;">
    
</div>

<p id="selection"></p>
<p id="stabilization"></p>
<p id="testing_id"></p>

<div id="ContextMenuTest" style="visibility:hidden; z-index: 10000;">
    <li class="settings" onclick="javascript: getDataSelection(this);">
        <div class="icons-menu-context">
            <i class="fa fa-desktop"></i>
        </div>
        <div class="label-menu-context">
            Configurar
        </div>
    </li>

    <li class="console" onclick="javascript: getDataSelection(this);">
        <div class="icons-menu-context">
            <i class="fa fa-desktop"></i>
        </div>
        <div class="label-menu-context">
            Consola
        </div>
    </li>

    <li class="process" onclick="javascript: getDataSelection(this);">
        <div class="icons-menu-context">
            <i class="fa fa-desktop"></i>
        </div>
        <div class="label-menu-context">
            Procesos
        </div>
    </li>

    <li class="sercices" onclick="javascript: getDataSelection(this);">
        <div class="icons-menu-context">
            <i class="fa fa-desktop"></i>
        </div>
        <div class="label-menu-context">
            Servicios
        </div>
    </li>

    <li class="start" onclick="javascript: getDataSelection(this);">
        <div class="icons-menu-context">
            <i class="fa fa-desktop"></i>
        </div>
        <div class="label-menu-context">
            Iniciar
        </div>
    </li>

    <li class="stop" onclick="javascript: getDataSelection(this);">
        <div class="icons-menu-context">
            <i class="fa fa-desktop"></i>
        </div>
        <div class="label-menu-context">
            Detener
        </div>
    </li>

    <li class="shutdown" onclick="javascript: getDataSelection(this);">
        <div class="icons-menu-context">
            <i class="fa fa-desktop"></i>
        </div>
        <div class="label-menu-context">
            Apagar
        </div>
    </li>
    <li class="properties" onclick="javascript: getDataSelection(this);">
        <div class="icons-menu-context">
            <i class="fa fa-desktop"></i>
        </div>
        <div class="label-menu-context">
            Propiedades
        </div>
    </li>
</div>