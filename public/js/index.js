//Initializing the slideshow
var slideshowContainer = document.getElementById('box');
let slideshow = new Slideshows(8, slideshowContainer);

//Launching the slideshow automation feature
slideshow.automaticAdvancement();

//Events related to the slideshow
document.getElementById("playButton").addEventListener("click", function (e) {
	slideshow.automaticAdvancement();
})
document.getElementById("previousButton").addEventListener("click", function (e) {
	slideshow.previousImage();
})
document.getElementById("nextButton").addEventListener("click", function (e) {
	slideshow.nextImage();
})
document.addEventListener("keydown", function (e) {
	if (e.keyCode == '37')
		slideshow.previousImage();
	if (e.keyCode == '39')
		slideshow.nextImage();
})