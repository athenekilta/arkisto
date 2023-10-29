const page = document.getElementById("slide-over");
const sizes = page.getBoundingClientRect();

function createParticles() {
	const particle = document.createElement("div");
	particle.classList.add("particle");
	particle.style.left = Math.random() * sizes.width + "px";
	particle.style.top = Math.random() * sizes.height + "px";

	page.appendChild(particle);

	setTimeout(() => {
		particle.remove();
	}, 10);
}

setInterval(() => {
	createParticles();
}, 10);
