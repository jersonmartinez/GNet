<!-- Este es el fichero de pie de página, donde se insertan los scripts escritos en JS -->

<script src="<?php echo PDS_SRC_PLUGINS_VENDOR_JQ; ?>/jquery-1.11.1.min.js"></script>
<script src="<?php echo PDS_SRC_PLUGINS_VENDOR_JQ; ?>/jquery_ui/jquery-ui.min.js"></script>

<!-- CanvasBG Plugin(creates mousehover effect) -->
<script src="<?php echo PDS_SRC_PLUGINS_VENDOR_PLUGINS; ?>/canvasbg/canvasbg.js"></script>

<!-- LazyLineSVG Plugin -->
<script src="<?php echo PDS_SRC_PLUGINS_VENDOR_PLUGINS; ?>/lazyline/jquery.lazylinepainter-1.5.0.js"></script>

<!-- HighCharts Plugin -->
<script src="<?php echo PDS_SRC_PLUGINS_VENDOR_PLUGINS; ?>/highcharts/highcharts.js"></script>
<script src="<?php echo PDS_SRC_PLUGINS_VENDOR_PLUGINS; ?>/highcharts/exporting.js"></script>
<script src="<?php echo PDS_SRC_PLUGINS_VENDOR_PLUGINS; ?>/highcharts/highcharts-3d.js"></script>
<script src="<?php echo PDS_SRC_PLUGINS_VENDOR_PLUGINS; ?>/highcharts/solid-gauge.js"></script>
<script src="<?php echo PDS_SRC_PLUGINS_VENDOR_PLUGINS; ?>/highcharts/highcharts-more.js"></script>

<!-- PNotify -->
<script src="<?php echo PDS_SRC_PLUGINS_VENDOR_PLUGINS; ?>/pnotify/pnotify.js"></script>

<!-- Theme Javascript -->
<script src="<?php echo PDS_SRC_PLUGINS_ASSETS_JS; ?>/utility/utility.js"></script>
<script src="<?php echo PDS_SRC_PLUGINS_ASSETS_JS; ?>/demo/demo.js"></script>
<script src="<?php echo PDS_SRC_PLUGINS_ASSETS_JS; ?>/main.js"></script>

<!-- Editable -->
<script src="<?php echo PDS_SRC_PLUGINS_VENDOR_PLUGINS; ?>/moment/moment.min.js"></script>
<script src="<?php echo PDS_SRC_PLUGINS_VENDOR_PLUGINS; ?>/xeditable/js/bootstrap-editable.min.js"></script>

<!-- Esta libreria es para el efecto de carga, es necesaria su version en css, esta en el archivo ic.head.php o bien, a la constante: PF_CORE_HEAD-->
<script src="<?php echo PDS_SRC_PLUGINS_VENDOR_PLUGINS; ?>/ladda/ladda.min.js"></script> 

<!-- Progressbar -->
<script src="<?php echo PDS_SRC_PLUGINS_VENDOR_PLUGINS; ?>/nprogress/nprogress.js"></script> 

<!-- Ordenar espacios (dispositivos en la filosofia del proyecto) -->
<script src="<?php echo PDS_SRC_PLUGINS_VENDOR_PLUGINS; ?>/mixitup/jquery.mixitup.min.js"></script>

<!-- <script src="app/controller/src/plugins/vendor/plugins/datepicker/js/bootstrap-datetimepicker.min.js"></script> -->
<script src="<?php echo PDS_SRC_PLUGINS_VENDOR_PLUGINS; ?>/datatables/media/js/jquery.dataTables.min.js"></script>

<script src="<?php echo PDS_SRC_PLUGINS_VENDOR_PLUGINS; ?>/highlight/highlight.pack.js"></script> 

<!-- Widget Javascript -->
<script src="<?php echo PDS_SRC_PLUGINS_ASSETS_JS; ?>/demo/widgets.js"></script>


<!-- Importants Scripts -->
<script src="<?php echo PDS_CTL_JS; ?>/ic.script.js"></script>
<script src="<?php echo PDS_DESKTOP_ROOT_JS; ?>/ic.RootScript.js"></script>

<!-- <script src="app/controller/src/plugins/vendor/plugins/datepicker/js/bootstrap-datetimepicker.min.js"></script>  -->
<!-- JvectorMap Plugin + US Map (more maps in plugin/assets folder) -->
<!--   <script src="app/controller/src/plugins/vendor/plugins/jvectormap/jquery.jvectormap.min.js"></script>
<script src="app/controller/src/plugins/vendor/plugins/jvectormap/assets/jquery-jvectormap-us-lcc-en.js"></script>  -->

<!-- FullCalendar Plugin + moment Dependency -->
<!-- <script src="app/controller/src/plugins/vendor/plugins/fullcalendar/lib/moment.min.js"></script> -->
<script src="app/controller/src/plugins/vendor/plugins/fullcalendar/fullcalendar.min.js"></script>

<script src="app/controller/src/plugins/vendor/plugins/typeahead/typeahead.bundle.min.js"></script>

<script src="app/controller/src/plugins/vendor/plugins/bstour/bootstrap-tour.js"></script>

<script type="text/javascript">

jQuery(document).ready(function() {
    "use strict";

    // Init Demo JS  
    Demo.init();
 
    // Init Theme Core    
    Core.init({
      collapse: "sb-l-c", // sidebar left collapse style
    });

    $('#xedit-basssjsjsic').editable({
        type: 'text',
        pk: 3,
        name: 'editable-33',
        title: 'Editable Data'
    });

    // A "stack" controls the direction and position
    // of a notification. Here we create an array w
    // with several custom stacks that we use later
    var Stacks = {
      stack_top_right: {
        "dir1": "down",
        "dir2": "left",
        "push": "top",
        "spacing1": 10,
        "spacing2": 10
      },
      stack_top_left: {
        "dir1": "down",
        "dir2": "right",
        "push": "top",
        "spacing1": 10,
        "spacing2": 10
      },
      stack_bottom_left: {
        "dir1": "right",
        "dir2": "up",
        "push": "top",
        "spacing1": 10,
        "spacing2": 10
      },
      stack_bottom_right: {
        "dir1": "left",
        "dir2": "up",
        "push": "top",
        "spacing1": 10,
        "spacing2": 10
      },
      stack_bar_top: {
        "dir1": "down",
        "dir2": "right",
        "push": "top",
        "spacing1": 0,
        "spacing2": 0
      },
      stack_bar_bottom: {
        "dir1": "up",
        "dir2": "right",
        "spacing1": 0,
        "spacing2": 0
      },
      stack_context: {
        "dir1": "down",
        "dir2": "left",
        "context": $("#stack-context")
      },
    }

    // PNotify Plugin Event Init
    $('.notification').on('click', function(e) {
      var noteStyle = $(this).data('data-note-style');
      var noteShadow = $(this).data('note-shadow');
      var noteOpacity = $(this).data('note-opacity');
      var noteStack = $(this).data('note-stack');
      var width = "290px";
      var title_sm = $("#title_sm").val();
      var content_sm = $("#content_sm").val();

      // If notification stack or opacity is not defined set a default
      var noteStack = noteStack ? noteStack : "stack_top_right";
      var noteOpacity = noteOpacity ? noteOpacity : "1";

      // We modify the width option if the selected stack is a fullwidth style
      function findWidth() {
        if (noteStack == "stack_bar_top") {
          return "100%";
        }
        if (noteStack == "stack_bar_bottom") {
          return "70%";
        } else {
          return "290px";
        }
      }

      // Create new Notification
      new PNotify({
        title: title_sm,
        text: content_sm,
        shadow: noteShadow,
        opacity: noteOpacity,
        addclass: noteStack,
        type: noteStyle,
        stack: Stacks[noteStack],
        width: findWidth(),
        delay: 1400, 
        success_icon: 'glyphicon glyphicon-ok-sign' 
      });

    });

    // Init Widget Demo JS
    // demoHighCharts.init();

    // Because we are using Admin Panels we use the OnFinish 
    // callback to activate the demoWidgets. It's smoother if
    // we let the panels be moved and organized before 
    // filling them with content from various plugins

    // Init plugins used on this page
    // HighCharts, JvectorMap, Admin Panels

    <?php
        if (basename($_SERVER['SCRIPT_NAME']) == "index.php"){
            ?>
                // $(".AdminPanel_DevicesManagement").addClass('animated fadeOut').hide();
                // $(".AdminPanel_TrackingNetwork").addClass('animated fadeOut').hide();
            <?php
        }
    ?>

     // Init Admin Panels on widgets inside the ".admin-panels" container
        $('.AdminPanel_TrackingNetwork').adminpanel({
            grid: '.admin-grid', // set column class
            // draggable: true,
            // preserveGrid: true,
            mobile: true,
            
            onFinish: function() {
                // On Init complete fadeIn adminpanel content
                $('.AdminPanel_TrackingNetwork').addClass('animated fadeIn').removeClass('fade-onload');
            },
        });

        //Sugerencias
          // Init Twitter Typeahead.js
          var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
              var matches, substrRegex;

              // an array that will be populated with substring matches
              matches = [];

              // regex used to determine if a string contains the substring `q`
              substrRegex = new RegExp(q, 'i');

              // iterate through the pool of strings and for any string that
              // contains the substring `q`, add it to the `matches` array
              $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                  // the typeahead jQuery plugin expects suggestions to a
                  // JavaScript object, refer to typeahead docs for more info
                  matches.push({
                    value: str
                  });
                }
              });

              cb(matches);
            };
          };

          // Define List

          <?php
            $getAllHost = $CN_Global->getAllHost();
            $getAllNet  = $CN_Global->getIPNet();


            if ($getAllHost->num_rows > 0 && $getAllNet->num_rows > 0){
                while ($list_host = $getAllHost->fetch_array(MYSQLI_ASSOC))
                    $ADM_ListData_Host[] = $list_host['ip_host'];

                while ($list_net = $getAllNet->fetch_array(MYSQLI_ASSOC))
                    $ADM_ListData_Net[] = $list_net['ip_net'];

                ?>
                    var ADM_ListData_Host = [<?php echo '"'.implode('","', $ADM_ListData_Host).'"' ?>];
                    var ADM_ListData_Net = [<?php echo '"'.implode('","', $ADM_ListData_Net).'"' ?>];
                <?php
            } else {
                ?>
                    var ADM_ListData_Host = ['No hay dispositivos'];
                    var ADM_ListData_Net = ['No hay redes'];
                <?php
            }
          ?>

          // Init Typeahead
          $('.ADM_TB_IPHost').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
          }, {
            name: 'ADM_ListData_Host',
            displayKey: 'value',
            source: substringMatcher(ADM_ListData_Host)
          });

          $('.ADM_TB_IPNet').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
          }, {
            name: 'ADM_ListData_Net',
            displayKey: 'value',
            source: substringMatcher(ADM_ListData_Net)
          });

          // Create Tour steps
          var tour = new Tour({
            backdrop: true, // can mask content in a modal
            steps: [
              {
                element: "#tour-item1", // item selector
                title: "Tour item title!", // title
                content: "I'm the content", // content
                placement: 'top' // left, right, top, bottom
              },
            ]
          });

          // Start Tour on click
          $('#tour_start').on('click',function(){
              tour.restart();
          });

        // $('.admin-panels2').adminpanel({
        //     grid: '.admin-grid2', // set column class
        //     onFinish: function() {
        //         // On Init complete fadeIn adminpanel content
        //         $('.admin-panels2').addClass('animated fadeIn').removeClass('fade-onload');
        //     },
        // });

    // Init Admin Panels on widgets inside the ".admin-panels" container
    // $('.admin-panels').adminpanel({
    //   grid: '.admin-grid',
    //   draggable: false,
    //   preserveGrid: true,
    //   mobile: true,

    //   onStart: function() {
    //     // Do something before AdminPanels runs
    //   },
    //   onFinish: function() {
    //     $('.admin-panels').addClass('animated fadeIn').removeClass('fade-onload');

    //     // Init the rest of the plugins now that the panels
    //     // have had a chance to be moved and organized.
    //     // It's less taxing to organize empty panels
    //     demoHighCharts.init();
    //     runVectorMaps(); // function below
    //   },
    //   onRemove: function(panel) {
    //     var pID = $(panel).attr('id');
    //     console.log(pID);
    //   }
    // });


    // Init plugins for ".calendar-widget"
    // plugins: FullCalendar
    //
    $('#calendar-widget').fullCalendar({
      // contentHeight: 397,
      editable: true,
      events: [{
          title: 'Sony Meeting',
          start: '2015-08-1',
          end: '2015-08-3',
          className: 'fc-event-success',
        }, {
          title: 'Conference',
          start: '2015-08-11',
          end: '2015-08-13',
          className: 'fc-event-warning'
        }, {
          title: 'Lunch Testing',
          start: '2015-08-21',
          end: '2015-08-23',
          className: 'fc-event-primary'
        },
      ],
      eventRender: function(event, element) {
        // create event tooltip using bootstrap tooltips
        $(element).attr("data-original-title", event.title);
        $(element).tooltip({
          container: 'body',
          delay: {
            "show": 100,
            "hide": 200
          }
        });
        // create a tooltip auto close timer  
        $(element).on('show.bs.tooltip', function() {
          var autoClose = setTimeout(function() {
            $('.tooltip').fadeOut();
          }, 3500);
        });
      }
    });


    // Init plugins for ".task-widget"
    // plugins: Custom Functions + jQuery Sortable
    //
    var taskWidget = $('div.task-widget');
    var taskItems = taskWidget.find('li.task-item');
    var currentItems = taskWidget.find('ul.task-current');
    var completedItems = taskWidget.find('ul.task-completed');

    // Init jQuery Sortable on Task Widget
    taskWidget.sortable({
      items: taskItems, // only init sortable on list items (not labels)
      handle: '.task-menu',
      axis: 'y',
      connectWith: ".task-list",
      update: function( event, ui ) {
        var Item = ui.item;
        var ParentList = Item.parent();

        // If item is already checked move it to "current items list"
        if (ParentList.hasClass('task-current')) {
            Item.removeClass('item-checked').find('input[type="checkbox"]').prop('checked', false);
        }
        if (ParentList.hasClass('task-completed')) {
            Item.addClass('item-checked').find('input[type="checkbox"]').prop('checked', true);
        }

      }
    });

    // Custom Functions to handle/assign list filter behavior
    taskItems.on('click', function(e) {
      e.preventDefault();
      var This = $(this);
      var Target = $(e.target);

      if (Target.is('.task-menu') && Target.parents('.task-completed').length) {
        This.remove();
        return;
      }

      if (Target.parents('.task-handle').length) {
          // If item is already checked move it to "current items list"
          if (This.hasClass('item-checked')) {
            This.removeClass('item-checked').find('input[type="checkbox"]').prop('checked', false);
          }
          // Otherwise move it to the "completed items list"
          else {
            This.addClass('item-checked').find('input[type="checkbox"]').prop('checked', true);
          }
      }

    });


    var highColors = [bgSystem, bgSuccess, bgWarning, bgPrimary];

    // Chart data
    var seriesData = [{
      name: 'Phones',
      data: [5.0, 9, 17, 22, 19, 11.5, 5.2, 9.5, 11.3, 15.3, 19.9, 24.6]
    }, {
      name: 'Notebooks',
      data: [2.9, 3.2, 4.7, 5.5, 8.9, 12.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
    }, {
      name: 'Desktops',
      data: [15, 19, 22.7, 29.3, 22.0, 17.0, 23.8, 19.1, 22.1, 14.1, 11.6, 7.5]
    }, {
      name: 'Music Players',
      data: [11, 6, 5, 15, 17.0, 22.0, 30.8, 24.1, 14.1, 11.1, 9.6, 6.5]
    }];

    var ecomChart = $('#ecommerce_chart1');
    if (ecomChart.length) {
      ecomChart.highcharts({
        credits: false,
        colors: highColors,
        chart: {
          backgroundColor: 'transparent',
          className: '',
          type: 'line',
          zoomType: 'x',
          panning: true,
          panKey: 'shift',
          marginTop: 45,
          marginRight: 1,
        },
        title: {
          text: null
        },
        xAxis: {
          gridLineColor: '#EEE',
          lineColor: '#EEE',
          tickColor: '#EEE',
          categories: ['Jan', 'Feb', 'Mar', 'Apr',
            'May', 'Jun', 'Jul', 'Aug',
            'Sep', 'Oct', 'Nov', 'Dec'
          ]
        },
        yAxis: {
          min: 0,
          tickInterval: 5,
          gridLineColor: '#EEE',
          title: {
            text: null,
          }
        },
        plotOptions: {
          spline: {
            lineWidth: 3,
          },
          area: {
            fillOpacity: 0.2
          }
        },
        legend: {
          enabled: true,
          floating: false,
          align: 'right',
          verticalAlign: 'top',
          x: -15
        },
        series: seriesData
      });
    }

    // Widget VectorMap
    function runVectorMaps() {

      // Jvector Map Plugin
      var runJvectorMap = function() {
        // Data set
        var mapData = [900, 700, 350, 500];
        // Init Jvector Map
        $('#WidgetMap').vectorMap({
          map: 'us_lcc_en',
          //regionsSelectable: true,
          backgroundColor: 'transparent',
          series: {
            markers: [{
              attribute: 'r',
              scale: [3, 7],
              values: mapData
            }]
          },
          regionStyle: {
            initial: {
              fill: '#E8E8E8'
            },
            hover: {
              "fill-opacity": 0.3
            }
          },
          markers: [{
            latLng: [37.78, -122.41],
            name: 'San Francisco,CA'
          }, {
            latLng: [36.73, -103.98],
            name: 'Texas,TX'
          }, {
            latLng: [38.62, -90.19],
            name: 'St. Louis,MO'
          }, {
            latLng: [40.67, -73.94],
            name: 'New York City,NY'
          }],
          markerStyle: {
            initial: {
              fill: '#a288d5',
              stroke: '#b49ae0',
              "fill-opacity": 1,
              "stroke-width": 10,
              "stroke-opacity": 0.3,
              r: 3
            },
            hover: {
              stroke: 'black',
              "stroke-width": 2
            },
            selected: {
              fill: 'blue'
            },
            selectedHover: {}
          },
        });
        // Manual code to alter the Vector map plugin to 
        // allow for individual coloring of countries
        var states = ['US-CA', 'US-TX', 'US-MO',
          'US-NY'
        ];
        var colors = [bgInfo, bgPrimaryLr, bgSuccessLr, bgWarningLr];
        var colors2 = [bgInfo, bgPrimary, bgSuccess, bgWarning];
        $.each(states, function(i, e) {
          $("#WidgetMap path[data-code=" + e + "]").css({
            fill: colors[i]
          });
        });
        $('#WidgetMap').find('.jvectormap-marker')
          .each(function(i, e) {
            $(e).css({
              fill: colors2[i],
              stroke: colors2[i]
            });
          });
      }

      if ($('#WidgetMap').length) {
        runJvectorMap();
      }
    }

  });
  </script>
  <!-- END: PAGE SCRIPTS
  
  <script type="text/javascript">
  // jQuery(document).ready(function() {

  //   "use strict";

  //   // Init Theme Core      
  //   Core.init();

  //   // Init Demo JS
  //   Demo.init();

  //   // Init CanvasBG and pass target starting location
  //   CanvasBG.init({
  //     Loc: {
  //       x: window.innerWidth / 2,
  //       y: window.innerHeight / 3.3
  //     },
  //   });

  // });

    // Example animate buttons
    // $('.btn').click(function() {
     
    //   $(this).addClass('item-checked');
    //   var animateVal = $(this).attr('data-test');
    //   testAnim(animateVal);
    // });

    // Simply adds CSS classes required for animation
    // and then removes them after an elapsed time
    // var animatedObj = $('#content');

    // function testAnim(x) {
    //   $('body').addClass('animation-running');
    //   animatedObj.removeClass('fadeInLeft').addClass(x + " animated");

    //   animatedObj.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
    //     $('body').removeClass('animation-running');
    //     animatedObj.removeClass(x);
    //   });

    // }
    // $('#content').lazylinepainter({
    //   "svgData": pathObj,
    //   "strokeWidth": 3,
    //   "strokeColor": "#e09b99",
    //   "delay": 400,
    //   "onComplete": function() {
    //     $('body').addClass('svg-fill');
    //   }
    // }).lazylinepainter('paint');
