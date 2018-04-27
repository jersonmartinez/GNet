<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="object_four"></div>
            <div class="object" id="object_three"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_one"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(window).load(function() {
        setTimeout(function(){
            $("#loading").fadeOut(500);
        }, 300);
    })
</script>