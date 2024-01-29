function updateDateTime() {
    var now = new Date();
    var dateString = now.toLocaleDateString(undefined, {year: 'numeric', month: 'long', day: 'numeric' });
    var timeString = now.toLocaleTimeString();
    document.getElementById('date-time-display').innerHTML = dateString + " " + timeString;
}

setInterval(updateDateTime, 100);