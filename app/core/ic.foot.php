<!-- Este es el fichero de pie de página, donde se insertan los scripts escritos en JS -->

<!-- jQuery -->
  <script src="app/controller/src/plugins/vendor/jquery/jquery-1.11.1.min.js"></script>
  <script src="app/controller/src/plugins/vendor/jquery/jquery_ui/jquery-ui.min.js"></script>

  <!-- CanvasBG Plugin(creates mousehover effect) -->
  <script src="app/controller/src/plugins/vendor/plugins/canvasbg/canvasbg.js"></script>

<!-- LazyLineSVG Plugin -->
  <script src="app/controller/src/plugins/vendor/plugins/lazyline/jquery.lazylinepainter-1.5.0.js"></script>

  <!-- Theme Javascript -->
  <script src="app/controller/src/plugins/assets/js/utility/utility.js"></script>
  <script src="app/controller/src/plugins/assets/js/demo/demo.js"></script>
  <script src="app/controller/src/plugins/assets/js/main.js"></script>
  <script src="app/controller/js/ic.script.js"></script>

  <!-- Page Javascript -->
  <script type="text/javascript">
  jQuery(document).ready(function() {

    "use strict";

    // Init Theme Core      
    Core.init();

    // Init Demo JS
    Demo.init();

    // Init CanvasBG and pass target starting location
    CanvasBG.init({
      Loc: {
        x: window.innerWidth / 2,
        y: window.innerHeight / 3.3
      },
    });

  });

    // Example animate buttons
    $('.btn').click(function() {
     
      $(this).addClass('item-checked');
      var animateVal = $(this).attr('data-test');
      testAnim(animateVal);
    });

    // Simply adds CSS classes required for animation
    // and then removes them after an elapsed time
    var animatedObj = $('#content');

    function testAnim(x) {
      $('body').addClass('animation-running');
      animatedObj.removeClass('fadeInLeft').addClass(x + " animated");

      animatedObj.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
        $('body').removeClass('animation-running');
        animatedObj.removeClass(x);
      });

    }
    $('#content').lazylinepainter({
      "svgData": pathObj,
      "strokeWidth": 3,
      "strokeColor": "#e09b99",
      "delay": 400,
      "onComplete": function() {
        $('body').addClass('svg-fill');
      }
    }).lazylinepainter('paint');
  </script>