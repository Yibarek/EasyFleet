<script>

// var x = setInterval(function() {
    @auth
    // Live Notifications for Admin
    @if (Auth::user()->role == 'admin')
    var xhttp0;
    xhttp0 = new XMLHttpRequest();
    xhttp0.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            uncheckedFeedback = JSON.parse(this.responseText);
            if (uncheckedFeedback.count > 9) {
                document.getElementById('notify_feedback').style.visibility = 'visible';
                document.getElementById('feedbacks').style.color = '#ffc451';
                document.getElementById('notify_feedback').innerHTML = '9+';
            } else if (uncheckedFeedback.count > 0) {
                document.getElementById('notify_feedback').style.visibility = 'visible';
                document.getElementById('feedbacks').style.color = '#ffc451';
                document.getElementById('notify_feedback').innerHTML = uncheckedFeedback.count;
            } else {
                document.getElementById('feedbacks').style.color = '#ffdca9';
                document.getElementById('notify_feedback').style.visibility = 'hidden';
            }
        }

    };
    var location_unF = "/countUncheckedFeedback";
    xhttp0.open("GET", location_unF, true);
    xhttp0.send();
    @endif

    // Live Notifications for Vehicle_Manager
    @if(Auth::user() -> role == 'Vehicle_Manager')
    var xhttp3;
    xhttp3 = new XMLHttpRequest();
    xhttp3.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            pendingMaintenance = JSON.parse(this.responseText);
            if (pendingMaintenance.count > 9) {
                document.getElementById('notify_maintenance').style.visibility = 'visible';
                document.getElementById('notify_maintenance').innerHTML = '9+';
            } else if (pendingMaintenance.count > 0) {
                document.getElementById('notify_maintenance').style.visibility = 'visible';
                document.getElementById('notify_maintenance').innerHTML = pendingMaintenance.count;
            } else {
                document.getElementById('notify_maintenance').style.visibility = 'hidden';
            }
        }

    };
    var location_maintenance = "/countPendingMaintenance";
    xhttp3.open("GET", location_maintenance, true);
    xhttp3.send();
    @endif

    // Live Notifications for Vehicle_Manager
    @if(Auth::user() -> role == 'Vehicle_Manager')
    var xhttp1;
    xhttp1 = new XMLHttpRequest();
    xhttp1.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            pendingRequest = JSON.parse(this.responseText);
            if (pendingRequest.count > 9) {
                document.getElementById('notify_request').style.visibility = 'visible';
                document.getElementById('notify_request').innerHTML = '9+';
            } else if (pendingRequest.count > 0) {
                document.getElementById('notify_request').style.visibility = 'visible';
                document.getElementById('notify_request').innerHTML = pendingRequest.count;
            } else {
                document.getElementById('notify_request').style.visibility = 'hidden';
            }
        }

    };
    var location1 = "/countPendingRequest";
    xhttp1.open("GET", location1, true);
    xhttp1.send();
    @endif

    @endauth

// }, 1000);

function mousemove(event){
    console.log("pageX: ",event.pageX,
    "pageY: ", event.pageY,
    "clientX: ", event.clientX,
    "clientY:", event.clientY);
    // notifiction();
}

window.addEventListener('mousemove', mousemove);

function notifiction() {
    @auth
    // Live Notifications for Admin
    @if (Auth::user()->role == 'admin')
    var xhttp0;
    xhttp0 = new XMLHttpRequest();
    xhttp0.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            uncheckedFeedback = JSON.parse(this.responseText);
            if (uncheckedFeedback.count > 9) {
                document.getElementById('notify_feedback').style.visibility = 'visible';
                document.getElementById('feedbacks').style.color = '#ffc451';
                document.getElementById('notify_feedback').innerHTML = '9+';
            } else if (uncheckedFeedback.count > 0) {
                document.getElementById('notify_feedback').style.visibility = 'visible';
                document.getElementById('feedbacks').style.color = '#ffc451';
                document.getElementById('notify_feedback').innerHTML = uncheckedFeedback.count;
            } else {
                document.getElementById('feedbacks').style.color = '#ffdca9';
                document.getElementById('notify_feedback').style.visibility = 'hidden';
            }
        }

    };
    var location_unF = "/countUncheckedFeedback";
    xhttp0.open("GET", location_unF, true);
    xhttp0.send();
    @endif

    // Live Notifications for Vehicle_Manager
    @if(Auth::user() -> role == 'Vehicle_Manager')
    var xhttp3;
    xhttp3 = new XMLHttpRequest();
    xhttp3.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            pendingMaintenance = JSON.parse(this.responseText);
            if (pendingMaintenance.count > 9) {
                document.getElementById('notify_maintenance').style.visibility = 'visible';
                document.getElementById('notify_maintenance').innerHTML = '9+';
            } else if (pendingMaintenance.count > 0) {
                document.getElementById('notify_maintenance').style.visibility = 'visible';
                document.getElementById('notify_maintenance').innerHTML = pendingMaintenance.count;
            } else {
                document.getElementById('notify_maintenance').style.visibility = 'hidden';
            }
        }

    };
    var location_maintenance = "/countPendingMaintenance";
    xhttp3.open("GET", location_maintenance, true);
    xhttp3.send();
    @endif

    // Live Notifications for Vehicle_Manager
    @if(Auth::user() -> role == 'Vehicle_Manager')
    var xhttp1;
    xhttp1 = new XMLHttpRequest();
    xhttp1.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            pendingRequest = JSON.parse(this.responseText);
            if (pendingRequest.count > 9) {
                document.getElementById('notify_request').style.visibility = 'visible';
                document.getElementById('notify_request').innerHTML = '9+';
            } else if (pendingRequest.count > 0) {
                document.getElementById('notify_request').style.visibility = 'visible';
                document.getElementById('notify_request').innerHTML = pendingRequest.count;
            } else {
                document.getElementById('notify_request').style.visibility = 'hidden';
            }
        }

    };
    var location1 = "/countPendingRequest";
    xhttp1.open("GET", location1, true);
    xhttp1.send();
    @endif

    @endauth

}
</script>
