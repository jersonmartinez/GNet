// Init Ladda Plugin on buttons
// Ladda.bind('.ladda-button', {
//     timeout: 3000
// });

// Bind progress buttons and simulate loading progress. Still requires ".ladda-button" class.
Ladda.bind('.progress-button', {
    callback: function(instance) {
        StartTracking();

        var progress = 0;
        var interval = setInterval(function() {
            progress = Math.min(progress + Math.random() * 0.1, 1);
            instance.setProgress(progress);

            if ($("#retardo_temporal").html() != "..."){
                instance.stop();
                clearInterval(interval);
            }

            // if (progress === 1) {
            //     instance.stop();
            //     clearInterval(interval);
            // }
        }, 400);
    }
});

$('.admin-panels').adminpanel({
    grid: '.admin-grid', // set column class
    // draggable: true,
    preserveGrid: true,
    mobile: true,
    
    onFinish: function() {
        // On Init complete fadeIn adminpanel content
        $('.admin-panels').addClass('animated fadeIn').removeClass('fade-onload');
    },
});

// $('.creating-admin-panels').adminpanel({
//     grid: '.admin-grid',
//     draggable: false,
//     preserveGrid: true,
//     mobile: true,
//     // On AdminPanel Init complete we fade in the content. Optional
//     onFinish: function() {
//         $('.creating-admin-panels').addClass('animated fadeIn').removeClass('fade-onload');
//     },
//     // We trigger a window resize after a panel has been modified. This helps catch
//     // any plugins which may need to update after the panel was changed. Optional
//     // onSave: function() {
//     //     $(window).trigger('resize');
//     // }
// });

$('#mix-items-other').mixItUp();

// Inline
// $('#datetimepicker_test').datetimepicker({
//     defaultDate: "9/4/2014", 
//     inline: true
// });