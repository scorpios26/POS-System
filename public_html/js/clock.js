function showTime(){
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";
    
    if(h == 0){
        h = 12;
    }
    
    if(h > 12){
        h = h - 12;
        session = "PM";
    }
    
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    
    var time = h + ":" + m + ":" + s + " " + session;

    // Check if the element exists before updating
    var clockElement = document.getElementById("MyClockDisplay");
    if (clockElement) {
        clockElement.innerText = time;
        clockElement.textContent = time;
    } else {
        console.error("Element with id 'MyClockDisplay' not found.");
    }
    
    setTimeout(showTime, 1000);
}

// Run after DOM is ready
document.addEventListener("DOMContentLoaded", showTime);
