//~ fixed-center-center flex-column-sparound-left
const showModal = (modalToShow) => {
	modalToShow.classList.remove("hidden");
	modalToShow.classList.add("fixed-center-center", "flex-column-sparound-left");
}

const fillModal = (divTextModal, plantInfos) => {
	divTextModal.innerHtml = `<img src='${plantInfos.path_picture}'
		alt='${plantInfos.botanical_name}' >`;
	console.log(divTextModal.innerHtml);
	console.log(divTextModal);
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
		fillModal(divTextModal, result[0])
		if(result.length > 1) console.warn("Plus d'une référence de plante a été trouvé!", result);
	}
	else
		"resultat non lisible";
	
	showModal(modal);
}
