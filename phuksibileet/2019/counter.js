var anno2kTime = new Date(2019, 2, 27, 21);
var counterGoal = anno2kTime;

onload = initialize;

function initialize() {
  var counter = setInterval(updateCounter, 500);
}

function timeDifference() {
  var currentTime = new Date();
  var currentSeconds = Math.floor(currentTime.getTime() / 1000);
  var goalSeconds = Math.floor(counterGoal.getTime() / 1000);
  return Math.max(goalSeconds - currentSeconds, 0);
}

function updateCounter() {
  var differenceString = ddhhmmss(timeDifference());
  document.getElementById("counter-wrapper").innerHTML = differenceString;
}

function ddhhmmss(seconds) {
  var s = seconds;
  var d = Math.floor(s / 86400);
  s = seconds - 86400 * d;
  var h = Math.floor(s / 3600);
  s -= 3600 * h;
  var m = Math.floor(s / 60);
  s -= m * 60;
  return (
    '<div class="counter-block"><div class="counter-value">' +
    zeroPadding(d) +
    '</div><div class="counter-description">' +
    "days" +
    '</div></div><div class="counter-block"><div class="counter-value">' +
    zeroPadding(h) +
    '</div><div class="counter-description">' +
    "hours" +
    '</div></div><div class="counter-block"><div class="counter-value">' +
    zeroPadding(m) +
    '</div><div class="counter-description">' +
    "minutes" +
    '</div></div><div class="counter-block"><div class="counter-value">' +
    zeroPadding(s) +
    '</div><div class="counter-description">' +
    "seconds"
    + '</div></div>'
  );
  function zeroPadding(i) {
    if (i.toString().length == 1) {
      return "0" + i;
    } else {
      return i;
    }
  }
}
