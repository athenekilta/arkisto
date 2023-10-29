//Clock
const clock = document.querySelector("#clock");

// Congratz you found the date, your're so smart
const t0 = new Date(Date.parse("2023-03-30T00:00:00+02:00"));

// Updates the clock
const tick = () => {
	const timeNow = new Date();

	// Fixes time being of by time zone amount
	timeNow.setTime(
		timeNow.getTime() - new Date().getTimezoneOffset() * 60 * 1000
	);

	const clockTime = new Date(t0.getTime() - timeNow.getTime());

	// Yeah I don't know either, it's black magic
	if (clockTime.valueOf() > -7200000) {
		// Date needs -1 because "time 0" is 1st of Jan 1970, not 0th of Jan
		const dd = String(clockTime.getDate() - 1).padStart(2, "0");
		const hh = String(clockTime.getHours()).padStart(2, "0");
		const MM = String(clockTime.getMinutes()).padStart(2, "0");
		const ss = String(clockTime.getSeconds()).padStart(2, "0");
		const ms = String(clockTime.getMilliseconds()).padStart(3, "0");

		const display = dd + ":" + hh + ":" + MM + ":" + ss + ":" + ms;
		clock.innerHTML = display;
	} else {
		clock.innerHTML = "00:00:00:00:000";
	}
};

// Updates every 16 ms, or roughly 60 times per second to match the screen refresh rate
setInterval(tick, 16);
