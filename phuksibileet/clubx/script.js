const countdownEnd = new Date("2024-02-28T14:00:00+02:00")


function msToTime(duration) {
    if (duration < 0) return "reveal live @ Olkkari"
    var milliseconds = Math.floor((duration % 1000)).toString().padStart(3, '0')
      seconds = Math.floor((duration / 1000) % 60),
      minutes = Math.floor((duration / (1000 * 60)) % 60),
      hours = Math.floor(duration / (1000 * 60 * 60) % 24),
      days = Math.floor(duration / (1000 * 60 * 60*24));

  
    hours = (hours < 10) ? "0" + hours : hours;
    minutes = (minutes < 10) ? "0" + minutes : minutes;
    seconds = (seconds < 10) ? "0" + seconds : seconds;
    
    let dstr = days > 0 ? `${days}d ` : ''
  
    return dstr + hours + ":" + minutes + ":" + seconds;
  }
function updateCountdown() {
    const countdownElem = document.getElementById("countdown");
    if(!countdownElem) return
    countdownElem.textContent = msToTime(countdownEnd - new Date());
}
updateCountdown()

setInterval(updateCountdown, 12)