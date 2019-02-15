// Bind progress buttons and simulate loading progress. Still requires ".ladda-button" class.
Ladda.bind('.btn_action_tn_effect', {
    callback: function(instance) {        
        // StartTracking();

        var progress = 0;
        var interval = setInterval(function() {
            progress = Math.min(progress + Math.random() * 0.1, 1);
            instance.setProgress(progress);

            if (($("#retardo_temporal").html() != "...")){
                instance.stop();
                clearInterval(interval);
            }

        }, 400);
    }
});