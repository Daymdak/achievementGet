class Slideshows {
	constructor(numbImages, slideshowContainer) {
		this.numbImages = numbImages
		this.slideshowContainer = slideshowContainer
		this.currentPicture = numbImages
		this.slideshowState = 0
	}

	//Go to the next image of the slideshow
	nextImage() {
		if (this.currentPicture < this.numbImages)
			this.currentPicture = this.currentPicture + 1;
		else
			this.currentPicture = 1;
		this.slideshowContainer.innerHTML= "<img src=public/images/howItWorks/image"+[this.currentPicture]+".png>";
	}

	//Go to the previous image of the slideshow
	previousImage() {
		if (this.currentPicture < this.numbImages+1 && this.currentPicture>1)
			this.currentPicture = this.currentPicture - 1;
		else
			this.currentPicture = this.numbImages;
		this.slideshowContainer.innerHTML= "<img src=public/images/howItWorks/image"+[this.currentPicture]+".png>";
	}

	//Go to the next image of the slideshow automatically
	automaticAdvancement() {
		if (this.slideshowState === 0)
			this.slideshowState++;
		else
			this.slideshowState = 0;
		var myInterval = setInterval(function nextImageAutomatic() {
			if (slideshow.slideshowState === 1)
				slideshow.nextImage();
			else
				clearInterval(myInterval);
		}, 10000);
	}
}