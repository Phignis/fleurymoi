<script>
	// get messages tabs 
	let errors = <?php echo json_encode($errors) ?>;
	let success = <?php echo json_encode($success) ?>;
	
	/*
	* create a paragraph containing the message, return element handler
	* 
	*/
	const createMessage = (content) => {
		let toReturn = document.createElement('p');
		toReturn.innerText = content;
		toReturn.classList.add("message");
		return toReturn;
	}
	
	if(errors.length || success.length) {
		// we have at least 1 message to display
		let messageSection = document.getElementById("messages");
		
		// message section is now visible at top right
		messageSection.classList.remove("hidden");
		messageSection.classList.add("fixed-top-right");
		
		/*
		* map synchronous, better than forEach in that case, we want to 
		* display next message after the last one
		*/
		errors.map((message, index) => {
			let para = createMessage(message);
			setTimeout(() => {
				para.classList.add("error");
				messageSection.appendChild(para);
				setTimeout(() => {
					para.classList.add("message-out");
					para.style.opacity = 0;
					setTimeout(() => {
						para.style.display = 'none';
					}, 350);
				}, 2000);
			}, 1800 * (index));
		});
		success.map((message, index) => {
			let para = createMessage(message);
			setTimeout(() => {
				para.classList.add("success");
				messageSection.appendChild(para);
				setTimeout(() => {
					para.classList.add("message-out");
					para.style.opacity = 0;
					setTimeout(() => {
						para.style.display = 'none';
					}, 350);
				}, 2000);
			}, 1800 * (index));
		});
		
		<?php
			// clean up arrays, to make sure to not display it again later during transaction
			// useful if we save arrays in $_SESSION for future display
			$errors = [];
			$success = [];
		 ?>
	}
</script>
