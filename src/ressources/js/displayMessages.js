/*
* create a paragraph containing the message, return element handler
*/
const createMessage = (content) => {
	let toReturn = document.createElement('p');
	toReturn.innerText = content;
	toReturn.classList.add("message");
	return toReturn;
}

/*
 * make a sleep with promise returned
 */
const sleepTimeout = (msTimeout) => {
	return new Promise((resolve) => {
		setTimeout(resolve, msTimeout);
		// not resolve("message") cause it cause resolve to be evaluated
	});
}

const printMessagesInHtml = (errors, success) => {
	if(errors.length || success.length) {
		// we have at least 1 message to display
		let messageSection = document.getElementById("messages");
		
		// message section is now visible at top right
		messageSection.classList.remove("hidden");
		messageSection.classList.add("fixed-top-right");
		
		let anims = errors.map(async (message, index) => {
			let para = createMessage(message);
			para.classList.add("error");
			/*
			* add message to display after last one almost start to slide
			* out of screen
			*/
			await sleepTimeout(1800 * index);
			messageSection.appendChild(para);
			await sleepTimeout(2000); // let message 2s
			para.classList.add("message-out");
			para.style.opacity = 0;
			await sleepTimeout(350);
			para.style.display = 'none';
		});
		
		// when all anims are finished, start success ones
		Promise.all(anims).then(() => {
			success.map(async (message, index) => {
				let para = createMessage(message);
				para.classList.add("success");
				/*
				* add message to display after last one almost start to slide
				* out of screen
				*/
				await sleepTimeout(1800 * index);
				messageSection.appendChild(para);
				await sleepTimeout(2000); // let message 2s
				para.classList.add("message-out");
				para.style.opacity = 0;
				await sleepTimeout(350);
				para.style.display = 'none';
			});
		});
	}
}

const getMessagesPhp = async () => {
	let fetched = await fetch(
		"/programmation/menu.php?" +
		new URLSearchParams({
			fetchMessages: true,
		}),
		{
			method: "GET",
			credentials: "include",
		}
	);
	
	return await fetched.json();
}

const displayMessages = async () => {
	let result = await getMessagesPhp();

	printMessagesInHtml(result[0], result[1]);
}

displayMessages();
