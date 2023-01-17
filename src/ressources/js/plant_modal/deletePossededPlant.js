const deletePossededPlant = async (buttonDeletion) => {
	let modal = buttonDeletion.closest("section#plant_modal");
	if(!modal) throw "modal non trouvée";
	
	let titleElt = modal.querySelector("div h3");
	if(!titleElt || !titleElt.innerText || titleElt.innerText == 0) throw "modal title (h3) not found or not filled";
	
	console.log(titleElt.innerText);
	
	let fetched = await fetch(
		"/config/config.php?" +
		new URLSearchParams({
			deletePossededPlant: true,
			botanical_name: titleElt.innerText,
		}),
		{
			method:"GET",
			credentials:"include",
		},
	);
	
	if(await fetched.json())
		location.reload();
	else
		displayMessages();
}
