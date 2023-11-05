if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register('sw.js').then(registration => {
        console.log("SW Registered!");
        console.log(registration);
    }).catch(error => {
        console.log("SW Registered Failed!");
        console.log(error);
    })
}





// My notification
var number_of_new_reports = 0;
setInterval(function() {
    $.ajax({url: "_engine/notificaiton_2.php", success: function(result){
        // $("#sse-data").html(result);
        if (result > number_of_new_reports) {
            Notification.requestPermission().then(perm => {
                if (perm === "granted" ) {
                    new Notification("You have new reports to see")
                }
            })
        }
        number_of_new_reports = result;
    }});
}, 1000);


