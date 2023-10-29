// for easy future referencing
const canvas = document.querySelector(".product-slide");
const slideOver = document.querySelector("#slide-over");
canvas.height = window.innerHeight;
canvas.width = window.innerWidth;
const context = canvas.getContext("2d");
const frameCount = 115;

// Stores the images in an array for quick  access
const images = [];
const imgPath = () => {
	// At less than around 1100 pixels the desktop text overflows,
	// so switch to mobile (portrait) images
	return screen.availWidth > 1100
		? "short_desktop_img_sequence"
		: "short_mobile_img_sequence";
};

// Takes index of img as parameter, returns src of img
const getImgPath = (index) =>
	`assets/${imgPath()}/${index.toString().padStart(4, "0")}.webp`;

const wrapper = document.querySelector(".canvas-wrapper");
const canvasPos = wrapper.getBoundingClientRect().top;

// Returns the frame index (integer) based on scroll position
const getFrameIndex = () => {
	// Get size and position of canvas wrapper
	const sizes = wrapper.getBoundingClientRect();
	const scrollFraction = Math.max(
		0,
		(window.pageYOffset - canvasPos) / sizes.height
	);

	// Calculate frame index based on scroll position
	const frameIndex = Math.min(
		frameCount - 1,
		Math.floor(scrollFraction * frameCount)
	);
	return frameIndex;
};

preloadImages();

let img = new Image();

// Responsible for initial load
img.onload = () => {
	updateScaling();
	drawImage(img);
};

// Set source to 1st frame
img.src = getImgPath(getFrameIndex());

let scale, centerShift_x, centerShift_y;

// Calculate scale and img draw position
const updateScaling = () => {
	canvas.height = window.innerHeight;
	canvas.width = window.innerWidth;
	scale = Math.max(canvas.width / img.width, canvas.height / img.height);
	centerShift_x = (canvas.width - img.width * scale) / 2;
	centerShift_y = (canvas.height - img.height * scale) / 2;
};

// This is called separately at initial load so it's
// a standalone function
function drawImage(photo) {
	context.drawImage(
		photo,
		0,
		0,
		photo.width,
		photo.height,
		centerShift_x,
		centerShift_y,
		photo.width * scale,
		photo.height * scale
	);
}

// Render image uses requestAnimationFrame which causes minimal flicker
function renderImg(index = 0) {
	requestAnimationFrame(() => drawImage(images[index]));
}

const isVisible = () => {
	return slideOver.getBoundingClientRect().top >= 0;
};

addEventListener("scroll", () => {
	if (isVisible()) {
		renderImg(getFrameIndex());
	}
});

addEventListener("resize", () => {
	updateScaling();
	renderImg(getFrameIndex());
});

// Loads images into memory for faster access
function preloadImages() {
	for (let i = 0; i < frameCount; i++) {
		const img = new Image();
		img.src = getImgPath(i);
		images[i] = img;
	}
}
