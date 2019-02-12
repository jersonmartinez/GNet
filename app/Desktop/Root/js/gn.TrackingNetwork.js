// Init Ladda Plugin on buttons
// Ladda.bind('.ladda-button', {
//     timeout: 3000
// });

// Bind progress buttons and simulate loading progress. Still requires ".ladda-button" class.
Ladda.bind('.btn_action_tn_effect', {
    callback: function(instance) {        
        // StartTracking();

        var progress = 0;
        var interval = setInterval(function() {
            progress = Math.min(progress + Math.random() * 0.1, 1);
            instance.setProgress(progress);

            if ( ($("#retardo_temporal").html() != "...") ){
                instance.stop();
                clearInterval(interval);
            }

        }, 400);
    }
});

// $('#mix-items-other').mixItUp();

// Inline
// $('#datetimepicker_test').datetimepicker({
//     defaultDate: "9/4/2014", 
//     inline: true
// });