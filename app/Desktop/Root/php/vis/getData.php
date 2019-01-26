<?php
    @session_start();
    include (@$_SESSION['getConsts']);
    $CurrentID = 8415;
    
    // echo "<br/><b>getData: </b>",PDS_DESKTOP_ROOT;
    // exit();

    // include ($_SERVER['DOCUMENT_ROOT']."/".explode("/", $_SERVER['REQUEST_URI'])[1]."/app/core/ic.const.php");
?>

<!-- <link rel="stylesheet" type="text/css" href="<?php echo PDS_DESKTOP_ROOT; ?>/css/vis/vis.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo PDS_DESKTOP_ROOT; ?>/css/vis/style.css"> -->

<script type="text/javascript">
    var nodes = null;
    var edges = null;
    var network = null;
    var popupMenu = undefined;

    var clusterIndex = 0;
    var clusters = [];
    var lastClusterZoomLevel = 0;
    var clusterFactor = 0.9;

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

        //Correct | Networks
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
                            nodes.push({id: <?php echo $RIPValue; ?>, label: "<?php echo $RIPValue_Alias; ?>", image: DIR + 'switchs/switchicon1.png', shape: 'image', group: "IPNet"});
                        <?php
                    }
                }
            }
        ?>

        //Correct | Routers with network next 
        <?php
            $Routers = $CN->getHostTypeRouter();
            while ($RRouter = $Routers->fetch_array(MYSQLI_ASSOC)){
                if ($RRouter['net_next'] != "-"){
                    $IDRouter = implode("", explode(".", $RRouter['ip_host']));
                    $RIPValueSwitch = implode("", explode("/", implode("", explode(".", $RRouter['ip_net']))));
                    
                    $RIPValueRouter_Alias = !empty($RRouter['alias']) ? $RRouter['alias'] : $RRouter['ip_host'];
                    $RIPValueRouterAddr = $RRouter['ip_host'];

                    ?>
                        nodes.push({id: <?php echo $IDRouter; ?>, label: "<?php echo $RIPValueRouter_Alias; ?>", ip_addr: "<?php echo $RIPValueRouterAddr; ?>", image: DIR + 'routers/router2.png', shape: 'image', group: "Routers"});
                    <?php
                }
            }
        ?>

        //If there's not records in the DB of type routers.
        <?php
            if (!$CN->CheckRouterExists()){
                ?>
                    nodes.push({id: <?php echo $CurrentID; ?>, label: "Local Network", ip_addr: "192.168.2.1.5", image: DIR + 'routers/router2.png', shape: 'image', group: "Routers"});
                <?php
            }
        ?>

        //Correct | Devices that are not routers.
        <?php
            $Machines = $CN->getHostTypeHost();
            while ($rm = $Machines->fetch_array(MYSQLI_ASSOC)){
                $RMValue        = implode("", explode(".", $rm['ip_host']));
                $RMValueSwitch  = implode("", explode("/", implode("", explode(".", $rm['ip_net']))));

                $RMValue_Alias = !empty($rm['alias']) ? $rm['alias'] : $rm['ip_host'];
                $RMValue_Addr = $rm['ip_host'];

                if ($CN->getMyIPServer() == $rm['ip_host']){
                    ?>
                        nodes.push({id: <?php echo $RMValue; ?>, label: "<?php echo $RMValue_Alias; ?>", ip_addr: "<?php echo $RMValue_Addr; ?>", image: DIR + 'servers/server1.png', shape: 'image'});
                    <?php
                } else {
                    ?>
                        nodes.push({id: <?php echo $RMValue; ?>, label: "<?php echo $RMValue_Alias; ?>", ip_addr: "<?php echo $RMValue_Addr; ?>", image: DIR + 'computers/laptop1.png', shape: 'image', group: "Devices"});
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
                    //edges.push({from: <?php echo $CurrentID; ?>, to: <?php echo $ExtGIPNValue; ?>, length: EDGE_LENGTH_SUB});
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
        var options = {
            autoResize: true,
            height: '100%',
            width: '100%',
            nodes: {
                shadow:true
            },
            edges: {
                width: 2,
                shadow:true
            },
            physics:{stabilization:false},
            layout: {randomSeed: 8},
            physics:{adaptiveTimestep:false},
            interaction: {
                navigationButtons: true,
                keyboard: true
            }
        };
        network = new vis.Network(container, data, options);
    
        // set the first initial zoom level
        network.once('initRedraw', function() {
            if (lastClusterZoomLevel === 0) {
                lastClusterZoomLevel = network.getScale();
            }
        });

        // we use the zoom event for our clustering
        network.on('zoom', function (params) {
            if (params.direction == '-') {
                if (params.scale < lastClusterZoomLevel*clusterFactor) {
                    makeClusters(params.scale);
                    lastClusterZoomLevel = params.scale;
                }
            }
            else {
                openClusters(params.scale);
            }
        });

        // if we click on a node, we want to open it up!
        network.on("selectNode", function (params) {
            // console.log("Heee, let's stay together - Select node");
            if (params.nodes.length == 1) {
                if (network.isCluster(params.nodes[0]) == true) {
                    network.openCluster(params.nodes[0])
                }
            }
        });

        // make the clusters
        function makeClusters(scale) {
            var clusterOptionsByData = {
                processProperties: function (clusterOptions, childNodes) {
                    clusterIndex = clusterIndex + 1;
                    var childrenCount = 0;
                    for (var i = 0; i < childNodes.length; i++) {
                        childrenCount += childNodes[i].childrenCount || 1;
                    }
                    clusterOptions.childrenCount = childrenCount;
                    clusterOptions.label = "# " + childrenCount + "";
                    clusterOptions.font = {size: childrenCount*5+15}
                    clusterOptions.id = 'cluster:' + clusterIndex;
                    clusters.push({id:'cluster:' + clusterIndex, scale:scale});
                    return clusterOptions;
                },
                clusterNodeProperties: {borderWidth: 3, image: DIR + 'computers/Cloud-Network.png', shape: 'image', font: {size: 30}}
            }
            network.clusterOutliers(clusterOptionsByData);
            if (document.getElementById('stabilizeCheckbox').checked === true) {
                // since we use the scale as a unique identifier, we do NOT want to fit after the stabilization
                network.setOptions({physics:{stabilization:{fit: false}}});
                network.stabilize();
            }
        }

        // open them back up!
        function openClusters(scale) {
            var newClusters = [];
            var declustered = false;
            for (var i = 0; i < clusters.length; i++) {
                if (clusters[i].scale < scale) {
                    network.openCluster(clusters[i].id);
                    lastClusterZoomLevel = scale;
                    declustered = true;
                }
                else {
                    newClusters.push(clusters[i])
                }
            }
            clusters = newClusters;
            if (declustered === true && document.getElementById('stabilizeCheckbox').checked === true) {
                // since we use the scale as a unique identifier, we do NOT want to fit after the stabilization
                network.setOptions({physics:{stabilization:{fit: false}}});
                network.stabilize();
            }
        }

        network.on('select', function(params) {
            if (popupMenu !== undefined) {
                popupMenu.parentNode.removeChild(popupMenu);
                popupMenu = undefined;
            }
            
            var nodeID = params.nodes[0];
            if (nodeID) {
                var clickedNode = this.body.nodes[nodeID];
                // $("#selection").html(params.nodes);
                $("#Topology_host_selected_id").html(params.nodes);
                $("#Topology_host_selected_ip_host").html(clickedNode.options.ip_addr);
            } else {
                $("#Topology_host_selected_ip_host").html("");
            }
            // console.log("Heee, let's stay together - Select");
        });

        // add event listeners
        $(container).click(function(){
            // console.log("Heee, let's stay together - Main container - click");
            document.getElementById("ContextMenuTest_White").style.visibility = "hidden";
            document.getElementById("ContextMenuTest").style.visibility = "hidden";
            $("#ContextMenuTest").css("visibility", "hidden");
            $("#ContextMenuTest_White").css("visibility", "hidden");

            valueSelection = $("#Topology_host_selected_ip_host").html();
            
            if (valueSelection == ""){
                $(".btn_tracking_device").attr("disabled", "disabled");
            } else{
                $(".btn_tracking_device").removeAttr("disabled");
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

                valueSelection = document.getElementById('Topology_host_selected_ip_host').innerHTML;
                if (valueSelection == ""){
                    popupMenux = document.getElementById("ContextMenuTest_White");
                    // document.getElementById("btn_tracking_b2").setAttribute("disabled", "disabled");
                } else {
                    // document.getElementById("btn_tracking_b2").removeAttribute("disabled");
                    popupMenux = document.getElementById("ContextMenuTest");
                }

                var offsetX = e.offsetX;
                var offsetY = e.offsetY;

                if (e.target != this){ // 'this' is our HTMLElement
                    offsetX = e.target.offsetLeft + e.offsetX;
                    offsetY = e.target.offsetTop + e.offsetY;
                }

                // alert("X: " + offsetX + ", Y: " + offsetY);

                popupMenux.style.left = offsetX + 'px';
                popupMenux.style.top = offsetY + 'px';
                // popupMenux.style.left = getCoords.x - 272 + 'px';
                // popupMenux.style.top = getCoords.y - 132 + 'px';
                container.appendChild(popupMenux);
                $("#ContextMenuTest").css("visibility", "hidden");
                $("#ContextMenuTest_White").css("visibility", "hidden");
                
                popupMenux.style.visibility = "visible";
            e.preventDefault()
        }, false);
    }

</script>

<input type="hidden" style="float: right" id="ClickSondeoFinal" onclick="javascript: draw();" value="Cambiar panorama" />
<div id="mynetwork" style="width: 100%; height:470px;"></div>
<!-- <div ondblclick="javascript: draw();" id="mynetwork" style="width: 100%; height:470px;"></div> -->