const sendNewPossededPlant = async (formInfo, buttonToAnimate) => {	
	let selectPlant = formInfo.querySelector("#add_posseded_plant #add_posseded_plant_form select[name='plant_name']");
	let quantityInput = formInfo.querySelector("#add_posseded_plant #add_posseded_plant_form input[name='quantity']");
	
	if(!selectPlant || !quantityInput) throw "select for plant or input for quantity not found";
		
	let icon = document.createElement("span");
	icon.classList.add("material-icons");
	icon.innerText = "add";
	
	buttonToAnimate.animate([{ transform: 'rotate(0)' }, { transform: 'rotate(360deg)' }], 300);
	
	selectPlant.disabled = true;
	quantityInput.disabled = true;
	let oldColor = formInfo.style.backgroundColor;
	formInfo.style.backgroundColor = "grey";
	
	console.log(selectPlant.value);
	console.log(quantityInput.value);
	
	await addOrUpdatePlantOfUser(); // wait for add or update to make form disappears
	
	formInfo.classList.remove("padding-appears");
	formInfo.classList.add("right-hidden-padding");
	
	formInfo.style.backgroundColor = oldColor;
	buttonToAnimate.onclick = getNonPossededPlants;
	buttonToAnimate.innerText = "";
	buttonToAnimate.appendChild(icon);
	
	selectPlant.innerText = ""; // empty old available options
	quantityInput.value = "";
}

const getNonPossededPlants = async () => {
	
	// prefer long query rather than id, to indicate what are parents
	
	let formToDisplay = document.querySelector("#add_posseded_plant #add_posseded_plant_form");
	
	if(!formToDisplay) throw "form not found";
	
	let selectPlant = formToDisplay.querySelector("#add_posseded_plant #add_posseded_plant_form select[name='plant_name']");
	let quantityInput = formToDisplay.querySelector("#add_posseded_plant #add_posseded_plant_form input[name='quantity']");
	
	let button = document.querySelector("#add_posseded_plant #button_non_posseded");
	
	if(!selectPlant || !quantityInput || !button) throw "select for plant, input for quantity or button not found";
	
	let fetched = await fetch(
		"/config/config.php?" +
		new URLSearchParams({
			getNonPossededPlants: true,
		}),
		{
			method: "GET",
			credentials: "include",
		},
	);
	
	let listPlant = await fetched.json();
	
	if(listPlant && listPlant instanceof Array) {
		listPlant.forEach((plant) => {
			let option = document.createElement("option");
			option.value = `${plant.botanical_name}-${plant.name}`;
			option.innerText = `${plant.botanical_name.toUpperCase()}-${plant.name}`;
			selectPlant.appendChild(option);
		});
		
		formToDisplay.classList.remove("left-hidden-padding");
		formToDisplay.classList.add("padding-appears");
		
		selectPlant.disabled = false; // usable form
		quantityInput.disabled = false;
		
		let icon = document.createElement("span");
		icon.classList.add("material-icons");
		icon.innerText = "publish";
		
		button.animate([{ transform: 'rotate(0)' }, { transform: 'rotate(360deg)' }], 400);
		
		button.onclick = () => {sendNewPossededPlant(formToDisplay, button);}
		button.innerText = "";
		button.appendChild(icon);
		
	} else throw "invalid returned value from fetch: not array";
	
}
