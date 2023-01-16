const closeElementByButton = (buttonClosing, depthOfButton) => {
	
	if(buttonClosing) {
		
		let toHide = buttonClosing;
		
		for(i = 0; i < depthOfButton; ++i) {
			toHide = toHide.parentNode;
			if(!toHide) throw "there's not so many parent node as depth indicate"
		}
		
		if(!(toHide instanceof Element)) throw "invalid node to hide, it's not a Element";
		
		toHide.classList.add("hidden");
	} else {
		throw "invalid caller, must be not null";
	}
}
