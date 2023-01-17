//~ fixed-center-center flex-column-sparound-left
const showModal = (modalToShow) => {
	modalToShow.classList.remove("hidden");
	modalToShow.classList.add("fixed-center-center", "flex-column-sparound-left");
}

const fillModal = (divTextModal, plantInfos) => {
	let fDiv = document.createElement('div');
	fDiv.classList.add("basic_info", "flex-column-sparound-start");
	let sDiv = document.createElement('div');
	sDiv.classList.add("detailled_info", "flex-column-sparound-center");
	
	divTextModal.appendChild(fDiv);
	divTextModal.appendChild(sDiv);
	
	let img = document.createElement('img');
	img.src = plantInfos.path_picture;
	img.alt = plantInfos.botanical_name;
	img.classList.add("plant_picture");
	fDiv.appendChild(img);
	
	let pName = document.createElement('p');
	pName.innerText = "Nom: " + plantInfos.name;
	fDiv.appendChild(pName);
	
	let pFName = document.createElement('p');
	pFName.innerText = "Famille: " + plantInfos.family_name;
	fDiv.appendChild(pFName);
	
	let pFDescrip = document.createElement('p');
	pFDescrip.innerText = "Description de la famille: ";
	let span = document.createElement('span');
	span.classList.add('smaller_modal_text');
	span.innerText = plantInfos.description;
	pFDescrip.appendChild(span);
	
	fDiv.appendChild(pFDescrip);
	
	let dim = document.createElement('p');
	dim.innerText = "Dimensions (hxL): " + plantInfos.heigth + "x" + plantInfos.width + "m";
	fDiv.appendChild(dim);
	
	let flowering = document.createElement('p');
	flowering.innerText = "Floraison: " + plantInfos.flowering_period;
	sDiv.appendChild(flowering);
	
	let insolation = document.createElement('p');
	insolation.innerText = "Exposition: " + plantInfos.insolation;
	sDiv.appendChild(insolation);
	
	let land = document.createElement('p');
	land.innerText = "Terre: " + plantInfos.land;
	sDiv.appendChild(land);
	
	let watering = document.createElement('p');
	watering.innerText = "Arrosage: " + plantInfos.watering;
	sDiv.appendChild(watering);
	
	let sowingPeriod = document.createElement('p');
	sowingPeriod.innerText = "semis: " + plantInfos.sowing_period;
	sDiv.appendChild(sowingPeriod);
	
	let plantingPeriod = document.createElement('p');
	plantingPeriod.innerText = "Période de plantation: " + plantInfos.planting_period;
	sDiv.appendChild(plantingPeriod);
	
	let form = document.createElement('form');
	form.classList.add("form_plant");
	sDiv.appendChild(form);
	
	let quantity = document.createElement('input');
	console.log(quantity);
	quantity.name = 'quantity';
	quantity.type = 'number';
	quantity.value = plantInfos.quantity;
	quantity.placeholder = 'quantité';
	quantity.size = 5;
	quantity.min = 1;
	quantity.max = 99999;
	quantity.style.textAlign = "center";
	form.appendChild(quantity);
}

const showDetailledInfoOfPlant = async (botanicalName) => {
	let modal = document.getElementById("plant_modal");
	
	if(!modal) throw "modal non trouvée";
	
	let modalTitle = modal.getElementsByTagName('h3')[0];
	
	let divTextModal = modal.querySelector('div#modal_content');
	
	if(!modalTitle) {
		modalTitle = document.createElement('h3');
		if(modal.firstChild) // insert before need a not null reference node
			modal.insertBefore(modalTitle, modal.firstChild);
		else // no child node, just append
			modal.appendChild(modalTitle);
	}
	
	if(!divTextModal) {
		divTextModal = document.createElement('div');
		divTextModal.classList.add('modal_content');
		modal.appendChild(divTextModal);
	}
	
	let fetched = await fetch(
		"/config/config.php?" +
		new URLSearchParams({
			getPlant: true,
			botanical_name: botanicalName,
		}),
		{
			method: "GET",
			credentials: "include",
		}
	);
	
	let result = await fetched.json();
	
	displayMessages();
	modalTitle.innerText = botanicalName;
	
	
	if(result == false || !result ) 
		divTextModal.innerText = "Email ou nom botanique non trouvé en base de données. impossible de trouver les informations";
	else if(result && result instanceof Array && result.length > 0) {
		divTextModal.innerText = ""; // erase content first
		fillModal(divTextModal, result[0])
		if(result.length > 1) console.warn("Plus d'une référence de plante a été trouvé!", result);
	}
	else
		"resultat non lisible";
	
	showModal(modal);
}
