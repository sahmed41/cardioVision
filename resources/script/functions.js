
// SSE

// const eventSource = new EventSource('_engine/notificaiton.php');

// eventSource.onmessage = function (event) {
//     const sseData = JSON.parse(event.data);
//     // Update your UI with the received data
//     document.getElementById('sse-data').textContent = sseData.message;
// };

// eventSource.close();

// Web Socket
// let socket = new WebSocket("ws://localhost:8080");

// socket.onopen = function(e) {
//     console.log("Connection established!");
// };

// socket.onmessage = function(event) {
//     document.getElementById('sse-data').textContent = event.data;
//     console.log("Received a message from the server: ", event.data);
// };

// AJAX Notification
// var number_of_new_reports = 0;
// setInterval(function() {
//     $.ajax({url: "_engine/notificaiton_2.php", success: function(result){
//         // $("#sse-data").html(result);
//         if (result > number_of_new_reports) {
//             Notification.requestPermission().then(perm => {
//                 if (perm === "granted" ) {
//                     new Notification("You have new reports to see")
//                 }
//             })
//         }
//         number_of_new_reports = result;
//     }});
// }, 1000);



