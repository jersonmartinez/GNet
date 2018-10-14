<?php
    // @session_start();
    include (@$_SESSION['getConsts']);
    
    // echo "<br/><b>getData: </b>",PDS_DESKTOP_ROOT;
    // exit();

    // include ($_SERVER['DOCUMENT_ROOT']."/".explode("/", $_SERVER['REQUEST_URI'])[1]."/app/core/ic.const.php");
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

        //Correcto | Networks
        <?php
            #Se obtienen las direcciones de red.
            $ReturnIPNets   = $CN->getIPNet();

            if ($ReturnIPNets->num_rows > 0){
                while ($RIP = $ReturnIPNets->fetch_array(MYSQLI_ASSOC)){
                    $RIPValue = implode("", explode("/", implode("", explode(".", $RIP['ip_net']))));
                    $Switches = $CN->getHostTypeSwitch($RIP['ip_net']);

                    $RIPValue_Alias = !empty($RIP['alias']) ? $RIP['alias'] : $RIP['ip_net'];

                    if ($Switches->num_rows >= 1){
                        ?>
                            nodes.push({id: <?php echo $RIPValue; ?>, label: "<?php echo $RIPValue_Alias; ?>", image: DIR + 'switchs/switchicon1.png', shape: 'image'});
                        <?php
                    }
                }
            }
        ?>

        //Correcto | Routers with network next 
        <?php
            $Routers = $CN->getHostTypeRouter();
            while ($RRouter = $Routers->fetch_array(MYSQLI_ASSOC)){
                
                if ($RRouter['net_next'] != "-"){
                    $IDRouter = implode("", explode(".", $RRouter['ip_host']));
                    $RIPValueSwitch = implode("", explode("/", implode("", explode(".", $RRouter['ip_net']))));
                    
                    $RIPValueRouter_Alias = !empty($RRouter['alias']) ? $RRouter['alias'] : $RRouter['ip_host'];

                    ?>
                        nodes.push({id: <?php echo $IDRouter; ?>, label: "<?php echo $RIPValueRouter_Alias; ?>", image: DIR + 'routers/router2.png', shape: 'image'});
                    <?php                    
                }
            }
        ?>

        //Correcto | Devices that are not routers.
        <?php
            $Machines = $CN->getHostTypeHost();
            while ($rm = $Machines->fetch_array(MYSQLI_ASSOC)){
                $RMValue        = implode("", explode(".", $rm['ip_host']));
                $RMValueSwitch  = implode("", explode("/", implode("", explode(".", $rm['ip_net']))));

                $RMValue_Alias = !empty($rm['alias']) ? $rm['alias'] : $rm['ip_host'];

                if ($CN->getMyIPServer() == $rm['ip_host']){
                    ?>
                        nodes.push({id: <?php echo $RMValue; ?>, label: "<?php echo $RMValue_Alias; ?>", image: DIR + 'servers/server1.png', shape: 'image'});
                    <?php
                } else {
                    ?>
                        nodes.push({id: <?php echo $RMValue; ?>, label: "<?php echo $RMValue_Alias; ?>", image: DIR + 'computers/laptop1.png', shape: 'image'});
                    <?php
                }
            }
        ?>

        //Connections
        <?php
            $ExtgetIPNet = $CN->getIPNet();

            if ($ExtgetIPNet->num_rows > 0){
                while ($ExtGIPN = $ExtgetIPNet->fetch_array(MYSQLI_ASSOC)){
                    $ExtGIPNValue   = implode("", explode("/", implode("", explode(".", $ExtGIPN['ip_net']))));
                    $Switches       = $CN->getHostTypeSwitch($ExtGIPN['ip_net']);

                    if ($Switches->num_rows >= 1){
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
            document.getElementById("ContextMenuTest_White").style.visibility = "hidden";
            valueSelection = document.getElementById('selection').innerHTML;

            if (valueSelection == 'Seleccionado: ' || valueSelection == ""){
                // document.getElementById("btn_tracking_b2").setAttribute("disabled", "disabled");
                $(".btn_tracking_device").attr("disabled", "disabled");
            } else{
                $(".btn_tracking_device").removeAttr("disabled");
                // document.getElementById("btn_tracking_b2").removeAttribute("disabled");
            }
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
                // getCoords = getCoordsPosition(e);
                valueSelection = document.getElementById('selection').innerHTML;
                if (valueSelection == 'Seleccionado: ' || valueSelection == ""){
                    popupMenux = document.getElementById("ContextMenuTest_White");
                    // document.getElementById("btn_tracking_b2").setAttribute("disabled", "disabled");
                } else {
                    // document.getElementById("btn_tracking_b2").removeAttribute("disabled");
                    popupMenux = document.getElementById("ContextMenuTest");
                }

                var offsetX = e.offsetX;
                var offsetY = e.offsetY;

                if( e.target != this ){ // 'this' is our HTMLElement
                    offsetX = e.target.offsetLeft + e.offsetX;
                    offsetY = e.target.offsetTop + e.offsetY;
                }

                // alert("X: " + offsetX + ", Y: " + offsetY);

                popupMenux.style.left = offsetX + 'px';
                popupMenux.style.top = offsetY + 'px';
                // popupMenux.style.left = getCoords.x - 272 + 'px';
                // popupMenux.style.top = getCoords.y - 132 + 'px';
                container.appendChild(popupMenux);
                popupMenux.style.visibility = "visible";
            e.preventDefault()
        }, false);
    }

</script>

<input type="hidden" style="float: right" id="ClickSondeoFinal" onclick="javascript: draw();" value="Cambiar panorama" />
<div ondblclick="javascript: draw();" id="mynetwork" style="width: 100%; height:470px;">
    
</div>

<p id="selection"></p>
<p id="stabilization"></p>
<p id="testing_id"></p>